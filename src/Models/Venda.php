<?php

namespace App\Models;

// Model para gerenciar dados de Vendas.
// Por agora, retorna dados de exemplo.
class Venda
{
    /**
     * Simula a busca pelo total vendido na data atual.
     * @return float
     */
    public function getTotalVendidoHoje(): float
    {
        // Lógica de exemplo:
        // SELECT SUM(valor_total) FROM vendas WHERE DATE(data_venda) = CURDATE();
        return 2850.75;
    }
}
