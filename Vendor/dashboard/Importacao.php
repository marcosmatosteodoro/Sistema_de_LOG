<?php
session_start();

require_once "Vendor/config/tratando_txt.php";
require_once "Vendor/config/bd_pacientes.php";

if (!isset($_SESSION['log']) || $_SESSION["log"] != true){
    header('Location:index.php?p=login');
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
    $extensao = substr($file['name'], -3, 3);
    $erro = false;
    if ($file["error"]) {
        throw new Excaption("Error: ".$file["error"]);
    }
    if($extensao != 'txt'){
        $message = " Extensão $extensao não suportada<br>Faça upload de arquivo com extensão txt!";
        mensagem($message, 'danger');
        $erro = true;
    }
    
    $dirUploads = "Vendor/uploads";
    if (!is_dir($dirUploads)) {

        mkdir($dirUploads);
    }
    if ($erro !== true) {
        move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $file["name"]);
        $message = enviartxt();
        mensagem($message, 'sucesso');
    }
}


require_once "Vendor/dashboard/importacao.html";
?>