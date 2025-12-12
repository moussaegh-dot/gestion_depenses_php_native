<?php
namespace App\Core;

use PDO;

use PDOException;

class Database 
{
    private static $instance = null;

    public static function getConnection()
    {
        if(self::$instance === null) 
        {
            try {
                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=gestion_des_depenses;charset=utf8", "root", ""
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                    die("Erreur de connexion : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}