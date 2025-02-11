<?php
include_once '../../Conexao.php';

$SQL_Listar_Clientes = "SELECT Clientes.*, Enderecos.CEP, Enderecos.Cidade, Enderecos.Bairro, Enderecos.Rua, Enderecos.Numero FROM Clientes LEFT JOIN Enderecos ON Clientes.Enderecos_Id = Enderecos.Id";
$Res_Listar_Clientes = $BD->query($SQL_Listar_Clientes);

$Id_Secretario = isset($_REQUEST['Id_Secretario']) ? $_REQUEST['Id_Secretario'] : '';

$searchResults = []; // Array para armazenar os resultados da pesquisa
$searchError = false; // Variável para controlar se houve erro na pesquisa

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchBy = $_POST['searchBy'];
    $searchValue = $_POST['searchValue'];
    
    // Ajustar o valor da pesquisa, se for data de nascimento, data de cadastro ou CEP
    if ($searchBy === 'DataNasc' || $searchBy === 'DataCadastro') {
        $searchValue = date('Y-m-d', strtotime(str_replace('/', '-', $searchValue)));
    }
    
    // Constrói a consulta SQL com base na opção selecionada
    switch ($searchBy) {
        case 'Id':
        case 'CPF':
        case 'DataNasc':
        case 'DataCadastro':
            // Se a pesquisa for por Id, CPF, DataNasc ou DataCadastro, utilize uma consulta exata
            $SQL_Pesquisar_Clientes = "SELECT Clientes.*, Enderecos.CEP, Enderecos.Cidade, Enderecos.Bairro, Enderecos.Rua, Enderecos.Numero FROM Clientes LEFT JOIN Enderecos ON Clientes.Enderecos_Id = Enderecos.Id WHERE Clientes.$searchBy = '$searchValue'";
            break;
        case 'CEP':
            // Para a pesquisa por CEP, verifique se o CEP pesquisado é exatamente igual ao do banco
            $SQL_Pesquisar_Clientes = "SELECT Clientes.*, Enderecos.CEP, Enderecos.Cidade, Enderecos.Bairro, Enderecos.Rua, Enderecos.Numero FROM Clientes LEFT JOIN Enderecos ON Clientes.Enderecos_Id = Enderecos.Id WHERE Enderecos.CEP = '$searchValue'";
            break;
        default:
        // Para os demais campos, utilize LIKE para buscar correspondências parciais
        $SQL_Pesquisar_Clientes = "SELECT Clientes.*, Enderecos.CEP, Enderecos.Cidade, Enderecos.Bairro, Enderecos.Rua, Enderecos.Numero FROM Clientes LEFT JOIN Enderecos ON Clientes.Enderecos_Id = Enderecos.Id WHERE Clientes.$searchBy LIKE '%$searchValue%'";
            break;
    }
    
    $Res_Pesquisar_Clientes = $BD->query($SQL_Pesquisar_Clientes);

    if ($Res_Pesquisar_Clientes->num_rows > 0) {
        // Resultados encontrados, armazene-os no array $searchResults
        while ($row = $Res_Pesquisar_Clientes->fetch_assoc()) {
            $searchResults[] = $row;
        }
    } else {
        // Nenhum resultado encontrado, define a variável de erro como verdadeira
        $searchError = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Clientes</title>
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
        <h1>Pesquisar Clientes</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="pesquisar" method="POST"
            style="width: 750px;">
            <label for="searchBy">Pesquisar por:</label>
            <select name="searchBy" id="searchBy" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="Id">ID</option>
                <option value="CPF">CPF</option>
                <option value="Nome">Nome</option>
                <option value="Sexo">Sexo</option>
                <option value="DataNasc">Data de Nascimento</option>
                <option value="Telefone">Telefone</option>
                <option value="Email">Email</option>
                <option value="DataCadastro">Data de Cadastro</option>
                <option value="CEP">CEP</option>
            </select>
            <input type="text" name="searchValue" id="searchValue" required>
            <input type="hidden" name="Id_Secretario" value="<?php echo $Id_Secretario; ?>">
            <input type="submit" value="Pesquisar">
        </form>

        <script>
        function updatePlaceholder() {
            var searchBy = document.getElementById("searchBy").value;
            var searchValueInput = document.getElementById("searchValue");
            switch (searchBy) {
                case "Email":
                    searchValueInput.placeholder = "emailexemplo@gmail.com";
                    break;
                case "Telefone":
                    searchValueInput.placeholder = "Qualquer parte do número";
                    break;
                case "CPF":
                    searchValueInput.placeholder = "XXX.XXX.XXX-XX";
                    document.getElementById('searchValue').addEventListener('input', function(e) {
                        var value = e.target.value;
                        var cpfPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                            .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o terceiro dígito
                            .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o sexto dígito
                            .replace(/(\d{3})(\d)/, '$1-$2') // Adiciona traço após o nono dígito
                            .replace(/(-\d{2})\d+?$/, '$1'); // Impede entrada de mais de 11 dígitos
                        e.target.value = cpfPattern;
                    });
                    break;
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
                    searchValueInput.placeholder = "Masculino ou Feminino";
                    break;
                case "CEP":
                    searchValueInput.placeholder = "99999-999";
                    document.getElementById('searchValue').addEventListener('input', function(e) {
                        var value = e.target.value;
                        var cepPattern = value.replace(/\D/g, '') // Remove qualquer coisa que não seja número
                            .replace(/(\d{5})(\d)/, '$1-$2') // Adiciona o hífen após o quinto dígito
                            .replace(/(\d{5}-\d{3}).*/, '$1'); // Limita a entrada ao formato 99999-999

                        e.target.value = cepPattern;
                    });
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
        if (!empty($searchResults)) {
            // Se houver resultados da pesquisa, exiba a tabela de resultados
            echo "<h1>Resultado da Pesquisa:</h1>";
            echo "<table>";
            echo "<tr>
                <th>ID</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Data de Cadastro</th>
                <th>CEP</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Visualizar</th>
            </tr>";
            foreach ($searchResults as $row) {
                echo "<tr>";
                echo "<td>" . $row['Id'] . "</td>";
                echo "<td>" . $row['CPF'] . "</td>";
                echo "<td>" . $row['Nome'] . "</td>";
                echo "<td>" . $row['Sexo'] . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['DataNasc'])) . "</td>"; // Formatando data de nascimento
                echo "<td>" . $row['Telefone'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['DataCadastro'])) . "</td>"; // Formatando data de cadastro
                echo "<td>" . $row['CEP'] . "</td>";
                echo "<td>" . $row['Cidade'] . "</td>";
                echo "<td>" . $row['Bairro'] . "</td>";
                echo "<td>" . $row['Rua'] . "</td>";
                echo "<td>" . $row['Numero'] . "</td>";
                echo "<td class='view-td'><a class='view' href='VisualizarCliente.php?Id=" . $row['Id'] . "&Id_Secretario=" . $Id_Secretario . "'>Visualizar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } elseif ($searchError) { 
            // Se houve erro na pesquisa, exibe um alerta
            echo "<script>
                    alert ('Nenhum Resultado encontrado para a pesquisa realizada.');
                </script>";
        }
    }
    ?>


        <h1>Listagem de Clientes</h1>
        <div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Sexo</th>
                    <th>Data de Nascimento</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Data de Cadastro</th>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>Bairro</th>
                    <th>Rua</th>
                    <th>Número</th>
                    <th>Visualizar</th>
                </tr>
                <?php
            while ($row = $Res_Listar_Clientes->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Id'] . "</td>";
                echo "<td>" . $row['CPF'] . "</td>";
                echo "<td>" . $row['Nome'] . "</td>";
                echo "<td>" . $row['Sexo'] . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['DataNasc'])) . "</td>"; // Formatando data de nascimento
                echo "<td>" . $row['Telefone'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['DataCadastro'])) . "</td>"; // Formatando data de cadastro
                echo "<td>" . $row['CEP'] . "</td>";
                echo "<td>" . $row['Cidade'] . "</td>";
                echo "<td>" . $row['Bairro'] . "</td>";
                echo "<td>" . $row['Rua'] . "</td>";
                echo "<td>" . $row['Numero'] . "</td>";
                echo "<td class='view-td'><a class='view' href='VisualizarCliente.php?Id=" . $row['Id'] . "&Id_Secretario=" . $Id_Secretario . "'>Visualizar</a></td>";
                echo "</tr>";
            }
            ?>
            </table>
            <br><br>



            <?php
    // Reinicia o ponteiro de resultados
    $Res_Listar_Clientes->data_seek(0);
    
    // Obtém todos os dados como uma matriz associativa
    $todosDados = $Res_Listar_Clientes->fetch_all(MYSQLI_ASSOC);
    
    // Imprime os dados no formato JSON
    echo "<script>";
    echo "console.log(" . json_encode($todosDados) . ");";
    echo "</script>";
    ?>
        </div>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>