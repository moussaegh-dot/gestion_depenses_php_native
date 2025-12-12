<?php
namespace App\Core;

class Controller
{
    protected function view($path, $data = []) 
    {
        extract($data);
        require __DIR__ . '/../Views/' . $path . '.php';
    }
}