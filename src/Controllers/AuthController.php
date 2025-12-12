<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Auth;

class AuthController extends Controller {

    public function login() 
    {
        $this->view('auth/auth_page',[
            'active' => 'login'
        ]);
    }

    public function authenticate()
    {
        session_start();

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $user = User::findByEmail($email);

        if(!$user || !password_verify($password, $user['password']))
        {
            $this->view('auth/auth_page', [
                'error' => 'Email ou mots de passe incorrect.'
            ]);
            return;
        }

        Auth::login($user);

        header("Location: /");
        exit;
    }

    public function register() 
    {
        $this->view('auth/auth_page', [
            'active' => 'register'
        ]);
    }

    public function store() 
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(empty($name) || empty($email) || empty($password))
        {
            $this->view('auth/auth_page', [
                'error' => 'Tous les champs sont obligatoire.'
            ]);
            return;
        }

        //Vérifier si email existe déjà
        if(User::findByEmail($email)){
            $this->view('auth/auth_page', [
                'error' => 'cet email existe déjà.'
            ]);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //Création utilisateur
        User::create($name, $email, $hashedPassword);

        header("Location: /login");
        exit;
    }

    public function logout()
    {
        session_start();
        Auth::logout();
        header("Location: /auth_page");
        exit;
    }
}