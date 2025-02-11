<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Secretário</title>
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
        <form style="width:35%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados do Secretário</h1>
            <div style="text-align: left; width:63%;" id="dados_sec">

                <?php
                include_once '../../Conexao.php';

                if (isset($_GET['Id'])) {
                    $Id = $_GET['Id'];

                    // Query to retrieve secretary details
                    $SQL_secretario = "SELECT * FROM secretarios WHERE Id = $Id";
                    $Res_secretario = $BD->query($SQL_secretario);

                    if ($Res_secretario->num_rows > 0) {
                        $Secretario = $Res_secretario->fetch_assoc();
                ?>

                <p><b>ID:</b> <?php echo $Secretario['Id']; ?></p>
                <p><b>CPF:</b> <?php echo $Secretario['CPF']; ?></p>
                <p><b>Nome:</b> <?php echo $Secretario['Nome']; ?></p>
                <p><b>Sexo:</b> <?php echo $Secretario['Sexo']; ?></p>
                <p><b>Data de Nascimento:</b> <?php echo date('d/m/Y', strtotime($Secretario['DataNasc'])); ?></p>
                <p><b>Telefone:</b> <?php echo $Secretario['Telefone']; ?></p>
                <p><b>Email:</b> <?php echo $Secretario['Email']; ?></p>
                <p><b>Data de Cadastro:</b> <?php echo date('d/m/Y', strtotime($Secretario['DataCadastro'])); ?></p>
                <p><b>Responsável:</b>
                    <?php 
                        $responsavelId = $Secretario['Administradores_Id'];
                        $SQL_administrador = "SELECT Nome FROM administradores WHERE Id = $responsavelId";
                        $Res_administrador = $BD->query($SQL_administrador);
                        if ($Res_administrador->num_rows > 0) {
                            $administrador = $Res_administrador->fetch_assoc();
                            echo $administrador['Nome'];
                        } else {
                            echo "Não encontrado";
                        }
                    ?>
                </p>
                <div style="text-align: center;">
                    <input type="button" class="button" value="Editar"
                        onclick="EditarSecretario(<?php echo $Secretario['Id']; ?>)">
                    <input type="button" class="button" value="Excluir"
                        onclick="ExcluirSecretario(<?php echo $Secretario['Id']; ?>)">
                    <p style='color:white;'>.</p>
                </div>
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
                echo "<p>Secretário não encontrado.</p>";
            }
        } else {
            echo "<p>ID do Secretário não encontrado.</p>";
        }
        ?>

        <script>
        function EditarSecretario(secretarioId) {
            window.location.href = "EditarSecretario.php?Id=" + secretarioId +
                "&Id_Administrador=<?php echo isset($_GET['Id_Administrador']) ? $_GET['Id_Administrador'] : ''; ?>";
        }

        function ExcluirSecretario(secretarioId) {
            var confirmation = confirm("Tem certeza de que deseja excluir este secretário?");
            if (confirmation) {
                window.location.href = "ExcluirSecretario.php?Id=" + secretarioId +
                    "&Id_Administrador=<?php echo isset($_GET['Id_Administrador']) ? $_GET['Id_Administrador'] : ''; ?>";
            }
        }
        </script>
</body>

</html>