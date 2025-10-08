<?php

namespace App\Models;

use App\Core\Database;

class Profile
{
    public ?int $id;
    public ?string $name;

    public static function getAll()
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query('SELECT * FROM profiles');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM profiles WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('INSERT INTO profiles (name) VALUES (:name)');
        return $stmt->execute(['name' => $data['name']]);
    }

    public static function update($id, $data)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('UPDATE profiles SET name = :name WHERE id = :id');
        return $stmt->execute(['name' => $data['name'], 'id' => $id]);
    }

    public static function delete($id)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('DELETE FROM profiles WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
