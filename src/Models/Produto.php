<?php

namespace App\Models;
use App\Core\Database;
use PDO;



class Produto {

    public $id;
    
    public $nome;
    
    public $descricao;
    
    public $preco_venda;
    
    public $estoque_atual;
    public $estoque_minimo;
    
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
            
            $stmt = $pdo->prepare(
                'UPDATE produtos SET nome = :nome, descricao = :descricao, 
                preco_venda = :preco_venda, estoque_atual = :estoque_atual, estoque_minimo = :estoque_minimo WHERE id = :id'
            );
            $stmt->execute([
                'id' => $this->id,
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'preco_venda' => $this->preco_venda,
                'estoque_atual' => $this->estoque_atual,
                'estoque_minimo' => $this->estoque_minimo
            ]);
        } else {
            
            $stmt = $pdo->prepare(
                'INSERT INTO produtos (nome, descricao, preco_venda, estoque_atual, estoque_minimo) 
VALUES (:nome, :descricao, :preco_venda, :estoque_atual, :estoque_minimo)'
            );
            $stmt->execute([
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'preco_venda' => $this->preco_venda,
                'estoque_atual' => $this->estoque_atual,
                'estoque_minimo' => $this->estoque_minimo
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

    /**
     * Tarefa 12: (estoque_atual <= estoque_minimo)
     * @return int
     */
    public function countEstoqueBaixo(): int
    {
        
        $pdo = Database::getConnection(); 
        
        
        
        
        $sql = "SELECT COUNT(id) AS total_baixo
                FROM produtos 
                WHERE estoque_atual <= estoque_minimo";
        
        $stmt = $pdo->query($sql);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        
        return (int) ($resultado['total_baixo'] ?? 0);
    }
}