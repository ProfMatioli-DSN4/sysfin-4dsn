<?php
// src/Controllers/CompraController.php
namespace App\Controllers;

use App\Models\Produto;
//use App\Models\Fornecedor;

class CompraController
{
    public function index()
    {
        $produtos = Produto::getAll();
        //$fornecedores = Fornecedor::getAll();
        // Simulação de fornecedores
        $fornecedores = [
            (object)['id' => 1, 'nome' => 'Fornecedor A'],
            (object)['id' => 2, 'nome' => 'Fornecedor B'],
            (object)['id' => 3, 'nome' => 'Fornecedor C'],
        ];
        require __DIR__ . '/../Views/compra/create.php';
    }

    public function create()
    {
        // Esta é a lógica da Tarefa #7, apenas exibe os dados recebidos, implementar a persistência no banco de dados aqui.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Location: ' . BASE_URL . '/compras/novo');
            exit;
        }

        $fornecedorId = $_POST['fornecedor_id'] ?? null;
        $dataCompra = $_POST['data_compra'] ?? date('Y-m-d');
        $itens = json_decode($_POST['itens_compra'] ?? '[]', true);
        $valorTotal = $_POST['valor_total'] ?? 0;
        }
}