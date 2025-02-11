<?php
include_once '../../Conexao.php';

$SQL_Listar_Clientes = "SELECT clientes.*, enderecos.CEP, enderecos.Cidade, enderecos.Bairro, enderecos.Rua, enderecos.Numero FROM clientes LEFT JOIN enderecos ON clientes.Enderecos_Id = enderecos.Id";
$Res_Listar_Clientes = $BD->query($SQL_Listar_Clientes);

$Id_Administrador = isset($_REQUEST['Id_Administrador']) ? $_REQUEST['Id_Administrador'] : '';

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
            // Para a pesquisa por Id, CPF, DataNasc ou DataCadastro, utilize uma consulta exata
            $SQL_Pesquisar_Clientes = "SELECT clientes.*, enderecos.CEP, enderecos.Cidade, enderecos.Bairro, enderecos.Rua, enderecos.Numero FROM clientes LEFT JOIN enderecos ON clientes.Enderecos_Id = enderecos.Id WHERE clientes.$searchBy = '$searchValue'";
            break;
        case 'CEP':
            // Para a pesquisa por CEP, verifique se o CEP pesquisado é exatamente igual ao do banco
            $SQL_Pesquisar_Clientes = "SELECT clientes.*, enderecos.CEP, enderecos.Cidade, enderecos.Bairro, enderecos.Rua, enderecos.Numero FROM clientes LEFT JOIN enderecos ON clientes.Enderecos_Id = enderecos.Id WHERE enderecos.CEP = '$searchValue'";
            break;
        default:
            // Para os demais campos, utilize LIKE para buscar correspondências parciais
            $SQL_Pesquisar_Clientes = "SELECT clientes.*, enderecos.CEP, enderecos.Cidade, enderecos.Bairro, enderecos.Rua, enderecos.Numero FROM clientes LEFT JOIN enderecos ON clientes.Enderecos_Id = enderecos.Id WHERE clientes.$searchBy LIKE '%$searchValue%'";
            break;
    }
    
    // Executa a consulta SQL
    $Res_Pesquisar_Clientes = $BD->query($SQL_Pesquisar_Clientes);
    
    if ($Res_Pesquisar_Clientes === false) {
        // Se a consulta falhar, exiba um alerta e pare a execução do script
        echo "<script>alert('Erro na consulta SQL.');</script>";
        exit;
    }
    
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
        <h1>Pesquisar Clientes</h1>
        <form class="pesquisar" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            style="width: 749px;">
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
            <input type="hidden" name="Id_Administrador" value="<?php echo $Id_Administrador; ?>">
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
                echo "<td class='view-td'><a  class='view' href='VisualizarCliente.php?Id=" . $row['Id'] . "&Id_Administrador=" . $Id_Administrador . "'>Visualizar</a></td>";
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

        <br><br>

        <h1>Listagem de Clientes</h1>
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
            echo "<td class='view-td'><a class='view' href='VisualizarCliente.php?Id=" . $row['Id'] . "&Id_Administrador=" . $Id_Administrador . "'>Visualizar</a></td>";
            echo "</tr>";
        }
        ?>
        </table><br><br>

        <?php
    // Reinicia o ponteiro de resultados
    $Res_Listar_Clientes->data_seek(0);
    
    // Obtém todos os dados como uma matriz associativa
    $all_data = $Res_Listar_Clientes->fetch_all(MYSQLI_ASSOC);
    
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