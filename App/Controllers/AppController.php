<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;
use PSpell\Config;

class AppController extends Action
{
    public function validaAutenticacao()
    {
        session_start();

        if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
            header('Location: /?login=erro');
        } else {

            return true;
        }
    }

    public function timeline()
    {
        $this->validaAutenticacao();
        $post = Container::getModel('Post');
        $post->__set('id_autor', $_SESSION['id']);

        if (isset($_GET['categoria'])) {
            $post->__set('categoria', $_GET['categoria']);
            $this->view->posts = $post->getPorCategoria();
        } else if (isset($_GET['pesquisarPor'])) {
            $post->__set('titulo', $_GET['pesquisarPor']);
            $this->view->posts = $post->getPesquisa();
        } else {
            $this->view->posts = $post->getAll();
        }



        $this->view->total_posts = $post->getTotalPosts();
        $this->render('timeline', 'layout');
    }

    public function novo_post()
    {
        $this->validaAutenticacao();
        $post = Container::getModel('Post');
        $post->__set('id_autor', $_SESSION['id']);
        $this->view->total_posts = $post->getTotalPosts();
        $this->render('novo_post', 'layout');
    }

    public function postar()
    {
        $this->validaAutenticacao();
        print_r($_SESSION);
        print_r($_POST);
        $post = Container::getModel('Post');
        $post->__set('id_autor', $_SESSION['id']);
        $post->__set('nome_autor', $_SESSION['nome']);
        $post->__set('titulo', $_POST['titulo']);
        $post->__set('conteudo', $_POST['conteudo']);
        $post->__set('categoria', $_POST['categoria']);

        $post->salvar();

        header('Location: /timeline');
    }

    public function leia_mais()
    {
        $this->validaAutenticacao();
        $post = Container::getModel('Post');
        $post->__set('id_autor', $_SESSION['id']);
        $post->__set('id', $_GET['id']);

        $this->view->detalhes = $post->getById();
        $this->view->total_posts = $post->getTotalPosts();

        $comentario = Container::getModel('Comentario');
        $comentario->__set('id_post', $_GET['id']);

        $this->view->comentarios = $comentario->getByIdPost();

        $this->render('leia_mais', 'layout');
    }

    public function editar_post()
    {
        $this->validaAutenticacao();
        $post = Container::getModel('Post');
        $post->__set('id_autor', $_SESSION['id']);
        $post->__set('id', $_GET['id']);

        $this->view->detalhes = $post->getById();
        $this->view->total_posts = $post->getTotalPosts();
        $this->render('editar_post', 'layout');
    }

    public function editar()
    {
        $this->validaAutenticacao();


        $post = Container::getModel('Post');
        $post->__set('id', $_GET['id']);
        $post->__set('titulo', $_POST['titulo']);
        $post->__set('conteudo', $_POST['conteudo']);
        $post->__set('categoria', $_POST['categoria']);

        if ($_SESSION['id'] == $post->getById()['id_autor']) {
            $post->editar();
        }

        header('Location: /timeline');
    }

    public function excluir_post()
    {
        $this->validaAutenticacao();
        $post = Container::getModel('Post');
        $post->__set('id', $_GET['id']);

        if ($_SESSION['id'] == $post->getById()['id_autor']) {
            $post->excluir();
        }

        header('Location: /timeline');
    }

    public function comentar()
    {
        $comentario = Container::getModel('Comentario');
        $comentario->__set('id_post', $_POST['id_post']);
        $comentario->__set('id_usuario', $_POST['id_usuario']);
        $comentario->__set('nome_usuario', $_POST['nome_usuario']);
        $comentario->__set('comentario', $_POST['comentario']);

        $comentario->salvar();

        header('Location: /leia_mais?id=' . $_POST['id_post']);
    }

    public function excluir_comentario()
    {
        $comentario = Container::getModel('Comentario');
        $comentario->__set('id', $_GET['id']);
        $comentario->excluir();

        header('Location: /leia_mais?id=' . $_GET['id_post']);
    }
}
