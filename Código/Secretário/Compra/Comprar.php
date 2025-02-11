<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Compra de Serviço</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../.CSS/Style.css">
    <?php
        include_once "../../Conexao.php";

        if ($BD->connect_error) {
            die("Erro na conexão: " . $BD->connect_error);
        }
    ?>
    <script>
    function MostrarTotal() {
    // Obtém o elemento select
    var select = document.getElementById("Servico");
    // Obtém o índice da opção selecionada
    var selectedIndex = select.selectedIndex;
    // Obtém o valor selecionado da opção
    var selectedOption = select.options[selectedIndex];
    // Obtém o valor do serviço selecionado
    var valorServico = selectedOption.getAttribute("data-valor");
    // Atualiza o valor do input hidden
    document.getElementById("ValorTotal").value = valorServico;
    // Atualiza o texto do div com o valor do serviço selecionado
    document.getElementById("Total").innerText = "Total: R$ " + valorServico;
    }
    // Função para preencher automaticamente a data e hora da compra
    function preencherDataHoraCompra() {
        var agora = new Date();
        var dataHoraCompra = agora.toISOString(); // Formato ISO: "AAAA-MM-DDTHH:MM:SS.mmmZ"
        document.getElementById('DataHoraCompra').value = dataHoraCompra;
    }

    // Função para mostrar todos os dados do formulário no console
    function mostrarDadosFormulario() {
        var dados = {
            Servico: document.getElementById('Servico').value,
            Secretarios_Id: document.getElementById('Secretarios_Id_Cliente').value,
            Animal: document.getElementById('Animal').value,
            Cliente_Id: document.getElementById('Cliente_Id').value,
            Promocao: document.getElementById('Promocao').value,
            Id_Promocao: document.getElementById('Id_Promocao').value,
            ValorTotal: document.getElementById('ValorTotal').value,
            DataHoraCompra: document.getElementById('DataHoraCompra').value,
            MetodoPagamento: document.getElementById('MetodoPagamento').value
        };
        console.log(dados);
    }

    function atualizarIdCliente() {
        var animalSelecionado = document.getElementById('Animal');
        var clienteId = animalSelecionado.options[animalSelecionado.selectedIndex].dataset.clienteid;
        document.getElementById('Cliente_Id').value = clienteId;
    }
    </script>
</head>

<body onload="preencherDataHoraCompra()">
    <nav class="menu-lateral">
        <?php
                if(isset($_REQUEST['Id_Secretario'])) {
                    $Id_Secretario = $_REQUEST['Id_Secretario'];
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
                <a href='../VisualizarPromoções/ListarPromocoes.php?Id_Administrador=<?php echo $Id_Secretario; ?>'>
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
                <a href='../VisualizarServiços/ListarServicos.php?Id_Administrador=<?php echo $Id_Secretario; ?>'>
                    <span class="txt-link">
                        Listar Serviços
                    </span>
                </a>
            </li>
            <li class="item-menuSAIR">
                <a href="../IniciarSecretario.php?IdUsuario=<?php echo $Id_Secretario; ?>">
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
            <img id="ftnavbar" src="../../.CSS/FTINI.png">
        </nav>

        <form style="width:38%" action="Comprando.php" method="post">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Comprar um Serviço</h1>
            <div style="text-align: left; width:55%;">
                <label>Selecione o Serviço:</label><br>

                <!-- Seleção do serviço -->
                <select name="Servico" id="Servico" onchange="MostrarTotal()">
                    <option value="" selected disabled>Escolha um serviço</option> <!-- Opção padrão -->
                    <?php
                        $Consulta_Servicos = "SELECT Id, Nome, Descricao, Valor FROM servicos";
                        $Resultado_Servicos = $BD->query($Consulta_Servicos);

                        while ($Row = $Resultado_Servicos->fetch_assoc()) {
                            echo "<option value='" . $Row['Id'] . "' data-valor='" . $Row['Valor'] . "'>" . $Row['Nome'] . " - R$ " . $Row['Valor'] . "</option>";
                        }
                    ?>
                </select>

                <!-- Campo oculto para o ID do secretário -->
                <?php
                    if(isset($_GET['Id_Secretario'])) {
                        $Id_Secretario = $_GET['Id_Secretario'];
                        echo "<input type='hidden' name='Secretarios_Id' id='Secretarios_Id_Cliente' value='$Id_Secretario'><br><br>";
                    } else {
                        echo "<input type='hidden' name='Secretarios_Id' id='Secretarios_Id_Cliente'><br><br>";
                    }
                ?>

                <!-- Seleção do animal -->
                <label for="Animal">Animal:</label><br>
                <select name="Animal" id="Animal" onchange="atualizarIdCliente();">
                    <option value="" selected disabled>Escolha um animal</option> <!-- Opção padrão -->
                    <?php
                        $Consulta_Animais = "SELECT animais.Id, animais.Nome AS NomeAnimal, animais.Tipo, animais.Raca, animais.Sexo, clientes.Nome AS NomeCliente, clientes.Id AS Cliente_Id
                                FROM animais
                                INNER JOIN clientes ON animais.Clientes_Id = clientes.Id";
                        $Resultado_Animais = $BD->query($Consulta_Animais);

                        $Id_Cliente = $Row['Clientes_Id'];

                        while ($Row = $Resultado_Animais->fetch_assoc()) {
                            echo "<option value='" . $Row['Id'] . "' data-clienteid='" . $Row['Cliente_Id'] . "' id='animal_" . $Row['Id'] . "'>" . $Row['NomeAnimal'] . " - " . $Row['NomeCliente'] . "</option>";
                        }
                        
                    ?>
                </select>
                <br><br>

                <!-- Campo oculto para o ID do cliente -->
                <input type="hidden" id="Cliente_Id" name="Cliente_Id" value='<?php echo $Id_Cliente?>'>

                <!--Promoção -->
                <?php
                    $Consulta_Promocoes = "SELECT servicos.Promocoes_Id AS Id_Promocao
                    FROM servicos
                    INNER JOIN promocoes ON servicos.Promocoes_Id = promocoes.Id";
                    $Resultado_Promocoes = $BD->query($Consulta_Promocoes);

                    $Row = $Resultado_Promocoes->fetch_assoc();
                    $Id_Promocao = $Row['Id_Promocao'];
                ?>

                <!-- Campo oculto para o ID da promoção -->
                <input type="hidden" id="Id_Promocao" name="Id_Promocao" value="<?php echo  $Id_Promocao ?>" value="0">
                <br>     

                <!-- Campo oculto para o valor total -->
                <input type="hidden" id="ValorTotal" name="ValorTotal" value="0">

                <!-- Campo oculto para a data e hora da compra -->
                <input type="hidden" id="DataHoraCompra" name="DataHoraCompra">

                <!-- Campos adicionais: método de pagamento -->
                <label for="MetodoPagamento">Método de Pagamento:</label>
                <select name="MetodoPagamento" id="MetodoPagamento" onchange="mostrarDadosFormulario()">
                    <option value="" selected disabled>Escolha um método de pagamento</option> <!-- Opção padrão -->
                    <?php
                    // Consulta para obter as formas de pagamento
                    $consultaFormasPagamento = "SELECT Id, Nome, Descricao FROM FormaPagamento";
                    $resultadoFormasPagamento = $BD->query($consultaFormasPagamento);
                    
                    // Exibição das opções de forma de pagamento
                    while ($rowFormaPagamento = $resultadoFormasPagamento->fetch_assoc()) {
                        echo "<option value='" . $rowFormaPagamento['Id'] . "'>" . $rowFormaPagamento['Nome'] . "</option>";
                    }
                    ?>
                </select>
                <br><br>

                <!-- Exibição do total -->
                <div style="font-family: 'Type';font-weight: bolder;" id="Total"></div>

                <br><br>
            </div style="margin-right: 12%">
            <input type="submit" class="button" name="Enviar" style="margin-right: 10px;" value="Comprar">
            <input type="reset" class="button" name="Limpar" value="Redefinir">
            <p style="color:white;">.</p>
        </form><br><br><br><br><br><br><br><br><br>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>