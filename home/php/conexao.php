<?php
include_once("cores.php");
$conn = new Mysqli('localhost','root','','amberlive');

if ($conn->connect_error) {
    echo('Erro ao conectar-se ao banco de dados'.$conn->connect_error);
}else{
    echo(green('Conexão ao banco de dados bem sucedida!'));
}
// basename();
?>