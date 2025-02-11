<?php
include_once '../../Conexao.php';

$Id = $_GET['Id'];
$Id_Administrador = $_GET['Id_Administrador'];

// Consulta para recuperar os detalhes do serviço
$SQL_servico = "SELECT * FROM servicos WHERE Id = $Id";
$Res_servico = $BD->query($SQL_servico);

if ($Res_servico->num_rows > 0) {
    $Servico = $Res_servico->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço</title>
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
    <form action="EditandoServico.php" method="post" id="servicoForm">
        <p style="color:white;">.</p>
        <h1 style="margin-top: 2px;">Editar Serviço</h1>
        <div style="text-align: left; width:45%; color:white;">
            <label for="Id">ID do Serviço:</label><br><br>
            <input type="text" name="Id" value="<?php echo $Servico['Id']; ?>" readonly><br><br>
            <label for="Nome">Nome:</label><br><br>
            <input type="text" name="Nome" id="Nome" value="<?php echo $Servico['Nome']; ?>"><br><br>
            <label for="Descricao">Descrição:</label><br><br>
            <textarea name="Descricao" id="Descricao" rows="4"
                cols="50" style="max-width: 96%;"><?php echo $Servico['Descricao']; ?></textarea><br><br>
            <label for="Valor">Valor:</label><br><br>
            <input type="number" step=".01" name="Valor" id="Valor" value="<?php echo $Servico['Valor']; ?>" placeholder="Formato: 00.00" min="0"><br><br>
            <label for="DuracaoEstimada">Duração Estimada (minutos):</label><br><br>
            <input type="number" name="DuracaoEstimada" id="DuracaoEstimada"
                value="<?php echo $Servico['DuracaoEstimada']; ?>"><br><br>
            <label for="Disponibilidade">Disponibilidade:</label><br><br>
            <input type="text" name="Disponibilidade" id="Disponibilidade"
                value="<?php echo $Servico['Disponibilidade']; ?>"><br><br>
            <label for="Promocoes_Id">ID da Promoção:</label><br><br>
            <input type="number" name="Promocoes_Id" id="Promocoes_Id"
                value="<?php echo $Servico['Promocoes_Id']; ?>"><br><br>
            <input type="hidden" name="Administradores_Id" value="<?php echo $Servico['Administradores_Id']; ?>"><br>
            <input type="hidden" name="Id_Administrador" value="<?php echo $Id_Administrador; ?>">
            <input type="submit" value="Editar"  class="button" style="margin-left: 30px;" >
            <input type="reset" class="button" name="Limpar" value="Redefinir" style="margin-left: 10px;">
            <p style='color:white;'>.</p>
        </div>
    </form>

    <script>
    // Função para exibir os dados do formulário no console
    function displayFormData() {
        var form = document.getElementById("servicoForm");
        var formData = new FormData(form);

        console.log("Dados do Formulário:");
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
    }

    // Adicionando ouvintes de evento aos campos do formulário
    var formInputs = document.querySelectorAll("#servicoForm input, #servicoForm textarea");
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
    echo "<script>alert('Serviço não encontrado!');</script>";
}
?>