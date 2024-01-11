<?php
include_once("cores.php");
$conn = new Mysqli('localhost','root','','id21624915_amber_live');

if ($conn->connect_error) {
    echo('Erro ao conectar-se ao banco de dados'.$conn->connect_error);
}
?>