<?php
include_once 'Conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CPF = $_POST['CPF'];
    $Senha = $_POST['Senha'];
    $TipoUsuario = $_POST['TipoUsuario'];

    if ($TipoUsuario == 'Administrador') {
        $Table = 'administradores';
        $RedirectPage = 'Administrador/IniciarAdministrador.php';
    } elseif ($TipoUsuario == 'Secretario') {
        $Table = 'secretarios';
        $RedirectPage = 'Secretário/IniciarSecretario.php';
    } else {
        echo "Tipo de usuário inválido.";
        exit();
    }

    $SQL = "SELECT * FROM $Table WHERE CPF = '$CPF'";
    $Res = $BD->query($SQL);

    if ($Res->num_rows > 0) {
        $User = $Res->fetch_assoc();

        if ($Senha == $User['Senha']) {
            if ($TipoUsuario == 'Administrador' || $TipoUsuario == 'Secretario') {
                $IdUsuario = $User['Id'];
                header("Location: $RedirectPage?IdUsuario=$IdUsuario");
                exit();
            }
        } else {
            echo "<script>alert ('Senha incorreta. Tente novamente!')
                    window.location.href = 'Login.html';
                </script>";
        }
    } else {
        echo "<script>
                alert ('Usuário não encontrado. Verifique o CPF e o tipo de usuário!');
                window.location.href = 'Login.html';
            </script>";
    }
}