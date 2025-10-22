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
    public ?string $senha_hash;
    public bool $ativo;
    private array $profiles = [];

    private static $db;

    public function __construct(?int $id = null, string $nome = '', string $login = '', ?string $senha = null, bool $ativo = true, ?string $senha_hash = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->ativo = $ativo;
        $this->senha_hash = $senha_hash;
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
            $user = new User($data['id'], $data['nome'], $data['login'], null, (bool)$data['ativo'], $data['senha_hash']);
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
            $user = new User($data['id'], $data['nome'], $data['login'], null, (bool)$data['ativo'], $data['senha_hash']);
            $user->loadProfiles();
            $users[] = $user;
        }
        return $users;
    }

    public function save(array $profileIds = [])
    {
        $db = new Database();
        $conn = $db->getConnection();

        $mainProfileId = !empty($profileIds) ? $profileIds[0] : null;
        if ($mainProfileId === null && $this->id === null) {
            $firstProfile = Profile::findAll(1);
            if(!empty($firstProfile)){
                $mainProfileId = $firstProfile[0]->id;
            } else {
                throw new \Exception("Nenhum perfil encontrado para associar ao usuário.");
            }
        }


        if ($this->id) {
            $ativoInt = (int)$this->ativo;
            $sql = "UPDATE usuarios SET nome = ?, login = ?, senha_hash = ?, ativo = ? WHERE id = ?";
            $params = [$this->nome, $this->login, $this->senha_hash, $ativoInt, $this->id];

            if ($mainProfileId !== null) {
                $sql = "UPDATE usuarios SET nome = ?, login = ?, senha_hash = ?, ativo = ?, id_perfil = ? WHERE id = ?";
                $params = [$this->nome, $this->login, $this->senha_hash, $ativoInt, $mainProfileId, $this->id];
            }

            $stmt = $conn->prepare($sql);
            $stmt->execute($params);

        } else {
            $ativoInt = (int)$this->ativo;
            $sql = "INSERT INTO usuarios (nome, login, senha_hash, ativo, id_perfil) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->login, $this->senha_hash, $ativoInt, $mainProfileId]);
            $this->id = $conn->lastInsertId();
        }

        if ($this->id) {
            $stmt = $conn->prepare("DELETE FROM usuario_perfis WHERE id_usuario = ?");
            $stmt->execute([$this->id]);

            if (!empty($profileIds)) {
                $stmt = $conn->prepare("INSERT INTO usuario_perfis (id_usuario, id_perfil) VALUES (?, ?)");
                foreach ($profileIds as $profileId) {
                    $stmt->execute([$this->id, $profileId]);
                }
            }
        }

        return $this;
    }

    public function delete(): bool
    {
        if (!$this->id) {
            return false;
        }
        $db = self::getDb();

        $stmt = $db->prepare("DELETE FROM usuario_perfis WHERE id_usuario = :id_usuario");
        $stmt->bindValue(':id_usuario', $this->id, PDO::PARAM_INT);
        $stmt->execute();

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
        $stmt = $db->prepare("DELETE FROM usuario_perfis WHERE id_usuario = :id_usuario");
        $stmt->bindValue(':id_usuario', $this->id, PDO::PARAM_INT);
        $stmt->execute();

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
