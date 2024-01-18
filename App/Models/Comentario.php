<?php

namespace App\Models;

use MF\Model\Model;


class Comentario extends Model
{
    private $id;
    private $id_post;
    private $id_usuario;
    private $nome_usuario;
    private $comentario;
    private $data;

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
        $query = 'insert into comentarios (id_post, id_usuario, nome_usuario, comentario) 
        values (:id_post, :id_usuario, :nome_usuario, :comentario)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue('id_post', $this->__get('id_post'));
        $stmt->bindValue('id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue('nome_usuario', $this->__get('nome_usuario'));
        $stmt->bindValue('comentario', $this->__get('comentario'));

        $stmt->execute();
    }

    public function getByIdPost()
    {
        $query = "select 
        id,
        id_post, 
        id_usuario, 
        nome_usuario, 
        comentario,
        DATE_FORMAT(data, '%d/%m/%Y %H:%i') as data  
        from comentarios
        where id_post = :id_post
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue('id_post', $this->__get('id_post'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function excluir()
    {
        $query = 'delete from comentarios where id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue('id', $this->__get('id'));
        $stmt->execute();
    }
}
