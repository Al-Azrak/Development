<?php
namespace PHPMVC\LIB;

class FrontController
{
    private $_controller = 'index';
    private $_action = 'default';
    private $_params = array();
    //private $_template;
    const NOT_FOUND_ACTION = 'notFoundAction';
    const NOT_FOUND_Controller = 'PHPMVC\Controllers\NotFoundController';

    private function _parseUrl()
    {
        $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
        //var_dump($url);
        // check if not send controller => default controller is index also action and params
        if(isset($url[0]) && $url[0] != ''){
            $this->_controller = $url[0];
        }
        if(isset($url[1]) && $url[1] != ''){
            $this->_action = $url[1];
        }
        if(isset($url[2]) && $url[2] != ''){
            $this->_params = explode('/', $url[2]);
        }
    }
    
    public function __construct(Template $temp)
    {
        
        $this->_template = $temp;
        $this->_parseUrl();
        
    }
    // dispatch method to call the action
    public function dispatch(){
        $controllerClassName = 'PHPMVC\\Controllers\\'.ucfirst($this->_controller).'Controller';
        //echo $controllerClassName,'====';
        $actionName = $this->_action.'Action';
        if(!class_exists($controllerClassName)){
            $controllerClassName = self::NOT_FOUND_Controller;
        }
        //echo $controllerClassName;
        $controller = new $controllerClassName($this->_template);
        if(!method_exists($controller, $actionName)){
            $this->_action = $actionName = self::NOT_FOUND_ACTION;
        }

        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        //echo $actionName;
        $controller->$actionName();
        
    }
}