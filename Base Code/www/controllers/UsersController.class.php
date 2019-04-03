<?php

declare(strict_types=1);

namespace Controllers;

use Models\View;
use Core\Validator;

class UsersController
{
    public function defaultAction(): void
    {
        echo("Users default");
    }

    public function addAction(): void
    {
        $user = new Users();
        $form = $user->getRegisterForm();

        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }

    public function saveAction(): void
    {
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

    public function loginAction(): void
    {
        $view = new View('loginUser', 'front');
    }

    public function forgetPasswordAction(): void
    {
        $view = new View('forgetPassword', 'front');
    }
}
