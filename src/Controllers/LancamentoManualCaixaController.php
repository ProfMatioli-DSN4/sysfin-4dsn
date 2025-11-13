<?php
namespace App\Controllers;
use App\Models\MovimentoCaixaModel;
use App\Models\LancamentoManualCaixa; 
use App\Models\PlanoContas; 

class LancamentoManualCaixaController
{
    public function index()
    {
        $contas = PlanoContas::getAllOrdered();
        
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/lancamento_caixa/index.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lancamento = new LancamentoManualCaixa();

            $lancamento->data_movimento = $_POST['data_movimento'];
            $lancamento->descricao = $_POST['descricao'];
            $lancamento->valor = $_POST['valor'];

            $tipo = $_POST['tipo'] ?? '';
            if ($tipo === 'Entrada') {
                $tipo = 'E';
            } elseif ($tipo === 'Saída' || $tipo === 'Saida') {
                $tipo = 'S';
            }

            $lancamento->tipo = $tipo;

            $idPlano = $_POST['id_plano_contas'] ?? null;
            if (!is_numeric($idPlano)) {
                die('Erro: Plano de contas inválido');
            }
            $lancamento->id_plano_contas = (int)$idPlano;

            $lancamento->save();

            header('Location: ' . BASE_URL . '/lancamento-manual-caixa?success=1');
            exit;
        } else {
            // 👇 Carregar os planos de conta na view de formulário
            $contas = PlanoContas::getAllOrdered();

            require __DIR__ . '/../Views/layout/header.php';
            require __DIR__ . '/../Views/lancamento_caixa/index.php';
            require __DIR__ . '/../Views/layout/footer.php';
        }
    }
}