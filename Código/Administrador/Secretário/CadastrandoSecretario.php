<?php
    include_once '../../Conexao.php';

$Id_Administrador = null;
if(isset($_POST['Id_Administrador'])) {
    $Id_Administrador = $_POST['Id_Administrador'];
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CamposObrigatorios = array('CPF', 'Nome', 'Senha', 'Sexo', 'DataNasc', 'Telefone', 'Email', 'Id_Administrador', 'DataCadastro');
        $CamposFaltando = array();
        foreach ($CamposObrigatorios as $Campo) {
            if (empty($_POST[$Campo])) {
                $CamposFaltando[] = $Campo;
            }
        }

        if (!empty($CamposFaltando)) {
            echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $CamposFaltando) . "');</script>";
            if(isset($_POST['Id_Administrador'])) {
                $Id_Administrador = $_POST['Id_Administrador'];
                echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
            } else {
                echo "<script>window.location.href = 'CadastrarSecretario.php';</script>";
            }
            exit;
        } else {
            $CPF = $_POST['CPF'];
            $Nome = $_POST['Nome'];
            $Senha = $_POST['Senha'];
            $Sexo = $_POST['Sexo'];
            $DataNasc = $_POST['DataNasc'];
            $Telefone = $_POST['Telefone'];
            $Email = $_POST['Email'];
            $Id_Administrador = $_POST['Id_Administrador'];
            $DataCadastro = $_POST['DataCadastro'];

            // Verificar se a data de nascimento é válida
        $DataNasc_timestamp = strtotime($DataNasc);
        $DataMaxima = strtotime('-200 years');
        $DataAtual = time();

        if ($DataNasc_timestamp > $DataAtual) {
            echo "<script>alert('A data de nascimento não pode ser no futuro.');</script>";
            echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
            exit;
        } elseif ($DataNasc_timestamp < $DataMaxima) {
            echo "<script>alert('A data de nascimento está muito distante.');</script>";
            echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
            exit;
        }

            // Verifica se o CPF já está cadastrado como secretário
            $VerificarCPFSecretario = "SELECT CPF FROM secretarios WHERE CPF = '$CPF'";
            $ResultadoSecretario = $BD->query($VerificarCPFSecretario);
            if ($ResultadoSecretario->num_rows > 0) {
                echo "<script>alert('CPF já cadastrado como secretário. Por favor, insira um CPF único!');</script>";
                echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
                exit;
            }

            // Verifica se o CPF é de um administrador
            $VerificarCPFAdmin = "SELECT Id FROM administradores WHERE CPF = '$CPF'";
            $ResultadoAdmin = $BD->query($VerificarCPFAdmin);
            if ($ResultadoAdmin->num_rows > 0) {
                echo "<script>alert('Este CPF já está cadastrado como administrador. Uma pessoa não pode estar cadastrada como um administrador e um secretário ao mesmo tempo.');</script>";
                echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
                exit;
            }

            // Verifica se o email já está cadastrado como secretário
            $verificarEmailSecretario = "SELECT Email FROM secretarios WHERE Email = '$email'";
            $resultadoEmailSecretario = $BD->query($verificarEmailSecretario);
            if ($resultadoEmailSecretario->num_rows > 0) {
                echo "<script>alert('Email já cadastrado como secretário. Por favor, insira um Email único!');</script>";
                echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
                exit;
            }

            // Verifica se o email já está cadastrado como administrador
            $verificarEmailAdmin = "SELECT Id FROM administradores WHERE Email = '$email'";
            $resultadoEmailAdmin = $BD->query($verificarEmailAdmin);
            if ($resultadoEmailAdmin->num_rows > 0) {
                echo "<script>alert('Este Email já está cadastrado como administrador. Uma pessoa não pode estar cadastrada como um administrador e um secretário ao mesmo tempo.');</script>";
                echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
                exit;
            }

            // Verifica se o telefone já está cadastrado como secretário
            $verificarTelefoneSecretario = "SELECT Telefone FROM secretarios WHERE Telefone = '$telefone'";
            $resultadoTelefoneSecretario = $BD->query($verificarTelefoneSecretario);
            if ($resultadoTelefoneSecretario->num_rows > 0) {
                echo "<script>alert('Telefone já cadastrado como secretário. Por favor, insira um Telefone único!');</script>";
                echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
                exit;
            }

            // Verifica se o telefone já está cadastrado como administrador
            $verificarTelefoneAdmin = "SELECT Id FROM administradores WHERE Telefone = '$telefone'";
            $resultadoTelefoneAdmin = $BD->query($verificarTelefoneAdmin);
            if ($resultadoTelefoneAdmin->num_rows > 0) {
                echo "<script>alert('Este Telefone já está cadastrado como administrador. Uma pessoa não pode estar cadastrada como um administrador e um secretário ao mesmo tempo.');</script>";
                echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
                exit;
            }

            // Insere o secretário no banco de dados
            $SQL = "INSERT INTO secretarios (CPF, Nome, Senha, Sexo, DataNasc, Telefone, Email, DataCadastro, Administradores_Id) VALUES ('$CPF', '$Nome', '$Senha', '$Sexo', '$DataNasc', '$Telefone', '$Email', '$DataCadastro', '$Id_Administrador')";
            
            if ($BD->query($SQL) === TRUE) {
                header("Location: VisualizarSecretario.php?Id=" . $BD->insert_id . "&Id_Administrador=$Id_Administrador");
                exit();
            } else {
                echo "<script>alert('Erro ao inserir dados. Por favor, entre em contato com o suporte.')</script>";
                error_log("Erro ao inserir dados no banco de dados: " . $BD->error);
            }
        }
    }
    
    // Envia o ID do administrador se estiver disponível
    if(isset($_POST['Id_Administrador'])) {
        $Id_Administrador = $_POST['Id_Administrador'];
        echo "<script>window.location.href = 'CadastrarSecretario.php?Id_Administrador=$Id_Administrador';</script>";
    }  