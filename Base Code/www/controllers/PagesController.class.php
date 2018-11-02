<?php

class PagesController {
    public function defaultAction() {
        $view = new View('home', 'front');
        $view->assign('pseudo', 'prof');
    }
}