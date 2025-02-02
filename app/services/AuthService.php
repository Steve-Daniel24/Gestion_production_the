<?php

namespace app\services;
use app\models\User;

use Flight;
class AuthService
{
    public static function login($username, $password)
    {
        $user = User::findByUsername($username);
        if ($user && $password == $user['password_hash']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = User::findRoleById($_SESSION['user_id']);  
            return true;
        }
        return false;
    }
    
    public static function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }
}
