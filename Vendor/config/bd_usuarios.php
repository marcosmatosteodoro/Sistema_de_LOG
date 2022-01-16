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

function alterarbd($campo, $novoDado, $id){
    $conn = conectar();
    $tabela = 'cadastro';

    $stmt = $conn->prepare("UPDATE $tabela SET $campo = :CAMPO WHERE id = :ID");

    $stmt->bindParam(":CAMPO", $novoDado);
    $stmt->bindParam(":ID", $id);

    $stmt->execute();

    $mensagem =  "Dados alterados com sucesso!";

    return $mensagem;
}

function validarBD($usuario, $senha){
    $conn = conectar();
    $tabela = 'cadastro';

    $stmt = $conn->prepare("SELECT * FROM $tabela WHERE usuario = '$usuario' && senha = '$senha'");

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return count($results); 

}

function puxarDados($usuario){
    $conn = conectar();
    $tabela = 'cadastro';

    $stmt = $conn->prepare("SELECT id, nome, sobrenome FROM $tabela WHERE usuario = '$usuario'");

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

?>