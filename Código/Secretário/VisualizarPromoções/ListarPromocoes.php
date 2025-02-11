<?php
include_once '../../Conexao.php';

$SQL_Listar_Promocoes = "SELECT * FROM promocoes";
$Res_Listar_Promocoes = $BD->query($SQL_Listar_Promocoes);

$Id_Secretario = isset($_REQUEST['Id_Secretario']) ? $_REQUEST['Id_Secretario'] : '';

$searchResults = []; // Array para armazenar os resultados da pesquisa

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchBy = $_POST['searchBy'];
    $searchValue = $_POST['searchValue'];

    if ($searchBy === 'Id') {
        $SQL_Pesquisar_Promocoes = "SELECT * FROM promocoes WHERE Id = '$searchValue'";
    } elseif ($searchBy === 'Nome') {
        $SQL_Pesquisar_Promocoes = "SELECT * FROM promocoes WHERE Nome LIKE '%$searchValue%'";
    } elseif ($searchBy === 'Valor') {
        if (!preg_match('/^R\$ \d+(\,\d{2})?$/', $searchValue)) {
            $numericValue = str_replace(',', '.', str_replace('R$ ', '', $searchValue));
            if (is_numeric($numericValue)) {
                $searchValue = 'R$ ' . number_format($numericValue, 2, ',', '.');
            }
        }

        if (preg_match('/^R\$ \d+(\,\d{2})?$/', $searchValue)) {
            $numericValue = str_replace(',', '.', str_replace('R$ ', '', $searchValue));
            $SQL_Pesquisar_Promocoes = "SELECT * FROM promocoes WHERE Valor = ?";
            $stmt = $BD->prepare($SQL_Pesquisar_Promocoes);
            $stmt->bind_param("d", $numericValue); // Assumindo que Valor é um decimal
        } else {
            echo "<script>alert('Formato de valor inválido!');</script>";
            $stmt = null;
        }
    }

    if ($stmt) {
        $stmt->execute();
        $Res_Pesquisar_Promocoes = $stmt->get_result();

        if ($Res_Pesquisar_Promocoes && $Res_Pesquisar_Promocoes->num_rows > 0) {
            while ($row = $Res_Pesquisar_Promocoes->fetch_assoc()) {
                $searchResults[] = $row;
            }
        } else {
            echo "<script>alert('Nenhum Resultado encontrado para a pesquisa.');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Promoções</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../.CSS/Style.css">

</head>

<body>
    <nav class="menu-lateral">
        <?php
            if(isset($_REQUEST['Id_Secretario'])) {
                $Id_Secretario = $_REQUEST['Id_Secretario'];
        ?>
        <ul>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-person-arms-up"></i>
                    Cliente
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
                        Listar Cliente
                    </span>
                </a>
            </li>
            <p></p>
            <p>
                <span class="Icon" style="font-size:xx-large; color: green;">
                    <i class="bi bi-github"></i>
                    Animal
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
                        Listar Animal
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
            }   
        ?>
    </nav>
    <center>
        <nav class="navbarini">
            <a href="../IniciarSecretario.php?IdUsuario=<?php echo $Id_Secretario; ?>"> <img id="ftnavbar"
                    src="../../.CSS/FTINI.png" title="Ir para o menu inicial"> </a>
        </nav>
        <h1>Pesquisar Promoções</h1>
        <div class="pesquisar">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="width: 672px;">
                <label for="searchBy">Pesquisar por:</label>
                <select name="searchBy" id="searchBy" required>
                    <option value="" disabled selected>Selecione...</option>
                    <option value="Id">ID</option>
                    <option value="Nome">Nome</option>
                    <option value="Valor">Valor</option>
                </select>
                <input type="text" name="searchValue" id="searchValue" required>
                <input type="hidden" name="Id_Secretario" value="<?php echo $Id_Secretario; ?>">
                <input type="submit" value="Pesquisar">
            </form>
        </div>

        <br><br>

        <script>
        document.getElementById('searchBy').addEventListener('change', function() {
            var searchBy = this.value;
            var searchValueInput = document.getElementById('searchValue');
            if (searchBy === 'Valor') {
                searchValueInput.setAttribute('placeholder',
                    'Ex: R$ 0,00');
            } else {
                searchValueInput.removeAttribute('placeholder');
            }
        });
        </script>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($searchResults)) {
            echo "<h1>Resultado da Pesquisa:</h1>";
            echo "<table>";
            echo "<tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Visualizar</th>
            </tr>";
            foreach ($searchResults as $row) {
                echo "<tr>";
                echo "<td>" . $row['Id'] . "</td>";
                echo "<td>" . $row['Nome'] . "</td>";
                $formattedValue = number_format($row['Valor'], 2, ',', '.');
                echo "<td>R$ " . $formattedValue . "</td>";
                echo "<td class='view-td'><a class='view' href='VisualizarPromocao.php?Id=" . $row['Id'] . "&Id_Secretario=" . $Id_Secretario . "'>Visualizar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    ?>

        <br><br>

        <h1>Listagem de Promoções</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Visualizar</th>
            </tr>
            <?php
        while ($row = $Res_Listar_Promocoes->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Id'] . "</td>";
            echo "<td>" . $row['Nome'] . "</td>";
            $formattedValue = number_format($row['Valor'], 2, ',', '.');
            echo "<td>R$ " . $formattedValue . "</td>";
            echo "<td class='view-td'><a class='view' href='VisualizarPromocao.php?Id=" . $row['Id'] . "&Id_Secretario=" . $Id_Secretario . "'>Visualizar</a></td>";
            echo "</tr>";
        }
        ?>
        </table>

        <?php
    $Res_Listar_Promocoes->data_seek(0);
    $todosDados = $Res_Listar_Promocoes->fetch_all(MYSQLI_ASSOC);
    echo "<script>";
    echo "console.log(" . json_encode($todosDados) . ");";
    echo "</script>";
    ?>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>