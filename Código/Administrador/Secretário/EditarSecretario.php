<?php
include_once '../../Conexao.php';

$Id = $_GET['Id'];

$Id_Administrador = $_GET['Id_Administrador'];

// Consulta para recuperar os detalhes do secretário
$SQL_secretario = "SELECT * FROM secretarios WHERE Id = $Id";
$Res_secretario = $BD->query($SQL_secretario);

if ($Res_secretario->num_rows > 0) {
    $Secretario = $Res_secretario->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Secretário</title>
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
        <form action="EditandoSecretario.php" method="post" id="secretarioForm">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Editar Secretário</h1>
            <div style="text-align: left; width:45%; color:white;">
                <label for="Id">ID do Secretário:</label><br><br>
                <input type="text" name="Id" value="<?php echo $Secretario['Id']; ?>" readonly><br><br>
                <label for="CPF">CPF:</label><br><br>
                <input type="text" name="CPF" id="CPF" value="<?php echo $Secretario['CPF']; ?>" readonly><br><br>
                <label for="Nome">Nome:</label><br><br>
                <input type="text" name="Nome" id="Nome" value="<?php echo $Secretario['Nome']; ?>"><br><br>
                <label for="Senha">Senha:</label><br><br>
                <input type="password" name="Senha" id="Senha" value="<?php echo $Secretario['Senha']; ?>"><br><br>
                <label for="Sexo">Sexo:</label><br><br>
                <select name="Sexo" id="Sexo">
                    <option value="Masculino" <?php if ($Secretario['Sexo'] === 'Masculino') echo 'selected'; ?>>
                        Masculino
                    </option>
                    <option value="Feminino" <?php if ($Secretario['Sexo'] === 'Feminino') echo 'selected'; ?>>Feminino
                    </option>
                </select><br><br>
                <label for="DataNasc">Data de Nascimento:</label><br><br>
                <input type="date" name="DataNasc" id="DataNasc" value="<?php echo $Secretario['DataNasc']; ?>"><br><br>
                <label for="Telefone">Telefone:</label><br><br>
                <input type="text" name="Telefone" id="Telefone" value="<?php echo $Secretario['Telefone']; ?>"><br><br>
                <label for="Email">Email:</label><br><br>
                <input type="email" name="Email" id="Email" value="<?php echo $Secretario['Email']; ?>"><br><br>
                <label for="Id_Admin">Id do Administrador Responsável:</label><br><br>
                <input type="text" name="Id_Admin" id="Id_Admin_Sec"
                    value="<?php echo $Secretario['Administradores_Id']; ?>" readonly><br><br>
                <input type="hidden" name="Id_Administrador" value="<?php echo $Id_Administrador; ?>"><br>
                <input type="submit" value="Editar" class="button" style="margin-left: 30px;">
                <input type="reset" class="button" name="Limpar" value="Redefinir" style="margin-left: 10px;">
                <p style='color:white;'>.</p>
            </div>
        </form>
        <script>
        document.getElementById('Telefone').addEventListener('input', function(e) {
            var value = e.target.value;
            var cpfPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                .replace(/(\d{2})(\d)/, '$1 $2') // Adiciona ponto após o terceiro dígito
                .replace(/(\d{5})(\d)/, '$1-$2') // Adiciona ponto após o sexto dígito
                .replace(/(-\d{4})\d+?$/, '$1'); // Impede entrada de mais de 11 dígitos
            e.target.value = cpfPattern;
        });
        // Função para exibir os dados do formulário no console
        function displayFormData() {
            var form = document.getElementById("secretarioForm");
            var formData = new FormData(form);

            console.log("Dados do Formulário:");
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
        }

        // Adicionando ouvintes de evento aos campos do formulário
        var formInputs = document.querySelectorAll("#secretarioForm input, #secretarioForm select");
        formInputs.forEach(function(input) {
            input.addEventListener("change", displayFormData);
        });

        // Exibir dados do formulário no carregamento da página
        displayFormData();
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
    echo "<script>alert('Secretário não encontrado!');</script>";
}
?>