<?php
session_start();
$_SESSION["log"] = false;

session_unset();

if($_SESSION["log"] != true){
    header('Location:http://localhost/php_teste/?p=vizualizacao');
}

?>