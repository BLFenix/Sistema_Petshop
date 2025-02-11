<?php
include_once '../../Conexao.php';

$Id_Administrador = null;
if(isset($_POST['Id_Administrador'])) {
    $Id_Administrador = $_POST['Id_Administrador'];
}
 
$Id = null;
if(isset($_POST['Id'])) {
    $Id = $_POST['Id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Seção para validação e processamento dos dados

    // Verificar se todos os campos obrigatórios foram preenchidos
    $camposObrigatorios = array('Id', 'CPF', 'Nome', 'Senha', 'Sexo', 'DataNasc', 'Telefone', 'Email', 'Id_Administrador');
    $camposFaltando = array();

    foreach ($camposObrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            $camposFaltando[] = $campo;
        }
    }

    if (!empty($camposFaltando)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $camposFaltando) . "');</script>";
        echo "<script>window.location.href = 'EditarSecretario.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
        exit;
    }

    // Atribuir os valores dos campos do formulário a variáveis
    $Id = $_POST['Id'];
    $CPF = $_POST['CPF'];
    $Nome = $_POST['Nome'];
    $Senha = $_POST['Senha'];
    $Sexo = $_POST['Sexo'];
    $DataNasc = $_POST['DataNasc'];
    $Telefone = $_POST['Telefone'];
    $Email = $_POST['Email'];

    // Verificar se a data de nascimento é válida
    $DataNasc_timestamp = strtotime($DataNasc);
    $DataMaxima = strtotime('-200 years');
    $DataAtual = time();

    if ($DataNasc_timestamp > $DataAtual) {
        echo "<script>alert('A data de nascimento não pode ser no futuro.');</script>";
        echo "<script>window.location.href = 'EditarSecretario.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
        exit;
    } elseif ($DataNasc_timestamp < $DataMaxima) {
        echo "<script>alert('A data de nascimento está muito distante.');</script>";
        echo "<script>window.location.href = 'EditarSecretario.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
        exit;
    }

    $SQL_Telefone = "SELECT Telefone FROM secretarios WHERE Id = $Id";
    $stmt_telefone = $BD->query($SQL_Telefone);
    $Telefone_Antigo_row = $stmt_telefone->fetch_assoc();
    $Telefone_Antigo = $Telefone_Antigo_row ? $Telefone_Antigo_row['Telefone'] : null;

    if ($Telefone_Antigo != $Telefone) {
        $SQL_Verificar_Telefone = "SELECT COUNT(*) AS Total FROM secretarios WHERE Telefone = '$Telefone'  AND Id != $Id";
        $Resultado_Verificar_Telefone = $BD->query($SQL_Verificar_Telefone);
        $Dados_Verificar_Telefone = $Resultado_Verificar_Telefone->fetch_assoc();
        if ($Dados_Verificar_Telefone['Total'] > 0) {
            echo "<script>alert('Já existe um secretário cadastrado com o telefone informado. Por favor, verifique o telefone e refaça a edição.');</script>";
            echo "<script>window.location.href = 'EditarSecretario.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
            exit;
        }
    }

    $verificarTelefoneAdmin = "SELECT Id FROM administradores WHERE Telefone = '$telefone'";
    $resultadoTelefoneAdmin = $BD->query($verificarTelefoneAdmin);
    if ($resultadoTelefoneAdmin->num_rows > 0) {
        echo "<script>alert('Este Telefone já está cadastrado como administrador. Uma pessoa não pode estar cadastrada como um administrador e um secretário ao mesmo tempo.');</script>";
        echo "<script>window.location.href = 'EditarSecretario.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
        exit;
    }

    $SQL_Email = "SELECT Email FROM secretarios WHERE Id = $Id";
    $stmt_email = $BD->query($SQL_Email);
    $Email_Antigo_row = $stmt_email->fetch_assoc();
    $Email_Antigo = $Email_Antigo_row ? $Email_Antigo_row['Email'] : null;

    if ($Email_Antigo != $Email) {
        $SQL_Verificar_Email = "SELECT COUNT(*) AS Total FROM secretarios WHERE Email = '$Email' AND Id != $Id";
        $Resultado_Verificar_Email = $BD->query($SQL_Verificar_Email);
        $Dados_Verificar_Email = $Resultado_Verificar_Email->fetch_assoc();
        if ($Dados_Verificar_Email['Total'] > 0) {
            echo "<script>alert('Email já cadastrado em outro secretário. Por favor, insira um Email único!');</script>";
            echo "<script>window.location.href = 'EditarSecretario.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
            exit;
        }
    }

    // Verifica se o email já está cadastrado como administrador
    $verificarEmailAdmin = "SELECT Id FROM administradores WHERE Email = '$Email'";
    $resultadoEmailAdmin = $BD->query($verificarEmailAdmin);
    if ($resultadoEmailAdmin->num_rows > 0) {
        echo "<script>alert('Este Email já está cadastrado como administrador. Uma pessoa não pode estar cadastrada como um administrador e um secretário ao mesmo tempo.');</script>";
        echo "<script>window.location.href = 'EditarSecretario.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
        exit;
    }

    echo "<script>";
    echo "console.log('Id:', $Id);";
    echo "console.log('CPF:', '$CPF');";
    echo "console.log('Nome:', '$Nome');";
    echo "console.log('Senha:', '$Senha');";
    echo "console.log('Sexo:', '$Sexo');";
    echo "console.log('DataNasc:', '$DataNasc');";
    echo "console.log('Telefone:', '$Telefone');";
    echo "console.log('Email:', '$Email');";
    echo "</script>";

    // Atualizar os dados do secretário na tabela "secretarios"
    $stmt = $BD->prepare("UPDATE secretarios SET CPF = ?, Nome = ?, Senha = ?, Sexo = ?, DataNasc = ?, Telefone = ?, Email = ? WHERE Id = ?");
    $stmt->bind_param("sssssssi", $CPF, $Nome, $Senha, $Sexo, $DataNasc, $Telefone, $Email, $Id);

    if ($stmt->execute()) {
        echo "<script>alert('Atualização realizada com sucesso!')</script>";
        // Redirecionar para a página de visualização do secretário
        header("Location: VisualizarSecretario.php?Id=$Id&Id_Administrador=" . $_POST['Id_Administrador']);
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar dados. Por favor, entre em contato com o suporte.')</script>";
        error_log("Erro ao atualizar dados do secretário no banco de dados: " . $BD->error);
        exit();
    }
}