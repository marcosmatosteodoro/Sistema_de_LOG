<?php
session_start();
require_once "Vendor/config/bd_pacientes.php";
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
        <button class='btn btn-warning'>Alterar</button>
        <button class='btn btn-danger'>Excluir</button>
    </td>
</tr>"
;
}
require_once "Vendor/dashboard/vizualizacaoFim.html";


?>