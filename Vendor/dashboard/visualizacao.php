<?php
session_start();
require_once "Vendor/config/bd_pacientes.php";
if (!isset($_SESSION['log']) || $_SESSION["log"] != true){
    header('Location:index.php?p=login');

}

if(isset($_GET['met']) && $_GET['met'] == 'alter'){
    $dados = json_decode($_GET['dados'], true);
    $dados['telefone'] = str_replace(" ","",$dados['telefone']);
    $dados['telefone'] = str_replace("-","",$dados['telefone']);
    require_once "Vendor/dashboard/visualizacaoAlter.html";

}elseif(isset($_GET['met']) && $_GET['met'] == 'exc'){
    $dados = json_decode($_GET['dados'], true);
    require_once "Vendor/dashboard/visualizacaoExec.html";

}elseif(isset($_GET['nome_a'])){
    $id = $_GET['id_a'];
    $nome = $_GET['nome_a'];
    $idade = $_GET['idade_a'];
    $telefone = $_GET['telefone_a'];
    $matricula = $_GET['matricula_a'];

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
    }else if(!validarmatricula($matricula, $id) && validarmatricula($matricula)){
        mensagem("Este numero de matricula já existe!", 'danger');
    }else{
    mensagem(alterarbd($nome, $idade, $telefone, $matricula, $id), 'sucesso');
    }

}elseif(isset($_GET['excluir'])){
    $message = excluirDados($_GET['excluir']);
    mensagem($message, 'sucesso');
}

if(isset($_GET['m']) && isset($_GET['t'])){
    mensagem($_GET['m'], $_GET['t']);
}
require_once "Vendor/dashboard/visualizacaoInicio.html";


foreach(exibirDados() as $dados){
    echo "
<tr>
    <th scope='row'>" . $dados['id'] . "</th>
    <td>" . $dados['nome'] . "</td>
    <td>" . $dados['idade'] . "</td>
    <td>" . $dados['telefone'] . "</td>
    <td>" . $dados['matricula'] . "</td>
    <td>
        
        <a href='?p=visualizacao&met=alter&dados=". json_encode($dados) ."'>
            <button class='btn btn-secundary'>Alterar</button>
        </a>
        <a href='?p=visualizacao&met=exc&dados=" .json_encode($dados)."'>
            <button class='btn btn-danger'>Excluir</button>
        </a>
        
    </td>
</tr>"
;
}

require_once "Vendor/dashboard/visualizacaoFim.html";

?>