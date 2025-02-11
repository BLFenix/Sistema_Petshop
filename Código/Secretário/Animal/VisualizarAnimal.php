<?php
include_once '../../Conexao.php';

// Verifica se o ID do animal foi passado via GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Consulta para recuperar os detalhes do animal
$SQL_Animal = "SELECT * FROM animais WHERE Id = $Id";
$Res_Animal = $BD->query($SQL_Animal);
 
// Verifica se o animal foi encontrado
if ($Res_Animal->num_rows > 0) {
    $Animal = $Res_Animal->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Animal</title>
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
        <form style="width:35%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Dados do Animal</h1>
            <div style="text-align: left; width:70%;" id="dados_sec">
                <p><b>ID:</b> <?php echo $Animal['Id']; ?></p>
                <p><b>Nome:</b> <?php echo $Animal['Nome']; ?></p> 
                <p><b>Tipo:</b> <?php echo $Animal['Tipo']; ?></p>
                <p><b>Raça:</b> <?php echo $Animal['Raca']; ?></p>
                <p><b>Sexo:</b> <?php echo $Animal['Sexo']; ?></p>
                <p><b>Data de Nascimento:</b> <?php echo date('d/m/Y', strtotime($Animal['DataNasc'])); ?></p>
                <p><b>Data de Cadastro:</b> <?php echo date('d/m/Y', strtotime($Animal['DataCadastro'])); ?></p>
                <p><b>ID do Dono:</b> <?php echo $Animal['Clientes_Id']; ?></p>
                <p><b>ID do Secretário Responsável:</b> <?php echo $Animal['Secretarios_Id']; ?></p>

                <?php
                // Consulta para recuperar os detalhes do cliente associado ao animal
                $Cliente_Id = $Animal['Clientes_Id'];
                $SQL_cliente = "SELECT Nome, CPF, Secretarios_Id FROM clientes WHERE Id = $Cliente_Id";
                $Res_cliente = $BD->query($SQL_cliente);

                if ($Res_cliente->num_rows > 0) {
                    $Cliente = $Res_cliente->fetch_assoc();
                ?>
                <h3><b>Dono do Animal:</b></h3>
                <p><b>Nome:</b> <?php echo $Cliente['Nome']; ?></p>
                <p><b>CPF:</b> <?php echo $Cliente['CPF']; ?></p>
                <input type="button" class="button" value="Visualizar Dono"
                    onclick="VisualizarDono(<?php echo $Cliente_Id . ', ' . $Cliente['Secretarios_Id']; ?>)">

                <?php
                } else {
                    echo "<p>Dono do animal não encontrado.</p>";
                }
                ?>
            </div><br><br>
            <input type="button" class="button" value="Editar Animal" style="margin-right:10px;"
                onclick="window.location.href='EditarAnimal.php?Id=<?php echo $Id; ?>&Id_Secretario=<?php echo $Animal['Secretarios_Id']; ?>'">
            <input type="button" class="button" value="Excluir Animal"
                onclick="excluirAnimal(<?php echo $Id; ?>, <?php echo $Animal['Secretarios_Id']; ?>); return false;">
            <p style="color:white;"></p>
            <br>
        </form>

        <script>
        function excluirAnimal(animalId, secretarioId) {
            var confirmation = confirm("Tem certeza de que deseja excluir este animal?");
            if (confirmation) {
                window.location.href = "ExcluirAnimal.php?Id=" + animalId + "&Id_Secretario=" + secretarioId;
            }
        }

        function VisualizarDono(clienteId, secretarioId) {
            window.location.href = "../Cliente/VisualizarCliente.php?Id=" + clienteId + "&Id_Secretario=" +
                secretarioId;
        }
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
    echo "<p>Animal não encontrado.</p>";
}
?>