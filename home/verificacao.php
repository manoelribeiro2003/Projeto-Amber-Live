<?php

include_once('./php/conexao.php');
include_once('./php/cores.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql_select = "SELECT * FROM streamers WHERE email = '$email'";
$result = $conn->query($sql_select);

session_start();
if ($result->num_rows == 0) {
    echo(red('Não encontrado email!'));
    $_SESSION['logado'] = '0';
    $_SESSION['email'] = $email;
    header('Location:./index.php');
}else{
    echo(green('Encontrado email!'));
    $_SESSION['logado'] = '1';
    $_SESSION['email'] = $email;
    header('Location:./index.php');

}
?>