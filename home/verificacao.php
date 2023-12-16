<?php

include_once('./php/conexao.php');
include_once('./php/cores.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql_select = "SELECT * FROM streamers WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql_select);

session_start();
if ($result->num_rows == 0) {
    $_SESSION['logado'] = 'naoEncontrado';
    header('Location:./login.php');
}else{
    $_SESSION['logado'] = TRUE;
    $_SESSION['email'] = $email;
    header('Location:./index.php');

}
?>