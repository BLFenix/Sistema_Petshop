<?php
    include_once '../../Conexao.php';
 
$Id_Administrador = null;
if(isset($_POST['Id_Administrador'])) {
    $Id_Administrador = $_POST['Id_Administrador'];
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CamposObrigatorios = array('Nome', 'Valor', 'Id_Administrador');
        $CamposFaltando = array();
        foreach ($CamposObrigatorios as $Campo) {
            if (empty($_POST[$Campo])) {
                $CamposFaltando[] = $Campo;
            }
        }

        if (!empty($CamposFaltando)) {
            echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $CamposFaltando) . "');</script>";
            echo "<script>window.location.href = 'CadastrarPromocao.php?Id_Administrador=$Id_Administrador';</script>";
            exit;
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar se o nome da promoção já existe
            $SQL_verificar = "SELECT COUNT(*) as total FROM promocoes WHERE '$Nome' LIKE CONCAT('%', Nome, '%')";
            $result = $BD->query($SQL_verificar);
            $row = $result->fetch_assoc();
            if ($row['total'] > 0) {
                echo "<script>alert('Já existe uma promoção com esse nome ou que contém esse nome como parte. Por favor, escolha um nome diferente.');</script>";
                echo "<script>window.location.href = 'CadastrarPromocao.php?Id_Administrador=$Id_Administrador';</script>";
                exit;
            }}

            $Nome = $_POST['Nome'];
            $Valor = $_POST['Valor'];
            $Id_Administrador = $_POST['Id_Administrador'];

            $SQL = "INSERT INTO promocoes (Nome, Valor, Administradores_Id) VALUES ('$Nome', '$Valor', '$Id_Administrador')";
            
            if ($BD->query($SQL) === TRUE) {
                header("Location: VisualizarPromocao.php?Id=" . $BD->insert_id . "&Id_Administrador=$Id_Administrador");
                exit();
            } else {
                echo "<script>alert('Erro ao inserir dados. Por favor, entre em contato com o suporte.')</script>";
                error_log("Erro ao inserir dados no banco de dados: " . $BD->error);
            }
        }
    }
    
    // Send administrator ID if available
    if(isset($_POST['Id_Administrador'])) {
        $Id_Administrador = $_POST['Id_Administrador'];
        echo "<script>window.location.href = 'CadastrarPromocao.php?Id_Administrador=$Id_Administrador';</script>";
    }