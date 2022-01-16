<?php
session_start();

require_once "Vendor/config/tratando_txt.php";
require_once "Vendor/config/bd_pacientes.php";

if (!isset($_SESSION['log']) || $_SESSION["log"] != true){
    header('Location:http://localhost/php_teste/?p=login');
}


if(isset($_POST['nome_i'])){

    $nome = $_POST['nome_i'];
    $idade = $_POST['idade_i'];
    $telefone = $_POST['telefone_i'];
    $matricula = $_POST['matricula_i'];

    if($nome == null || $idade == null || $telefone == null || $matricula == null){
        $message = 'Nenhum campo pode ser nulo!';
        mensagem($message, 'dager');
    }else{
        $message = inseriBD($nome, $idade, $telefone, $matricula);
        mensagem($message, 'sucesso');
    }

} else if(isset($_FILES["fileUpload"])){
    $file = $_FILES["fileUpload"];
    if ($file["error"]) {
        throw new Excaption("Error: ".$file["error"]);
    }
    $dirUploads = "Vendor/uploads";
    if (!is_dir($dirUploads)) {

        mkdir($dirUploads);
    }
    if (move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $file["name"])) {
        $message = enviartxt();
        mensagem($message, 'sucesso');
    } else {
        throw new Exception("Não foi possível reaizar o upload.");
    }
}


require_once "Vendor/dashboard/importacao.html";
?>