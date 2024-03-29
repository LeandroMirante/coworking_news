create database coworking_news;

use coworking_news;

create table usuarios(
id int not null PRIMARY key AUTO_INCREMENT,
    nome varchar(100) not null,
    email varchar(150) not null,
    senha varchar(32) not null
);

create table posts(
    id int not null PRIMARY key AUTO_INCREMENT,
    id_autor int not null,
    titulo varchar(200) not null,
    conteudo text not null,
    categoria varchar(40) not null,
    data datetime default current_timestamp,
    data_atualizacao datetime default current_timestamp,
    nome_autor varchar(150) not null
);

create TABLE comentarios (
id int not null PRIMARY key AUTO_INCREMENT,
    id_post int not null,
    id_usuario int not null,
    nome_usuario varchar(150) not null,
    comentario text not null,
    data datetime DEFAULT CURRENT_TIMESTAMP
);
