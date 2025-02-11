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
    $Campos_Obrigatorios = array('Id', 'Nome', 'Tipo', 'Raca', 'Sexo', 'DataNasc', 'Clientes_Id', 'Secretarios_Id');
    $Campos_Faltando = array();

    foreach ($Campos_Obrigatorios as $Campo) {
        if (empty($_POST[$Campo])) {
            $Campos_Faltando[] = $Campo;
        }
    }

    if (!empty($Campos_Faltando)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $Campos_Faltando) . "');</script>";
        echo "<script>window.location.href = 'EditarAnimal.php?Id=$Id&Id_Secretario=$Secretario_id';</script>";
        exit;
    }

    // Atribuir valores dos campos do formulário a variáveis
    $Id = $_POST['Id'];
    $Nome = $_POST['Nome'];
    $Tipo = $_POST['Tipo'];
    $Raca = $_POST['Raca'];
    $Sexo = $_POST['Sexo'];
    $DataNasc = $_POST['DataNasc'];
    $Clientes_Id = $_POST['Clientes_Id'];
    $Secretarios_Id = $_POST['Secretarios_Id'];

    // Verificar se a data de nascimento é válida
    $DataNasc_timestamp = strtotime($DataNasc);
    $DataMaxima = strtotime('-200 years');
    $DataAtual = time();

    if ($DataNasc_timestamp > $DataAtual) {
        echo "<script>alert('A data de nascimento não pode ser no futuro.');</script>";
        echo "<script>window.location.href = 'EditarAnimal.php?Id=$Id';</script>";
        exit;
    } elseif ($DataNasc_timestamp < $DataMaxima) {
        echo "<script>alert('A data de nascimento está muito distante.');</script>";
        echo "<script>window.location.href = 'EditarAnimal.php?Id=$Id';</script>";
        exit;
    }

    // Atualizar os dados do animal na tabela "animais"
    $stmt = $BD->prepare("UPDATE animais SET Nome = ?, Tipo = ?, Raca = ?, Sexo = ?, DataNasc = ?, Clientes_Id = ?, Secretarios_Id = ? WHERE Id = ?");
    $stmt->bind_param("sssssiii", $Nome, $Tipo, $Raca, $Sexo, $DataNasc, $Clientes_Id, $Secretarios_Id, $Id);

    if ($stmt->execute()) {
        echo "<script>alert('Atualização realizada com sucesso!')</script>";

        // Redirecionar para a página de visualização do animal, incluindo os IDs do animal e do secretário
        header("Location: VisualizarAnimal.php?Id=$Id&Id_Secretario=$Secretarios_Id");
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar dados. Por favor, entre em contato com o suporte.')</script>";
        error_log("Erro ao atualizar dados do animal no banco de dados: " . $BD->error);
        exit();
    }
}