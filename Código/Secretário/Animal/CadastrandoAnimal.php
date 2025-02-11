<?php
include_once '../../Conexao.php';
 
$Secretario_id = null;
if(isset($_POST['Id_Secretario'])) {
    $Secretario_id = $_POST['Id_Secretario'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Campos_Obrigatorios = array('Nome', 'Tipo', 'Raca', 'Sexo', 'DataNasc' , 'DataCadastro', 'Cliente_Id', 'Id_Secretario');
    $Campos_Faltando = array();
    foreach ($Campos_Obrigatorios as $Campo) {
        if (empty($_POST[$Campo])) {
            $Campos_Faltando[] = $Campo;
        }
    } 

    if (!empty($Campos_Faltando)) {
        echo "<script>alert('ID: $Secretario_id Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $Campos_Faltando) . "');</script>";
        echo "<script>window.location.href = 'CadastrarAnimal.php?Id_Secretario=$Secretario_id';</script>";
        exit;
    } else {
        $Nome = $_POST['Nome'];
        $Tipo = $_POST['Tipo'];
        $Raca = $_POST['Raca'];
        $Sexo = $_POST['Sexo'];
        $DataNasc = $_POST['DataNasc'];
        $DataCadastro = $_POST['DataCadastro'];
        $Cliente_Id = $_POST['Cliente_Id'];
        $Id_Secretario = $_POST['Id_Secretario'];

        // Verificar se a data de nascimento é válida
        $DataNasc_timestamp = strtotime($DataNasc);
        $DataMaxima = strtotime('-200 years');
        $DataAtual = time();

        if ($DataNasc_timestamp > $DataAtual) {
            echo "<script>alert('A data de nascimento não pode ser no futuro.');</script>";
            echo "<script>window.location.href = 'CadastrarAnimal.php?Id_Secretario=$Secretario_id';</script>";
            exit;
        } elseif ($DataNasc_timestamp < $DataMaxima) {
            echo "<script>alert('A data de nascimento está muito distante.');</script>";
            echo "<script>window.location.href = 'CadastrarAnimal.php?Id_Secretario=$Secretario_id';</script>";
            exit;
        }

        // Montagem da query SQL para inserir os dados na tabela 'animais'
        $SQL = "INSERT INTO animais (Nome, Tipo, Raca, Sexo, DataNasc, DataCadastro, Clientes_Id, Secretarios_Id) VALUES ('$Nome', '$Tipo', '$Raca', '$Sexo', '$DataNasc', '$DataCadastro', '$Cliente_Id', '$Id_Secretario')";
        
        // Execução da query SQL    
        if ($BD->query($SQL) === TRUE) {
            // Se a inserção for bem sucedida, redireciona para a página de visualização do animal inserido
            header("Location: VisualizarAnimal.php?Id=" . $BD->insert_id . "&Id_Secretario=$Secretario_id");
            exit(); // Encerra a execução do script
        } else {
            // Se houver um erro durante a inserção
            // Exibe um alerta de erro
            echo "<script>alert('Erro ao inserir dados. Por favor, entre em contato com o suporte.')</script>";
            // Registra o erro no log do servidor
            error_log("Erro ao inserir dados no banco de dados: " . $BD->error);
        }
    }
}