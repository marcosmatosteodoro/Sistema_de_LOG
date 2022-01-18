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
    $message = alterarbd($_GET['nome_a'], $_GET['idade_a'], $_GET['telefone_a'], $_GET['matricula_a'], $_GET['id_a']);
    mensagem($message, 'sucesso');
    
}elseif(isset($_GET['excluir'])){
    $message = excluirDados($_GET['excluir']);
    mensagem($message, 'sucesso');
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