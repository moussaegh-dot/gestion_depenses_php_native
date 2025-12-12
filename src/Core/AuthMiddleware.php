<?php
namespace App\Core;

class AuthMiddleware 
{
    public static function requireAuth() 
    {
        session_start();
        if(!Auth::check())
        {
            header("Location: /login");
            exit;
        }
    }
}