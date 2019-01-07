<?php

class Users extends BaseSQL{
    public $id = null;
    public $firstname;
    public $lastname;
    public $email;
    public $pwd;
    public $role = 1;
    public $status = 0;

    public function __construct() {
        parent::__construct();
    }
    
    public function setFirstname($firstname) {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }
    
    public function setLastname($lastname) {
        $this->lastname = strtoupper(trim($lastname));
    }
    
    public function setEmail($email) {
        $this->email = strtolower(trim($email));
    }
    
    public function setPwd($pwd) {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }
    
    public function setRole($role) {
        $this->role = $role;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getRegisterForm() {
        return [
            'config' => [
                'method' => 'POST',
                'action' => Routing::getSlug('Users', 'save'),
                'class' => '',
                'id' => '',
                'submit' => 'S\'inscrire',
                'reset' => 'Annuler',
            ],
            'data' => [
                'firstname'  => [
                    'type' => 'text',
                    'placeholder' => 'Votre prénom',
                    'required' => true,
                    'class' => 'form-control',
                    'id' => 'firstname',
                ],
                'lastname'  => [
                    'type' => 'text',
                    'placeholder' => 'Votre nom',
                    'required' => true,
                    'class' => 'form-control',
                    'id' => 'lastname',
                ],
                'email'     => [
                    'type' => 'email',
                    'placeholder' => 'Votre email',
                    'required' => true, 'class' =>
                    'form-control',
                    'id' => 'email',
                ],
                'pwd'       => [
                    'type' => 'password',
                    'placeholder' => 'Votre mot de passe',
                    'required' => true,
                    'class' => 'form-control',
                    'id' => 'pwd',
                ],
                'pwdConfirm' => [
                    'type' => 'password',
                    'placeholder' => 'Confirmation',
                    'required' => true,
                    'class' => 'form-control',
                    'id' => 'pwdConfirm',
                ],
            ]
        ];
    }
}