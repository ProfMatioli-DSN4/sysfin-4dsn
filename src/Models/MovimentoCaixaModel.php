<?php

class MovimentoCaixaModel {
    // Propriedades que espelham as colunas da tabela
    public $id;
    public $data_lancamento;
    public $descricao;
    public $valor;
    public $tipo;
    public $id_plano_contas;

    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    /**
     * Salva o lançamento atual no banco de dados.
     * Retorna true em caso de sucesso, false em caso de falha.
     */
    public function salvar() {
        $sql = "INSERT INTO movimento_caixa (data_lancamento, descricao, valor, tipo, id_plano_contas)
                VALUES (:data, :descricao, :valor, :tipo, :id_plano_contas)";

        $stmt = $this->conexao->prepare($sql);

        // Limpeza dos dados (sanitization)
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));

        // Vinculação dos parâmetros (binding)
        $stmt->bindParam(':data', $this->data_lancamento);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':id_plano_contas', $this->id_plano_contas);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

?>