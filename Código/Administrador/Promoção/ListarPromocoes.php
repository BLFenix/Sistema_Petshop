<?php
include_once '../../Conexao.php';

$SQL_Listar_Promocoes = "SELECT * FROM promocoes";
$Res_Listar_Promocoes = $BD->query($SQL_Listar_Promocoes);

$Id_Administrador = isset($_REQUEST['Id_Administrador']) ? $_REQUEST['Id_Administrador'] : '';

$searchResults = []; // Array para armazenar os resultados da pesquisa

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchBy = $_POST['searchBy'];
    $searchValue = $_POST['searchValue'];
    
    if ($searchBy === 'Id') {
        $SQL_Pesquisar_Promocoes = "SELECT * FROM promocoes WHERE Id = ?";
        $stmt = $BD->prepare($SQL_Pesquisar_Promocoes);
        $stmt->bind_param("i", $searchValue); // Assumindo que Id é um inteiro
    } elseif ($searchBy === 'Nome') {
        $SQL_Pesquisar_Promocoes = "SELECT * FROM promocoes WHERE Nome LIKE ?";
        $searchValue = "%$searchValue%";
        $stmt = $BD->prepare($SQL_Pesquisar_Promocoes);
        $stmt->bind_param("s", $searchValue);
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
                <a href='../Login.html'>
                    <span class="txt-linkSAIR">
                        Sair
                    </span>
                </a>
            </li>
            <br><br><br><br><br>
        </ul>
    </nav>
    <center>
        <nav class="navbarini">
            <a href="../IniciarAdministrador.php?IdUsuario=<?php echo $Id_Administrador; ?>"> <img id="ftnavbar"
                    src="../../.CSS/FTINI.png" title="Ir para o menu inicial"> </a>
        </nav>
        <h1>Pesquisar Promoções</h1>
        <div class="pesquisar">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="width: 680px;">
                <label for="searchBy">Pesquisar por:</label>
                <select name="searchBy" id="searchBy" required>
                    <option value="" disabled selected>Selecione...</option>
                    <option value="Id">ID</option>
                    <option value="Nome">Nome</option>
                    <option value="Valor">Valor</option>
                </select>
                <input type="text" name="searchValue" id="searchValue" required>
                <input type="hidden" name="Id_Administrador" value="<?php echo $Id_Administrador; ?>">
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
                    'Ex: R$ 0,00'); // Mostra o placeholder com o formato esperado
            } else {
                searchValueInput.removeAttribute(
                    'placeholder'); // Remove o placeholder se a opção não for "Valor"
            }
        });
        </script>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($searchResults)) {
            // Se houver resultados da pesquisa, exiba a tabela de resultados
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
                $formattedValue = number_format($row['Valor'], 2, ',', '.'); // Formata o valor com duas casas decimais, vírgula como separador de milhar e ponto como separador decimal
                echo "<td>R$ " . $formattedValue . "</td>"; // Adiciona o prefixo "R$ " ao valor formatado
                echo "<td class='view-td'><a class='view' href='VisualizarPromocao.php?Id=" . $row['Id'] . "&Id_Administrador=" . $Id_Administrador . "'>Visualizar</a></td>";
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
            $formattedValue = number_format($row['Valor'], 2, ',', '.'); // Formata o valor com duas casas decimais, vírgula como separador de milhar e ponto como separador decimal
            echo "<td>R$ " . $formattedValue . "</td>"; // Adiciona o prefixo "R$ " ao valor formatado
            echo "<td class='view-td'><a class='view' href='VisualizarPromocao.php?Id=" . $row['Id'] . "&Id_Administrador=" . $Id_Administrador . "'>Visualizar</a></td>";
            echo "</tr>";
        }
        ?>
        </table>

        <br><br>


        <?php
    // Reinicia o ponteiro de resultados
    $Res_Listar_Promocoes->data_seek(0);
    
    // Obtém todos os dados como uma matriz associativa
    $todosDados = $Res_Listar_Promocoes->fetch_all(MYSQLI_ASSOC);
    
    // Imprime os dados no formato JSON
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