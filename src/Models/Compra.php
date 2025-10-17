<?php
namespace App\Models;
use App\Core\Database;
use PDO;
use Exception;

class Compra
{
    public $id;
    public $id_fornecedor;
    public $data_compra;
    public $valor_total;
    public $itens = [];

    public function save()
    {
        $pdo = Database::getConnection();

        try {

            $pdo->beginTransaction();


            $stmt = $pdo->prepare("
                INSERT INTO compras (id_fornecedor, data_compra, valor_total)
                VALUES (:id_fornecedor, :data_compra, :valor_total)
            ");
            $stmt->execute([
                'id_fornecedor' => $this->id_fornecedor,
                'data_compra' => $this->data_compra,
                'valor_total' => $this->valor_total
            ]);


            $this->id = $pdo->lastInsertId();


            foreach ($this->itens as $item) {
                $stmtItem = $pdo->prepare("
                    INSERT INTO itens_compra (id_compra, id_produto, quantidade, valor_unitario)
                    VALUES (:id_compra, :id_produto, :quantidade, :valor_unitario)
                ");
                $stmtItem->execute([
                    'id_compra' => $this->id,
                    'id_produto' => $item['id_produto'],
                    'quantidade' => $item['quantidade'],
                    'valor_unitario' => $item['valor_unitario']
                ]);


                $stmtEstoque = $pdo->prepare("
                    UPDATE produtos
                    SET estoque_atual = estoque_atual + :quantidade
                    WHERE id = :id_produto
                ");
                $stmtEstoque->execute([
                    'quantidade' => $item['quantidade'],
                    'id_produto' => $item['id_produto']
                ]);
            }

            $stmtCaixa = $pdo->prepare("
                INSERT INTO movimento_caixa (data_movimento, descricao, id_plano_de_contas, tipo, valor)
                VALUES (:data_movimento, :descricao, :id_plano_de_contas, :tipo, :valor)
            ");
            $stmtCaixa->execute([
                'data_movimento' => $this->data_compra,
                'descricao' => 'Compra de produtos (ID: ' . $this->id . ')',
                'id_plano_de_contas' => 2,
                'tipo' => 'S',
                'valor' => $this->valor_total
            ]);


            $pdo->commit();
            return true;

        } catch (Exception $e) {

            $pdo->rollBack();
            error_log("Erro na compra: " . $e->getMessage());
            return false;
        }
    }
}
