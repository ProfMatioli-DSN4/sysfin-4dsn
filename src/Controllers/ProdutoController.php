<?php
// App/Controllers/ProdutoController.php 
namespace App\Controllers;
use App\Models\Produto;
class ProdutoController
{
    public function index()
    {
        $produtos = Produto::getAll();
        require __DIR__ . '/../Views/produto/index.php';
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produto = new Produto();
            $produto->nome = $_POST['nome'];
            $produto->preco_venda = $_POST['preco_venda'];
            $produto->descricao = $_POST['descricao'];
            $produto->estoque_atual = $_POST['estoque_atual'] ?? $produto->estoque_atual;
            $produto->save();
            header('Location: '. BASE_URL .'/produtos');
        } else {
            require __DIR__ . '/../Views/produto/create.php';
        }
    }
    public function edit($id)
    {
        $produto = Produto::getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produto->nome = $_POST['nome'];
            $produto->preco_venda = $_POST['preco_venda'];
            $produto->descricao = $_POST['descricao'];
            $produto->save();
            header('Location: '. BASE_URL .'/produtos');
        } else {
            require __DIR__ . '/../Views/produto/edit.php';
        }
    }
    public function delete($id)
    {
        Produto::delete($id);
        header('Location: '. BASE_URL .'/produtos');
    }
}