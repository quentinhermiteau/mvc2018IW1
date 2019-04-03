<?php

declare(strict_types=1);

namespace Core;

class View
{
    private $view;
    private $template;
    private $data = [];

    public function __construct($view, $template = 'back')
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view)
    {
        $viewPath = 'views/' . $view . '.view.php';
        
        if (file_exists($viewPath)) {
            $this->view = $viewPath;
        } else {
            throw new \Exception('The view file "' . $modalPath . '" doesn\'t exist');
        }
    }

    public function setTemplate($template)
    {
        $templatePath = 'views/templates/' . $template . '.template.php';
        
        if (file_exists($templatePath)) {
            $this->template = $templatePath;
        } else {
            throw new \Exception('The template file "' . $modalPath . '" doesn\'t exist');
        }
    }

    public function addModal($modal, $config, $data = null)
    {
        $modalPath = 'views/modals/' . $modal . '.mod.php';
        
        if (file_exists($modalPath)) {
            include $modalPath;
        } else {
            throw new \Exception('The modal file "' . $modalPath . '" doesn\'t exist');
        }
    }

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }
}
