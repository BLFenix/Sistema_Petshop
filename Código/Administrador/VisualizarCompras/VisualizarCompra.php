<?php
include_once '../../Conexao.php';

if (isset($_GET['Id'])) { 
    $Id = $_GET['Id'];

    // Consulta para recuperar os detalhes da compra
    $SQL_compra = "SELECT * FROM compras WHERE Id = $Id";

    $Res_compra = $BD->query($SQL_compra);

    if ($Res_compra->num_rows > 0) {
        $Compra = $Res_compra->fetch_assoc();

        // Exibir detalhes da compra
        // Consulta para recuperar o nome da forma de pagamento
        $SQL_forma_pagamento = "SELECT Nome FROM formapagamento WHERE Id = (SELECT FormaPagamento_Id FROM compras WHERE Id = $Id)";

        $Res_forma_pagamento = $BD->query($SQL_forma_pagamento);

        if ($Res_forma_pagamento->num_rows > 0) {
            $FormaPagamento = $Res_forma_pagamento->fetch_assoc();

            // Exibir o nome da forma de pagamento
            $NomeFormaPagamento = $FormaPagamento['Nome'];
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
            if(isset($_GET['Id_Administrador'])) {
                $Id_Administrador = $_GET['Id_Administrador'];
        ?>
        <ul>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-headset"></i>
                    Secretários(as)
                </span>
            </p>
            <li class="item-menu">
                <a href='../Secretário/CadastrarSecretario.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Cadastrar Secretário(a)
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='../Secretário/ListarSecretarios.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Listar Secretários(as)
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
                <a href='../Promoção/CadastrarPromocao.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Cadastrar Promoção
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='../Promoção/ListarPromocoes.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
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
                <a href='../Serviço/CadastrarServico.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Cadastrar Serviços
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='../Serviço/ListarServicos.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Listar Serviços
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
            <p></p>
            <li class="item-menu">
                <a href='../VisualizarCompras/ListarCompras.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Listar Compras
                    </span>
                </a>
            </li>
            <p></p>
            <span class="Icon" style="font-size:xx-large; color: green;">
                <i class="bi bi-person-arms-up"></i>
                Clientes
            </span>
            <p></p>
            <li class="item-menu">
                <a href='../VisualizarClientes/ListarClientes.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Listar Clientes
                    </span>
                </a>
            </li>
            <span class="Icon" style="font-size:xx-large; color: green;">
                <i class="bi bi-github"></i>
                Animais
            </span>
            <p></p>
            <li class="item-menu">
                <a href='../VisualizarAnimais/ListarAnimais.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Listar Animais
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
            <a href="../IniciarAdministrador.php?IdUsuario=<?php echo $Id_Administrador; ?>"> <img id="ftnavbar"
                    src="../../.CSS/FTINI.png" title="Ir para o menu inicial"> </a>
        </nav>
        <form style="width:38%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados da Compra</h1>
            <div style="text-align: left; width:70%;" id="dados_sec">
                <p><b>ID:</b> <?php echo $Compra['Id']; ?></p>
                <p><b>Data e Hora:</b> 
                    <?php 
                        $DataHora = new DateTime($Compra['DataHora']);
                        echo $DataHora->format('d/m/Y H:i:s'); 
                    ?>
                </p>
                <p><b>Valor:</b> R$ <?php echo $Compra['Valor']; ?></p>
                <p><b>Serviço:</b> <?php echo $Compra['Nome_Servico']; ?></p>
                <p><b>Secretário:</b> <?php echo $Compra['Nome_Secretario']; ?></p>
                <p><b>Cliente:</b> <?php echo $Compra['Nome_Cliente']; ?></p>
                <p><b>Animal:</b> <?php echo $Compra['Nome_Animal']; ?></p>
                <p><b>Promoção:</b> <?php echo $Compra['Nome_Promocao']; ?> - R$
                    <?php echo $Compra['Valor_Promocao']; ?>
                </p>
                <p><b>Forma de Pagamento:</b> <?php echo $FormaPagamento['Nome']; ?></p>
            </div><br>
        </form><br><br><br><br><br>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>
<?php
        }
    } else {
        // Se a compra não for encontrada, redirecionar de volta para a lista de compras
        echo "<script>
                alert ('Compra não encontrada!')
                window.location.href = 'ListarCompras.php";
        if(isset($_GET['Id_Administrador'])) echo "?Id_Administrador=".$_GET['Id_Administrador'];
        echo "';</script>";
    }
} else {
    if(isset($_GET['Id_Administrador'])) {
        $Administrador_id = $_GET['Id_Administrador'];
        header("Location: ListarCompras.php?Id_Administrador=$Administrador_id");
    } else {
        header("Location: ListarCompras.php");
    }
    exit();
}
?>