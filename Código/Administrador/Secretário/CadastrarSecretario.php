<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Secretário</title>
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
        <form action="CadastrandoSecretario.php" method="post" style="width:33%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Cadastrar Secretário</h1>
            <div style="text-align: left; width:50%; color:white;">
                <label for="CPF_Secretario">CPF:</label><br><br>
                <input type="text" name="CPF" id="CPF_Secretario" pattern="\d{3}.\d{3}.\d{3}-\d{2}"
                    placeholder="Formato: 999.999.999-99"><br><br>
                <label for="Nome_Secretario">Nome:</label><br><br>
                <input type="text" name="Nome" id="Nome_Secretario" max="100"><br><br>
                <label for="Senha_Secretario">Senha:</label><br>
                <input type="password" name="Senha" id="Senha_Secretario"><br><br>
                <label for="Sexo_Secretario">Sexo:</label><br><br>
                <select name="Sexo" id="Sexo_Secretario">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                </select><br><br>
                <label for="DataNasc_Secretario">Data de Nascimento:</label><br><br>
                <input type="date" name="DataNasc" id="DataNasc_Secretario"><br><br>
                <label for="Telefone_Secretario">Telefone para Contato:</label><br><br>
                <input type="text" name="Telefone" id="Telefone_Secretario" pattern="\d{2} \d{4,5}-\d{4}"
                    placeholder="Formato: 99 99999-9999"><br><br>
                <label for="Email_Secretario">E-mail para contato:</label><br><br>
                <input type="email" name="Email" id="Email_Secretario"><br><br>
                <!-- Input hidden para armazenar a data de cadastro -->
                <input type="hidden" name="DataCadastro" value="<?php echo date('Y-m-d'); ?>">
                <?php
                    if(isset($_GET['Id_Administrador'])) {
                        $Id_Administrador = $_GET['Id_Administrador'];
                        echo "<input type='hidden' name='Id_Administrador' id='Administradores_Id_Secretario' value='$Id_Administrador'><br><br>";
                    } else {
                        echo "<input type='hidden' name='Id_Administrador' id='Administradores_Id_Secretario'><br><br>";
                    }
                ?>
                <input class="button" type="submit" name="Enviar" value="Cadastrar">
                . .
                <input type="reset" class="button" name="Limpar" value="Redefinir">
                <p style='color:white;'>.</p>
            </div>
        </form>
        <script>
            document.getElementById('CPF_Secretario').addEventListener('input', function(e) {
            var value = e.target.value;
            var cpfPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                                    .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o terceiro dígito
                                    .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o sexto dígito
                                    .replace(/(\d{3})(\d)/, '$1-$2') // Adiciona traço após o nono dígito
                                    .replace(/(-\d{2})\d+?$/, '$1'); // Impede entrada de mais de 11 dígitos
            e.target.value = cpfPattern;
            });
            document.getElementById('Telefone_Secretario').addEventListener('input', function(e) {
            var value = e.target.value;
            var cpfPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                                    .replace(/(\d{2})(\d)/, '$1 $2') // Adiciona ponto após o terceiro dígito
                                    .replace(/(\d{5})(\d)/, '$1-$2') // Adiciona ponto após o sexto dígito
                                    .replace(/(-\d{4})\d+?$/, '$1'); // Impede entrada de mais de 11 dígitos
            e.target.value = cpfPattern;
            });
        </script>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>