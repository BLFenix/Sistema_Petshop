<?php
include_once '../../Conexao.php';

$Id = $_GET['Id'];
$Id_Administrador = $_GET['Id_Administrador']; // Recebendo o ID do administrador

$BD->query("SET FOREIGN_KEY_CHECKS=0");
// Excluindo o secretário
$SQL_Excluir_Secretario = "DELETE FROM secretarios WHERE Id = $Id";

if ($BD->query($SQL_Excluir_Secretario) === TRUE) {
    $BD->query("SET FOREIGN_KEY_CHECKS=1");
    echo "<script>alert ('Secretário excluído com sucesso!')</script>";
    header("Location: ListarSecretarios.php?Id_Administrador=$Id_Administrador"); // Enviando o ID do administrador
    exit();
} else {
    $BD->query("SET FOREIGN_KEY_CHECKS=1");
    echo "<script>alert('Erro ao excluir o secretário. Por favor, entre em contato com o suporte.')</script>";
    error_log("Erro ao excluir o secretário no banco de dados: " . $BD->error);
}