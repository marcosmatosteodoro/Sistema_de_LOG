<?php

//require_once "Vendor/config/bd_pacientes.php";
require_once "bd_pacientes.php";

function enviartxt(){
    $dir = 'Vendor/uploads';   

    if(!is_dir($dir)){
        mkdir($dir);
    }
    // RETORNA UM ARRAY COM TODOS OS ARQUIVOS TXT NA PASTA
    $arquivos = scandir($dir);
    foreach($arquivos as $arquivo){
        if(!in_array($arquivo, array('.', '..'))){ 
            $filename = $dir . "/" . $arquivo;
        
        // LÊ A PRIMEIRA LINHA  DA PAGINA
        $file = fopen($filename, 'r');
        $headers = explode(' ', fgets($file));

        // LÊ CADA LINHA DA PAGINA
        while( $row = fgets($file)){
            $row_data = manipuladados($row);
            

            $message = inseriBD($row_data['nome'], $row_data['idade'], $row_data['numero'], $row_data['matricula']);
            }
        unlink($filename);
        }
        
    }

    return 'Dados salvo com sucesso!';
}

function manipuladados($row){
    $r = array();
    for($i = 0; $i < 10; $i++){
        $palavra = " $i";
        $q = strpos($row, $palavra);
        array_push($r, $q);
    }
    $r = array_reduce($r, 'menor');
    $palavra = " 4";
    $q = strpos($row, $palavra);
    $nome = substr($row, 0, $r);
    $resto = substr($row, $r + (strlen($palavra) -1), strlen($row));

    $palavra2 = " ";
    $q2 = strpos($resto, $palavra2);
    $idade = substr($resto, 0, $q2);
    $resto2 = substr($resto, $q2 + strlen($palavra2), strlen($resto));

    $palavra3 = " ";
    $numero = substr($resto2, 0, 13);
    $resto3 = substr($resto2, 13 + 1, strlen($resto2));
    
    $matricula = $resto3;

    $new_row['nome'] = $nome;
    $new_row['idade'] = $idade;
    $new_row['numero'] = $numero;
    $new_row['matricula'] = $matricula;
    return $new_row;
}

function menor($a, $p){
    if($a == false){
        return $p;
    }elseif($p == false){
        return $a;
    }elseif($a < $p){
        return $a;
    } else {
        return $p;
    }
}

?>