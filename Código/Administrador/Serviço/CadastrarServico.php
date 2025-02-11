<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <?php
    include_once '../../Conexao.php';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Serviço</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../.CSS/Style.css">
</head>

<body>
    <nav class="menu-lateral">
        <?php
            if(isset($_GET['Id_Administrador'])) {
                $Id_Administrador = $_GET['Id_Administrador'];
        ?>
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
            <a href="../IniciarAdministrador.php?IdUsuario=<?php echo $Id_Administrador; ?>"> <img id="ftnavbar"
                    src="../../.CSS/FTINI.png" title="Ir para o menu inicial"> </a>
        </nav>
        <form action="CadastrandoServico.php" method="post" style="width:34%">
            <p style="color:white;">.</p>
            <h1 style="margin-top: 2px;">Cadastrar Serviço</h1>
            <div style="text-align: left; width:52%; color:white;">
                <label for="Nome_Servico">Nome:</label><br><br>
                <input type="text" name="Nome" id="Nome_Servico"><br><br>
                <label for="Descricao_Servico">Descrição:</label><br><br>
                <textarea name="Descricao" id="Descricao_Servico" rows="4" cols="50" style="max-width: 287px;"></textarea><br><br>
                <label for="Valor_Servico">Valor:</label><br><br>
                <input type="number" step=".01" name="Valor" id="Valor_Servico" min="0"><br><br>
                <label for="DuracaoEstimada_Servico">Duração Estimada (minutos):</label><br><br>
                <input type="number" name="DuracaoEstimada" id="DuracaoEstimada_Servico" placeholder="Formato: 00.00" min="0"><br><br>
                <label for="Disponibilidade_Servico">Disponibilidade:</label><br><br>
                <input type="text" name="Disponibilidade" id="Disponibilidade_Servico"
                    placeholder="Ex.: Segunda a sexta, das 9h às 17h"><br><br>
                <label for="Promocoes_Id_Servico">Selecione uma Promoção:</label><br><br>
                <select name="Promocoes_Id" id="Promocoes_Id_Servico" min="0">
                    <?php
                        // Query para obter todas as promoções
                        $Query_Promocoes = "SELECT Id, Nome, Valor FROM promocoes";
                        $Result_Promocoes = $BD->query($Query_Promocoes);

                        // Verifica se há resultados
                        if ($Result_Promocoes->num_rows > 0) {
                            // Loop através dos resultados para criar as opções do select
                            while ($Row_Promocao = $Result_Promocoes->fetch_assoc()) {
                                $Id_Promocao = $Row_Promocao['Id'];
                                $Nome_Promocao = $Row_Promocao['Nome'];
                                $Valor_Promocao = $Row_Promocao['Valor'];
                                echo "<option value='$Id_Promocao'>$Nome_Promocao - R$ $Valor_Promocao</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhuma promoção encontrada</option>";
                        }
                    ?>
                </select><br><br>
                <?php
                    if(isset($_GET['Id_Administrador'])) {
                        $Id_Administrador = $_GET['Id_Administrador'];
                        echo "<input type='hidden' name='Administradores_Id' id='Administradores_Id_Servico' value='$Id_Administrador'><br><br>";
                    } else {
                        echo "<input type='hidden' name='Administradores_Id' id='Administradores_Id_Servico'><br><br>";
                    }
                ?>
                <input class="button" type="submit" name="Enviar" value="Cadastrar">
                . . . .
                <input type="reset" class="button" name="Limpar" value="Redefinir">
                <p style='color:white;'>.</p>
            </div>
        </form>
        <footer>
            <div class="container">
                &copy; 2024 PET SHOP - RCR. Todos os direitos reservados.
            </div>
        </footer>
</body>

</html>