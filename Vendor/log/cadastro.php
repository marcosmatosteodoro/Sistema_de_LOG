<?php
require_once "Vendor/config/bd_usuarios.php";
require_once "Vendor/log/cadastro.html";

if(isset($_POST['nome_c'])){
    $nome = $_POST['nome_c'];
    $sobrenome = $_POST['sobrenome_c'];
    $email = $_POST['email_c'];
    $usuario = $_POST['user_c'];
    $senha = $_POST['pass_c'];
    $senha2 = $_POST['pass2_c'];

    if($nome == null || $sobrenome == null || $email == null || $usuario == null || $senha == null || $senha2 ==null){
        $message = 'Nenhum campo pode ser nulo!';
    }else if ($senha != $senha2){
        $message = 'Senhas não conferem!';
    }else{
        $message = inseriBD($nome, $sobrenome, $email, $usuario, $senha);
    }
echo $message;
}

?>