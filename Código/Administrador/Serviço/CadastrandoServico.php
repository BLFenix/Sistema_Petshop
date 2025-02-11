<?php
include_once '../../Conexao.php';

$Id_Administrador = null;
if(isset($_POST['Id_Administrador'])) {
    $Id_Administrador = $_POST['Id_Administrador'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CamposObrigatorios = array('Nome', 'Descricao', 'Valor', 'DuracaoEstimada', 'Disponibilidade', 'Promocoes_Id', 'Administradores_Id');
    $CamposFaltando = array();
    foreach ($CamposObrigatorios as $Campo) {
        if (empty($_POST[$Campo])) {
            $CamposFaltando[] = $Campo;
        }
    }

    if (!empty($CamposFaltando)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $CamposFaltando) . "');</script>";
        if(isset($_POST['Administradores_Id'])) {
            $Id_Administrador = $_POST['Administradores_Id'];
            echo "<script>window.location.href = 'CadastrarServico.php?Id_Administrador=$Id_Administrador';</script>";
        } else {
            echo "<script>window.location.href = 'CadastrarServico.php';</script>";
        }
        exit;
    } else {
        $Nome = $_POST['Nome'];
        $Descricao = $_POST['Descricao'];
        $Valor = $_POST['Valor'];
        $DuracaoEstimada = $_POST['DuracaoEstimada'];
        $Disponibilidade = $_POST['Disponibilidade'];
        $PromocoesId = $_POST['Promocoes_Id'];
        $AdministradoresId = $_POST['Administradores_Id'];

        // Verifica se há uma promoção vinculada ao serviço
        if (!empty($PromocoesId)) {
            // Consulta para obter o valor da promoção
            $queryPromocao = "SELECT Valor FROM promocoes WHERE Id = $PromocoesId";
            $resultPromocao = $BD->query($queryPromocao);

            if ($resultPromocao->num_rows > 0) {
                $rowPromocao = $resultPromocao->fetch_assoc();
                $valorPromocao = $rowPromocao['Valor'];
                // Subtrai o valor da promoção do valor do serviço
                $Valor -= $valorPromocao;
            }
        }

        $SQL = "INSERT INTO servicos (Nome, Descricao, Valor, DuracaoEstimada, Disponibilidade, Promocoes_Id, Administradores_Id) VALUES ('$Nome', '$Descricao', '$Valor', '$DuracaoEstimada', '$Disponibilidade', '$PromocoesId', '$AdministradoresId')";
        
        if ($BD->query($SQL) === TRUE) {
            header("Location: VisualizarServico.php?Id=" . $BD->insert_id . "&Id_Administrador=$AdministradoresId");
            exit();
        } else {
            echo "<script>alert('Erro ao inserir dados. Por favor, entre em contato com o suporte.')</script>";
            error_log("Erro ao inserir dados no banco de dados: " . $BD->error);
        }
    }
}

// Envia o ID do administrador se disponível
if(isset($_POST['Administradores_Id'])) {
    $Id_Administrador = $_POST['Administradores_Id'];
    echo "<script>window.location.href = 'CadastrarServico.php?Id_Administrador=$Id_Administrador';</script>";
}