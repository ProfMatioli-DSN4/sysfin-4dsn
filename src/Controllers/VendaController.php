<?php
namespace App\Controllers;

use App\Models\Cliente;
use App\Models\Produto;

class VendaController {

    public function create() {
        $clientes = Cliente::getAll();
        $produtos = Produto::getAll();
        require __DIR__ . '/../Views/vendas/create.php';
    }

    public function store() {
        // Aqui depois entrará a lógica da Tarefa 9 (transação da venda)
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }
}
