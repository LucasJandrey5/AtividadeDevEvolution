<?php

namespace App\controllers;

use App\services\DB;

use PDOException;

class CriarTabelas {
    public static function usuarios(): void {
        $pdo = DB::conectar();

        $sql = "
            CREATE TABLE IF NOT EXISTS usuarios (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                senha TEXT NOT NULL,
                criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ";

        try {
            $pdo->exec($sql);
            echo "Tabela 'usuarios' criada com sucesso!\n";
        } catch (PDOException $e) {
            echo "Erro ao criar tabela: " . $e->getMessage() . "\n";
        }
    }

    public static function tarefas(): void {
        $pdo = DB::conectar();

        $sql = "
            CREATE TABLE IF NOT EXISTS tarefas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                titulo TEXT NOT NULL,
                descricao TEXT NOT NULL,
                prioridade INTEGER NOT NULL,
                criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
                
                FOREIGN KEY (user_id) REFERENCES usuarios(id)
            )
        ";
        
        try {
            $pdo->exec($sql);
            echo "Tabela 'produtos' criada com sucesso!\n";
        } catch (PDOException $e) {
            echo "Erro ao criar tabela: " . $e->getMessage() . "\n";
        }
    }

    public static function reset(): void {
        $pdo = DB::conectar();
        $sql = "
            DROP TABLE IF EXISTS tarefas;
            DROP TABLE IF EXISTS usuarios;
        ";
          $pdo->exec($sql);
        echo "Tabelas deletadas com sucesso!\n";
    }
}