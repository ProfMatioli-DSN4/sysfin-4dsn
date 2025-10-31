<?php
namespace App\Controllers;
use App\Models\MovimentoCaixaModel;
class LancamentoManualCaixaController
{
    public function index()
    {
        require __DIR__ . '/../Views/lancamento_caixa/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lancemento = new LancamentoManualCaixa();
            $lancemento->data_lancamento = $_POST['data_lancamento'];
            $lancemento->descricao = $_POST['descricao'];
            $lancemento->valor = $_POST['valor'];
            $lancemento->tipo = $_POST['tipo'];
            $lancemento->id_plano_contas = $_POST['id_plano_contas'];
            $lancemento-> save();
            header('Location: /lancamento_caixa/index.php');
        } else {
            require __DIR__ . '/../Views/lancamento_caixa/index.php';
        }
    }
}