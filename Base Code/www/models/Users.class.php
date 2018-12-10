<?php

class Users extends BaseSQL{
    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;
    protected $role = 1;
    protected $status = 0;

    public function __construct() {
        parent::__construct();
    }

    public function setId($id = null) {
        $this->id = $id;
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

    public function save() {
        parent::save();
    }
}