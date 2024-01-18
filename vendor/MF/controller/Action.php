<?php

namespace MF\Controller;

class Action
{
    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass();
    }

    protected function render($view, $layout = 'layout1')
    {
        $this->view->page = $view;
        require_once '../App/Views/' . $layout . '.phtml';
    }

    protected function content()
    {
        $class = get_class($this);
        $class = str_replace("App\\Controllers\\", "", $class);
        $class = str_replace("Controller", "", $class);
        $class = strtolower($class);

        require_once "../App/Views/" . $class . "/" . $this->view->page . ".phtml";
    }
}
