<?php

class BaseSQL {

    private $pdo;
    private $table;

    public function __construct() {
        try {
            $this->pdo = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }

        $this->table = get_called_class();
    }

    public function save() {
        $dataObject = get_object_vars($this);
        $dataChild = array_diff_key($dataObject, get_class_vars(get_class()));

        if (is_null($dataChild['id'])) {
            $sql = 'INSERT INTO ' . $this->table . ' (' . implode(',', array_keys($dataChild)) . ') 
            VALUES (:' . implode(',:', array_keys($dataChild)) .  ');';
        } else {
            foreach($dataChild as $key => $value) {
                if ($key != 'id') {
                    $sqlUpdate[] = $key . '=:' . $key;
                }
            }
            
            $sql = 'UPDATE ' . $this->table . ' SET ' . implode(',', $sqlUpdate) . ' WHERE id=:id';
        }

        $query = $this->pdo->prepare($sql);
        $query->execute($dataChild);
    }
}