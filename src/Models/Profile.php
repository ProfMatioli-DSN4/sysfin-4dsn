<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Profile
{
    public ?int $id;
    public string $nome;

    private static $db;

    public function __construct(?int $id = null, string $nome = '')
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    private static function getDb()
    {
        if (!self::$db) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public static function findById(int $id): ?Profile
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM perfis WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Profile($data['id'], $data['nome']);
        }
        return null;
    }

    public static function findAll(): array
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM perfis ORDER BY id ASC");
        $perfisData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $perfis = [];
        foreach ($perfisData as $data) {
            $perfis[] = new Profile($data['id'], $data['nome']);
        }
        return $perfis;
    }

    public function save(): bool
    {
        $db = self::getDb();
        if ($this->id) {
            // Atualizar
            $stmt = $db->prepare("UPDATE perfis SET nome = :nome WHERE id = :id");
        } else {
            // Inserir
            $stmt = $db->prepare("INSERT INTO perfis (nome) VALUES (:nome)");
        }

        $stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
        if ($this->id) {
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        }

        $result = $stmt->execute();
        if (!$this->id) {
            $this->id = $db->lastInsertId();
        }
        return $result;
    }

    public function delete(): bool
    {
        if (!$this->id) {
            return false;
        }
        $db = self::getDb();

        // Antes de excluir o perfil, desvincular de todos os usuários
        $stmt = $db->prepare("DELETE FROM usuario_perfis WHERE id_perfil = :id_perfil");
        $stmt->bindValue(':id_perfil', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        // Agora excluir o perfil
        $stmt = $db->prepare("DELETE FROM perfis WHERE id = :id");
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
