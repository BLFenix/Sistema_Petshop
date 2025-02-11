<?php
include_once '../../Conexao.php';

$Id = $_GET['Id'];
$Id_Administrador = $_GET['Id_Administrador']; // Recebendo o ID do administrador

$BD->query("SET FOREIGN_KEY_CHECKS=0");
// Excluindo o serviço
$SQL_Excluir_Servico = "DELETE FROM servicos WHERE Id = $Id";

if ($BD->query($SQL_Excluir_Servico) === TRUE) {
    $BD->query("SET FOREIGN_KEY_CHECKS=1");
    echo "<script>alert ('Serviço excluído com sucesso!')</script>";
    header("Location: ListarServicos.php?Id_Administrador=$Id_Administrador"); // Enviando o ID do administrador
    exit();
} else {
    $BD->query("SET FOREIGN_KEY_CHECKS=1");
    echo "<script>alert('Erro ao excluir o serviço. Por favor, entre em contato com o suporte.')</script>";
    error_log("Erro ao excluir o serviço no banco de dados: " . $BD->error);
}  