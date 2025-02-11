<?php
include_once '../Conexao.php';

// Verifica se foi recebido o ID do administrador
if(isset($_GET['IdUsuario'])) {
    $Id_Administrador = $_GET['IdUsuario'];
    
    // Consulta para selecionar os dados do administrador com base no ID recebido
    $SQL_Visualizar_Administrador = "SELECT * FROM administradores WHERE Id = $Id_Administrador";
    $Res_Visualizar_Administrador = $BD->query($SQL_Visualizar_Administrador);

    // Verifica se o administrador foi encontrado
    if ($Res_Visualizar_Administrador->num_rows > 0) {
        // Exibe os dados do administrador
        $dadosAdministrador = $Res_Visualizar_Administrador->fetch_assoc();
        ?>

<!DOCTYPE html>
<html lang="Pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar-Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../.CSS/Style.css">
</head>

<body>
    <nav class="menu-lateral">
        <ul>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-headset"></i>
                    Secretários(as)
                </span>
            </p>
            <li class="item-menu">
                <a href='Secretário/CadastrarSecretario.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Cadastrar Secretário(a)
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='Secretário/ListarSecretarios.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
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
                <a href='Promoção/CadastrarPromocao.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Cadastrar Promoção
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='Promoção/ListarPromocoes.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
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
                <a href='Serviço/CadastrarServico.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Cadastrar Serviços
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='Serviço/ListarServicos.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
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
                <a href='VisualizarCompras/ListarCompras.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
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
                <a href='VisualizarClientes/ListarClientes.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
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
                <a href='VisualizarAnimais/ListarAnimais.php?Id_Administrador=<?php echo $Id_Administrador; ?>'>
                    <span class="txt-link">
                        Listar Animais
                    </span>
                </a>
            </li>
            <li class="item-menuSAIR">
                <a href='../Login.html'>
                    <span class="txt-linkSAIR">
                        SAIR
                    </span>
                </a>
            </li>
            <br><br><br><br><br>
        </ul>
    </nav>
    <center>
        <nav class="navbarini">
            <img id="ftnavbar" src="../.CSS/FTINI.png">
        </nav>
        <form action="" style="width:40%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados do administrador</h1>
            <div style="text-align: left; width: 57%;" id="dados_sec">
                <p><b>ID:</b> <?php echo $dadosAdministrador['Id']; ?></p>
                <p><b>CPF:</b> <?php echo $dadosAdministrador['CPF']; ?></p>
                <p><b>Nome:</b> <?php echo $dadosAdministrador['Nome']; ?></p>
                <p><b>Sexo:</b> <?php echo $dadosAdministrador['Sexo']; ?></p>
                <p><b>Data de Nascimento:</b> <?php echo $dadosAdministrador['DataNasc']; ?></p>
                <p><b>Telefone:</b> <?php echo $dadosAdministrador['Telefone']; ?></p>
                <p><b>Email:</b> <?php echo $dadosAdministrador['Email']; ?></p>
                <p><b>Data de Cadastro:</b> <?php echo $dadosAdministrador['DataCadastro']; ?></p><br>
            </div>
        </form><br><br><br><br><br><br><br>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>

<?php
    } else {
        // Se o administrador não for encontrado, exibe uma mensagem de erro
        echo "<script>alert('Administrador não encontrado.');</script>";
        echo "<script>window.history.back();</script>";
    }
} else {
    // Se o ID do administrador não for recebido, redireciona para a página de login
    echo "<script>alert('Realize login');</script>";
    echo "<script>window.location.href = '../Login.html';</script>";
}
?>