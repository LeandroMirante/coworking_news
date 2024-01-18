<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap
{
    protected function initRoutes()
    {

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['registrar'] = array(
            'route' => '/registrar',
            'controller' => 'indexController',
            'action' => 'registrar'
        );

        $routes['cadastrar'] = array(
            'route' => '/cadastrar',
            'controller' => 'indexController',
            'action' => 'cadastrar'
        );

        $routes['autenticar'] = array(
            'route' => '/autenticar',
            'controller' => 'AuthController',
            'action' => 'autenticar'
        );

        $routes['sair'] = array(
            'route' => '/sair',
            'controller' => 'AuthController',
            'action' => 'sair'
        );

        $routes['timeline'] = array(
            'route' => '/timeline',
            'controller' => 'AppController',
            'action' => 'timeline'
        );

        $routes['novo_post'] = array(
            'route' => '/novo_post',
            'controller' => 'AppController',
            'action' => 'novo_post'
        );

        $routes['postar'] = array(
            'route' => '/postar',
            'controller' => 'AppController',
            'action' => 'postar'
        );
        $routes['leia_mais'] = array(
            'route' => '/leia_mais',
            'controller' => 'AppController',
            'action' => 'leia_mais'
        );

        $routes['editar_post'] = array(
            'route' => '/editar_post',
            'controller' => 'AppController',
            'action' => 'editar_post'
        );

        $routes['editar'] = array(
            'route' => '/editar',
            'controller' => 'AppController',
            'action' => 'editar'
        );

        $routes['excluir_post'] = array(
            'route' => '/excluir_post',
            'controller' => 'AppController',
            'action' => 'excluir_post'
        );

        $routes['comentar'] = array(
            'route' => '/comentar',
            'controller' => 'AppController',
            'action' => 'comentar'
        );

        $this->setRoutes($routes);
    }
}
