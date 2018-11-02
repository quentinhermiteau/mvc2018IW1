<?php

class UsersController {
    public function defaultAction() {
        echo("Users default");
    }

    public function addAction() {
        $view = new View('addUser', 'front');
    }

    public function loginAction() {
        $view = new View('loginUser', 'front');
    }

    public function forgetPasswordAction() {
        $view = new View('forgetPassword', 'front');
    }
}