<?php
namespace App\Controllers;
use App\Models\RelatorioVenda;

class RelatorioVendaController
{
    public function index()
    {
        require __DIR__ . '/../Views/relatorio-venda/venda_por_periodo.php';
    }

    public function gerar()
{
    $dataInicial = $_POST['data_inicial'] ?? null;
    $dataFinal   = $_POST['data_final'] ?? null;

    if ($dataInicial && $dataFinal) {
        // Validação: data inicial não pode ser maior que data final
        if ($dataInicial > $dataFinal) {
            $erroData = "A data inicial não pode ser maior que a data final.";
            require __DIR__ . '/../Views/relatorio-venda/venda_por_periodo.php';
            return;
        }

        $vendas = RelatorioVenda::listarPorPeriodo($dataInicial, $dataFinal);

        $totalVendas = count($vendas);
        $valorTotal = array_sum(array_column($vendas, 'valor_total'));

        require __DIR__ . '/../Views/relatorio-venda/venda_por_periodo.php';
    } else {
        echo "<h3>Por favor, selecione um período válido.</h3>";
    }
}

}
