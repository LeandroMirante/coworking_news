<?php

namespace App\Models;

use MF\Model\Model;


class Post extends Model
{
    private $id;
    private $id_autor;
    private $nome_autor;
    private $titulo;
    private $conteudo;
    private $categoria;
    private $data;
    private $data_atualizacao;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function salvar()
    {
        $query = 'insert into posts (id_autor, nome_autor, titulo,conteudo, categoria)
        values (:id_autor, :nome_autor, :titulo, :conteudo, :categoria)
        ';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue('id_autor', $this->__get('id_autor'));
        $stmt->bindValue('nome_autor', $this->__get('nome_autor'));
        $stmt->bindValue('titulo', $this->__get('titulo'));
        $stmt->bindValue('conteudo', $this->__get('conteudo'));
        $stmt->bindValue('categoria', $this->__get('categoria'));
        $stmt->execute();
    }

    public function getAll()
    {
        $query = "select 
            id,
            id_autor, 
            nome_autor, 
            titulo, 
            conteudo, 
            categoria, 
            DATE_FORMAT(data, '%d/%m/%Y %H:%i') as data, 
            DATE_FORMAT(data_atualizacao, '%d/%m/%Y %H:%i') as data_atualizacao 
                from posts order by data_atualizacao desc";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPorCategoria()
    {
        $query = "select 
            id,
            id_autor, 
            nome_autor, 
            titulo, 
            conteudo, 
            categoria, 
            DATE_FORMAT(data, '%d/%m/%Y %H:%i') as data, 
            DATE_FORMAT(data_atualizacao, '%d/%m/%Y %H:%i') as data_atualizacao 
                from posts 
            where
                categoria = :categoria
                order by data_atualizacao desc";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':categoria', $this->__get('categoria'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPesquisa()
    {
        $query = "select 
            id,
            id_autor, 
            nome_autor, 
            titulo, 
            conteudo, 
            categoria, 
            DATE_FORMAT(data, '%d/%m/%Y %H:%i') as data, 
            DATE_FORMAT(data_atualizacao, '%d/%m/%Y %H:%i') as data_atualizacao 
                from posts 
            where
                titulo like :titulo
            order by data_atualizacao desc";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':titulo', '%' . $this->__get('titulo') . '%');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById()
    {
        $query = "
        select 
                id,
                id_autor, 
                nome_autor, 
                titulo, 
                conteudo, 
                categoria, 
                DATE_FORMAT(data, '%d/%m/%Y %H:%i') as data, 
                DATE_FORMAT(data_atualizacao, '%d/%m/%Y %H:%i') as data_atualizacao 
            from 
                posts 
            where
                id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function editar()
    {
        $query = 'update posts set titulo = :titulo, conteudo = :conteudo, categoria= :categoria, data_atualizacao = current_timestamp
        where id = :id
        ';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->bindValue(':titulo', $this->__get('titulo'));
        $stmt->bindValue(':conteudo', $this->__get('conteudo'));
        $stmt->bindValue(':categoria', $this->__get('categoria'));
        $stmt->execute();
    }

    public function excluir()
    {
        $query = 'delete from posts where id=:id
        ';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();
    }

    public function getTotalPosts()
    {
        $query = 'select count(*) as total_posts from posts where id_autor = :id_autor';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_autor', $this->__get('id_autor'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
