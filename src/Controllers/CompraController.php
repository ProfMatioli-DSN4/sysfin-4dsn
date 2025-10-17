<?php

namespace App\Controllers;

use App\Models\Compra;

class CompraController
{
    public function index()
    {
        echo "Lista de compras (ainda não implementada)";
        // Mais tarde você pode pegar as compras do banco e mostrar na view
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $compra = new Compra();
            $compra->id_fornecedor = $_POST['id_fornecedor'];
            $compra->data_compra = date('Y-m-d H:i:s');
            $compra->valor_total = $_POST['valor_total'];
            $compra->itens = $_POST['itens'];

            if ($compra->save()) {
                header('Location: ' . BASE_URL . '/compras');
                exit;
            } else {
                echo "Erro ao processar a compra!";
            }
        } else {
            require __DIR__ . '/../Views/compra/create.php';
        }
    }
}

