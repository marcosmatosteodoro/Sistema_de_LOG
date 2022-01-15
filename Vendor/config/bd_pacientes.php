<?php
function conectar(){
    $dbname = 'bdusuario';
    $host = 'localhost';
    $user = "root";
    $senha = "";
    $conn = new PDO("mysql:dbname=$dbname; host=$host", $user, $senha);
    return $conn;
}
function inseriBD($nome, $idade, $telefone, $matricula){
    $conn = conectar();
    $tabela = 'pacientes';
    $stmt = $conn->prepare("INSERT INTO $tabela (nome, idade, telefone, matricula) 
        VALUES(:NAME, :IDADE, :TEL, :MAT)");
    
    $stmt->bindParam(":NAME", $nome);
    $stmt->bindParam(":IDADE", $idade);
    $stmt->bindParam(":TEL", $telefone);
    $stmt->bindParam(":MAT", $matricula);
    
    $stmt->execute();
    
    return "Dados inserido com sucesso!";
}

function alterarbd($campo, $novoDado, $id){
    $conn = conectar();
    $tabela = 'pacientes';

    $stmt = $conn->prepare("UPDATE $tabela SET $campo = :CAMPO WHERE id = :ID");

    $stmt->bindParam(":CAMPO", $novoDado);
    $stmt->bindParam(":ID", $id);

    $stmt->execute();

    $mensagem =  "Dados alterados com sucesso!";

    return $mensagem;
}

function exibirDados(){
    $conn = conectar();
    $tabela = 'pacientes';

    $stmt = $conn->prepare("SELECT * FROM $tabela ORDER BY nome");

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results; 

}

?>