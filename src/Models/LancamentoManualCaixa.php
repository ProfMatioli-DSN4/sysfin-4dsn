<?php

namespace App\Models;
use App\Core\Database;
use PDO;

class LancamentoManualCaixa{
    public $id;
    public $data_movimento; 
    public $descricao;
    public $valor;
    public $tipo;
    public $id_plano_contas; 

    private $conexao;

    public function save() 
    {
        $pdo = Database::getConnection();

        $sql = "INSERT INTO movimento_caixa (data_movimento, descricao, valor, tipo, id_plano_contas)
        VALUES (:data_movimento, :descricao, :valor, :tipo, :id_plano_contas)";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            'data_movimento' => $this->data_movimento,
            'descricao' => $this->descricao,
            'valor' => $this->valor,
            'tipo' => $this->tipo,
            'id_plano_contas' => $this->id_plano_contas
        ]);
                
        $this->id = $pdo->lastInsertId();
    }
}
