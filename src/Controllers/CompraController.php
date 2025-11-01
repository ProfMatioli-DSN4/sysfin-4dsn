<?php
// src/Controllers/CompraController.php
namespace App\Controllers;

use App\Models\Produto;
use App\Models\Fornecedor;

class CompraController
{
    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        $produtos = Produto::getAll();
        $fornecedores = Fornecedor::getAll();

        // Simulação de fornecedores (sem model ainda)
        //$fornecedores = [
        //    (object)['id' => 1, 'nome' => 'Fornecedor A'],
        //    (object)['id' => 2, 'nome' => 'Fornecedor B'],
        //    (object)['id' => 3, 'nome' => 'Fornecedor C'],
        //];

        if (!isset($_SESSION['itens_compra'])) {
            $_SESSION['itens_compra'] = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['adicionar_item'])) {
                $this->adicionarItem();
            } elseif (isset($_POST['limpar_itens'])) {
                $this->limparItens();
            } elseif (isset($_POST['selecionar_fornecedor'])) {
                $this->selecionarFornecedor();
            }
        }

        $total = array_sum(array_column($_SESSION['itens_compra'], 'subtotal'));

        $itens = $_SESSION['itens_compra'];
        $fornecedorSelecionado = $_SESSION['fornecedor_compra'] ?? null;

        require __DIR__ . '/../Views/compra/create.php';
    }

    private function adicionarItem()
    {
        $produto_id = $_POST['produto_id_add'] ?? null;
        $quantidade = floatval($_POST['quantidade_add'] ?? 0);
        $valor_unitario = floatval($_POST['valor_unitario_add'] ?? 0);

        if ($produto_id && $quantidade > 0 && $valor_unitario > 0) {
            $produto = Produto::getById($produto_id);

            if ($produto) {
                $produto = (array) $produto;
                $_SESSION['itens_compra'][] = [
                    'id' => $produto['id'],
                    'nome' => $produto['nome'],
                    'quantidade' => $quantidade,
                    'valor_unitario' => $valor_unitario,
                    'subtotal' => $quantidade * $valor_unitario
                ];
            }
        }
    }

    private function limparItens()
    {
        $_SESSION['itens_compra'] = [];
        unset($_SESSION['fornecedor_compra']);
    }

    private function selecionarFornecedor()
    {
        $fornecedor_id = $_POST['fornecedor_id'] ?? null;

        if ($fornecedor_id) {
            $fornecedor = Fornecedor::find($fornecedor_id);

            if ($fornecedor) {
                $_SESSION['fornecedor_compra'] = $fornecedor;
            }
        }
    }

    public function create()
    {
        // Lógica da Tarefa #7 (ainda não implementada)
        if (!empty($_SESSION['itens_compra'])) {
            $_SESSION['itens_compra'] = [];
        }

        unset($_SESSION['fornecedor_compra']);

        header('Location: ' . BASE_URL . '/compras');
        exit;
    }
}
