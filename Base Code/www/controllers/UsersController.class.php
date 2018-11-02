<?php

class UsersController {
    public function defaultAction() {
        echo 'users default';
    }

    public function addAction() {
        $view = new View('addUser', 'front');
    }
}