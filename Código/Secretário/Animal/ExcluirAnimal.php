<?php
include_once '../../Conexao.php';

$Id = isset($_GET['Id']) ? $_GET['Id'] : '';
$Id_Secretario = $_GET['Id_Secretario']; // Recebendo o ID do secretário

// Desativar temporariamente a verificação de chaves estrangeiras
$BD->query("SET FOREIGN_KEY_CHECKS=0");

// Excluir o animal da tabela `animais`
$SQL_Excluir_Animal = "DELETE FROM animais WHERE Id = $Id";
if ($BD->query($SQL_Excluir_Animal) === TRUE) {
    // Reativar a verificação de chaves estrangeiras
    $BD->query("SET FOREIGN_KEY_CHECKS=1");

    // Exibir mensagem de sucesso
    echo "<script>alert('Animal excluído com sucesso!');</script>";

    // Redirecionar para a página de listagem de animais
    echo "<script>window.location.href = 'ListarAnimais.php?Id_Secretario=$Id_Secretario';</script>";
    exit;
} else {
    // Reativar a verificação de chaves estrangeiras em caso de erro
    $BD->query("SET FOREIGN_KEY_CHECKS=1");

    // Exibir mensagem de erro
    echo "<script>alert('Erro ao excluir o animal. Por favor, entre em contato com o suporte.');</script>";
    error_log("Erro ao excluir o animal: " . $BD->error);
}