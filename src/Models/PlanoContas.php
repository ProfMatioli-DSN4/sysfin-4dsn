<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use PDOException;

/**
 * Classe PlanoContas
 * Gerencia as operações CRUD para a tabela 'plano_contas'.
 */
class PlanoContas
{
    public $id;
    public $descricao;
    public $tipo; // 'Receita' ou 'Despesa'
    
    /**
     * Tenta criar a tabela 'plano_contas' se ela não existir.
     */
    private static function setupTable()
    {
        $pdo = Database::getConnection();
        $sql = "
            CREATE TABLE IF NOT EXISTS plano_contas (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                descricao VARCHAR(255) NOT NULL,
                tipo ENUM('Receita', 'Despesa') NOT NULL DEFAULT 'Despesa',
                UNIQUE KEY uk_descricao (descricao)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        try {
            $pdo->exec($sql);
        } catch (PDOException $e) {
            // Em ambiente de produção, seria melhor registrar o erro, mas aqui ignoramos para evitar interrupções
            // se o comando exec falhar por outros motivos após a verificação IF NOT EXISTS.
        }
    }

    /**
     * Retorna todas as contas ordenadas.
     * @return array
     */
    public static function getAllOrdered()
    {
        // Garante que a tabela exista antes de tentar consultá-la
        self::setupTable(); 
        
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM plano_contas ORDER BY tipo, descricao');
        // PDO::FETCH_CLASS garante que cada linha seja retornada como um objeto PlanoContas
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Busca uma conta pelo ID.
     * @param int $id
     * @return PlanoContas|false
     */
    public static function getById($id) 
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM plano_contas WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(self::class);
    }

    /**
     * Verifica se a conta pode ser deletada.
     * @param int $id
     * @return bool
     */
    public static function canDelete($id) 
    {
        // Lógica de verificação de integridade seria adicionada aqui
        return true; 
    }

    /**
     * Salva ou atualiza a conta no banco de dados.
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getConnection();
        if ($this->id) {
            // UPDATE
            $stmt = $pdo->prepare(
                'UPDATE plano_contas SET descricao = :descricao, tipo = :tipo WHERE id = :id'
            );
            $stmt->execute([
                'id' => $this->id,
                'descricao' => $this->descricao,
                'tipo' => $this->tipo
            ]);
        } else {
            // INSERT
            $stmt = $pdo->prepare(
                'INSERT INTO plano_contas (descricao, tipo) VALUES (:descricao, :tipo)'
            );
            $stmt->execute([
                'descricao' => $this->descricao,
                'tipo' => $this->tipo
            ]);
            $this->id = $pdo->lastInsertId();
        }
        return $stmt->rowCount() > 0 || $this->id > 0; // Retorna true se houver sucesso
    }

    /**
     * Deleta a conta pelo ID.
     * @param int $id
     * @return bool
     */
    public static function delete($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM plano_contas WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
