<?php

class UsersController {
    public function defaultAction() {
        echo("Users default");
    }

    public function addAction() {
        $user = new Users();
        $form = $user->getRegisterForm();

        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }

    public function saveAction() {
        $user = new Users();
        $form = $user->getRegisterForm();

        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }

    public function loginAction() {
        $view = new View('loginUser', 'front');
    }

    public function forgetPasswordAction() {
        $view = new View('forgetPassword', 'front');
    }
}