<?php

declare(strict_types=1);

namespace Core;

class Validator
{
    public $errors = [];

    public function __construct(array $config, array $data)
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
                } elseif ($info['type'] === 'password' && !self::checkPassword($data[$name])) {
                    $this->errors[] = $info['error'];
                }
            }
        }
    }

    private static function notEmpty(string $string): bool
    {
        return !empty(trim($string));
    }

    private static function minLength(string $string, int $length): bool
    {
        return strlen(trim($string)) >= $length;
    }
    
    private static function maxLength(string $string, int $length): bool
    {
        return strlen(trim($string)) <= $length;
    }

    private static function checkEmail(string $email): bool
    {
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }

    private static function checkPassword(string $password): bool
    {
        return (preg_match("#[a-z]#", $password) && preg_match("#[A-Z]#", $password) && preg_match("#[0-9]#", $password));
    }
}
