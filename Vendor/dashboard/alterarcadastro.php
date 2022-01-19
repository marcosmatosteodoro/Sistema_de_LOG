<?php
session_start();
require_once "Vendor/config/bd_usuarios.php";
if (!isset($_SESSION['log']) || $_SESSION["log"] != true){
    header('Location:index.php?p=login');
}
$dados = puxarDados($_SESSION["usuario"], true);

if(isset($_POST['nome_ac'])){
    $nome = $_POST['nome_ac'];
    $sobrenome = $_POST['sobrenome_ac'];
    $email = $_POST['email_ac'];
    $usuario = $_POST['user_ac'];
    $senha = $_POST['senha_ac'];
    $senha2 = $_POST['senha2_ac'];

    if($nome == null || $sobrenome == null || $email == null || $usuario == null || $senha == null || $senha2 ==null){
        mensagem('Nenhum campo pode ser nulo!', 'danger');
    }else if ($senha != $senha2){
        mensagem('Senhas não conferem!', 'danger');
    }else if(strlen($nome) < 4 || strlen($sobrenome) < 4 || strlen($usuario) < 4 || strlen($senha) < 4){
        mensagem('Nenhum campo pode ser inferior a 4 caracteres!', 'danger');
    }else if(strpos($nome, ' ') === 0 || strpos($sobrenome, ' ') === 0 || strpos($usuario, ' ') === 0 || strpos($senha, ' ') === 0 || strpos($email, ' ') === 0){
        mensagem('Nenhum campo pode iniciar com espaço vazio!', 'danger');
    }else if($_SESSION["usuario"] != $usuario && puxarDados($usuario)){
        mensagem("Este usuario já existe!", 'danger');
    }else{
        $mensagem = alterarbd($dados[0]['id'], $_POST['nome_ac'], $_POST['sobrenome_ac'], $_POST['email_ac'], $_POST['user_ac'], $_POST['senha_ac']);
        $_SESSION["usuario"] = $usuario;
        header("Location:index.php?p=visualizacao&m=$mensagem&t=sucesso");

    }

}


require_once "Vendor/dashboard/alterarcadastro.html";

?>