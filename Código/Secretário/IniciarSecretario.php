<?php
    include_once '../Conexao.php';

    // Verifica se foi recebido o ID do secretário
    if(isset($_GET['IdUsuario'])) {
        $Id_Secretario = $_GET['IdUsuario'];
        
        // Consulta para selecionar os dados do secretário com base no ID recebido
        $SQL_Visualizar_Secretario = "SELECT * FROM secretarios WHERE Id = $Id_Secretario";
        $Res_Visualizar_Secretario = $BD->query($SQL_Visualizar_Secretario);

        // Verifica se o secretário foi encontrado
        if ($Res_Visualizar_Secretario->num_rows > 0) {
            // Exibe os dados do secretário
            $dadosSecretario = $Res_Visualizar_Secretario->fetch_assoc();
            
            // Consulta para obter o nome do administrador responsável pelo secretário
            $Id_Secretario = $dadosSecretario['Administradores_Id'];
            $SQL_Nome_Administrador = "SELECT Nome FROM administradores WHERE Id = $Id_Secretario";
            $Res_Nome_Administrador = $BD->query($SQL_Nome_Administrador);
            
            // Verifica se o administrador foi encontrado
            if ($Res_Nome_Administrador->num_rows > 0) {
                $dadosAdministrador = $Res_Nome_Administrador->fetch_assoc();
                $nomeAdministrador = $dadosAdministrador['Nome'];
            } else {
                $nomeAdministrador = "Não encontrado";
            }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar-Secretário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../.CSS/Style.css">
</head>

<body>
    <nav class="menu-lateral">
        <?php
            if(isset($_GET['IdUsuario'])) {
                $Id_Secretario = $_GET['IdUsuario'];
        ?>
        <ul>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-person-arms-up"></i>
                    Cliente
                </span>
            </p>
            <li class="item-menu">
                <a href='Cliente/CadastrarCliente.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Cadastrar Cliente
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='Cliente/ListarClientes.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Cliente
                    </span>
                </a>
            </li>
            <p></p>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-github"></i>
                    Animal
                </span>
            </p>
            <li class="item-menu">
                <a href='Animal/CadastrarAnimal.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Cadastrar Animal
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='Animal/ListarAnimais.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Animal
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
                <a href='Compra/Comprar.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Realizar Compra
                    </span>
                </a>
            </li>
            <p></p>
            <li class="item-menu">
                <a href='Compra/ListarCompras.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
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
                <a href='VisualizarPromoções/ListarPromocoes.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Promoções
                    </span>
                </a>
            </li>
            <p></p>

            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-cash"></i>
                    Serviços
                </span>
            </p>
            <li class="item-menu">
                <a href='VisualizarServiços/ListarServicos.php?Id_Secretario=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Serviços
                    </span>
                </a>
            </li>
            <li class="item-menuSAIR">
                <a href="../Login.html">
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
            }   
        ?>
    </nav>
    <center>
        <nav class="navbarini">
            <img id="ftnavbar" src="../.CSS/FTINI.png">
        </nav>
        <form action="" style="width:37%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados do Secretário(a)</h1>
            <div style="text-align: left; width:60%;" id="dados_sec">
                <p><b>ID:</b> <?php echo $dadosSecretario['Id']; ?></p>
                <p><b>CPF:</b> <?php echo $dadosSecretario['CPF']; ?></p>
                <p><b>Nome:</b> <?php echo $dadosSecretario['Nome']; ?></p>
                <p><b>Sexo:</b> <?php echo $dadosSecretario['Sexo']; ?></p>
                <p><b>Data de Nascimento:</b> <?php echo $dadosSecretario['DataNasc']; ?></p>
                <p><b>Telefone:</b> <?php echo $dadosSecretario['Telefone']; ?></p>
                <p><b>Email:</b> <?php echo $dadosSecretario['Email']; ?></p>
                <p><b>Data de Cadastro:</b> <?php echo $dadosSecretario['DataCadastro']; ?></p>
                <p><b>Responsável:</b> <?php echo $nomeAdministrador; ?></p>
            </div>
            <p style="color:white;">.</p>
        </form><br><br><br>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>
<?php
    } else {
        // Se o secretário não for encontrado, exibe uma mensagem de erro
        echo "<script>alert('Secretário não encontrado.');</script>";
        echo "<script>window.history.back();</script>";
    }
} else {
    // Se o ID do secretário não for recebido, redireciona para a página de login
    echo "<script>alert('Realize login');</script>";
    echo "<script>window.location.href = '../Login.html';</script>";
}
?>