<?php
require_once "Vendor/config/bd_usuarios.php";

if(isset($_POST['nome_c'])){
    $nome = $_POST['nome_c'];
    $sobrenome = $_POST['sobrenome_c'];
    $email = $_POST['email_c'];
    $usuario = $_POST['user_c'];
    $senha = $_POST['pass_c'];
    $senha2 = $_POST['pass2_c'];


    if($nome == null || $sobrenome == null || $email == null || $usuario == null || $senha == null || $senha2 ==null){
        mensagem('Nenhum campo pode ser nulo!', 'danger');
    }else if ($senha != $senha2){
        mensagem('Senhas não conferem!', 'danger');
    }else if(strlen($nome) < 4 || strlen($sobrenome) < 4 || strlen($usuario) < 4 || strlen($senha) < 4){
        mensagem('Nenhum campo pode ser inferior a 4 caracteres!', 'danger');
    }else if(strpos($nome, ' ') === 0 || strpos($sobrenome, ' ') === 0 || strpos($usuario, ' ') === 0 || strpos($senha, ' ') === 0 || strpos($email, ' ') === 0){
        mensagem('Nenhum campo pode iniciar com espaço vazio!', 'danger');
    }else if(puxarDados($usuario)){
        mensagem("Este usuario já existe!", 'danger');
    }else{
        $mensagem = inseriBD($nome, $sobrenome, $email, $usuario, $senha);
        header("Location:index.php?p=login&m=$mensagem&t=sucesso");
    }
}

require_once "Vendor/log/cadastro.html";
?>
