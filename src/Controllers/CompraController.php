<?php
// src/Controllers/CompraController.php
namespace App\Controllers;

use App\Models\Produto;
// use App\Models\Fornecedor; quando houver model de fornecedor

class CompraController
{
    public function index()
    {
        $produtos = Produto::getAll();
        // Simulação de fornecedores
        $fornecedores = [
            (object)['id' => 1, 'nome' => 'Fornecedor A'],
            (object)['id' => 2, 'nome' => 'Fornecedor B'],
            (object)['id' => 3, 'nome' => 'Fornecedor C'],
        ];
        require __DIR__ . '/../Views/compra/create.php';
    }

    public function finalizarCompra()
    {
        // Esta é a lógica da Tarefa #7, apenas exibe os dados recebidos, implementar a persistência no banco de dados aqui.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fornecedorId = $_POST['fornecedor_id'] ?? null;
            $dataCompra = $_POST['data_compra'] ?? date('Y-m-d');
            $itens = json_decode($_POST['itens_compra'] ?? '[]', true);
            $valorTotal = $_POST['valor_total'] ?? 0;

            echo "<h2>Compra Finalizada! (Lógica da Tarefa #7)</h2>";
            echo "<p>Fornecedor ID: " . htmlspecialchars($fornecedorId) . "</p>";
            echo "<p>Data da Compra: " . htmlspecialchars($dataCompra) . "</p>";
            echo "<p>Valor Total: R$ " . number_format($valorTotal, 2, ',', '.') . "</p>";
            echo "<h3>Itens da Compra:</h3>";
            if (!empty($itens)) {
                echo "<pre>" . json_encode($itens, JSON_PRETTY_PRINT) . "</pre>";
            } else {
                echo "<p>Nenhum item na compra.</p>";
            }
            echo '<p><a href="' . BASE_URL . '/compras/novo">Nova Compra</a></p>';
        } else {
            header('Location: ' . BASE_URL . '/compras/novo');
        }
    }
}