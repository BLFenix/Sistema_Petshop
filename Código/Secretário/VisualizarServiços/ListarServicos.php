<?php
include_once '../../Conexao.php';

$SQL_Listar_Servicos = "SELECT servicos.*, promocoes.Nome AS NomePromocao FROM servicos LEFT JOIN promocoes ON servicos.Promocoes_Id = promocoes.Id";
$Res_Listar_Servicos = $BD->query($SQL_Listar_Servicos);

$Id_Secretario = isset($_REQUEST['Id_Secretario']) ? $_REQUEST['Id_Secretario'] : '';

$searchResults = []; // Array para armazenar os resultados da pesquisa

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchBy = $_POST['searchBy'];
    $searchValue = $_POST['searchValue'];
    
    // Constrói a consulta SQL com base na opção selecionada
    switch ($searchBy) {
        case 'Id':
            $SQL_Pesquisar_Servicos = "SELECT * FROM servicos WHERE Id = '$searchValue'";
            break;
        case 'Nome':
        case 'Descricao':
        case 'Disponibilidade':
            // Para Nome, Descrição e Disponibilidade, pesquisa usando LIKE
            $SQL_Pesquisar_Servicos = "SELECT * FROM servicos WHERE $searchBy LIKE '%$searchValue%'";
            break;
        case 'Valor':
            // Extrai o valor numérico da string de pesquisa, removendo o prefixo "R$ " e convertendo para float
            $numericValue = floatval(str_replace('R$ ', '', $searchValue));
            // Constrói a consulta SQL com base no valor numérico
            $SQL_Pesquisar_Servicos = "SELECT * FROM servicos WHERE Valor = $numericValue";
            break;
        case 'DuracaoEstimada':
            // Extrai o valor numérico da string de pesquisa, considerando apenas os dígitos
            $duration = intval(preg_replace('/[^0-9]/', '', $searchValue));
            // Constrói a consulta SQL com base na duração estimada
            $SQL_Pesquisar_Servicos = "SELECT * FROM servicos WHERE DuracaoEstimada = $duration";
            break;
        default:
            $SQL_Pesquisar_Servicos = "SELECT * FROM servicos WHERE $searchBy = '$searchValue'";
            break;
    }
    
    $Res_Pesquisar_Servicos = $BD->query($SQL_Pesquisar_Servicos);

    if ($Res_Pesquisar_Servicos->num_rows > 0) {
        // Resultados encontrados, armazene-os no array $searchResults
        while ($row = $Res_Pesquisar_Servicos->fetch_assoc()) {
            $searchResults[] = $row;
        }
    } else {
        // Nenhum resultado encontrado, exibe um alerta
        $alertMessage = "Nenhum Resultado encontrado para a pesquisa.";
        echo "<script>
                alert ('$alertMessage');
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Serviços</title>
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
        <h1>Pesquisar Serviços</h1>
        <form class="pesquisar" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            style="width: 735px;">
            <label for="searchBy">Pesquisar por:</label>
            <select name="searchBy" id="searchBy" required onchange="updatePlaceholder()">
                <option value="" disabled selected>Selecione...</option>
                <option value="Id">ID</option>
                <option value="Nome">Nome</option>
                <option value="Descricao">Descrição</option>
                <option value="Valor">Valor</option>
                <option value="DuracaoEstimada">Duração Estimada</option>
                <option value="Disponibilidade">Disponibilidade</option>
            </select>
            <input type="text" name="searchValue" id="searchValue" required>
            <input type="hidden" name="Id_Secretario" value="<?php echo $Id_Secretario; ?>">
            <input type="submit" value="Pesquisar">
        </form>

        <br><br>

        <script>
        function updatePlaceholder() {
            var searchBy = document.getElementById("searchBy").value;
            var searchValueInput = document.getElementById("searchValue");
            switch (searchBy) {
                case "Valor":
                    searchValueInput.placeholder = "Ex: R$ 0,00";
                    break;
                case "DuracaoEstimada":
                    searchValueInput.placeholder = "Ex: 40 Minutos";
                    break;
                case "Disponibilidade":
                    searchValueInput.placeholder = "Ex: Segunda à Sexta - 07:00 até 18:00";
                    break;
                default:
                    searchValueInput.placeholder = "";
                    break;
            }
        }
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
                <th>Descrição</th>
                <th>Valor</th>
                <th>Duração Estimada</th>
                <th>Disponibilidade</th>
                <th>Promoção</th>
                <th>Visualizar</th>
            </tr>";
            foreach ($searchResults as $row) {
                echo "<tr>";
                echo "<td>" . $row['Id'] . "</td>";
                echo "<td>" . $row['Nome'] . "</td>";
                echo "<td>" . $row['Descricao'] . "</td>";
                $formattedValue = number_format($row['Valor'], 2, ',', '.'); // Formata o valor com duas casas decimais, vírgula como separador de milhar e ponto como separador decimal
                echo "<td>R$ " . $formattedValue . "</td>"; // Adiciona o prefixo "R$ " ao valor formatado
                echo "<td>" . ($row['DuracaoEstimada'] ? $row['DuracaoEstimada'] . " Minutos" : "Tempo Inestimado") . "</td>"; // Adiciona "Minutos" ao valor da duração estimada, ou "Tempo Inestimado" se não houver
                echo "<td>" . ($row['Disponibilidade'] ? $row['Disponibilidade'] : "Sem Disponibilidade Específica") . "</td>"; // Exibe a disponibilidade ou "Sem Disponibilidade Específica" se não houver
                echo "<td>" . ($row['NomePromocao'] ?? 'Nenhuma') . "</td>"; // Mostra o nome da promoção relacionada ou "Nenhuma" se não houver promoção
                echo "<td class='view-td'><a class='view'href='VisualizarServico.php?Id=" . $row['Id'] . "&Id_Secretario=" . $Id_Secretario . "'>Visualizar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    ?>

        <br><br>

        <h1>Listagem de Serviços</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Duração Estimada</th>
                <th>Disponibilidade</th>
                <th>Promoção</th>
                <th>Visualizar</th>
            </tr>
            <?php
        while ($row = $Res_Listar_Servicos->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Id'] . "</td>";
            echo "<td>" . $row['Nome'] . "</td>";
            echo "<td>" . $row['Descricao'] . "</td>";
            $formattedValue = number_format($row['Valor'], 2, ',', '.'); // Formata o valor com duas casas decimais, vírgula como separador de milhar e ponto como separador decimal
            echo "<td>R$ " . $formattedValue . "</td>"; // Adiciona o prefixo "R$ " ao valor formatado
            echo "<td>" . ($row['DuracaoEstimada'] ? $row['DuracaoEstimada'] . " Minutos" : "Tempo Inestimado") . "</td>"; // Adiciona "Minutos" ao valor da duração estimada, ou "Tempo Inestimado" se não houver
            echo "<td>" . ($row['Disponibilidade'] ? $row['Disponibilidade'] : "Sem Disponibilidade Específica") . "</td>"; // Exibe a disponibilidade ou "Sem Disponibilidade Específica" se não houver
            echo "<td>" . ($row['NomePromocao'] ?? 'Nenhuma') . "</td>"; // Mostra o nome da promoção relacionada ou "Nenhuma" se não houver promoção
            echo "<td class='view-td'><a class='view' href='VisualizarServico.php?Id=" . $row['Id'] . "&Id_Secretario=" . $Id_Secretario . "'>Visualizar</a></td>";
            echo "</tr>";
        }
        ?>
        </table>

        <?php
    // Reinicia o ponteiro de resultados
    $Res_Listar_Servicos->data_seek(0);
    
    // Obtém todos os dados como uma matriz associativa
    $todosDados = $Res_Listar_Servicos->fetch_all(MYSQLI_ASSOC);
    
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