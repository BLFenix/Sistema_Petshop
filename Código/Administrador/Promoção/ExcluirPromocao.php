<?php
include_once '../../Conexao.php';

$Id = $_GET['Id'];
$Id_Administrador = $_GET['Id_Administrador']; // Recebendo o ID do administrador

$BD->query("SET FOREIGN_KEY_CHECKS=0");
// Excluindo a promoção
$SQL_Excluir_Promocao = "DELETE FROM promocoes WHERE Id = $Id";

if ($BD->query($SQL_Excluir_Promocao) === TRUE) {
    // Excluindo o ID da promoção da tabela de serviços
    $SQL_Atualizar_Servicos = "UPDATE servicos SET Promocoes_Id = 1, Valor = Valor + (SELECT Valor FROM promocoes WHERE Id = $Id) WHERE Promocoes_Id = $Id";
    if ($BD->query($SQL_Atualizar_Servicos) === TRUE) {
        $BD->query("SET FOREIGN_KEY_CHECKS=1");
        echo "<script>alert ('Promoção excluída com sucesso!')</script>";
        header("Location: ListarPromocoes.php?Id_Administrador=$Id_Administrador"); // Enviando o ID do administrador
        exit();
    } else {
        $BD->query("SET FOREIGN_KEY_CHECKS=1");
        echo "<script>alert('Erro ao atualizar os serviços. Por favor, entre em contato com o suporte.')</script>";
        error_log("Erro ao atualizar os serviços no banco de dados: " . $BD->error);
    }
} else {
    echo "<script>alert('Erro ao excluir a promoção. Por favor, entre em contato com o suporte.')</script>";
    error_log("Erro ao excluir a promoção no banco de dados: " . $BD->error);
} 