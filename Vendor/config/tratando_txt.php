<?php

$dir = '../dashboard/upload';   

if(!is_dir($dir)){
    mkdir($dir);
    echo '<br>Criando pasta';
}
// RETORNA UM ARRAY COM TODOS OS ARQUIVOS TXT NA PASTA
$file_data = array();
$arquivos = scandir($dir);
foreach($arquivos as $arquivo){
        if(!in_array($arquivo, array('.', '..'))){ 
            $filename = $dir . "/" . $arquivo;
            array_push($file_data, $filename);
    }
}
// LÊ A PRIMEIRA LINHA  DA PAGINA
$file = fopen($file_data[0], 'r');
$headers = explode(' ', fgets($file));
$data_linhas = array();
// LÊ CADA LINHA DA PAGINA
while( $row = fgets($file)){
    $row_data = manipuladados($row);
    $linha = array();
    //var_dump($row_data);
    //echo "<hr>";
    
    for($i = 0; $i < count($headers); $i++){
        $linha[$headers[$i]] = $row_data[$i];
    }
    array_push($data_linhas, $linha);
}
fclose($file);
echo json_encode($data_linhas);



function manipuladados($row){
    $r = array();
    for($i = 0; $i < 10; $i++){
        $palavra = " $i";
        $q = strpos($row, $palavra);
        array_push($r, $q);
    }
    $r = array_reduce($r, 'maior');
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
    $matricula = substr($resto2, 13 + 1, strlen($resto2));

    $new_row = [
        $nome,
        $idade,
        $numero,
        $matricula
    ];
    return $new_row;
}

function maior($a, $p){
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