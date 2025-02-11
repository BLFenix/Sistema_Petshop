<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Animal</title>
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
            <a href="../IniciarSecretario.php?IdUsuario=<?php echo $Id_Secretario; ?>"> <img id="ftnavbar"
                    src="../../.CSS/FTINI.png" title="Ir para o menu inicial"> </a>
        </nav>
        <form action="CadastrandoAnimal.php" method="post" id="formCadastro" style="width:35%;">
            <p style=" color:white;">.</p>
            <h1 style="margin-top: 2px;">Cadastrar Animal</h1><br>
            <div style="text-align: left; width:55%; color:white; margin-right: 12%">
                <label for="Nome_Animal">Nome:</label><br><br>
                <input type="text" name="Nome" id="Nome_Animal" max="100" min="0"><br><br>
                <!-- Dropdown select para selecionar o tipo de animal -->
                <label for="Tipo_Animal">Tipo:</label><br><br>
                <select name="Tipo" id="Tipo_Animal">
                    <option value="" disabled selected>Selecione o tipo de animal</option>
                    <option value="Cachorro">Cachorro</option>
                    <option value="Gato">Gato</option>
                    <option value="Pássaro">Pássaro</option>
                    <option value="Coelho">Coelho</option>
                    <option value="Peixe">Peixe</option>
                    <option value="Hamster">Hamster</option>
                    <option value="Cavalo">Cavalo</option>
                    <option value="Tartaruga">Tartaruga</option>
                    <option value="Pato">Pato</option>
                    <option value="Porco">Porco</option>
                    <option value="Cobra">Cobra</option>
                    <option value="Lagarto">Lagarto</option>
                    <option value="Macaco">Macaco</option>
                    <option value="Tigre">Tigre</option>
                    <option value="Elefante">Elefante</option>
                    <option value="Pônei">Pônei</option>
                    <option value="Urso">Urso</option>
                    <option value="Rato">Rato</option>
                    <option value="Coruja">Coruja</option>
                    <option value="Furão">Furão</option>
                </select><br><br>

                <!-- Dropdown select para selecionar a raça de acordo com o tipo -->
                <label for="Raca_Animal">Raça:</label><br><br>
                <select name="Raca" id="Raca_Animal">
                    <option value="">Selecione a raça do animal</option>
                    <!-- As opções de raça serão preenchidas dinamicamente com JavaScript -->
                </select><br><br>

                <script>
                // Função para preencher as opções de raça baseadas no tipo selecionado
                document.getElementById('Tipo_Animal').addEventListener('change', function() {
                    var tipoSelecionado = this.value;
                    var racaSelect = document.getElementById('Raca_Animal');
                    racaSelect.innerHTML = ''; // Limpa as opções atuais

                    // Objeto contendo raças para cada tipo de animal
                    var racasPorTipo = {
                        'Cachorro': ['Labrador', 'Poodle', 'Golden Retriever', 'Bulldog', 'Beagle', 'Pug',
                            'Pastor Alemão', 'Dálmata', 'Shih Tzu', 'Boxer', 'Rottweiler', 'Doberman',
                            'Chihuahua', 'Husky Siberiano', 'Border Collie'
                        ],
                        'Gato': ['Siamês', 'Persa', 'Sphynx', 'Maine Coon', 'Ragdoll', 'British Shorthair',
                            'Bengal', 'Burmese', 'Siberiano', 'Scottish Fold', 'Manx',
                            'American Shorthair',
                            'Cornish Rex', 'Devon Rex', 'Norwegian Forest Cat'
                        ],
                        'Pássaro': ['Canário', 'Periquito', 'Cacatua', 'Calopsita', 'Agapornis', 'Papagaio',
                            'Arara', 'Caturrita', 'Diamante Mandarim', 'Cockatiel', 'Pomba', 'Araponga',
                            'Galinha-d\'angola', 'Galinha-da-serra', 'Tucano'
                        ],
                        'Coelho': ['Holandês', 'Lionhead', 'Mini Lop', 'Fuzzy Lop', 'Mini Rex',
                            'Holland Lop',
                            'Angorá', 'Chinchila', 'Californiano', 'Mini Holandês', 'Flemish Giant',
                            'Rex',
                            'Polonês', 'Belier', 'Gigante de Flandres'
                        ],
                        'Peixe': ['Betta', 'Tetra', 'Acará', 'Bárbus', 'Oscar', 'Peixe-Dourado', 'Tilápia',
                            'Bagre',
                            'Cascudo', 'Dourado', 'Kinguio', 'Labeo', 'Molinésia', 'Pacus', 'Arraia'
                        ],
                        'Hamster': ['Sírio', 'Russo', 'Chinês', 'Anão Roborovski', 'Anão Russo',
                            'Anão Winter White', 'Teddy Bear', 'Teddy Bear Albino', 'Teddy Bear Moca',
                            'Anão Russo Albino', 'Sírio Albino', 'Hamster Preto', 'Hamster Chinês',
                            'Hamster Anão Chinês', 'Hamster Roborovski'
                        ],
                        'Cavalo': ['Arabian', 'Appaloosa', 'Quarto de Milha', 'Paint Horse', 'Mustangue',
                            'Puro Sangue Inglês', 'Clydesdale', 'Puro Sangue Árabe', 'Mangalarga',
                            'Pônei Shetland', 'Pônei Galês', 'Pônei Islandês', 'Pônei Falabella',
                            'Pônei Mini',
                            'Pônei Fjord'
                        ],
                        'Tartaruga': ['Tigre D\'água', 'Tartaruga-leopardo', 'Tartaruga-sulcata',
                            'Tartaruga-de-pescoco-longo', 'Tartaruga-de-espora',
                            'Tartaruga-de-casco-mole',
                            'Tartaruga-gigante-de-aldraba', 'Tartaruga-de-espora-africana',
                            'Tartaruga-de-espora-mexicana', 'Tartaruga-da-florida', 'Tartaruga-pintada',
                            'Tartaruga-terrestre', 'Tartaruga-selvagem', 'Tartaruga-do-deserto',
                            'Tartaruga-de-caixa'
                        ],
                        'Pato': ['Pato-real', 'Pato-mergulhão', 'Pato-crespo', 'Pato-mandarim',
                            'Pato-da-tundra',
                            'Pato-marreco', 'Pato-carolino', 'Pato-mudo', 'Pato-asa-branca',
                            'Pato-do-pará',
                            'Pato-mallard', 'Pato-verde', 'Pato-bravo', 'Pato-ruddy', 'Pato-pintail'
                        ],
                        'Porco': ['Porco-doméstico', 'Porco-espinho', 'Porco-do-mato',
                            'Porco-do-mato-asiático',
                            'Porco-bravo', 'Porco-javali', 'Porco-de-ouvido-miúdo',
                            'Porco-espinho-de-cauda-curta', 'Porco-de-cabeça-chata', 'Porco-galês',
                            'Porco-de-rosa', 'Porco-selvagem', 'Porco-da-montanha',
                            'Porco-do-mato-europeu',
                            'Porco-espinho-da-indonésia'
                        ],
                        'Cobra': ['Cobra-real', 'Cobra-coral', 'Cobra-rei', 'Cobra-píton', 'Cobra-naja',
                            'Cobra-voadora', 'Cobra-líquida', 'Cobra-cega', 'Cobra-d\'água',
                            'Cobra-água',
                            'Cobra-de-duas-cabeças', 'Cobra-de-chifre', 'Cobra-de-capuz',
                            'Cobra-de-nariz-chato', 'Cobra-de-folha'
                        ],
                        'Lagarto': ['Lagarto-verde', 'Lagarto-teiú', 'Lagarto-d\'água',
                            'Lagarto-das-galápagos',
                            'Lagarto-das-seychelles', 'Lagarto-de-combate', 'Lagarto-de-flor',
                            'Lagarto-de-jardim', 'Lagarto-do-deserto', 'Lagarto-da-montanha',
                            'Lagarto-do-sol',
                            'Lagarto-azul', 'Lagarto-verde-da-jamaica', 'Lagarto-tartaruga',
                            'Lagarto-de-garganta-pintada'
                        ],
                        'Macaco': ['Macaco-prego', 'Macaco-aranha', 'Macaco-rhesus', 'Macaco-gorila',
                            'Macaco-macaco', 'Macaco-babuíno', 'Macaco-mico', 'Macaco-orangotango',
                            'Macaco-sagui', 'Macaco-mico-leão', 'Macaco-macaco-de-cauda-longa',
                            'Macaco-macaco-japonês', 'Macaco-macaco-rhesus', 'Macaco-macaco-aranha',
                            'Macaco-macaco-de-cauda-curta'
                        ],
                        'Tigre': ['Tigre-de-bengala', 'Tigre-siberiano', 'Tigre-malaio', 'Tigre-de-sumatra',
                            'Tigre-branco', 'Tigre-azul', 'Tigre-indochinês', 'Tigre-dourado',
                            'Tigre-das-cavernas', 'Tigre-javanês', 'Tigre-da-tasmânia',
                            'Tigre-de-areia',
                            'Tigre-das-montanhas-de-china', 'Tigre-de-pelo-comprido', 'Tigre-do-deserto'
                        ],
                        'Elefante': ['Elefante-africano', 'Elefante-indiano',
                            'Elefante-africano-da-floresta',
                            'Elefante-africano-da-savana', 'Elefante-asiático', 'Elefante-da-tasmânia',
                            'Elefante-do-cabo', 'Elefante-nasal', 'Elefante-marinho',
                            'Elefante-de-coleira',
                            'Elefante-de-aquário', 'Elefante-anão', 'Elefante-mamute',
                            'Elefante-branco',
                            'Elefante-vermelho'
                        ],
                        'Pônei': ['Pônei-shetland', 'Pônei-mini', 'Pônei-galês', 'Pônei-da-montanha',
                            'Pônei-de-flandres', 'Pônei-puro-sangue', 'Pônei-árabe', 'Pônei-de-troia',
                            'Pônei-de-guerra', 'Pônei-da-ilha', 'Pônei-de-gelo', 'Pônei-de-fogo',
                            'Pônei-marinho', 'Pônei-lusitano', 'Pônei-do-norte'
                        ],
                        'Urso': ['Urso-polar', 'Urso-pardo', 'Urso-negro', 'Urso-de-óculos',
                            'Urso-das-cavernas',
                            'Urso-gigante', 'Urso-lunar', 'Urso-de-baikal', 'Urso-de-kodiak',
                            'Urso-de-gobi',
                            'Urso-de-toddy', 'Urso-de-labrador', 'Urso-de-sol', 'Urso-de-spectacled',
                            'Urso-de-sloth'
                        ],
                        'Rato': ['Rato-preto', 'Rato-marrom', 'Rato-de-guerra', 'Rato-de-água',
                            'Rato-de-mesa',
                            'Rato-de-piano', 'Rato-de-esgoto', 'Rato-de-teto', 'Rato-de-campo',
                            'Rato-de-pilha',
                            'Rato-do-deserto', 'Rato-dourado', 'Rato-gigante', 'Rato-da-montanha',
                            'Rato-da-cidade'
                        ],
                        'Coruja': ['Coruja-das-torres', 'Coruja-do-nabal', 'Coruja-das-neves',
                            'Coruja-buraqueira',
                            'Coruja-pequena', 'Coruja-dos-campos', 'Coruja-orelhuda', 'Coruja-manchada',
                            'Coruja-das-rochas', 'Coruja-de-igreja', 'Coruja-das-cavernas',
                            'Coruja-da-tundra',
                            'Coruja-do-mato', 'Coruja-das-torres-europeia',
                            'Coruja-das-neves-das-torres'
                        ],
                        'Furão': ['Furão-polecat', 'Furão-silver', 'Furão-albino', 'Furão-canela',
                            'Furão-sable',
                            'Furão-de-pata-preta', 'Furão-blaze', 'Furão-panda', 'Furão-de-prata',
                            'Furão-ponto-preto', 'Furão-de-sable-de-prata', 'Furão-siames',
                            'Furão-preto-sable',
                            'Furão-angora', 'Furão-chocolate'
                        ]
                    };

                    // Preenche as opções de raça com base no tipo selecionado
                    if (tipoSelecionado in racasPorTipo) {
                        racasPorTipo[tipoSelecionado].forEach(function(raca) {
                            var option = document.createElement('option');
                            option.value = raca;
                            option.textContent = raca;
                            racaSelect.appendChild(option);
                        });
                    }
                });
                </script>

                <label for="Sexo_Animal">Sexo:</label><br><br>
                <select name="Sexo" id="Sexo_Animal">
                    <option value="" disabled selected>Selecione o sexo do animal</option>
                    <option value="Macho">Macho</option>
                    <option value="Fêmea">Fêmea</option>
                </select><br><br>
                <label for="DataNasc_Animal">Data de Nascimento:</label><br><br>
                <input type="date" name="DataNasc" id="DataNasc_Animal"><br><br>

                <?php
                    // Verificando se o ID do cliente foi passado via GET
                    $Id_Cliente = isset($_REQUEST['Id_Cliente']) ? $_REQUEST['Id_Cliente'] : '';

                    if ($Id_Cliente) {
                        // Se o ID do cliente foi passado, podemos recuperar as informações do dono
                        include_once '../../Conexao.php';
                        $sql = "SELECT Nome, CPF FROM clientes WHERE Id = $Id_Cliente";
                        $result = $BD->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $Nome_Dono = $row['Nome'];
                            $CPF_Dono = $row['CPF'];
                        } else {
                            // Caso não encontre o cliente, definimos valores padrão
                            $Nome_Dono = 'Cliente não encontrado';
                            $CPF_Dono = '';
                    }
                ?>

                <label for="Visu_Cliente">Dono:</label><br><br>
                <!-- Campo de texto travado com nome e CPF do dono -->
                <input type="text" name="Visu_Cliente" id="Cliente_Info"
                    value="<?php echo $Nome_Dono . " - " . $CPF_Dono; ?>" readonly>
                <input type="hidden" name="Cliente_Id" id="Cliente_Id" value="<?php echo $Id_Cliente; ?>">

                <?php
                } else {
                ?>
                <label for="Cliente_Id">Dono:</label><br><br>
                <!-- Dropdown select para selecionar o cliente -->
                <select name="Cliente_Id" id="Cliente_Id">
                    <?php
                        include_once '../../Conexao.php';

                        // Query para selecionar todos os clientes
                        $sql = "SELECT Id, Nome, CPF FROM clientes";
                        $result = $BD->query($sql);

                        // Se houver resultados, exibe cada cliente como uma opção no dropdown
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $selected = ($Id_Cliente == $row['Id']) ? 'selected' : '';
                        ?>
                    <option value="<?php echo $row['Id']; ?>" <?php echo $selected; ?>>
                        <?php echo $row['Nome'] . " - " . $row['CPF']; ?></option>
                    <?php
                            }
                        }
                        ?>
                </select><br><br>
                <?php
                }
                ?>

                <!-- Input hidden para armazenar a data de cadastro -->
                <input type="hidden" name="DataCadastro" value="<?php echo date('Y-m-d'); ?>">

                <?php
                    if(isset($_GET['Id_Secretario'])) {
                        $Id_Secretario = $_GET['Id_Secretario'];
                        echo "<input type='hidden' name='Id_Secretario' id='Secretarios_Id_Animal' value='$Id_Secretario'><br><br>";
                    } else {
                        echo "<input type='hidden' name='Id_Secretario' id='Secretarios_Id_Animal'><br><br>";
                    }
                ?>
            </div>
            <input class="button" type="submit" name="Enviar" style="margin-right:10px" value="Cadastrar">
            <input type="reset" class="button" name="Limpar" value="Redefinir">
            <p style='color:white;'>.</p>
        </form>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>

        <script>
        // Função para mostrar os dados do formulário no console
        function mostrarDadosFormulario() {
            // Obtém os valores dos campos do formulário
            var nome = document.getElementById('Nome_Animal').value;
            var tipo = document.getElementById('Tipo_Animal').value;
            var raca = document.getElementById('Raca_Animal').value;
            var sexo = document.getElementById('Sexo_Animal').value;
            var dataNascimento = document.getElementById('DataNasc_Animal').value;
            var Id_Cliente = document.getElementById('Cliente_Id').value;
            var secretarioId = document.getElementById('Secretarios_Id_Animal').value;

            // Exibe os dados no console
            console.log("Nome: " + nome);
            console.log("Tipo: " + tipo);
            console.log("Raça: " + raca);
            console.log("Sexo: " + sexo);
            console.log("Data de Nascimento: " + dataNascimento);
            console.log("ID do Cliente: " + Id_Cliente);
            console.log("ID do Secretário: " + secretarioId);
        }

        // Adiciona um ouvinte de evento para o formulário
        document.getElementById('formCadastro').addEventListener('input', mostrarDadosFormulario);
        </script>
        <style>
        .menu-lateral {
            margin-top: -1%;
        }
        </style>
        
</body>

</html>