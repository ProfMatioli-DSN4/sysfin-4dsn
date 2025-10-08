<?php

namespace App\Models;

use App\Core\Database;

class User
{
    public ?int $id;
    public ?string $name;
    public ?string $login;
    public ?string $password;
    public array $profiles = [];

    public static function getAll()
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query('SELECT users.*, GROUP_CONCAT(profiles.name) as profiles
                                 FROM users
                                 LEFT JOIN user_profiles ON users.id = user_profiles.user_id
                                 LEFT JOIN profiles ON user_profiles.profile_id = profiles.id
                                 GROUP BY users.id');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user) {
            $stmt = $conn->prepare('SELECT profile_id FROM user_profiles WHERE user_id = :id');
            $stmt->execute(['id' => $id]);
            $user['profiles'] = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        }

        return $user;
    }

    public static function create($data)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('INSERT INTO users (name, login, password) VALUES (:name, :login, :password)');
        $stmt->execute([
            'name' => $data['name'],
            'login' => $data['login'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
        $userId = $conn->lastInsertId();

        if (!empty($data['profiles'])) {
            $stmt = $conn->prepare('INSERT INTO user_profiles (user_id, profile_id) VALUES (:user_id, :profile_id)');
            foreach ($data['profiles'] as $profileId) {
                $stmt->execute(['user_id' => $userId, 'profile_id' => $profileId]);
            }
        }

        return $userId;
    }

    public static function update($id, $data)
    {
        $db = new Database();
        $conn = $db->getConnection();

        if (!empty($data['password'])) {
            $stmt = $conn->prepare('UPDATE users SET name = :name, login = :login, password = :password WHERE id = :id');
            $stmt->execute([
                'name' => $data['name'],
                'login' => $data['login'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'id' => $id
            ]);
        } else {
            $stmt = $conn->prepare('UPDATE users SET name = :name, login = :login WHERE id = :id');
            $stmt->execute([
                'name' => $data['name'],
                'login' => $data['login'],
                'id' => $id
            ]);
        }

        $stmt = $conn->prepare('DELETE FROM user_profiles WHERE user_id = :id');
        $stmt->execute(['id' => $id]);

        if (!empty($data['profiles'])) {
            $stmt = $conn->prepare('INSERT INTO user_profiles (user_id, profile_id) VALUES (:user_id, :profile_id)');
            foreach ($data['profiles'] as $profileId) {
                $stmt->execute(['user_id' => $id, 'profile_id' => $profileId]);
            }
        }

        return true;
    }

    public static function delete($id)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
