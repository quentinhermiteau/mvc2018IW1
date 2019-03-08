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

        $method = strtoupper($form['config']['method']);
        $data = $GLOBALS['_' . $method];

        if ($_SERVER['REQUEST_METHOD'] === $method && !empty($data)) {
            $validator = new Validator($form, $data);

            if (empty($validator->errors)) {
                $user->setFirstname($data['firstname']);
                $user->setLastname($data['lastname']);
                $user->setEmail($data['email']);
                $user->setPwd($data['pwd']);
                $user->save();
            } else {

            }
        }

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