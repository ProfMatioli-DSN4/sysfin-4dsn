<?php
namespace App\Controllers;

use App\Models\Produto;

class RelatorioEstoqueController
{
    public function index()
    {

        $produtos = Produto::getAll();

        require __DIR__ . '/../Views/relatorio_estoque/index.php';
    }
}
