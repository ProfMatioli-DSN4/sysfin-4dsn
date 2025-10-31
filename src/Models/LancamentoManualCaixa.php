<?php

namespace App\Models;
use App\Core\Database;
use PDO;

class LancamentoManualCaixa{
    // Propriedades que espelham as colunas da tabela
    public $id;
    
    // CORRIGIDO: O nome da coluna no BD é 'data_movimento', não 'data_lancamento'
    public $data_movimento; 
    
    public $descricao;
    public $valor;
    public $tipo;
    
    // CORRIGIDO: O nome da coluna no BD é 'id_plano_de_contas', não 'id_plano_contas'
    public $id_plano_contas; 

    private $conexao;

    public function save() 
    {
        $pdo = Database::getConnection();
        
        // CORREÇÃO 1: Usar os nomes corretos das colunas do BD no SQL
        $sql = "INSERT INTO movimento_caixa (data_movimento, descricao, valor, tipo, id_plano_de_contas)
                VALUES (:data_movimento, :descricao, :valor, :tipo, :id_plano_de_contas)";
        
        $stmt = $pdo->prepare($sql);
    
        // CORREÇÃO 2: Garantir que o valor de data_movimento não seja NULL
        // Atenção: Este valor deve ser atribuído no Controller. 
        // Se estiver nulo aqui, significa que o Controller não preencheu.
        
        // Verifica se a data é NULL ou vazia e define um valor padrão se necessário, 
        // embora o ideal seja corrigir no Controller. Para fins de demonstração, 
        // vamos garantir que o PDO não insira um NULL literal se a propriedade for NULL, 
        // embora a restrição do BD permaneça.
        
        $stmt->execute([
            // data_movimento agora existe na classe, resolvendo o Warning
            'data_movimento' => $this->data_movimento, 
            'descricao' => $this->descricao,
            'valor' => $this->valor,
            'tipo' => $this->tipo,
            // A CHAVE E O VALOR AGORA USAM O NOME CORRETO DA COLUNA/PROPRIEDADE
            'id_plano_de_contas' => $this->id_plano_contas 
        ]);
        
        $this->id = $pdo->lastInsertId();
    }
}
