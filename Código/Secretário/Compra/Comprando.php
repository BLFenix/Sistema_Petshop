<?php
include_once "../../Conexao.php";

$Id_Secretario = null;
if(isset($_POST['Secretarios_Id'])) {
    $Id_Secretario = $_POST['Secretarios_Id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se todos os campos obrigatórios foram enviados
    $camposObrigatorios = array('Servico', 'Secretarios_Id', 'Cliente_Id', 'Animal', 'Id_Promocao', 'DataHoraCompra', 'MetodoPagamento', 'ValorTotal');
    $camposFaltando = array();
    foreach ($camposObrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            $camposFaltando[] = $campo;
        }
    }

    if (!empty($camposFaltando)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios: \\n" . implode(", ", $camposFaltando) . "');</script>";
        echo "<script>window.location.href = 'Comprar.php?Id_Secretario=$Id_Secretario';</script>";
        exit;
    } else {
        // Preparar e executar a inserção dos dados no banco de dados
        $servicosId = $_POST['Servico'];
        $clientesId = $_POST['Cliente_Id'];
        $animaisId = $_POST['Animal'];
        $promocoesId = isset($_POST['Id_Promocao']) ? $_POST['Id_Promocao'] : 0;
        $dataHoraCompra = $_POST['DataHoraCompra'];
        $valor = $_POST['ValorTotal'];
        $formaPagamentoId = $_POST['MetodoPagamento'];

        // Consulta SQL para obter os dados adicionais
        $consulta = "SELECT 
                        secretarios.Nome AS Nome_Secretario,
                        clientes.Nome AS Nome_Cliente,
                        animais.Nome AS Nome_Animal,
                        servicos.Nome AS Nome_Servico,
                        servicos.Valor AS Valor_Servico,
                        promocoes.Nome AS Nome_Promocao,
                        promocoes.Valor AS Valor_Promocao
                     FROM 
                        secretarios,
                        clientes,
                        animais,
                        servicos,
                        promocoes
                     WHERE 
                        secretarios.Id = $Id_Secretario AND
                        clientes.Id = $clientesId AND
                        animais.Id = $animaisId AND
                        servicos.Id = $servicosId AND
                        promocoes.Id = $promocoesId";

        // Executar a consulta
        $resultado = $BD->query($consulta);

        if ($resultado && $resultado->num_rows > 0) {
            $dados = $resultado->fetch_assoc();

            // Extrair os dados obtidos da consulta
            $Nome_Secretario = $dados['Nome_Secretario'];
            $Nome_Cliente = $dados['Nome_Cliente'];
            $Nome_Animal = $dados['Nome_Animal'];
            $Nome_Servico = $dados['Nome_Servico'];
            $Valor_Servico = $dados['Valor_Servico'];
            $Nome_Promocao = $dados['Nome_Promocao'];
            $Valor_Promocao = $dados['Valor_Promocao'];

            // Inserir os dados na tabela compras
            $sql = "INSERT INTO compras (DataHora, Valor, Servicos_Id, Nome_Servico, Valor_Servico, Secretarios_Id, Nome_Secretario, Clientes_Id, Nome_Cliente, Animais_Id, Nome_Animal, Promocoes_Id, Nome_Promocao, Valor_Promocao, FormaPagamento_Id) 
                    VALUES ('$dataHoraCompra', '$valor', '$servicosId', '$Nome_Servico','$Valor_Servico', '$Id_Secretario', '$Nome_Secretario', '$clientesId', '$Nome_Cliente', '$animaisId', '$Nome_Animal', '$promocoesId', '$Nome_Promocao', '$Valor_Promocao', '$formaPagamentoId')";

            if ($BD->query($sql) === TRUE) {
                // Redirecionar para a página de visualização da compra com o ID da compra e o ID do secretário
                header("Location: VisualizarCompra.php?Id=" . $BD->insert_id . "&Id_Secretario=" . $Id_Secretario);
                exit();
            } else {
                echo "<script>alert('Erro ao realizar compra. Por favor, entre em contato com o suporte.');</script>";
                header("Location: VisualizarCompra.php?Id_Secretario=" . $Id_Secretario);
                error_log("Erro ao realizar compra no banco de dados: " . $BD->error);
            }
        } else {
            echo "<script>alert('Erro ao obter dados adicionais para a compra. Por favor, entre em contato com o suporte.');</script>";
            header("Location: VisualizarCompra.php?Id_Secretario=" . $Id_Secretario);
            error_log("Erro ao obter dados adicionais para a compra: " . $BD->error);
        }
    }
}