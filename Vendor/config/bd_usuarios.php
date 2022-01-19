<?php
function conectar(){
    $dbname = 'bdusuario';
    $host = 'localhost';
    $user = "root";
    $senha = "";
    $conn = new PDO("mysql:dbname=$dbname; host=$host", $user, $senha);
    return $conn;
}
function inseriBD($nome, $sobrenome, $email, $usuario, $senha){
    $conn = conectar();
    $tabela = 'cadastro';
    $stmt = $conn->prepare("INSERT INTO $tabela (nome, sobrenome, email, usuario, senha) 
        VALUES(:NAME, :LASTNAME, :EMAIL, :LOGIN, :PASSWORD)");
    
    $stmt->bindParam(":NAME", $nome);
    $stmt->bindParam(":LASTNAME", $sobrenome);
    $stmt->bindParam(":EMAIL", $email);
    $stmt->bindParam(":LOGIN", $usuario);
    $stmt->bindParam(":PASSWORD", $senha);

    $stmt->execute();
    
    return "Dados inserido com sucesso!";
}

function alterarbd($id, $nome, $sobrenome, $email, $usuario, $senha){
    $conn = conectar();
    $tabela = 'cadastro';

    $stmt = $conn->prepare("UPDATE $tabela SET nome= :NAME, sobrenome= :LASTNAME, email= :EMAIL, usuario= :LOGIN, senha= :PASSWORD WHERE id = :ID");
    $stmt->bindParam(":ID", $id);
    $stmt->bindParam(":NAME", $nome);
    $stmt->bindParam(":LASTNAME", $sobrenome);
    $stmt->bindParam(":EMAIL", $email);
    $stmt->bindParam(":LOGIN", $usuario);
    $stmt->bindParam(":PASSWORD", $senha);
    
    $stmt->execute();
    return "Dados alterados com sucesso!";
}

function validarBD($usuario, $senha){
    $conn = conectar();
    $tabela = 'cadastro';

    $stmt = $conn->prepare("SELECT * FROM $tabela WHERE usuario = '$usuario' && senha = '$senha'");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return count($results); 
}

function puxarDados($usuario, $tudo = false){
    $conn = conectar();
    $tabela = 'cadastro';
    if($tudo == true){
        $campos = '*';
    } else{
        $campos = 'id, nome, sobrenome';
    }
    
    $stmt = $conn->prepare("SELECT $campos FROM $tabela WHERE usuario = '$usuario'");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}


?>