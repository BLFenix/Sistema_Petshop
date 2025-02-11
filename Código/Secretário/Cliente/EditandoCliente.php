<?php
include_once '../../Conexao.php';

$Id_Secretario = null;
if(isset($_POST['Id_Secretario'])) {
    $Id_Secretario = $_POST['Id_Secretario'];
}

$Id = null;
if(isset($_POST['Id'])) {
    $Id = $_POST['Id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Seção de validação e processamento de dados do formulário
    
    // Verificar se todos os campos obrigatórios foram preenchidos
    $Campos_Obrigatorios = array('Id', 'CPF', 'Nome', 'Sexo', 'DataNasc', 'Telefone', 'Email', 'Rua', 'Numero', 'Bairro', 'Cidade', 'Estado', 'CEP','Endereco_Id', 'Id_Secretario');
    $Campos_Faltando = array();

    foreach ($Campos_Obrigatorios as $Campo) {
        if (empty($_POST[$Campo])) {
            $Campos_Faltando[] = $Campo;
        }
    }

    if (!empty($Campos_Faltando)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $Campos_Faltando) . "');</script>";
        echo "<script>window.location.href = 'EditarCliente.php?Id=$Id&Id_Secretario=$Id_Secretario';</script>";
        exit;
    }

    // Atribuir valores dos campos do formulário a variáveis
    $Id = $_POST['Id'];
    $CPF = $_POST['CPF'];
    $Nome = $_POST['Nome'];
    $Sexo = $_POST['Sexo'];
    $DataNasc = $_POST['DataNasc'];
    $Telefone = $_POST['Telefone'];
    $Email = $_POST['Email'];
    $Endereco_Id = $_POST['Endereco_Id'];
    $Rua = $_POST['Rua'];
    $Numero = $_POST['Numero'];
    $Complemento = $_POST['Complemento'];
    $Bairro = $_POST['Bairro'];
    $Cidade = $_POST['Cidade'];
    $Estado = $_POST['Estado'];
    $CEP = $_POST['CEP'];

    // Verificar se a data de nascimento é válida
    $DataNasc_timestamp = strtotime($DataNasc);
    $DataMaxima = strtotime('-200 years');
    $IdadeMinima = strtotime('-18 years');
    $DataAtual = time();

    if ($DataNasc_timestamp > $DataAtual) {
        echo "<script>alert('A data de nascimento não pode ser no futuro.');</script>";
        echo "<script>window.location.href = 'EditarCliente.php?Id=$Id&Id_Secretario=$Id_Secretario';</script>";
        exit;
    } elseif ($DataNasc_timestamp < $DataMaxima) {
        echo "<script>alert('A data de nascimento está muito distante.');</script>";
        echo "<script>window.location.href = 'EditarCliente.php?Id=$Id&Id_Secretario=$Id_Secretario';</script>";
        exit;
    } elseif ($DataNasc_timestamp > $IdadeMinima) {
        echo "<script>alert('O cliente tem que ser maior de idade.');</script>";
        echo "<script>window.location.href = 'EditarCliente.php?Id=$Id&Id_Secretario=$Id_Secretario';</script>";
        exit;
    }

    $SQL_Telefone = "SELECT Telefone FROM clientes WHERE Id = $Id";
    $stmt_telefone = $BD->query($SQL_Telefone);
    $Telefone_Antigo_row = $stmt_telefone->fetch_assoc();
    $Telefone_Antigo = $Telefone_Antigo_row ? $Telefone_Antigo_row['Telefone'] : null;

    if ($Telefone_Antigo != $Telefone) {
        $SQL_Verificar_Telefone = "SELECT COUNT(*) AS Total FROM clientes WHERE Telefone = '$Telefone'  AND Id != $Id";
        $Resultado_Verificar_Telefone = $BD->query($SQL_Verificar_Telefone);
        $Dados_Verificar_Telefone = $Resultado_Verificar_Telefone->fetch_assoc();
        if ($Dados_Verificar_Telefone['Total'] > 0) {
            echo "<script>alert('Já existe um secretário cadastrado com o telefone informado. Por favor, verifique o telefone e refaça a edição.');</script>";
            echo "<script>window.location.href = 'EditarCliente.php?Id=$Id&Id_Secretario=$Id_Secretario';</script>";
            exit;
        }
    }

    $SQL_Email = "SELECT Email FROM clientes WHERE Id = $Id";
    $stmt_email = $BD->query($SQL_Email);
    $Email_Antigo_row = $stmt_email->fetch_assoc();
    $Email_Antigo = $Email_Antigo_row ? $Email_Antigo_row['Email'] : null;

    if ($Email_Antigo != $Email) {
        $SQL_Verificar_Email = "SELECT COUNT(*) AS Total FROM clientes WHERE Email = '$Email' AND Id != $Id";
        $Resultado_Verificar_Email = $BD->query($SQL_Verificar_Email);
        $Dados_Verificar_Email = $Resultado_Verificar_Email->fetch_assoc();
        if ($Dados_Verificar_Email['Total'] > 0) {
            echo "<script>alert('Email já cadastrado em outro secretário. Por favor, insira um Email único!');</script>";
            echo "<script>window.location.href = 'EditarCliente.php?Id=$Id&Id_Secretario=$Id_Secretario';</script>";
            exit;
        }
    }

    echo "<script>";
    echo "console.log('Id:', $Id);";
    echo "console.log('CPF:', '$CPF');";
    echo "console.log('Sexo:', '$Sexo');";
    echo "console.log('Nome:', '$Nome');";
    echo "console.log('DataNasc:', '$DataNasc');";
    echo "console.log('Telefone:', '$Telefone');";
    echo "console.log('Email:', '$Email');";
    echo "console.log('Rua:', '$Rua');";
    echo "console.log('Numero:', '$Numero');";
    echo "console.log('Complemento:', '$Complemento');";
    echo "console.log('Bairro:', '$Bairro');";
    echo "console.log('Cidade:', '$Cidade');";
    echo "console.log('Estado:', '$Estado');";
    echo "console.log('CEP:', '$CEP');";
    echo "</script>";

    // Atualizar os dados do cliente na tabela "clientes"
    $stmt = $BD->prepare("UPDATE clientes SET CPF = ?, Nome = ?, Sexo = ?, DataNasc = ?, Telefone = ?, Email = ? WHERE Id = ?");
    $stmt->bind_param("ssssssi", $CPF, $Nome, $Sexo, $DataNasc, $Telefone, $Email, $Id);

    if ($stmt->execute()) {
        // Atualizar os dados do endereço associado ao cliente na tabela "enderecos"
        $stmt = $BD->prepare("UPDATE enderecos SET Rua = ?, Numero = ?, Complemento = ?, Bairro = ?, Cidade = ?, Estado = ?, CEP = ? WHERE Id = ?");
        $stmt->bind_param("sssssssi", $Rua, $Numero, $Complemento, $Bairro, $Cidade, $Estado, $CEP, $Endereco_Id);

        if ($stmt->execute()) {
            echo "<script>alert('Atualização realizada com sucesso!')</script>";
        } else {
            echo "<script>alert('Erro ao atualizar endereço. Por favor, entre em contato com o suporte.')</script>";
            error_log("Erro ao atualizar endereço no banco de dados: " . $BD->error);
        }

        // Redirecionar para a página de visualização do cliente, incluindo o ID do secretário
        header("Location: VisualizarCliente.php?Id=$Id&Id_Secretario=" . $Id_Secretario);
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar dados. Por favor, entre em contato com o suporte.')</script>";
        error_log("Erro ao atualizar dados do cliente no banco de dados: " . $BD->error);
        exit();
    }
}