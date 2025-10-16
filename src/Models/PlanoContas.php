<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class PlanoContas
{
    public $id;
    public $descricao;
    public $tipo; 
    
    
    public static function getAllOrdered()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM plano_contas ORDER BY tipo, descricao');
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    
    
    public static function getById($id) 
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM plano_contas WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(self::class);
    }

    
    public static function canDelete($id) 
    {
        
        return true; 
    }

    
    public function save()
    {
        
        $pdo = Database::getConnection();
        if ($this->id) {
            
            $stmt = $pdo->prepare(
                'UPDATE plano_contas SET descricao = :descricao, tipo = :tipo WHERE id = :id'
            );
            $stmt->execute([
                'id' => $this->id,
                'descricao' => $this->descricao,
                'tipo' => $this->tipo
            ]);
        } else {
            
            $stmt = $pdo->prepare(
                'INSERT INTO plano_contas (descricao, tipo) VALUES (:descricao, :tipo)'
            );
            $stmt->execute([
                'descricao' => $this->descricao,
                'tipo' => $this->tipo
            ]);
            $this->id = $pdo->lastInsertId();
        }
        return $stmt->rowCount() > 0;
    }

    
    public static function delete($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM plano_contas WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}