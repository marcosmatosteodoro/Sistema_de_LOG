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
        mensagem('Nenhum campo pode ser nulo!', 'dager');
    }else if($idade > 120){
        mensagem('Idade não pode ser superior a 120 anos!', 'dager');
    }else if($idade < 0){
        mensagem('Idade não pode ser negativo!', 'dager');
    }else if(strlen($nome) < 4){
        mensagem('Campo nome não pode ser inferior a 4 caracteres!', 'danger');
    }else if(strlen($matricula) < 8){
        mensagem('Campo matricula não pode ser inferior a 8 caracteres!', 'danger');
    }else if(strpos($nome, ' ') === 0 || strpos($idade, ' ') === 0 || strpos($telefone, ' ') === 0 || strpos($matricula, ' ') === 0){
        mensagem('Nenhum campo pode iniciar com espaço vazio!', 'danger');
    }else if(validarmatricula($matricula)){
        mensagem("Este numero de matricula já existe!", 'danger');
    }else{
        $mensagem = inseriBD($nome, $idade, $telefone, $matricula);
        header("Location:index.php?p=visualizacao&m=$mensagem&t=sucesso");
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
        $mensagem = enviartxt();
        header("Location:index.php?p=visualizacao&m=$mensagem&t=sucesso");
    }
}


require_once "Vendor/dashboard/importacao.html";
?>