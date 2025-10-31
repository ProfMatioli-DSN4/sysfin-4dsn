<?php
namespace App\Models;

use App\Database;
use Exception;
use PDO;

class Venda
{
    public static function processar($idCliente, $itens)
    {
        if ($idCliente <= 0 || empty($itens)) {
            throw new Exception("Dados da venda inválidos.");
        }

        $pdo = Database::getConnection();
        $valorTotal = 0.0;
        foreach ($itens as $i) {
            $valorTotal += $i['quantidade'] * $i['valor_unitario'];
        }

        try {
            $pdo->beginTransaction();

            // 1️⃣ Cabeçalho da venda
            $stmtVenda = $pdo->prepare("
                INSERT INTO vendas (id_cliente, data_venda, valor_total)
                VALUES (:id_cliente, NOW(), :valor_total)
            ");
            $stmtVenda->execute([
                ':id_cliente' => $idCliente,
                ':valor_total' => $valorTotal
            ]);
            $idVenda = $pdo->lastInsertId();

            // 2️⃣ Itens + atualização de estoque
            $stmtItem = $pdo->prepare("
                INSERT INTO itens_venda (id_venda, id_produto, quantidade, valor_unitario)
                VALUES (:id_venda, :id_produto, :qtd, :valor)
            ");
            $stmtEstoque = $pdo->prepare("
                UPDATE produtos
                SET estoque_atual = estoque_atual - :qtd
                WHERE id = :id_produto AND estoque_atual >= :qtd
            ");

            foreach ($itens as $it) {
                $stmtItem->execute([
                    ':id_venda' => $idVenda,
                    ':id_produto' => $it['id_produto'],
                    ':qtd' => $it['quantidade'],
                    ':valor' => $it['valor_unitario']
                ]);

                $stmtEstoque->execute([
                    ':qtd' => $it['quantidade'],
                    ':id_produto' => $it['id_produto']
                ]);

                if ($stmtEstoque->rowCount() === 0) {
                    throw new Exception("Estoque insuficiente para produto #{$it['id_produto']}");
                }
            }

            // 3️⃣ Movimento de caixa
            $stmtPlano = $pdo->query("SELECT id FROM plano_de_contas WHERE descricao = 'Receita de Vendas' LIMIT 1");
            $idPlano = $stmtPlano->fetchColumn();

            if (!$idPlano) throw new Exception("Plano de contas 'Receita de Vendas' não encontrado.");

            $stmtCaixa = $pdo->prepare("
                INSERT INTO movimento_caixa (data_movimento, descricao, id_plano_de_contas, tipo, valor, id_venda)
                VALUES (NOW(), :desc, :id_plano, 'E', :valor, :id_venda)
            ");
            $stmtCaixa->execute([
                ':desc' => "Venda #{$idVenda}",
                ':id_plano' => $idPlano,
                ':valor' => $valorTotal,
                ':id_venda' => $idVenda
            ]);

            $pdo->commit();
            return $idVenda;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw new Exception("Falha ao processar venda: " . $e->getMessage());
        }
    }
}
