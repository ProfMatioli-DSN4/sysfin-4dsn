<?php
class FornecedoresModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar($busca = '') {
        if ($busca) {
            $stmt = $this->pdo->prepare("SELECT * FROM fornecedores WHERE nome LIKE ?");
            $stmt->execute(["%$busca%"]);
        } else {
            $stmt = $this->pdo->query("SELECT * FROM fornecedores ORDER BY id DESC");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($id, $nome, $cnpj, $email, $telefone) {
        if ($id) {
            $stmt = $this->pdo->prepare("UPDATE fornecedores SET nome=?, cnpj=?, email=?, telefone=? WHERE id=?");
            return $stmt->execute([$nome, $cnpj, $email, $telefone, $id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO fornecedores (nome, cnpj, email, telefone) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$nome, $cnpj, $email, $telefone]);
        }
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM fornecedores WHERE id=?");
        return $stmt->execute([$id]);
    }
}
