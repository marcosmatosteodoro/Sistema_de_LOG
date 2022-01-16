<?php
session_start();

require_once "Vendor/config/tratando_txt.php";
require_once "Vendor/config/bd_pacientes.php";
require_once "Vendor/dashboard/importacao.html";

if(isset($_POST['nome_i'])){

    $nome = $_POST['nome_i'];
    $idade = $_POST['idade_i'];
    $telefone = $_POST['telefone_i'];
    $matricula = $_POST['matricula_i'];

    $telefone = substr_replace($telefone, ' ', 2, 0);
    $telefone = substr_replace($telefone, '-', 8, 0);

    if($nome == null || $idade == null || $telefone == null || $matricula == null){
        $message = 'Nenhum campo pode ser nulo!';
    }else{
        //$message = inseriBD($nome, $idade, $telefone, $matricula);
        //echo $message;
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
        echo "Upload realizado com sucesso!<br>";
        echo $message;
    } else {
        throw new Exception("Não foi possível reaizar o upload.");
    }
}

?>