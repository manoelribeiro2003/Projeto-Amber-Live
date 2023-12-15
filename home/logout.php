<?php
session_start();

if(isset($_SESSION['logado'])){
    if($_SESSION['logado'] == TRUE){
        $_SESSION['logado'] = FALSE;
        header('Location:./login.php');
    }
}



?>