<?php

class View {
    private $view;
    private $template;
    private $data = [];

    public function __construct($view, $template = 'back') {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view) {
        $viewPath = 'views/' . $view . '.view.php';
        
        if(file_exists($viewPath)) {
            $this->view = $viewPath;
        } else {
            die('The view file "' . $viewPath . '" doesn\'t exist');
        }
    }

    public function setTemplate($template) {
        $templatePath = 'views/templates/' . $template . '.template.php';
        
        if(file_exists($templatePath)) {
            $this->template = $templatePath;
        } else {
            die('The template file "' . $templatePath . '" doesn\'t exist');
        }
    }

    public function assign($key, $value) {
        $this->data[$key] = $value;
    }

    public function __destruct() {
        extract($this->data);
        include $this->template;
    }
}