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

    $telefone = substr_replace($telefone, ' ', 2, 0);
    $telefone = substr_replace($telefone, '-', 8, 0);

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

function alterarbd($nome, $idade, $telefone, $matricula, $id){

    $telefone = substr_replace($telefone, ' ', 2, 0);
    $telefone = substr_replace($telefone, '-', 8, 0);

    $conn = conectar();
    $tabela = 'pacientes';

    $stmt = $conn->prepare("UPDATE $tabela SET nome= :NOME, idade = :IDADE, telefone = :TEL, matricula = :MAT WHERE id = :ID");

    $stmt->bindParam(":NOME", $nome);
    $stmt->bindParam(":IDADE", $idade);
    $stmt->bindParam(":TEL", $telefone);
    $stmt->bindParam(":MAT", $matricula);
    $stmt->bindParam(":ID", $id);

    $stmt->execute();

    return  "Dados alterados com sucesso!";
}

function exibirDados($ordem = 'id'){
    $conn = conectar();
    $tabela = 'pacientes';

    $stmt = $conn->prepare("SELECT * FROM $tabela ORDER BY id");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function validarmatricula($matricula, $id=0){
    $conn = conectar();
    $tabela = 'pacientes';

    if($id > 0){
        $stmt = $conn->prepare("SELECT * FROM $tabela WHERE matricula = '$matricula' && id = '$id'");
    }else{
        $stmt = $conn->prepare("SELECT * FROM $tabela WHERE matricula = '$matricula'");
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function excluirDados($id_paciente){
    $conn = conectar();
    $tabela = 'pacientes';

    $stmt = $conn->prepare("DELETE FROM $tabela WHERE id = $id_paciente");
    $stmt->execute();

    return 'Dados excluidos com sucesso!';
}

?>