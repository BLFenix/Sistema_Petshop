<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da Promoção</title>
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
            <br><br><br><br><br>
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
        <form style="width:37%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados da Promoção</h1>
            <div style="text-align: left; width:40%;" id="dados_sec">

                <?php
                include_once '../../Conexao.php';

                if (isset($_GET['Id'])) {
                    $Id = $_GET['Id'];

                    // Query para recuperar os detalhes da promoção
                    $SQL_promocao = "SELECT * FROM promocoes WHERE Id = $Id";
                    $Res_promocao = $BD->query($SQL_promocao);

                    if ($Res_promocao->num_rows > 0) {
                        $Promocao = $Res_promocao->fetch_assoc();
                ?>

                <p><b>ID:</b> <?php echo $Promocao['Id']; ?></p>
                <p><b>Nome:</b> <?php echo $Promocao['Nome']; ?></p>
                <p><b>Valor:</b> <?php echo "R$ ". $Promocao['Valor']; ?></p>
                <br>
                <input type="button" class="button" value="Editar"
                    onclick="EditarPromocao(<?php echo $Promocao['Id']; ?>)">
                <input type="button" class="button" value="Excluir"
                    onclick="ExcluirPromocao(<?php echo $Promocao['Id']; ?>)">
                <p style='color:white;'>.</p>

            </div>
        </form><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>

        <?php
                    } else {
                        echo "<p>Promoção não encontrada.</p>";
                    }
                } else {
                    echo "<p>ID da Promoção não encontrado.</p>";
                }
                ?>

        <script>
        function EditarPromocao(promocaoId) {
            window.location.href = "EditarPromocao.php?Id=" + promocaoId +
                "&Id_Administrador=<?php echo isset($_GET['Id_Administrador']) ? $_GET['Id_Administrador'] : ''; ?>";
        }

        function ExcluirPromocao(promocaoId) {
            var confirmation = confirm("Tem certeza de que deseja excluir esta promoção?");
            if (confirmation) {
                window.location.href = "ExcluirPromocao.php?Id=" + promocaoId +
                    "&Id_Administrador=<?php echo isset($_GET['Id_Administrador']) ? $_GET['Id_Administrador'] : ''; ?>";
            }
        }
        </script>
</body>

</html>