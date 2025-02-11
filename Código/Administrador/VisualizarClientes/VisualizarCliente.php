<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Cliente</title>
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
        <form style="width:35%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados do Cliente</h1>
            <div style="text-align: left; width:70%;" id="dados_sec">

                <?php
            include_once '../../Conexao.php';

            if (isset($_GET['Id'])) {
                $Id = $_GET['Id'];

                // Consulta para recuperar os detalhes do cliente
                $SQL_cliente = "SELECT * FROM clientes WHERE Id = $Id";
                $Res_cliente = $BD->query($SQL_cliente);

                if ($Res_cliente->num_rows > 0) {
                    $Cliente = $Res_cliente->fetch_assoc();

                    // Consulta para recuperar os detalhes do endereço associado ao cliente
                    $Endereco_Id = $Cliente['Enderecos_Id'];
                    $SQL_endereco = "SELECT * FROM enderecos WHERE Id = $Endereco_Id";
                    $Res_endereco = $BD->query($SQL_endereco);

                if ($Res_endereco->num_rows > 0) {
                    $Endereco = $Res_endereco->fetch_assoc();
            ?>

                <p><b>ID:</b> <?php echo $Cliente['Id']; ?></p>
                <p><b>CPF:</b> <?php echo $Cliente['CPF']; ?></p>
                <p><b>Nome:</b> <?php echo $Cliente['Nome']; ?></p>
                <p><b>Sexo:</b> <?php echo $Cliente['Sexo']; ?></p>
                <p><b>Data de Nascimento:</b> <?php echo date('d/m/Y', strtotime($Cliente['DataNasc'])); ?></p>
                <p><b>Telefone:</b> <?php echo $Cliente['Telefone']; ?></p>
                <p><b>Email:</b> <?php echo $Cliente['Email']; ?></p>
                <p><b>Data de Cadastro:</b> <?php echo date('d/m/Y', strtotime($Cliente['DataCadastro'])); ?></p>
                <p><b> Id do Responsável:</b> <?php echo $Cliente['Secretarios_Id']; ?></p>

                <h3><b>Endereço Completo:</b></h3>

                <p><b>ID do Endereço:</b> <?php echo $Endereco['Id']; ?></p>
                <p><b>Rua:</b> <?php echo $Endereco['Rua']; ?></p>
                <p><b>Número:</b> <?php echo $Endereco['Numero']; ?></p>
                <p><b>Complemento:</b> <?php echo $Endereco['Complemento']; ?></p>
                <p><b>Bairro:</b> <?php echo $Endereco['Bairro']; ?></p>
                <p><b>Cidade:</b> <?php echo $Endereco['Cidade']; ?></p>
                <p><b>Estado:</b> <?php echo $Endereco['Estado']; ?></p>
                <p><b>CEP:</b> <?php echo $Endereco['CEP']; ?></p>


                <h3>Animais do Cliente</h3>

                <?php
                // Consulta para recuperar os animais relacionados ao cliente
                $SQL_animais = "SELECT * FROM animais WHERE Clientes_Id = $Id";
                $Res_animais = $BD->query($SQL_animais);

                if ($Res_animais->num_rows > 0) {
                    while ($Animal = $Res_animais->fetch_assoc()) {
                ?>

                <p><b>ID:</b> <?php echo $Animal['Id'] ?></p>
                <p><b>Nome:</b> <?php echo $Animal['Nome'] ?></p>
                <p><b>Tipo:</b> <?php echo $Animal['Tipo'] ?></p>
                <p><b>Raça:</b> <?php echo $Animal['Raca'] ?></p>
                <p><b>Sexo:</b> <?php echo $Animal['Sexo'] ?></p>
                <p><b>Data de Nascimento:</b> <?php echo date('d/m/Y', strtotime($Animal['DataNasc'])); ?></p>
                <p><b>Data de Cadastro:</b> <?php echo date('d/m/Y', strtotime($Animal['DataCadastro'])); ?></p>
                <p></p>
                <input type="button" value="Visualizar Animal" class="button"
                    onclick="window.location.href='../VisualizarAnimais/VisualizarAnimal.php?Id=<?php echo $Animal['Id']; ?>&Id_Administrador=<?php echo isset($_GET['Id_Administrador']) ? $_GET['Id_Administrador'] : ''; ?>'">

                <p style="color:white;"></p>

                <?php
                    }} else {
                ?>

                <p>O cliente não possui animais cadastrados.</p>

                <?php
                    }
                ?> <br>

            </div>
        </form>

        <?php
                } else {
                    echo "<p>O endereço não foi encontrado para este cliente!</p>";
                }
            }
        } else {
            // Se o Id do cliente não estiver definido, redireciona para a página de listagem de clientes
            if(isset($_GET['Id_Administrador'])) {
                $Id_Administrador = $_GET['Id_Administrador'];
                header("Location: ../VisualizarClientes/ListarClientes.php?Id_Administrador=$Id_Administrador");
            } else {
                header("Location: ../VisualizarClientes/ListarClientes.php");
            }
            exit(); // Garantindo a finalização do script após o redirecionamento
        }
        ?>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>