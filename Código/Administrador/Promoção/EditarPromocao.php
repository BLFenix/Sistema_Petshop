<?php
include_once '../../Conexao.php';

$Id = $_GET['Id'];

$Id_Administrador = $_GET['Id_Administrador'];

// Consulta para recuperar os detalhes da promoção
$SQL_promocao = "SELECT * FROM promocoes WHERE Id = $Id";
$Res_promocao = $BD->query($SQL_promocao);

if ($Res_promocao->num_rows > 0) {
    $Promocao = $Res_promocao->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Promoção</title>
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
    <form action="EditandoPromocao.php" method="post" id="promocaoForm">
        <p style="color:white;">.</p>
        <h1 style="margin-top: 2px;">Editar Promoção</h1>
        <div style="text-align: left; width:45%; color:white;">
        <label for="Id">ID da Promoção:</label>
        <input type="text" name="Id" value="<?php echo $Promocao['Id']; ?>" readonly><br><br>
        <label for="Nome">Nome:</label>
        <input type="text" name="Nome" id="Nome" value="<?php echo $Promocao['Nome']; ?>"><br><br>
        <label for="Valor">Valor:</label>
        <input type="number" step=".01" name="Valor" id="Valor" value="<?php echo $Promocao['Valor']; ?>" placeholder="Formato: 00.00" min="0"><br><br>
        <input type="hidden" name="Id_Administrador" value="<?php echo $Id_Administrador; ?>"><br>
        <input type="submit" value="Editar"  class="button" style="margin-left: 30px;" >
        <input type="reset" class="button" name="Limpar" value="Redefinir" style="margin-left: 10px;">
        <p style='color:white;'>.</p>
    </div>
    </form><br><br><br><br><br><br><br><br><br><br>

    <script>
    // Função para exibir os dados do formulário no console
    function displayFormData() {
        var form = document.getElementById("promocaoForm");
        var formData = new FormData(form);

        console.log("Dados do Formulário:");
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
    }

    // Adicionando ouvintes de evento aos campos do formulário
    var formInputs = document.querySelectorAll("#promocaoForm input");
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
    echo "<script>alert('Promoção não encontrada!');</script>";
}
?>