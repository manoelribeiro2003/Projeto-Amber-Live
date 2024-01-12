<?php

include_once('./php/conexao.php');

if (isset($_POST['email']) && $_POST['senha']) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql_select = "SELECT id FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql_select);
    $linha = $result->fetch_array();

    session_start();
    if ($result->num_rows == 0) {
        $_SESSION['logado'] = 'naoEncontrado';
        header('Location:./login.php');
    } else {
        $_SESSION['logado'] = TRUE;
        $_SESSION['id'] = $linha['id'];
        header('Location:./index.php');
    }
}else {
    header("Location:./login.php");
}
