<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    public ?int $id;
    public string $nome;
    public string $login;
    public ?string $senha;
    public bool $ativo;
    private array $profiles = [];

    private static $db;

    public function __construct(?int $id = null, string $nome = '', string $login = '', ?string $senha = null, bool $ativo = true)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->ativo = $ativo;
    }

    private static function getDb()
    {
        if (!self::$db) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public static function findById(int $id): ?User
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new User($data['id'], $data['nome'], $data['login'], null, $data['ativo']);
            $user->loadProfiles();
            return $user;
        }
        return null;
    }

    public static function findAll(): array
    {
        $db = self::getDb();
        $stmt = $db->query("SELECT * FROM usuarios");
        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($usersData as $data) {
            $user = new User($data['id'], $data['nome'], $data['login'], null, $data['ativo']);
            $user->loadProfiles();
            $users[] = $user;
        }
        return $users;
    }

    public function save(): bool
    {
        $db = self::getDb();
        if ($this->id) {
            // Atualizar
            $sql = "UPDATE usuarios SET nome = :nome, login = :login, ativo = :ativo";
            if ($this->senha) {
                $sql .= ", senha_hash = :senha_hash";
            }
            $sql .= " WHERE id = :id";
            $stmt = $db->prepare($sql);
        } else {
            // Inserir
            $stmt = $db->prepare("INSERT INTO usuarios (nome, login, senha_hash, ativo) VALUES (:nome, :login, :senha_hash, :ativo)");
        }

        $stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindValue(':login', $this->login, PDO::PARAM_STR);
        $stmt->bindValue(':ativo', $this->ativo, PDO::PARAM_BOOL);

        if ($this->senha) {
            $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
            $stmt->bindValue(':senha_hash', $senha_hash, PDO::PARAM_STR);
        }

        if ($this->id) {
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        }

        $result = $stmt->execute();
        if (!$this->id) {
            $this->id = $db->lastInsertId();
        }

        if ($result) {
            $this->syncProfiles();
        }

        return $result;
    }

    public function delete(): bool
    {
        if (!$this->id) {
            return false;
        }
        $db = self::getDb();

        // Desvincular perfis
        $stmt = $db->prepare("DELETE FROM usuario_perfis WHERE id_usuario = :id_usuario");
        $stmt->bindValue(':id_usuario', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        // Excluir usuário
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function loadProfiles(): void
    {
        if (!$this->id) return;

        $db = self::getDb();
        $stmt = $db->prepare("
            SELECT p.* FROM perfis p
            INNER JOIN usuario_perfis up ON p.id = up.id_perfil
            WHERE up.id_usuario = :id_usuario
        ");
        $stmt->bindValue(':id_usuario', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $profilesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->profiles = [];
        foreach ($profilesData as $data) {
            $this->profiles[] = new Profile($data['id'], $data['nome']);
        }
    }

    public function getProfiles(): array
    {
        return $this->profiles;
    }

    public function setProfiles(array $profileIds): void
    {
        $this->profiles = $profileIds; // Temporariamente armazena os IDs
    }

    private function syncProfiles(): void
    {
        if (!$this->id) return;

        $db = self::getDb();
        // Remover perfis antigos
        $stmt = $db->prepare("DELETE FROM usuario_perfis WHERE id_usuario = :id_usuario");
        $stmt->bindValue(':id_usuario', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        // Adicionar novos perfis
        if (!empty($this->profiles)) {
            $stmt = $db->prepare("INSERT INTO usuario_perfis (id_usuario, id_perfil) VALUES (:id_usuario, :id_perfil)");
            foreach ($this->profiles as $profileId) {
                $stmt->bindValue(':id_usuario', $this->id, PDO::PARAM_INT);
                $stmt->bindValue(':id_perfil', $profileId, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }

    public function hasProfile(int $profileId): bool
    {
        foreach ($this->profiles as $profile) {
            if ($profile->id === $profileId) {
                return true;
            }
        }
        return false;
    }
}
