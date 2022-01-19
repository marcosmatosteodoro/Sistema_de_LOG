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
        $headers = explode(';', fgets($file));
        if(count($headers) != 4){
            return ['danger','Primeira linha fora do formato.'];
        }
        $i = 0;
        // LÊ CADA LINHA DA PAGINA
        while($row = fgets($file)){
            $newrow = explode(';', $row);
            $i++;
            if(count($newrow) != 4){
                return ['danger',"Linha $i fora do formato. Registrado " . ($i-1) ." pacientes."];
            }
            inseriBD($newrow[0],$newrow[1],$newrow[2],$newrow[3]);
            }
        unlink($filename);
        }  
    }

    return ['sucesso' ,'Dados salvo com sucesso!'];
}
?>