<?php
session_start();
require_once "Vendor/config/bd_usuarios.php";
if (!isset($_SESSION['log']) || $_SESSION["log"] != true){
    header('Location:index.php?p=login');
}
$dados = puxarDados($_SESSION["usuario"], true);

if(isset($_POST['nome_ac'])){
    if($_POST['nome_ac'] == null || $_POST['sobrenome_ac'] == null || $_POST['email_ac'] == null || $_POST['user_ac'] == null || $_POST['senha_ac'] == null){
        $message = 'Nenhum campo pode ser nulo';
        $status = 'danger';

    }elseif($_POST['senha_ac'] != $_POST['senha2_ac']){
        $message = 'Senhas não conferem';
        $status = 'danger';
    }
    else{
        $message = alterarbd($_POST['nome_ac'], $_POST['sobrenome_ac'], $_POST['email_ac'], $_POST['user_ac'], $_POST['senha_ac']);
        $status = 'sucesso';
    }
    mensagem($message, $status); 
}


require_once "Vendor/dashboard/alterarcadastro.html";

?>