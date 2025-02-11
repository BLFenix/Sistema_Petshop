<?php
include_once '../../Conexao.php';

if (isset($_GET['Id'])) {
    $Id = $_GET['Id'];

    // Consulta para recuperar os detalhes da compra
    $SQL_compra = "SELECT compras.*, 
                    FormaPagamento.Nome AS Nome_FormaPagamento 
                FROM compras 
                LEFT JOIN FormaPagamento ON compras.FormaPagamento_Id = FormaPagamento.Id 
                WHERE compras.Id = $Id;";

    $Res_compra = $BD->query($SQL_compra);
 
    if ($Res_compra->num_rows > 0) {
        $Compra = $Res_compra->fetch_assoc();

        // Exibir detalhes da compra
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../.CSS/Style.css">
</head>

<body>
    <nav class="menu-lateral">
        <?php
                if(isset($_GET['Id_Secretario'])) {
                    $Id_Secretario = $_GET['Id_Secretario'];
            ?>
        <ul>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-person-arms-up"></i>
                    Clientes
                </span>
            </p>
            <li class="item-menu">
                <a href='../Cliente/CadastrarCliente.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Cadastrar Cliente
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='../Cliente/ListarClientes.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Clientes
                    </span>
                </a>
            </li>
            <p></p>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-github"></i>
                    Animais
                </span>
            </p>
            <li class="item-menu">
                <a href='../Animal/CadastrarAnimal.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Cadastrar Animal
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='../Animal/ListarAnimais.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Animais
                    </span>
                </a>
            </li>
            <p></p>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-cart3"></i>
                    Compras
                </span>
            </p>
            <li class="item-menu">
                <a href='../Compra/Comprar.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Realizar Compra
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='../Compra/ListarCompras.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Compras
                    </span>
                </a>
            </li>
            <p></p>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-cash"></i>
                    Promoções
                </span>
            </p>
            <li class="item-menu">
                <a href='../VisualizarPromoções/ListarPromocoes.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Promoções
                    </span>
                </a>
            </li>
            <p></p>

            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-file-earmark-medical"></i>
                    Serviços
                </span>
            </p>
            <li class="item-menu">
                <a href='../VisualizarServiços/ListarServicos.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Serviços
                    </span>
                </a>
            </li>
            <li class="item-menuSAIR">
                <a href="../../Login.html">
                    <span class="txt-linkSAIR">
                        Sair
                    </span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="txt-link">
                        .
                    </span>
                </a>
            </li>
        </ul>
        <?php
                } else {
                    echo '<script>
                        alert (´Erro na recepçao do id do secretário!´);
                        win
                    </script>';
                }
        ?>
    </nav>
    <center>
        <nav class="navbarini">
            <a href="../IniciarSecretario.php?IdUsuario=<?php echo $Id_Secretario; ?>"> <img id="ftnavbar"
                    src="../../.CSS/FTINI.png" title="Ir para o menu inicial"> </a>
        </nav>
        <form style="width:40%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados da Compra</h1>
            <div style="text-align: left; width:70%;" id="dados_sec">
                <p><b>ID:</b> <?php echo $Compra['Id']; ?></p>
                <p><b>Data e Hora:</b> 
                    <?php 
                        $DataHora = new DateTime($Compra['DataHora']);
                        echo $DataHora->format('d/m/Y H:i:s'); 
                    ?></p>
                <p><b>Valor:</b> R$ <?php echo $Compra['Valor']; ?></p>
                <p><b>ID do Serviço:</b> <?php echo $Compra['Servicos_Id']; ?></p>
                <p><b>Nome do Serviço:</b> <?php echo $Compra['Nome_Servico']; ?></p>
                <p><b>ID do Secretário:</b> <?php echo $Compra['Secretarios_Id']; ?></p>
                <p><b>Nome do Secretário:</b> <?php echo $Compra['Nome_Secretario']; ?></p>
                <p><b>ID do Cliente:</b> <?php echo $Compra['Clientes_Id']; ?></p>
                <p><b>Nome do Cliente:</b> <?php echo $Compra['Nome_Cliente']; ?></p>
                <p><b>ID do Animal:</b> <?php echo $Compra['Animais_Id']; ?></p>
                <p><b>Nome do Animal:</b> <?php echo $Compra['Nome_Animal']; ?></p>
                <p><b>ID da Promoção:</b> <?php echo $Compra['Promocoes_Id']; ?></p>
                <p><b>Nome da Promoção:</b> <?php echo $Compra['Nome_Promocao']; ?></p>
                <p><b>Valor da Promoção:</b> <?php echo $Compra['Valor_Promocao']; ?></p>
                <p><b>ID da Forma de Pagamento:</b> <?php echo $Compra['FormaPagamento_Id']; ?></p>
                <p><b>Nome da Forma de Pagamento:</b> <?php echo $Compra['Nome_FormaPagamento']; ?></p>
            </div><br>
        </form><br><br><br><br><br>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>
<?php
        } else {
            // Se a compra não for encontrada, redirecionar de volta para a lista de compras
            echo "<script>
                    alert ('Compra não encontrada!')
                    window.location.href = 'ListarCompras.php";
            if(isset($_GET['Id_Secretario'])) echo "?Id_Secretario=".$_GET['Id_Secretario'];
            echo "';</script>";
        }
    } else {
        if(isset($_GET['Id_Secretario'])) {
            $Secretario_id = $_GET['Id_Secretario'];
            header("Location: ListarCompras.php?Id_Secretario=$Secretario_id");
        } else {
            header("Location: ListarCompras.php");
        }
        exit();
    }
    ?>

</html>