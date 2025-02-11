<?php
include_once '../../Conexao.php';

$Id_Secretario = null;
if(isset($_POST['Secretarios_Id'])) {
    $Id_Secretario = $_POST['Secretarios_Id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Campos_Obrigatorios = array('CPF', 'Nome', 'Sexo', 'DataNasc', 'Telefone', 'Email', 'Rua', 'Numero', 'Bairro', 'Cidade', 'Estado', 'CEP', 'Secretarios_Id');
    $Campos_Faltando = array();
    foreach ($Campos_Obrigatorios as $Campo) {
        if (empty($_POST[$Campo])) {
            $Campos_Faltando[] = $Campo;
        }
    }

    if (!empty($Campos_Faltando)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $Campos_Faltando) . "');</script>";
        echo "<script>window.location.href = 'CadastrarCliente.php?Id_Secretario=$Id_Secretario';</script>";
        exit;
    } else {
        $CPF = $_POST['CPF'];
        $Nome = $_POST['Nome'];
        $Sexo = $_POST['Sexo'];
        $DataNasc = $_POST['DataNasc'];
        $Telefone = $_POST['Telefone'];
        $Email = $_POST['Email'];
        $Rua = $_POST['Rua'];
        $Numero = $_POST['Numero'];
        $Complemento = $_POST['Complemento'];
        $Bairro = $_POST['Bairro'];
        $Cidade = $_POST['Cidade'];
        $Estado = $_POST['Estado'];
        $CEP = $_POST['CEP'];
        $Id_Secretario = $_POST['Secretarios_Id'];

        // Verificar se a data de nascimento é válida
        $DataNasc_timestamp = strtotime($DataNasc);
        $DataMaxima = strtotime('-200 years');
        $IdadeMinima = strtotime('-18 years');
        $DataAtual = time();

        if ($DataNasc_timestamp > $DataAtual) {
            echo "<script>alert('A data de nascimento não pode ser no futuro.');</script>";
            echo "<script>window.location.href = 'CadastrarCliente.php?Id_Secretario=$Id_Secretario';</script>";
            exit;
        } elseif ($DataNasc_timestamp < $DataMaxima) {
            echo "<script>alert('A data de nascimento está muito distante.');</script>";
            echo "<script>window.location.href = 'CadastrarCliente.php?Id_Secretario=$Id_Secretario';</script>";
            exit;
        } elseif ($DataNasc_timestamp > $IdadeMinima) {
            echo "<script>alert('O cliente tem que ser maior de idade para ser cadastrado.');</script>";
            echo "<script>window.location.href = 'CadastrarCliente.php?Id_Secretario=$Id_Secretario';</script>";
            exit;
        }

        // Verificar se já existe um cliente com o CPF informado
        $SQL_Verificar_CPF = "SELECT COUNT(*) AS Total FROM clientes WHERE CPF = '$CPF'";
        $Resultado_Verificar_CPF = $BD->query($SQL_Verificar_CPF);
        $Dados_Verificar_CPF = $Resultado_Verificar_CPF->fetch_assoc();
        if ($Dados_Verificar_CPF['Total'] > 0) {
            echo "<script>alert('Já existe um cliente cadastrado com o CPF informado. Por favor, verifique o CPF e refaça o cadastro.');</script>";
            echo "<script>window.location.href = 'CadastrarCliente.php?Id_Secretario=$Id_Secretario';</script>";
            exit;
        }

        // Verificar se já existe um cliente com o email informado
        $SQL_Verificar_Email = "SELECT COUNT(*) AS Total FROM clientes WHERE Email = '$Email'";
        $Resultado_Verificar_Email = $BD->query($SQL_Verificar_Email);
        $Dados_Verificar_Email = $Resultado_Verificar_Email->fetch_assoc();
        if ($Dados_Verificar_Email['Total'] > 0) {
            echo "<script>alert('Já existe um cliente cadastrado com o email informado. Por favor, verifique o email e refaça o cadastro.');</script>";
            echo "<script>window.location.href = 'CadastrarCliente.php?Id_Secretario=$Id_Secretario';</script>";
            exit;
        }

        // Verificar se já existe um cliente com o telefone informado
        $SQL_Verificar_Telefone = "SELECT COUNT(*) AS Total FROM clientes WHERE Telefone = '$Telefone'";
        $Resultado_Verificar_Telefone = $BD->query($SQL_Verificar_Telefone);
        $Dados_Verificar_Telefone = $Resultado_Verificar_Telefone->fetch_assoc();
        if ($Dados_Verificar_Telefone['Total'] > 0) {
            echo "<script>alert('Já existe um cliente cadastrado com o telefone informado. Por favor, verifique o telefone e refaça o cadastro.');</script>";
            echo "<script>window.location.href = 'CadastrarCliente.php?Id_Secretario=$Id_Secretario';</script>";
            exit;
        }
 
        // Inserir dados do endereço na tabela "enderecos"
        $SQL_Endereco = "INSERT INTO enderecos (Rua, Numero, Complemento, Bairro, Cidade, Estado, CEP) VALUES ('$Rua', '$Numero', '$Complemento', '$Bairro', '$Cidade', '$Estado', '$CEP')";
        if ($BD->query($SQL_Endereco) === TRUE) {
            // Obter o ID do endereço inserido
            $Endereco_Id = $BD->insert_id;

            // Inserir data de cadastro
            $DataCadastro = date('Y-m-d');
            
            // Inserir dados do cliente na tabela "clientes" com o ID do endereço vinculado
            $SQL_Cliente = "INSERT INTO clientes (CPF, Nome, Sexo, DataNasc, Telefone, Email, DataCadastro, Enderecos_Id, Secretarios_Id) VALUES ('$CPF', '$Nome', '$Sexo', '$DataNasc', '$Telefone', '$Email', '$DataCadastro', '$Endereco_Id', '$Id_Secretario')";
            if ($BD->query($SQL_Cliente) === TRUE) {
                // Mostrar alerta e redirecionar para cadastrar novo animal ou visualizar cliente
                echo "<script>alert('Cliente cadastrado com sucesso!');</script>";
                echo "<script>
                    if (confirm('Deseja cadastrar um novo animal?')) {
                        window.location.href = '../Animal/CadastrarAnimal.php?Id_Cliente=" . $BD->insert_id . "&Id_Secretario=$Id_Secretario';
                    } else {
                        window.location.href = 'VisualizarCliente.php?Id=" . $BD->insert_id . "&Id_Secretario=$Id_Secretario';
                    }
                </script>";
            }else {
                echo "<script>alert('Erro ao inserir dados. Por favor, entre em contato com o suporte.')</script>";
                error_log("Erro ao inserir dados do cliente no banco de dados: " . $BD->error);
            }
        } else {
            echo "<script>alert('Erro ao inserir dados do endereço. Por favor, entre em contato com o suporte.')</script>";
            error_log("Erro ao inserir dados do endereço no banco de dados: " . $BD->error);
        }
    }
}
?>