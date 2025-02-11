<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Serviço</title>
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
        <form style="width:37%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados do Serviço</h1>
            <div style="text-align: left; width:71%;" id="dados_sec">

                <?php
            include_once '../../Conexao.php';

            if (isset($_GET['Id'])) {
                $Id = $_GET['Id'];

                // Query to retrieve service details
                $SQL_servico = "SELECT * FROM servicos WHERE Id = $Id";
                $Res_servico = $BD->query($SQL_servico);

                if ($Res_servico->num_rows > 0) {
                    $Servico = $Res_servico->fetch_assoc();

            ?>
                <p><b>ID:</b> <?php echo $Servico['Id']; ?></p>
                <p><b>Nome:</b> <?php echo $Servico['Nome']; ?></p>
                <p><b>Descrição:</b> <?php echo $Servico['Descricao']; ?></p>
                <p><b>Valor:</b> <?php echo "R$ " . $Servico['Valor']; ?></p>
                <p><b>Duração Estimada (minutos):</b> <?php echo $Servico['DuracaoEstimada']; ?></p>
                <p><b>Disponibilidade:</b> <?php echo $Servico['Disponibilidade']; ?></p>
                <p><b>Promoção:</b>
                    <?php 
                    $promocaoId = $Servico['Promocoes_Id'];
                    $SQL_promocao = "SELECT Nome, Valor FROM promocoes WHERE Id = $promocaoId";
                    $Res_promocao = $BD->query($SQL_promocao);
                    if ($Res_promocao->num_rows > 0) {
                        $promocao = $Res_promocao->fetch_assoc();
                        echo $promocao['Nome'] . " - R$ " . $promocao['Valor'];
                    } else {
                        echo "Não encontrado";
                    }
                ?>
                </p><br>
            </div>

            <div style="text-align: center; color: white;">
                <input type="button" class="button" value="Editar"
                    onclick="EditarServico(<?php echo $Servico['Id']; ?>)">......
                <input type="button" class="button" value="Excluir"
                    onclick="ExcluirServico(<?php echo $Servico['Id']; ?>)">
                <p style='color:white;'>.</p>
            </div>
        </form><br><br><br><br><br><br>
        <p style='color:rgb(46, 152, 184);'>.</p>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>

        <?php
        } else {
            echo "<p>Serviço não encontrado.</p>";
        }
    } else {
        echo "<p>ID do Serviço não encontrado.</p>";
    }
    ?>

        <script>
        function EditarServico(servicoId) {
            window.location.href = "EditarServico.php?Id=" + servicoId +
                "&Id_Administrador=<?php echo isset($_GET['Id_Administrador']) ? $_GET['Id_Administrador'] : ''; ?>";
        }

        function ExcluirServico(servicoId) {
            var confirmation = confirm("Tem certeza de que deseja excluir este serviço?");
            if (confirmation) {
                window.location.href = "ExcluirServico.php?Id=" + servicoId +
                    "&Id_Administrador=<?php echo isset($_GET['Id_Administrador']) ? $_GET['Id_Administrador'] : ''; ?>";
            }
        }
        </script>
        
</body>

</html>