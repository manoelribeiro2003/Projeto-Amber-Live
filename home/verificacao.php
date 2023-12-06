<?php

include_once('./php/conexao.php');
include_once('./php/cores.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql_select = "SELECT * FROM streamers WHERE email = '$email'";
$result = $conn->query($sql_select);

if ($result->num_rows == 0) {
    echo(red('Não encontrado email!'));
}else{
    echo(green('Encontrado email!'));
    // header('Location:./verificacao.php');
}
?>