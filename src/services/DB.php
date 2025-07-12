<?php

namespace App\services;

Use PDO;
use PDOException;

class DB{
    public static function conectar() {
        try{
            $pdo = new PDO('sqlite:db.slite');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch (PDOException $e){
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    }
}

?>