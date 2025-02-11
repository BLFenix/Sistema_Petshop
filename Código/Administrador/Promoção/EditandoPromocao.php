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
    // Verificar se o nome da promoção já existe
    $SQL_verificar = "SELECT COUNT(*) as total FROM promocoes WHERE '$Nome' LIKE CONCAT('%', Nome, '%')";
    $result = $BD->query($SQL_verificar);
    $row = $result->fetch_assoc();
    if ($row['total'] > 0) {
        echo "<script>alert('Já existe uma promoção com esse nome ou que contém esse nome como parte. Por favor, escolha um nome diferente.');</script>";
        echo "<script>window.location.href = 'EditarPromocao.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
        exit;
    }}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Seção para validação e processamento dos dados

    // Verificar se todos os campos obrigatórios foram preenchidos
    $camposObrigatorios = array('Id', 'Nome', 'Valor', 'Id_Administrador');
    $camposFaltando = array();

    foreach ($camposObrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            $camposFaltando[] = $campo;
        }
    }

    if (!empty($camposFaltando)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $camposFaltando) . "');</script>";
        echo "<script>window.location.href = 'EditarPromocao.php?Id=$Id&Id_Administrador=$Id_Administrador';</script>";
        exit;
    }

    // Atribuir os valores dos campos do formulário a variáveis
    $Id = $_POST['Id'];
    $Nome = $_POST['Nome'];
    $Valor = $_POST['Valor'];
    $Id_Administrador = $_POST['Id_Administrador'];

    // Imprimir os valores das variáveis no console
    echo "<script>";
    echo "console.log('Id:', $Id);";
    echo "console.log('Nome:', '$Nome');";
    echo "console.log('Valor:', $Valor);";
    echo "console.log('Id_Administrador:', $Id_Administrador);";
    echo "</script>";

    // Atualizar os dados da promoção na tabela "promocoes"
    $stmt = $BD->prepare("UPDATE promocoes SET Nome = ?, Valor = ? WHERE Id = ?");
    $stmt->bind_param("sdi", $Nome, $Valor, $Id);

    if ($stmt->execute()) {
        echo "<script>alert('Atualização realizada com sucesso!')</script>";
        // Redirecionar para a página de visualização da promoção
        header("Location: VisualizarPromocao.php?Id=$Id&Id_Administrador=$Id_Administrador");
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar dados. Por favor, entre em contato com o suporte.')</script>";
        error_log("Erro ao atualizar dados da promoção no banco de dados: " . $BD->error);
        exit();
    }
}