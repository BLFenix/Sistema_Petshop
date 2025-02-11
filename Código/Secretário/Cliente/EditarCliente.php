<?php
include_once '../../Conexao.php';

$Id = null;
if(isset($_GET['Id'])) {
    $Id = $_GET['Id'];
}

$Id_Secretario = null;
if(isset($_GET['Id_Secretario'])) {
    $Id_Secretario = $_GET['Id_Secretario'];
}

// Consulta para recuperar os detalhes do cliente
$SQL_cliente = "SELECT * FROM clientes WHERE Id = ?";
$stmt_cliente = $BD->prepare($SQL_cliente);
$stmt_cliente->bind_param("i", $Id);
$stmt_cliente->execute();
$Res_cliente = $stmt_cliente->get_result();

if ($Res_cliente->num_rows > 0) {
    $Cliente = $Res_cliente->fetch_assoc();

    // Consulta para recuperar os detalhes do endereço associado ao cliente
    $Endereco_Id = $Cliente['Enderecos_Id'];
    $SQL_endereco = "SELECT * FROM enderecos WHERE Id = $Endereco_Id";
    $Res_endereco = $BD->query($SQL_endereco);

    if ($Res_endereco->num_rows > 0) {
        $Endereco = $Res_endereco->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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
            <a href="../IniciarSecretario.php?IdUsuario=<?php echo $Id_Secretario; ?>"> <img id="ftnavbar"
                    src="../../.CSS/FTINI.png" title="Ir para o menu inicial"> </a>
        </nav>
        <form action="EditandoCliente.php" method="post" id="clienteForm">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Editar Cliente</h1>
            <div style="text-align: left; width:45%; color:white;">
                <label for="Id">Id do Cliente:</label><br><br>
                <input type="text" name="Id" value="<?php echo $Cliente['Id']; ?>" readonly><br><br>
                <label for="CPF">CPF:</label><br><br>
                <input type="text" name="CPF" id="CPF" value="<?php echo $Cliente['CPF']; ?>" readonly><br><br>
                <label for="Nome">Nome:</label><br><br>
                <input type="text" name="Nome" id="Nome" value="<?php echo $Cliente['Nome']; ?>"><br><br>
                <label for="Sexo">Sexo:</label><br><br>
                <select name="Sexo" id="Sexo">
                    <option value="Masculino" <?php if ($Cliente['Sexo'] === 'Masculino') echo 'selected'; ?>>Masculino
                    </option>
                    <option value="Feminino" <?php if ($Cliente['Sexo'] === 'Feminino') echo 'selected'; ?>>Feminino
                    </option>
                </select><br><br>
                <label for="DataNasc">Data de Nascimento:</label><br><br>
                <input type="date" name="DataNasc" id="DataNasc" value="<?php echo $Cliente['DataNasc']; ?>"><br><br>
                <label for="Telefone">Telefone:</label><br><br>
                <input type="text" name="Telefone" id="Telefone" value="<?php echo $Cliente['Telefone']; ?>"><br><br>
                <label for="Email">Email:</label><br><br>
                <input type="email" name="Email" id="Email" value="<?php echo $Cliente['Email']; ?>"><br><br>
                <label for="Secretarios_Id">ID do Secretário:</label><br><br>
                <input type="text" name="Secretarios_Id" id="Secretarios_Id"
                    value="<?php echo $Cliente['Secretarios_Id']; ?>" readonly><br><br>
                <!-- Fim dos campos do cliente -->
                <!-- Campos do endereço -->
                <label for="Endereco_Id">Id do Endereço:</label><br><br>
                <input type="text" name="Endereco_Id" id="Endereco_Id" value="<?php echo $Endereco['Id']; ?>"
                    readonly><br><br>
                <label for="Rua">Rua:</label><br><br>
                <input type="text" name="Rua" id="Rua" value="<?php echo $Endereco['Rua']; ?>"><br><br>
                <label for="Numero">Número:</label><br><br>
                <input type="text" name="Numero" id="Numero" value="<?php echo $Endereco['Numero']; ?>"><br><br>
                <label for="Complemento">Complemento:</label><br><br>
                <input type="text" name="Complemento" id="Complemento"
                    value="<?php echo $Endereco['Complemento']; ?>"><br><br>
                <label for="Bairro">Bairro:</label><br><br>
                <input type="text" name="Bairro" id="Bairro" value="<?php echo $Endereco['Bairro']; ?>"><br><br>
                <label for="Cidade">Cidade:</label><br><br>
                <input type="text" name="Cidade" id="Cidade" value="<?php echo $Endereco['Cidade']; ?>"><br><br>
                <label for="Estado">Estado:</label><br><br>
                <input type="text" name="Estado" id="Estado" value="<?php echo $Endereco['Estado']; ?>"><br><br>
                <label for="CEP">CEP:</label><br><br>
                <input type="text" name="CEP" id="CEP" value="<?php echo $Endereco['CEP']; ?>"><br><br>
                <input type="hidden" name="Id_Secretario" value="<?php echo $Id_Secretario; ?>">
                <!-- Fim dos campos do endereço -->

                <br>
                <input type="submit" value="Editar" class="button" style="margin-left: 30px;">
                <input type="reset" class="button" name="Limpar" value="Redefinir" style="margin-left: 10px;">
                <p style="color:white;">.</p>
            </div>
        </form>

        <script>
        // Função para exibir os dados do formulário no console
        function exibirDadosFormulario() {
            var form = document.getElementById("clienteForm");
            var formData = new FormData(form);

            console.log("Dados do formulário:");
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
        }

        // Adicionando manipuladores de eventos aos campos do formulário
        var formInputs = document.querySelectorAll("#clienteForm input, #clienteForm select");
        formInputs.forEach(function(input) {
            input.addEventListener("change", exibirDadosFormulario);
        });

        // Exibir dados do formulário ao carregar a página
        exibirDadosFormulario();
        document.getElementById('CPF').addEventListener('input', function(e) {
            var value = e.target.value;
            var cpfPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o terceiro dígito
                .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o sexto dígito
                .replace(/(\d{3})(\d)/, '$1-$2') // Adiciona traço após o nono dígito
                .replace(/(-\d{2})\d+?$/, '$1'); // Impede entrada de mais de 11 dígitos
            e.target.value = cpfPattern;
        });
        document.getElementById('Telefone').addEventListener('input', function(e) {
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
<?php
    } else {
        echo "<script>alert('Endereço não encontrado para este cliente!');</script>";
    }
} else {
    echo "<script>alert('Cliente não encontrado!');</script>";
}
?>