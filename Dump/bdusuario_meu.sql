CREATE SCHEMA bdusuario;

use bdusuario;

CREATE TABLE cadastro(
	id int(10) unsigned not null auto_increment,
    nome varchar(100) not null,
    sobrenome varchar(100) not null,
    email varchar(100) not null,
    usuario varchar(100) not null,
    senha varchar(100) not null,
    PRIMARY KEY (id)
);

CREATE TABLE pacientes(
	id int(10) unsigned not null auto_increment,
    nome varchar(100) not null,
    idade int(5) not null,
    telefone varchar(50) not null,
    matricula varchar(100) not null,
    PRIMARY KEY (id)
)