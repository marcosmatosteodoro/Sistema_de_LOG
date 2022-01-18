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
    require_once "Vendor/dashboard/vizualizacaoAlter.html";

}elseif(isset($_GET['met']) && $_GET['met'] == 'exc'){
    $dados = json_decode($_GET['dados'], true);
    require_once "Vendor/dashboard/vizualizacaoExec.html";

}elseif(isset($_GET['nome_a'])){
    $message = alterarbd($_GET['nome_a'], $_GET['idade_a'], $_GET['telefone_a'], $_GET['matricula_a'], $_GET['id_a']);
    mensagem($message, 'sucesso');
    
}elseif(isset($_GET['excluir'])){
    $message = excluirDados($_GET['excluir']);
    mensagem($message, 'sucesso');
}


require_once "Vendor/dashboard/vizualizacaoInicio.html";


foreach(exibirDados() as $dados){
    echo "
<tr>
    <th scope='row'>" . $dados['id'] . "</th>
    <td>" . $dados['nome'] . "</td>
    <td>" . $dados['idade'] . "</td>
    <td>" . $dados['telefone'] . "</td>
    <td>" . $dados['matricula'] . "</td>
    <td>
        
        <a href='?p=vizualizacao&met=alter&dados=". json_encode($dados) ."'>
            <button class='btn btn-secundary'>Alterar</button>
        </a>
        <a href='?p=vizualizacao&met=exc&dados=" .json_encode($dados)."'>
            <button class='btn btn-danger'>Excluir</button>
        </a>
        
    </td>
</tr>"
;
}
require_once "Vendor/dashboard/vizualizacaoFim.html";
?>