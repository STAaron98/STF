<?php

class Controller {
    
    private $context = array();

    public function __construct() {
    }
    
    public function run($action) {
        $this->$action(); // Logik
        $this->generatePage($action); // Sicht
    }
    
    private function home() {

    }
    
    private function aboutUs() {
        
    }
    
    private function addContext($key, $value) {
        $this->context [$key] = $value;
    }
    
    private function generatePage($template) {
        extract($this->context);
        if (file_exists('view/' . $template . '.tpl.php'))
            require_once 'view/' . $template . '.tpl.php';  
        else
            header("Location: index.php");
    }
}
