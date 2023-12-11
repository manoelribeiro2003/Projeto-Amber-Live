<?php
session_start();

if(isset($_SESSION['logado'])){
    if($_SESSION['logado'] == '1'){
        session_destroy();
        header('Location:./login.php');
    }
}



?>