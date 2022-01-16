<?php
require_once "Vendor/config/bd_usuarios.php";
require_once "Vendor/config/session.php";


if(isset($_POST['user_l']) && isset($_POST['pass_l'])){

    $logado = false;
    $usuario = $_POST['user_l'];
    $senha = $_POST['pass_l'];

    if($usuario == null || $senha == null){
        mensagem('Nenhum campo pode ser nulo!', 'danger');
    }else{
        $validacao = validarBD($usuario, $senha);
        if($validacao === 0){
            mensagem("Usuário ou senha não conferem", 'danger');
        } elseif($validacao != 1 ){
            mensagem("Ops! Algo deu errado", 'danger');
        }else{
            $logado = true;
            $dados = puxarDados($usuario);
            $message = entrarSession($dados[0]['id'], $dados[0]['nome'], $dados[0]['sobrenome'], $usuario);
        }
    }
    if ($logado === true) {
        header('Location:http://localhost/php_teste/?p=vizualizacao');
    }
}

require_once 'Vendor/log/login.html';

?>