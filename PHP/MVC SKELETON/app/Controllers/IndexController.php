<?php
namespace PHPMVC\Controllers;

class IndexController extends AbstractController
{
    public function defaultAction()
    {
        echo 'Hello from MVC Action';
        $this->_view();
    }
}