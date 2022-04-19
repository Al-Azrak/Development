<?php
namespace PHPMVC\LIB;

class Template
{
    private $_templateParts;
    private $_action_view;
    private $_data;

    public function __construct(array $parts)
    {
        $this->_templateParts = $parts;
    }

    public function setActionViewFile($actinViewPath)
    {
        $this->_action_view = $actinViewPath;
    }

    public function setAppData($data)
    {
        $this->_data = $data;
    }

    private function renderTemplateHeaderStart()
    {
        require_once TEMPLATE_PATH.'templateHeaderStart.php';
    }

    private function renderTemplateHeaderEnd()
    {
        require_once TEMPLATE_PATH.'templateHeaderEnd.php';
    }

    private function renderTemplateFooter()
    {
        require_once TEMPLATE_PATH.'footer.php';
    }

    private function renderTemplateBlocks()
    {
        if(!array_key_exists('template', $this->_templateParts)){
            trigger_error('Sorry you have to define the template blocks'.E_USER_WARNNING);
        } else {
            $parts = $this->_templateParts['template'];
            if(!empty($parts)){
                extract($this->_data);
                foreach($parts as $partKey => $file){
                    if($file === ':action_view'){ // 
                        require_once $this->_action_view;
                    } else {
                        echo $file;
                        require_once $file;
                    }

                }
            }
        }
    }

    private function renderHeaderResources()
    {
        $output = '';
        if(!array_key_exists('header_resources',$this->_templateParts)){
            trigger_error('Sorry you have to define the header resources'.E_USER_WARNNING);
        } else {
            $resources = $this->_templateParts['header_resources'];
            // Generate CSS Links
            $css = $resources['css'];
            if(!empty($css)){
                foreach($css as $cssKey => $path){
                    $output .= '<link rel="stylesheet" href="'.$path.'" />';
                }

            }

            // Generate JS Links
            $js = $resources['js'];
            if(!empty($js)){
                foreach($js as $jsKey => $path){
                    $output .= '<script src="'.$path.'"></script>' ;

                }
            }
            
        }
        echo $output;
    }

    private function renderFooterResources()
    {
        $output="";
        if(!array_key_exists('footer_resources', $this->_templateParts)){
            trigger_error('Sorry you have to define the header resources'.E_USER_WARNNING);
        } else {
            $resources = $this->_templateParts['footer_resources'];

            // Generate Js Scripts
            if(!empty($resources)){
                foreach($resources as $resourceKey => $path){
                    $output .= '<script src="'.$path.'"></script>';
                }
            }
        }
        echo $output;
    }

    public function renderApp()
    {
        //var_dump($this->_data);
        $this->_data = ['1', '2'];
        extract($this->_data);
        $this->renderTemplateHeaderStart();
        $this->renderHeaderResources();
        $this->renderTemplateHeaderEnd();
        $this->renderTemplateBlocks();
        $this->renderFooterResources();
        $this->renderTemplateFooter();


    }
}