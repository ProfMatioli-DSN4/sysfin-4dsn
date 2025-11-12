<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class Fornecedor
{
    public $id;
    public $nome;
    public $cnpj;
    public $email;
    public $telefone;

    public static function getAll($busca = null)
    {
        $pdo = Database::getConnection();
        if ($busca) {
            $stmt = $pdo->prepare('SELECT * FROM fornecedores WHERE nome LIKE :busca ORDER BY id DESC');
            $stmt->execute(['busca' => "%$busca%"]);
        } else {
            $stmt = $pdo->query('SELECT * FROM fornecedores ORDER BY id DESC');
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM fornecedores WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $pdo = Database::getConnection();
        if (!empty($this->id)) {
            $stmt = $pdo->prepare('UPDATE fornecedores SET nome=:nome, cnpj=:cnpj, email=:email, telefone=:telefone WHERE id=:id');
            $stmt->execute([
                'nome' => $this->nome,
                'cnpj' => $this->cnpj,
                'email' => $this->email,
                'telefone' => $this->telefone,
                'id' => $this->id
            ]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO fornecedores (nome, cnpj, email, telefone) VALUES (:nome, :cnpj, :email, :telefone)');
            $stmt->execute([
                'nome' => $this->nome,
                'cnpj' => $this->cnpj,
                'email' => $this->email,
                'telefone' => $this->telefone
            ]);
            $this->id = $pdo->lastInsertId();
        }
        return $stmt->rowCount() > 0;
    }

    public static function delete($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM fornecedores WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public static function validCnpjExists($cnpjFornecedor) {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM fornecedores WHERE cnpj = :cnpj");
        $stmt->execute(['cnpj' => $cnpjFornecedor]);
        return $stmt->fetchColumn();
    }
}
