<?php

class BaseSQL {

    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function save() {
        $tableName = get_called_class();

        $objectAttributes = get_object_vars($this);

        $class = get_class();
        $classAttributes = get_class_vars($class);

        $attributes = array_diff_key($objectAttributes, $classAttributes);

        $keys = [];
        $values = [];
        $stringKeys = '';
        $query = '';

        foreach($attributes as $key => $value) {
            if(is_null($value)) {
                continue;
            }

            $keys[] = $key;
            $values[':' . $key] = $value;
        }
        
        if(is_null($attributes['id'])) {
            $stringKeys = implode(',', $keys);

            $query = 'INSERT INTO ' . $tableName . '(' . $stringKeys . ') VALUES (';
            
            foreach($keys as $key) {
                $query .= ':' . $key . ', ';
            }
            
            $query = rtrim($query, ', ');
            $query .= ');';
        } else {
            $query = 'UPDATE ' . $tableName . ' SET ';

            foreach($keys as $key) {
                $query .= $key . ' = :' . $key . ', ';
            }
            $query = rtrim($query, ', ');
            $query .= ' WHERE id = :id;';
        }

        $statement = $this->pdo->prepare($query);
        $statement->execute($values);

        return $statement;
    }
}