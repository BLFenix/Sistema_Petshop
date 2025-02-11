<?php
include_once '../../Conexao.php';

$Id = null;
if(isset($_GET['Id'])) {
    $Id = $_GET['Id'];
}

$SQL = "SELECT * FROM animais WHERE Id = $Id";
$Res = $BD->query($SQL);

if ($Res->num_rows > 0) {
    $Animal = $Res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
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
    <form action="EditandoAnimal.php" method="post" id="formEdicao">
        <p style="color:white;">.</p>
        <h1 style="margin-top: 2px;">Editar Animal</h1>
        <div style="text-align: left; width:45%; color:white;">
            <label for="Id">Id:</label><br><br>
            <input type="text" name="Id" id="Id" value="<?php echo $Animal['Id']; ?>" readonly><br><br>
            <label for="Nome">Nome:</label><br><br>
            <input type="text" name="Nome" id="Nome" value="<?php echo $Animal['Nome']; ?>" max="100" min="0"><br><br>
            <!-- Select de tipo de animal com opções preenchidas -->
            <label for="Tipo">Tipo:</label><br><br>
            <select name="Tipo" id="Tipo">
                <option value="">Selecione o tipo de animal</option>
                <option value="Cachorro" <?php echo ($Animal['Tipo'] === 'Cachorro') ? 'selected' : ''; ?>>Cachorro</option>
                <option value="Gato" <?php echo ($Animal['Tipo'] === 'Gato') ? 'selected' : ''; ?>>Gato</option>
                <option value="Pássaro" <?php echo ($Animal['Tipo'] === 'Pássaro') ? 'selected' : ''; ?>>Pássaro</option>
                <option value="Coelho" <?php echo ($Animal['Tipo'] === 'Coelho') ? 'selected' : ''; ?>>Coelho</option>
                <option value="Peixe" <?php echo ($Animal['Tipo'] === 'Peixe') ? 'selected' : ''; ?>>Peixe</option>
                <option value="Hamster" <?php echo ($Animal['Tipo'] === 'Hamster') ? 'selected' : ''; ?>>Hamster</option>
                <option value="Cavalo" <?php echo ($Animal['Tipo'] === 'Cavalo') ? 'selected' : ''; ?>>Cavalo</option>
                <option value="Tartaruga" <?php echo ($Animal['Tipo'] === 'Tartaruga') ? 'selected' : ''; ?>>Tartaruga
                </option>
                <option value="Pato" <?php echo ($Animal['Tipo'] === 'Pato') ? 'selected' : ''; ?>>Pato</option>
                <option value="Porco" <?php echo ($Animal['Tipo'] === 'Porco') ? 'selected' : ''; ?>>Porco</option>
                <option value="Cobra" <?php echo ($Animal['Tipo'] === 'Cobra') ? 'selected' : ''; ?>>Cobra</option>
                <option value="Lagarto" <?php echo ($Animal['Tipo'] === 'Lagarto') ? 'selected' : ''; ?>>Lagarto</option>
                <option value="Macaco" <?php echo ($Animal['Tipo'] === 'Macaco') ? 'selected' : ''; ?>>Macaco</option>
                <option value="Tigre" <?php echo ($Animal['Tipo'] === 'Tigre') ? 'selected' : ''; ?>>Tigre</option>
                <option value="Elefante" <?php echo ($Animal['Tipo'] === 'Elefante') ? 'selected' : ''; ?>>Elefante</option>
                <option value="Pônei" <?php echo ($Animal['Tipo'] === 'Pônei') ? 'selected' : ''; ?>>Pônei</option>
                <option value="Urso" <?php echo ($Animal['Tipo'] === 'Urso') ? 'selected' : ''; ?>>Urso</option>
                <option value="Rato" <?php echo ($Animal['Tipo'] === 'Rato') ? 'selected' : ''; ?>>Rato</option>
                <option value="Coruja" <?php echo ($Animal['Tipo'] === 'Coruja') ? 'selected' : ''; ?>>Coruja</option>
                <option value="Furão" <?php echo ($Animal['Tipo'] === 'Furão') ? 'selected' : ''; ?>>Furão</option>
            </select><br><br>

            <!-- Select de raça de animal com opções preenchidas dinamicamente -->
            <label for="Raca">Raça:</label><br><br>
            <select name="Raca" id="Raca">
                <!-- As opções de raça serão preenchidas dinamicamente com JavaScript -->
            </select><br><br>

            <label for="Sexo">Sexo:</label><br><br>
            <select name="Sexo" id="Sexo">
                <option value="Macho" <?php if ($Animal['Sexo'] === 'Macho') echo 'selected'; ?>>Macho</option>
                <option value="Fêmea" <?php if ($Animal['Sexo'] === 'Fêmea') echo 'selected'; ?>>Fêmea</option>
            </select><br><br>

            <label for="DataNasc">Data de Nascimento:</label><br><br>
            <input type="date" name="DataNasc" id="DataNasc" value="<?php echo $Animal['DataNasc']; ?>"><br><br>

            <label for="Cliente_Id">ID do Cliente:</label><br><br>
            <input type="text" name="Clientes_Id" id="Clientes_Id" value="<?php echo $Animal['Clientes_Id'];?>"
                readonly><br><br>

            <label for="Secretarios_Id">ID do Secretário:</label><br><br>
            <input type="text" name="Secretarios_Id" id="Secretarios_Id" value="<?php echo $Animal['Secretarios_Id']; ?>"
                readonly><br><br><br>
            <input type="submit" value="Editar"  class="button" style="margin-left: 30px;" >
            <input type="reset" class="button" name="Limpar" value="Redefinir" style="margin-left: 10px;">
            <p style="color:white;">.</p>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var racasPorTipo = {
            'Cachorro': ['Labrador', 'Poodle', 'Golden Retriever', 'Bulldog', 'Beagle', 'Pug',
                'Pastor Alemão', 'Dálmata', 'Shih Tzu', 'Boxer', 'Rottweiler', 'Doberman', 'Chihuahua',
                'Husky Siberiano', 'Border Collie'
            ],
            'Gato': ['Siamês', 'Persa', 'Sphynx', 'Maine Coon', 'Ragdoll', 'British Shorthair', 'Bengal',
                'Burmese', 'Siberiano', 'Scottish Fold', 'Manx', 'American Shorthair', 'Cornish Rex',
                'Devon Rex', 'Norwegian Forest Cat'
            ],
            'Pássaro': ['Canário', 'Periquito', 'Cacatua', 'Calopsita', 'Agapornis', 'Papagaio', 'Arara',
                'Caturrita', 'Diamante Mandarim', 'Cockatiel', 'Pomba', 'Araponga', 'Galinha-d\'angola',
                'Galinha-da-serra', 'Tucano'
            ],
            'Coelho': ['Holandês', 'Lionhead', 'Mini Lop', 'Fuzzy Lop', 'Mini Rex', 'Holland Lop', 'Angorá',
                'Chinchila', 'Californiano', 'Mini Holandês', 'Flemish Giant', 'Rex', 'Polonês',
                'Belier', 'Gigante de Flandres'
            ],
            'Peixe': ['Betta', 'Tetra', 'Acará', 'Bárbus', 'Oscar', 'Peixe-Dourado', 'Tilápia', 'Bagre',
                'Cascudo', 'Dourado', 'Kinguio', 'Labeo', 'Molinésia', 'Pacus', 'Arraia'
            ],
            'Hamster': ['Sírio', 'Russo', 'Chinês', 'Anão Roborovski', 'Anão Russo', 'Anão Winter White',
                'Teddy Bear', 'Teddy Bear Albino', 'Teddy Bear Moca', 'Anão Russo Albino',
                'Sírio Albino', 'Hamster Preto', 'Hamster Chinês', 'Hamster Anão Chinês',
                'Hamster Roborovski'
            ],
            'Cavalo': ['Arabian', 'Appaloosa', 'Quarto de Milha', 'Paint Horse', 'Mustangue',
                'Puro Sangue Inglês', 'Clydesdale', 'Puro Sangue Árabe', 'Mangalarga', 'Pônei Shetland',
                'Pônei Galês', 'Pônei Islandês', 'Pônei Falabella', 'Pônei Mini', 'Pônei Fjord'
            ],
            'Tartaruga': ['Tigre D\'água', 'Tartaruga-leopardo', 'Tartaruga-sulcata',
                'Tartaruga-de-pescoco-longo', 'Tartaruga-de-espora', 'Tartaruga-de-casco-mole',
                'Tartaruga-gigante-de-aldraba', 'Tartaruga-de-espora-africana',
                'Tartaruga-de-espora-mexicana', 'Tartaruga-da-florida', 'Tartaruga-pintada',
                'Tartaruga-terrestre', 'Tartaruga-selvagem', 'Tartaruga-do-deserto',
                'Tartaruga-de-caixa'
            ],
            'Pato': ['Pato-real', 'Pato-mergulhão', 'Pato-crespo', 'Pato-mandarim', 'Pato-da-tundra',
                'Pato-marreco', 'Pato-carolino', 'Pato-mudo', 'Pato-asa-branca', 'Pato-do-pará',
                'Pato-mallard', 'Pato-verde', 'Pato-bravo', 'Pato-ruddy', 'Pato-pintail'
            ],
            'Porco': ['Porco-doméstico', 'Porco-espinho', 'Porco-do-mato', 'Porco-do-mato-asiático',
                'Porco-bravo', 'Porco-javali', 'Porco-de-ouvido-miúdo', 'Porco-espinho-de-cauda-curta',
                'Porco-de-cabeça-chata', 'Porco-galês', 'Porco-de-rosa', 'Porco-selvagem',
                'Porco-da-montanha', 'Porco-do-mato-europeu', 'Porco-espinho-da-indonésia'
            ],
            'Cobra': ['Cobra-real', 'Cobra-coral', 'Cobra-rei', 'Cobra-píton', 'Cobra-naja',
                'Cobra-voadora', 'Cobra-líquida', 'Cobra-cega', 'Cobra-d\'água', 'Cobra-água',
                'Cobra-de-duas-cabeças', 'Cobra-de-chifre', 'Cobra-de-capuz', 'Cobra-de-nariz-chato',
                'Cobra-de-folha'
            ],
            'Lagarto': ['Lagarto-verde', 'Lagarto-teiú', 'Lagarto-d\'água', 'Lagarto-das-galápagos',
                'Lagarto-das-seychelles', 'Lagarto-de-combate', 'Lagarto-de-flor', 'Lagarto-de-jardim',
                'Lagarto-do-deserto', 'Lagarto-da-montanha', 'Lagarto-do-sol', 'Lagarto-azul',
                'Lagarto-verde-da-jamaica', 'Lagarto-tartaruga', 'Lagarto-de-garganta-pintada'
            ],
            'Macaco': ['Macaco-prego', 'Macaco-aranha', 'Macaco-rhesus', 'Macaco-gorila', 'Macaco-macaco',
                'Macaco-babuíno', 'Macaco-mico', 'Macaco-orangotango', 'Macaco-sagui',
                'Macaco-mico-leão', 'Macaco-macaco-de-cauda-longa', 'Macaco-macaco-japonês',
                'Macaco-macaco-rhesus', 'Macaco-macaco-aranha', 'Macaco-macaco-de-cauda-curta'
            ],
            'Tigre': ['Tigre-de-bengala', 'Tigre-siberiano', 'Tigre-malaio', 'Tigre-de-sumatra',
                'Tigre-branco', 'Tigre-azul', 'Tigre-indochinês', 'Tigre-dourado', 'Tigre-das-cavernas',
                'Tigre-javanês', 'Tigre-da-tasmânia', 'Tigre-de-areia', 'Tigre-das-montanhas-de-china',
                'Tigre-de-pelo-comprido', 'Tigre-do-deserto'
            ],
            'Elefante': ['Elefante-africano', 'Elefante-indiano', 'Elefante-africano-da-floresta',
                'Elefante-africano-da-savana', 'Elefante-asiático', 'Elefante-da-tasmânia',
                'Elefante-do-cabo', 'Elefante-nasal', 'Elefante-marinho', 'Elefante-de-coleira',
                'Elefante-de-aquário', 'Elefante-anão', 'Elefante-mamute', 'Elefante-branco',
                'Elefante-vermelho'
            ],
            'Pônei': ['Pônei-shetland', 'Pônei-mini', 'Pônei-galês', 'Pônei-da-montanha',
                'Pônei-de-flandres', 'Pônei-puro-sangue', 'Pônei-árabe', 'Pônei-de-troia',
                'Pônei-de-guerra', 'Pônei-da-ilha', 'Pônei-de-gelo', 'Pônei-de-fogo', 'Pônei-marinho',
                'Pônei-lusitano', 'Pônei-do-norte'
            ],
            'Urso': ['Urso-polar', 'Urso-pardo', 'Urso-negro', 'Urso-de-óculos', 'Urso-das-cavernas',
                'Urso-gigante', 'Urso-lunar', 'Urso-de-baikal', 'Urso-de-kodiak', 'Urso-de-gobi',
                'Urso-de-toddy', 'Urso-de-labrador', 'Urso-de-sol', 'Urso-de-spectacled',
                'Urso-de-sloth'
            ],
            'Rato': ['Rato-preto', 'Rato-marrom', 'Rato-de-guerra', 'Rato-de-água', 'Rato-de-mesa',
                'Rato-de-piano', 'Rato-de-esgoto', 'Rato-de-teto', 'Rato-de-campo', 'Rato-de-pilha',
                'Rato-do-deserto', 'Rato-dourado', 'Rato-gigante', 'Rato-da-montanha', 'Rato-da-cidade'
            ],
            'Coruja': ['Coruja-das-torres', 'Coruja-do-nabal', 'Coruja-das-neves', 'Coruja-buraqueira',
                'Coruja-pequena', 'Coruja-dos-campos', 'Coruja-orelhuda', 'Coruja-manchada',
                'Coruja-das-rochas', 'Coruja-de-igreja', 'Coruja-das-cavernas', 'Coruja-da-tundra',
                'Coruja-do-mato', 'Coruja-das-torres-europeia', 'Coruja-das-neves-das-torres'
            ],
            'Furão': ['Furão-polecat', 'Furão-silver', 'Furão-albino', 'Furão-canela', 'Furão-sable',
                'Furão-de-pata-preta', 'Furão-blaze', 'Furão-panda', 'Furão-de-prata',
                'Furão-ponto-preto', 'Furão-de-sable-de-prata', 'Furão-siames', 'Furão-preto-sable',
                'Furão-angora', 'Furão-chocolate'
            ]
        };

        var tipoSelect = document.getElementById('Tipo');
        var racaSelect = document.getElementById('Raca');

        // Adiciona um ouvinte de evento para o select de tipo
        tipoSelect.addEventListener('change', function() {
            var tipoSelecionado = tipoSelect.value;
            var racas = racasPorTipo[tipoSelecionado] || [];

            // Limpa as opções existentes
            racaSelect.innerHTML = '';

            // Adiciona a opção padrão
            var defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Selecione a raça';
            racaSelect.appendChild(defaultOption);

            // Adiciona as opções de raça para o tipo selecionado
            racas.forEach(function(raca) {
                var option = document.createElement('option');
                option.value = raca;
                option.textContent = raca;
                racaSelect.appendChild(option);
            });

            // Define a raça selecionada com base nos dados do banco de dados
            var racaSelecionada = '<?php echo $Animal['Raca']; ?>';
            if (racas.includes(racaSelecionada)) {
                racaSelect.value = racaSelecionada;
            }
        });

        // Dispara o evento 'change' para preencher as raças quando a página carrega
        var event = new Event('change');
        tipoSelect.dispatchEvent(event);
    });

    // Função para mostrar os dados do formulário no console
    function mostrarDadosFormulario() {
        // Obtém os valores dos campos do formulário
        var id = document.getElementById('Id').value;
        var nome = document.getElementById('Nome').value;
        var tipo = document.getElementById('Tipo').value;
        var raca = document.getElementById('Raca').value;
        var sexo = document.getElementById('Sexo').value;
        var dataNascimento = document.getElementById('DataNasc').value;
        var clienteId = document.getElementById('Cliente_Id').value;
        var secretarioId = document.getElementById('Secretarios_Id').value;

        // Exibe os dados no console
        console.log("ID: " + id);
        console.log("Nome: " + nome);
        console.log("Tipo: " + tipo);
        console.log("Raça: " + raca);
        console.log("Sexo: " + sexo);
        console.log("Data de Nascimento: " + dataNascimento);
        console.log("ID do Cliente: " + clienteId);
        console.log("ID do Secretário: " + secretarioId);
    }

    // Adiciona um ouvinte de evento para o formulário
    document.getElementById('formEdicao').addEventListener('input', mostrarDadosFormulario);
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
    echo "<script>alert ('Animal não encontrado!')</script>";
}
?>