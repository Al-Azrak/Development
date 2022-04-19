<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\FrontController;

class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_data = [];
    protected $_template;

    public function __construct()
    {
        //$_template = $temp;
    }

    public function notFoundAction()
    {
        echo 'Sorry this page is not Found 404';
    }

    public function setController($controllerName)
    {
        $this->_controller = $controllerName;
    }

    public function setAction($actionName)
    {
        $this->_action = $actionName;
    }

    public function setParams($params)
    {
        $this->_params = $params;
    }

    public function setTemplate($temp)
    {
        $this->_template = $temp;
    }
    protected function _view()
    {
        if($this->_action == FrontController::NOT_FOUND_ACTION){
            require_once VIEWS_PATH.'notFound'.DS.'notfound.view.php';
        } else {
            $view = VIEWS_PATH.$this->_controller.DS.$this->_action.'.view.php';
            //echo $view;
            if(file_exists($view)){
                /*
                require_once TEMPLATE_PATH.'templateHeaderStart.php';
                require_once TEMPLATE_PATH.'templateHeaderEnd.php';
                require_once TEMPLATE_PATH.'header.php';
                require_once TEMPLATE_PATH.'nav.php';
                require_once $view;
                require_once TEMPLATE_PATH.'footer.php';
                */
                $this->_template->setActionViewFile($view);
                extract($this->_data);
                $this->_template->renderApp();
            } else {
                require_once VIEWS_PATH.'notFound'.DS.'notfound.view.php';
            }
        }
    }
}