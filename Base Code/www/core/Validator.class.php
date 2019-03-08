<?php

class Validator
{
    public $errors = [];

    public function __construct($config, $data)
    {
        if (count($config['data']) != count($data)) {
            throw new \Exception('Erreur: tentative faille XSS.');
        }

        foreach ($config['data'] as $name => $info) {
            if (!isset($data[$name])) {
                throw new \Exception('Erreur: tentative faille XSS.');
            } else {
                if (($info['required'] ?? false) && !self::notEmpty($data[$name])) {
                    $this->errors[] = $info['error'];
                }

                if (isset($info['minlength']) && !self::minLength($data[$name], $info['minlength'])) {
                    $this->errors[] = $info['error'];
                }

                if (isset($info['maxlength']) && !self::maxLength($data[$name], $info['maxlength'])) {
                    $this->errors[] = $info['error'];
                }

                if ($info['type'] === 'email' && !self::checkEmail($data[$name])) {
                    $this->errors[] = $info['error'];
                }
                
                if (isset($info['confirm']) && $data[$name] != $data[$info['confirm']]) {
                    $this->errors[] = $info['error'];
                } else if ($info['type'] === 'password' && !self::checkPassword($data[$name])) {
                    $this->errors[] = $info['error'];
                }

                
            }
        }
    }

    private static function notEmpty($string)
    {
        return !empty(trim($string));
    }

    private static function minLength($string, $length)
    {
        return strlen(trim($string)) >= $length;
    }
    
    private static function maxLength($string, $length)
    {
        return strlen(trim($string)) <= $length;
    }

    private static function checkEmail($string)
    {
        return filter_var(trim($string), FILTER_VALIDATE_EMAIL);
    }

    private static function checkPassword($string)
    {
        return (preg_match("#[a-z]#", $string) && preg_match("#[A-Z]#", $string) && preg_match("#[0-9]#", $string));
    }
}