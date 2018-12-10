<?php

class UsersController {
    public function defaultAction() {
        echo("Users default");
    }

    public function addAction() {
        $user = new Users();
        $user->setFirstname("quentin");
		$user->setLastname("hermiteau");
		$user->setEmail("quentinhermiteau@gmail.com");
		$user->setPwd("Test1234");
		$user->save();
        // $view = new View('addUser', 'front');
    }

    public function loginAction() {
        $view = new View('loginUser', 'front');
    }

    public function forgetPasswordAction() {
        $view = new View('forgetPassword', 'front');
    }
}