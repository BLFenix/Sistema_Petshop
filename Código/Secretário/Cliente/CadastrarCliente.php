<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
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
        <form action="CadastrandoCliente.php" method="post" style="width:33%;">
            <p style=" color:white;">.</p>
            <h1 style="margin-top: 2px;">Cadastrar Cliente</h1>
            <div style="text-align: left; width:50%;">
                <label for="CPF_Cliente">CPF:</label><br><br>
                <input type="text" name="CPF" id="CPF_Cliente" pattern="\d{3}.\d{3}.\d{3}-\d{2}"
                    placeholder="Formato: 999.999.999-99" max="14" min="14"><br><br>
                <label for="Nome_Cliente">Nome:</label><br><br>
                <input type="text" name="Nome" id="Nome_Cliente" max="100" min="0"><br><br>
                <label for="Sexo_Cliente">Sexo:</label><br><br>
                <select name="Sexo" id="Sexo_Cliente">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                </select><br><br>
                <label for="DataNasc_Cliente">Data de Nascimento:</label><br><br>
                <input type="date" name="DataNasc" id="DataNasc_Cliente"><br><br>
                <label for="Telefone_Cliente">Telefone para Contato:</label><br><br>
                <input type="text" name="Telefone" id="Telefone_Cliente" pattern="\d{2} \d{4,5}-\d{4}"
                    placeholder="Formato: 99 99999-9999" max="13" min="13"><br><br>
                <label for="Email_Cliente">E-mail para contato:</label><br><br>
                <input type="email" name="Email" id="Email_Cliente" max="100" min="0"><br><br>
                <label>
                    <h2>Endereço:</h2>
                </label><br>
                <label for="Rua">Rua:</label><br><br>
                <input type="text" name="Rua" id="Rua"><br><br>
                <label for="Numero">Número:</label><br><br>
                <input type="number" name="Numero" id="Numero"><br><br>
                <label for="Complemento">Complemento:</label><br><br>
                <input type="text" name="Complemento" id="Complemento"><br><br>
                <label for="Bairro">Bairro:</label><br><br>
                <input type="text" name="Bairro" id="Bairro"><br><br>
                <label for="Cidade">Cidade:</label><br><br>
                <input type="text" name="Cidade" id="Cidade"><br><br>
                <label for="Estado">Estado:</label><br><br>
                <input type="text" name="Estado" id="Estado"><br><br>
                <label for="CEP">CEP:</label><br><br>
                <input type="text" name="CEP" id="CEP" pattern="\d{5}-\d{3}" placeholder="Formato: 99999-999" max="9"
                    min="9"><br><br>
                <!-- Input hidden para armazenar a data de cadastro -->
                <input type="hidden" name="DataCadastro" value="<?php echo date('Y-m-d'); ?>">
                <?php
            if(isset($_GET['Id_Secretario'])) {
                $Id_Secretario = $_GET['Id_Secretario'];
                echo "<input type='hidden' name='Secretarios_Id' id='Secretarios_Id_Cliente' value='$Id_Secretario'><br><br>";
            } else {
                echo "<input type='hidden' name='Secretarios_Id' id='Secretarios_Id_Cliente'><br><br>";
            }
        ?>
            </div>
            <div style="color:white;">
                <input type="submit" class="button" name="Enviar" value="Cadastrar">. . . .
                <input type="reset" class="button" name="Limpar" value="Redefinir">
            </div>

            <p style="color:white;">.</p>
        </form>
        <script>
        document.getElementById('CPF_Cliente').addEventListener('input', function(e) {
            var value = e.target.value;
            var cpfPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o terceiro dígito
                .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o sexto dígito
                .replace(/(\d{3})(\d)/, '$1-$2') // Adiciona traço após o nono dígito
                .replace(/(-\d{2})\d+?$/, '$1'); // Impede entrada de mais de 11 dígitos
            e.target.value = cpfPattern;
        });
        document.getElementById('Telefone_Cliente').addEventListener('input', function(e) {
            var value = e.target.value;
            var cpfPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                .replace(/(\d{2})(\d)/, '$1 $2') // Adiciona ponto após o terceiro dígito
                .replace(/(\d{5})(\d)/, '$1-$2') // Adiciona ponto após o sexto dígito
                .replace(/(-\d{4})\d+?$/, '$1'); // Impede entrada de mais de 11 dígitos
            e.target.value = cpfPattern;
        });
        document.getElementById('CEP').addEventListener('input', function(e) {
            var value = e.target.value;
            var cepPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                .replace(/(\d{5})(\d)/, '$1-$2') // Adiciona o hífen após o quinto dígito
                .replace(/(\d{5}-\d{3}).*/, '$1'); // Limita a entrada ao formato 99999-999

            e.target.value = cepPattern;
        });
        </script>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>