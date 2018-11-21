<?php

class PagesController {
    public function defaultAction() {
        $view = new View('homepage', 'back');
    }
}