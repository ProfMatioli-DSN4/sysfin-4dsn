<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class RelatorioVendas
{
    public static function listarPorPeriodo($dataInicial, $dataFinal)
    {
        $pdo = Database::getConnection();
        $sql = "SELECT v.data_venda, c.nome AS cliente, v.valor_total
                FROM vendas v
                INNER JOIN clientes c ON c.id = v.id_cliente
                WHERE v.data_venda BETWEEN :inicio AND :fim
                ORDER BY v.data_venda ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':inicio', $dataInicial);
        $stmt->bindValue(':fim', $dataFinal);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
