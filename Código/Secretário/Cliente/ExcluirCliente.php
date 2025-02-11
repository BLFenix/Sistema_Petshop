<?php
include_once '../../Conexao.php';

$Id = $_GET['Id'];
$Id_Secretario = $_GET['Id_Secretario']; // Recebendo o ID do secretário

$BD->query("SET FOREIGN_KEY_CHECKS=0");

// Preparar e executar a consulta para verificar se o endereço está sendo utilizado por outros clientes
$Endereco_Id = null;
$SQL_Endereco = "SELECT Enderecos_Id FROM clientes WHERE Id = $Id";
$Result_Endereco = $BD->query($SQL_Endereco);

if ($Result_Endereco->num_rows > 0) {
    $row = $Result_Endereco->fetch_assoc();
    $Endereco_Id = $row['Enderecos_Id'];
}

if ($Endereco_Id !== null) {
    // Verificar se o endereço está sendo utilizado por outros clientes
    $SQL_Outros_Clientes = "SELECT Id FROM clientes WHERE Enderecos_Id = $Endereco_Id AND Id != $Id";
    $Result_Outros_Clientes = $BD->query($SQL_Outros_Clientes);

    if ($Result_Outros_Clientes->num_rows == 0) {
        // Excluir o endereço, pois não está sendo utilizado por outros clientes
        $SQL_Excluir_Endereco = "DELETE FROM enderecos WHERE Id = $Endereco_Id";
        $BD->query($SQL_Excluir_Endereco);
    }
}

$SQL_Delete_Animais = "DELETE FROM animais WHERE Clientes_Id = $Id";
if ($BD->query($SQL_Delete_Animais) === TRUE) {
    // Now, delete the client
    $SQL_Excluir_Cliente = "DELETE FROM clientes WHERE Id = $Id";

    if ($BD->query($SQL_Excluir_Cliente) === TRUE) {
        echo "<script>alert ('Cliente excluído com sucesso!')</script>";
        header("Location: ListarClientes.php?Id_Secretario=$Id_Secretario"); // Sending the Secretary's ID
        exit();
    } else {
        echo "<script>alert('Erro ao excluir dados. Por favor, entre em contato com o suporte.')</script>";
        error_log("Erro ao excluir dados no banco de dados: " . $BD->error);
    }
} else {
    echo "<script>alert('Erro ao excluir animais. Por favor, entre em contato com o suporte.')</script>";
    error_log("Erro ao excluir animais no banco de dados: " . $BD->error);
}

// Excluir o cliente
$SQL_Excluir_Cliente = "DELETE FROM clientes WHERE Id = $Id";

if ($BD->query($SQL_Excluir_Cliente) === TRUE) {
    $BD->query("SET FOREIGN_KEY_CHECKS=1");
    echo "<script>alert ('Cliente excluído com sucesso!')</script>";
    header("Location: ListarClientes.php?Id_Secretario=$Id_Secretario"); // Enviando o ID do secretário
    exit();
} else {
    $BD->query("SET FOREIGN_KEY_CHECKS=1");
    echo "<script>alert('Erro ao excluir dados. Por favor, entre em contato com o suporte.')</script>";
    error_log("Erro ao excluir dados no banco de dados: " . $BD->error);
} 