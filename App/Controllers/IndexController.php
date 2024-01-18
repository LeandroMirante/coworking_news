<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{

    public function index()
    {
        $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

        $this->render('index');
    }

    public function registrar()
    {
        $this->view->usuario = array(
            'nome' => '',
            'email' => '',
            'senha' => '',
        );
        $this->view->error = '';

        $this->render('registrar');
    }

    public function cadastrar()
    {
        $usuario = Container::getModel('Usuario');
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', $_POST['senha']);

        $valdiar_cadastro = $usuario->validarCadastro();
        $count_usuario_por_email = count($usuario->getUsuarioPorEmail());

        if ($valdiar_cadastro[0] && $count_usuario_por_email == 0) {
            $usuario->salvar();
            $this->render('cadastro');
        } else {
            if ($valdiar_cadastro[0]) {
                $this->view->error = 'Usuário já cadastrado';
            } else {
                $this->view->error = $valdiar_cadastro[1];
            }

            $this->view->usuario = array(
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => $_POST['senha'],
            );
            $this->render('registrar');
        }
    }
}
