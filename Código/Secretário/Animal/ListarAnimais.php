<?php
include_once '../../Conexao.php';

$SQL_Listar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id";
$Res_Listar_Animais = $BD->query($SQL_Listar_Animais);

$Id_Secretario = isset($_REQUEST['Id_Secretario']) ? $_REQUEST['Id_Secretario'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchBy = $_POST['searchBy'];
    $searchValue = $_POST['searchValue'];

    switch ($searchBy) {
        case 'Id':
            // Convertendo o valor de entrada para um número inteiro
            $searchValue = intval($searchValue);
            $SQL_Pesquisar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id WHERE animais.$searchBy = $searchValue";
            break;
        case 'Tipo':
        case 'Raca':
            $SQL_Pesquisar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id WHERE $searchBy = '$searchValue'";
            break;
        case 'Sexo':
            // Como o sexo é uma string, envolvemos o valor em aspas simples na consulta SQL
            $SQL_Pesquisar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id WHERE animais.$searchBy = '$searchValue'";
            break;
        case 'DataNasc':
            // Formatar a data inserida pelo usuário para o formato do banco de dados (YYYY-MM-DD)
            $searchValue = date('Y-m-d', strtotime(str_replace('/', '-', $searchValue)));
            $SQL_Pesquisar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id WHERE animais.$searchBy = '$searchValue'";
            break;
        case 'DataCadastro':
            $searchValue = date('Y-m-d', strtotime(str_replace('/', '-', $searchValue)));
            $SQL_Pesquisar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id WHERE animais.$searchBy = '$searchValue'";
            break;
        case 'Nome':
            $SQL_Pesquisar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id WHERE animais.Nome LIKE '%$searchValue%'";
            break;
        case 'NomeDono':
            $SQL_Pesquisar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id WHERE clientes.Nome LIKE '%$searchValue%'";
            break;
        default:
            $SQL_Pesquisar_Animais = "SELECT animais.*, clientes.Nome as NomeDono FROM animais JOIN clientes ON animais.Clientes_Id = clientes.Id WHERE animais.Nome LIKE '%$searchValue%'";
            break;
    }

    $Res_Pesquisar_Animais = $BD->query($SQL_Pesquisar_Animais);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Animais</title>
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
        <h1>Pesquisar Animais</h1>
        <form class="pesquisar" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            style="width: 749px;">
            <label for="searchBy">Pesquisar por:</label>
            <select name="searchBy" id="searchBy" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="Id">ID</option>
                <option value="Nome">Nome</option>
                <option value="Tipo">Tipo</option>
                <option value="Raca">Raça</option>
                <option value="Sexo">Sexo</option>
                <option value="DataNasc">Data de Nascimento</option>
                <option value="DataCadastro">Data de Cadastro</option>
                <option value="NomeDono">Nome do Dono</option>
            </select>
            <input type="text" name="searchValue" id="searchValue" required>
            <input type="hidden" name="Id_Secretario" value="<?php echo $Id_Secretario; ?>">
            <input type="submit" value="Pesquisar">
        </form>

        <script>
        function updatePlaceholder() {
            var searchBy = document.getElementById("searchBy").value;
            var searchValueInput = document.querySelector("input[name='searchValue']");
            switch (searchBy) {
                case "DataNasc":
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
                case "DataCadastro":
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
                case "Sexo":
                    searchValueInput.placeholder = "Macho ou Fêmea";
                    break;
                default:
                    searchValueInput.placeholder = "";
                    break;
            }
        }

        document.getElementById("searchBy").addEventListener("change", updatePlaceholder);
        updatePlaceholder(); // Chama a função para configurar o placeholder inicial
        </script>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($Res_Pesquisar_Animais) && $Res_Pesquisar_Animais->num_rows > 0) {
            echo "<h1>Resultado da Pesquisa:</h1>";
            echo "<table>";
            echo "<tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Raça</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Data de Cadastro</th>
                <th>ID do Dono</th>
                <th>Nome do Dono</th>
                <th>Visualizar</th>
            </tr>";
            while ($row = $Res_Pesquisar_Animais->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Id'] . "</td>";
                echo "<td>" . $row['Nome'] . "</td>";
                echo "<td>" . $row['Tipo'] . "</td>";
                echo "<td>" . $row['Raca'] . "</td>";
                echo "<td>" . $row['Sexo'] . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['DataNasc'])) . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['DataCadastro'])) . "</td>";
                echo "<td>" . $row['Clientes_Id'] . "</td>";
                echo "<td>" . $row['NomeDono'] . "</td>";
                echo "<td class='view-td'><a class='view' href='VisualizarAnimal.php?Id=" . $row['Id'] . "&Id_Secretario=" . $Id_Secretario . "'>Visualizar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<script>
                    alert ('Nenhum Resultado encontrado, verifique se o valor está escrito corretamente!');
                </script>";
        }
    }
    ?>

        <br><br>

        <h1>Listagem de Animais</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Raça</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Data de Cadastro</th>
                <th>ID do Dono</th>
                <th>Nome do Dono</th>
                <th>Visualizar</th>
            </tr>
            <?php
        while ($row = $Res_Listar_Animais->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Id'] . "</td>";
            echo "<td>" . $row['Nome'] . "</td>";
            echo "<td>" . $row['Tipo'] . "</td>";
            echo "<td>" . $row['Raca'] . "</td>";
            echo "<td>" . $row['Sexo'] . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['DataNasc'])) . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['DataCadastro'])) . "</td>";
            echo "<td>" . $row['Clientes_Id'] . "</td>";
            echo "<td>" . $row['NomeDono'] . "</td>";
            echo "<td class='view-td'><a class='view' href='VisualizarAnimal.php?Id=" . $row['Id'] . "&Id_Secretario=" . $Id_Secretario . "'>Visualizar</a></td>";
            echo "</tr>";
        }
        ?>
        </table>

        <br><br>
        <?php
    // Reinicie o ponteiro de resultados
    $Res_Listar_Animais->data_seek(0);
    
    // Obtém todos os dados como uma matriz associativa
    $all_data = $Res_Listar_Animais->fetch_all(MYSQLI_ASSOC);
    
    // Imprime os dados no formato JSON
    echo "<script>";
    echo "console.log(" . json_encode($all_data) . ");";
    echo "</script>";
    ?>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>