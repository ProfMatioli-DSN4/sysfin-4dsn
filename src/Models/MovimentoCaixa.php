<?php

namespace App\Models;

// No futuro, esta classe irá interagir com o banco de dados.
// Por agora, ela retorna dados de exemplo.
class MovimentoCaixa
{
    /**
     * Simula a busca pelo saldo total atual do caixa.
     * @return float
     */
    public function getSaldoAtual(): float
    {
        // Lógica de exemplo:
        // SELECT SUM(CASE WHEN tipo = 'entrada' THEN valor ELSE -valor END) as saldo FROM movimento_caixa;
        return 7345.50;
    }

    /**
     * Simula a busca pelos últimos lançamentos no caixa.
     * @param int $limit O número de lançamentos a serem retornados.
     * @return array
     */
    public function getUltimosLancamentos(int $limit = 5): array
    {
        // Lógica de exemplo:
        // SELECT descricao, tipo, valor FROM movimento_caixa ORDER BY data DESC LIMIT :limit;
        return [
            ['descricao' => 'Venda de 2x Teclado Mecânico', 'tipo' => 'entrada', 'valor' => 350.00],
            ['descricao' => 'Pagamento Fornecedor de Peças', 'tipo' => 'saida', 'valor' => 875.90],
            ['descricao' => 'Venda de 1x Monitor Gamer', 'tipo' => 'entrada', 'valor' => 1250.00],
            ['descricao' => 'Compra de café e lanches', 'tipo' => 'saida', 'valor' => 45.20],
            ['descricao' => 'Venda de 5x Mousepad', 'tipo' => 'entrada', 'valor' => 125.00],
        ];
    }
}
