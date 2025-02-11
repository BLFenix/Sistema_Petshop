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
    $camposObrigatorios = array('Id', 'Nome', 'Descricao', 'Valor', 'DuracaoEstimada', 'Disponibilidade', 'Promocoes_Id', 'Administradores_Id');
    $camposFaltando = array();

    foreach ($camposObrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            $camposFaltando[] = $campo;
        }
    }

    if (!empty($camposFaltando)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $camposFaltando) . "');</script>";
        echo "<script>window.location.href = 'EditarServico.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
        exit;
    }

    // Atribuir os valores dos campos do formulário a variáveis
    $Id = $_POST['Id'];
    $Nome = $_POST['Nome'];
    $Descricao = $_POST['Descricao'];
    $Valor = $_POST['Valor'];
    $DuracaoEstimada = $_POST['DuracaoEstimada'];
    $Disponibilidade = $_POST['Disponibilidade'];
    $Promocoes_Id = $_POST['Promocoes_Id'];
    $Administradores_Id = $_POST['Administradores_Id'];

    // Imprimir os valores das variáveis no console
    echo "<script>";
    echo "console.log('Id:', $Id);";
    echo "console.log('Nome:', '$Nome');";
    echo "console.log('Descricao:', '$Descricao');";
    echo "console.log('Valor:', $Valor);";
    echo "console.log('DuracaoEstimada:', $DuracaoEstimada);";
    echo "console.log('Disponibilidade:', '$Disponibilidade');";
    echo "console.log('Promocoes_Id:', $Promocoes_Id);";
    echo "console.log('Administradores_Id:', $Administradores_Id);";
    echo "</script>";

    // Atualizar os dados do serviço na tabela "servicos"
    $stmt = $BD->prepare("UPDATE servicos SET Nome = ?, Descricao = ?, Valor = ?, DuracaoEstimada = ?, Disponibilidade = ?, Promocoes_Id = ?, Administradores_Id = ? WHERE Id = ?");
    $stmt->bind_param("ssdissii", $Nome, $Descricao, $Valor, $DuracaoEstimada, $Disponibilidade, $Promocoes_Id, $Administradores_Id, $Id);

    if ($stmt->execute()) {
        echo "<script>alert('Atualização realizada com sucesso!')</script>";
        // Redirecionar para a página de visualização do serviço
        header("Location: VisualizarServico.php?Id=$Id&Id_Administrador=" . $_POST['Id_Administrador']);
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar dados. Por favor, entre em contato com o suporte.')</script>";
        error_log("Erro ao atualizar dados do serviço no banco de dados: " . $BD->error);
        exit();
    }
}