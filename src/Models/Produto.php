<?php

namespace App\Models;
use App\Core\Database;
use PDO;

// Nome, Descrição, Preço de Venda e Estoque Inicial

class Produto {
    
    public $nome;
    
    public $descricao;
    
    public $precoVenda;
    
    public $estoque;
    
    public static function getAll(){
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM produtos');
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    
    public static function getById($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(self::class);
    }
    public function save()
    {
        $pdo = Database::getConnection();
        if ($this->id) {
            // Atualizar 
            $stmt = $pdo->prepare(
                'UPDATE produtos SET nome = :nome, descricao = :descricao, 
                precoVenda = :precoVenda, estoque = :estoque WHERE id = :id'
            );
            $stmt->execute([
                'id' => $this->id,
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'precoVenda' => $this->precoVenda,
                'estoque' => $this->estoque
            ]);
        } else {
            // Inserir 
            $stmt = $pdo->prepare(
                'INSERT INTO produtos (nome, descricao, precoVenda, estoque) 
VALUES (:nome, :descricao, :precoVenda, :estoque)'
            );
            $stmt->execute([
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'precoVenda' => $this->precoVenda,
                'estoque' => $this->estoque
            ]);
            $this->id = $pdo->lastInsertId();
        }
        return $stmt->rowCount() > 0;
    }
    public static function delete($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}