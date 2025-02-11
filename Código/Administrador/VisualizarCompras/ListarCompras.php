<?php
include_once '../../Conexao.php';

$SQL_Listar_Compras = "SELECT compras.*, 
                            servicos.Nome AS NomeServico, 
                            servicos.Descricao AS DescricaoServico, 
                            clientes.Nome AS NomeCliente, 
                            animais.Nome AS NomeAnimal, 
                            promocoes.Nome AS NomePromocao, 
                            promocoes.Valor AS ValorPromocao, 
                            FormaPagamento.Nome AS NomeFormaPagamento,
                            secretarios.Nome AS NomeSecretario
                        FROM compras 
                        LEFT JOIN servicos ON compras.Servicos_Id = servicos.Id 
                        LEFT JOIN clientes ON compras.Clientes_Id = clientes.Id 
                        LEFT JOIN animais ON compras.Animais_Id = animais.Id 
                        LEFT JOIN promocoes ON compras.Promocoes_Id = promocoes.Id 
                        LEFT JOIN FormaPagamento ON compras.FormaPagamento_Id = FormaPagamento.Id
                        LEFT JOIN secretarios ON compras.Secretarios_Id = secretarios.Id";
$Res_Listar_Compras = $BD->query($SQL_Listar_Compras);

$SQL_Pesquisar_Compras = "SELECT compras.*, 
                                servicos.Nome AS NomeServico, 
                                servicos.Descricao AS DescricaoServico, 
                                clientes.Nome AS NomeCliente, 
                                animais.Nome AS NomeAnimal, 
                                promocoes.Nome AS NomePromocao, 
                                promocoes.Valor AS ValorPromocao, 
                                FormaPagamento.Nome AS NomeFormaPagamento,
                                secretarios.Nome AS NomeSecretario
                            FROM compras 
                            LEFT JOIN servicos ON compras.Servicos_Id = servicos.Id 
                            LEFT JOIN clientes ON compras.Clientes_Id = clientes.Id 
                            LEFT JOIN animais ON compras.Animais_Id = animais.Id 
                            LEFT JOIN promocoes ON compras.Promocoes_Id = promocoes.Id 
                            LEFT JOIN FormaPagamento ON compras.FormaPagamento_Id = FormaPagamento.Id
                            LEFT JOIN secretarios ON compras.Secretarios_Id = secretarios.Id";

$Id_Administrador = isset($_GET['Id_Administrador']) ? $_GET['Id_Administrador'] : (isset($_POST['Id_Administrador']) ? $_POST['Id_Administrador'] : '');

// Inicialize a variável $Res_Pesquisar_Compras
$Res_Pesquisar_Compras = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchBy = $_POST['searchBy'];
    $searchValue = $_POST['searchValue'];

    // Tratamento para evitar injeção de SQL
    $searchValue = $BD->real_escape_string($searchValue);

    // Constrói a consulta SQL com base na opção selecionada
    switch ($searchBy) {
        case 'ID':
            // Coloca o valor entre aspas simples para IDs
            $SQL_Pesquisar_Compras .= " WHERE compras.$searchBy = '$searchValue'";
            break;
        case 'ID do Serviço':
            $SQL_Pesquisar_Compras .= " WHERE Servicos_Id = '$searchValue'";
            break;
        case 'ID do Secretário':
            $SQL_Pesquisar_Compras .= " WHERE compras.Secretarios_Id = '$searchValue'";
            break;
        case 'ID do Cliente':
            $SQL_Pesquisar_Compras .= " WHERE compras.Clientes_Id = '$searchValue'";
            break;
        case 'ID do Animal':
            $SQL_Pesquisar_Compras .= " WHERE Animais_Id = '$searchValue'";
            break;
        case 'ID da Promoção':
            $SQL_Pesquisar_Compras .= " WHERE compras.Promocoes_Id = '$searchValue'";
            break;
        case 'ID da Forma de Pagamento':
            $SQL_Pesquisar_Compras .= " WHERE compras.FormaPagamento_Id = '$searchValue'";
            break;
        case 'Data':
            // Verifica se a data está no formato esperado (dd/mm/aaaa)
            if (preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $searchValue)) {
                // Converte a data para o formato do MySQL (aaaa-mm-dd)
                $searchValue = DateTime::createFromFormat('d/m/Y', $searchValue)->format('Y-m-d');
                $SQL_Pesquisar_Compras .= " WHERE DATE(compras.DataHora) = '$searchValue'";
                
                // Feedback para depuração
                echo "<script>alert('Consulta SQL para pesquisa por data: $SQL_Pesquisar_Compras');</script>";
            } else {
                // Se a data estiver em um formato incorreto, exiba uma mensagem de erro
                echo "<script>alert('Formato de data inválido. Use o formato dd/mm/aaaa.');</script>";
            }
            break;
        case 'Valor':
            // Extrai apenas os dígitos do valor pesquisado
            $numericValue = preg_replace("/[^0-9,]/", "", $searchValue);
            // Substitui a vírgula por ponto (formato para valores monetários em SQL)
            $numericValue = str_replace(",", ".", $numericValue);
            $SQL_Pesquisar_Compras .= " WHERE compras.Valor = '$numericValue'";
            break;
        // Outros cases omitidos para brevidade
        case 'Valor da Promoção':
            // Extrai apenas os dígitos do valor pesquisado
            $numericValue = preg_replace("/[^0-9,]/", "", $searchValue);
            // Substitui a vírgula por ponto (formato para valores monetários em SQL)
            $numericValue = str_replace(",", ".", $numericValue);
            $SQL_Pesquisar_Compras .= " WHERE promocoes.Valor = '$numericValue'";
            break;
        case 'Nome do Serviço':
            // Remove qualquer caractere especial do valor de pesquisa
            $searchValue = preg_replace("/[^a-zA-Z0-9\s]/", "", $searchValue);
            $SQL_Pesquisar_Compras .= " WHERE servicos.Nome LIKE '%$searchValue%'";
            break;
        case 'Nome do Secretário':
            // Remove qualquer caractere especial do valor de pesquisa
            $searchValue = preg_replace("/[^a-zA-Z0-9\s]/", "", $searchValue);
            $SQL_Pesquisar_Compras .= " WHERE secretarios.Nome LIKE '%$searchValue%'";
            break;
        case 'Nome do Cliente':
            // Remove qualquer caractere especial do valor de pesquisa
            $searchValue = preg_replace("/[^a-zA-Z0-9\s]/", "", $searchValue);
            $SQL_Pesquisar_Compras .= " WHERE clientes.Nome LIKE '%$searchValue%'";
            break;
        case 'Nome do Animal':
            // Remove qualquer caractere especial do valor de pesquisa
            $searchValue = preg_replace("/[^a-zA-Z0-9\s]/", "", $searchValue);
            $SQL_Pesquisar_Compras .= " WHERE animais.Nome LIKE '%$searchValue%'";
            break;
        case 'Nome da Promoção':
            // Remove qualquer caractere especial do valor de pesquisa
            $searchValue = preg_replace("/[^a-zA-Z0-9\s]/", "", $searchValue);
            $SQL_Pesquisar_Compras .= " WHERE promocoes.Nome LIKE '%$searchValue%'";
            break;
        default:
            // Para qualquer outro caso, mantenha a lógica existente
            break;
    }

    $stmt = $BD->prepare($SQL_Pesquisar_Compras);

    if (!$stmt) {
    die('Erro na preparação da consulta: ' . $BD->error);
    }

    $stmt->execute();
    $Res_Pesquisar_Compras = $stmt->get_result();

    if (!$Res_Pesquisar_Compras) {
        die('Erro na consulta SQL: ' . $BD->error);
    }
    
    // Verifica se foram encontrados resultados
    if ($Res_Pesquisar_Compras->num_rows === 0) {
        echo "<script>alert('Nenhum resultado encontrado.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Compras</title>
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
        <h1>Pesquisar Compras</h1>
        <form class="pesquisar" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            style="width: 823px;">
            <label for="searchBy">Pesquisar por:</label>
            <select name="searchBy" id="searchBy" required onchange="updatePlaceholder()">
                <option value="" disabled selected>Selecione...</option>
                <option value="ID">ID</option>
                <option value="ID do Serviço">ID do Serviço</option>
                <option value="ID do Secretário">ID do Secretário</option>
                <option value="ID do Cliente">ID do Cliente</option>
                <option value="ID do Animal">ID do Animal</option>
                <option value="ID da Promoção">ID da Promoção</option>
                <option value="ID da Forma de Pagamento">ID da Forma de Pagamento</option>
                <option value="Data">Data</option>
                <option value="Valor">Valor</option>
                <option value="Valor da Promoção">Valor da Promoção</option>
                <option value="Nome do Serviço">Nome do Serviço</option>
                <option value="Nome do Secretário">Nome do Secretário</option>
                <option value="Nome do Cliente">Nome do Cliente</option>
                <option value="Nome do Animal">Nome do Animal</option>
                <option value="Nome da Promoção">Nome da Promoção</option>
            </select>
            <input type="text" name="searchValue" id="searchValue" required>
            <input type="hidden" name="Id_Administrador" value="<?php echo $Id_Administrador; ?>">
            <input type="submit" value="Pesquisar">
        </form>

        <br><br>

        <script>
        function updatePlaceholder() {
            var searchBy = document.getElementById("searchBy").value;
            var searchValueInput = document.getElementById("searchValue");
            switch (searchBy) {
                case "Data":
                    searchValueInput.placeholder = "dd/mm/aaaa";
                    document.getElementById('searchValue').addEventListener('input', function(e) {
                        var value = e.target.value;
                        var cpfPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                            .replace(/(\d{2})(\d)/, '$1/$2') // Adiciona ponto após o terceiro dígito
                            .replace(/(\d{2})(\d)/, '$1/$2') // Adiciona ponto após o sexto dígito
                            .replace(/(\d{4})(\d)/, '$1') // Adiciona traço após o nono dígito
                        e.target.value = cpfPattern;
                    });
                    break;
                case "Valor":
                case "Valor da Promoção":
                    searchValueInput.placeholder = "R$ 0,00";
                    break;
                default:
                    searchValueInput.placeholder = "";
                    break;
            }
        }
        </script>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($Res_Pesquisar_Compras)) {
        if ($Res_Pesquisar_Compras !== false && $Res_Pesquisar_Compras->num_rows > 0) {
            echo "<h1>Resultados da Pesquisa:</h1>";
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Data e Hora</th>
                    <th>Valor</th>
                    <th>Serviço</th>
                    <th>Cliente</th>
                    <th>Secretário Responsável</th>
                    <th>Animal</th>
                    <th>Promoção</th>
                    <th>Forma de Pagamento</th>
                    <th>Visualizar</th>
                </tr>";
            while ($row = $Res_Pesquisar_Compras->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Id'] . "</td>";
                echo "<td>" . date('d/m/Y H:i:s', strtotime($row['DataHora'])) . "</td>";
                echo "<td>R$ " . number_format($row['Valor'], 2, ',', '.') . "</td>";
                echo "<td>" . (isset($row['NomeServico']) ? $row['NomeServico'] . " - " . $row['DescricaoServico'] : '') . "</td>";
                echo "<td>" . (isset($row['NomeCliente']) ? $row['NomeCliente'] : '') . "</td>";
                echo "<td>" . (isset($row['NomeSecretario']) ? $row['NomeSecretario'] : '') . "</td>";
                echo "<td>" . (isset($row['NomeAnimal']) ? $row['NomeAnimal'] : '') . "</td>";
                echo "<td>" . (isset($row['NomePromocao']) ? $row['NomePromocao'] . " - R$ " . number_format($row['ValorPromocao'], 2, ',', '.') : '') . "</td>";
                echo "<td>" . (isset($row['NomeFormaPagamento']) ? $row['NomeFormaPagamento'] : '') . "</td>";
                echo "<td class='view-td'><a class='view' href='VisualizarCompra.php?Id=" . $row['Id'] . "&Id_Administrador=" . $Id_Administrador . "'>Visualizar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    ?>

        <br><br>

        <h1>Listagem de Compras</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Data e Hora</th>
                <th>Valor</th>
                <th>Serviço</th>
                <th>Cliente</th>
                <th>Secretário Responsável</th>
                <th>Animal</th>
                <th>Promoção</th>
                <th>Forma de Pagamento</th>
                <th>Visualizar</th>
            </tr>
            <?php
        while ($row = $Res_Listar_Compras->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Id'] . "</td>";
            echo "<td>" . date('d/m/Y H:i:s', strtotime($row['DataHora'])) . "</td>";
            echo "<td>R$ " . number_format($row['Valor'], 2, ',', '.') . "</td>";
            echo "<td>" . $row['NomeServico'] . " - " . $row['DescricaoServico'] . "</td>";
            echo "<td>" . $row['NomeCliente'] . "</td>";
            echo "<td>" . $row['NomeSecretario'] . "</td>";
            echo "<td>" . $row['NomeAnimal'] . "</td>";
            echo "<td>" . $row['NomePromocao'] . " - R$ " . number_format($row['ValorPromocao'], 2, ',', '.') . "</td>";
            echo "<td>" . $row['NomeFormaPagamento'] . "</td>";
            echo "<td class='view-td'><a class='view' href='VisualizarCompra.php?Id=" . $row['Id'] . "&Id_Administrador=" . $Id_Administrador . "'>Visualizar</a></td>";
            echo "</tr>";
        }
        ?>
        </table>

        <br><br>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>