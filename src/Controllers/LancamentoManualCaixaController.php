<?php
namespace App\Controllers;
use App\Models\MovimentoCaixaModel;
use App\Models\LancamentoManualCaixa; 
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
            
            // CORREÇÃO PRINCIPAL: 
            // 1. Usa a propriedade correta do Modelo (data_movimento)
            // 2. Assume que o nome do campo no formulário HTML também foi corrigido
            $lancemento->data_movimento = $_POST['data_movimento'];
            
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