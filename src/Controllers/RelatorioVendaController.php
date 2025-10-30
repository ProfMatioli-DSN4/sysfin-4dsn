<?php
namespace App\Controllers;
use App\Models\RelatorioVenda;

class RelatorioVendaController
{
    /**
     * Esta função verifica se o usuário tem permissão para acessar o relatório de vendas
     * Apenas Administrador (id=1) e Tesoureiro (id=2) podem acessar
     * 
     * Esta função está comentada pois ainda não existe sistema de login.
     * Quando implementar o login, serão descomentadas as linhas e realizados ajustes conforme necessário.
     */
    private function verificarAcesso()
    {
        
        // session_start();
        // 
        // if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['perfil_id'])) {
        //     return false;
        // }
        // 
        // $perfilId = $_SESSION['perfil_id'];
        // if ($perfilId == 1 || $perfilId == 2) {
        //     return true;
        // }
        // 
        // return false;
        
        //  RETORNA TRUE PARA PERMITIR ACESSO DURANTE O DESENVOLVIMENTO
        return true;
    }

    public function index()
    {
        if (!$this->verificarAcesso()) {
            $erroAcesso = "Acesso negado. Apenas Administradores e Tesoureiros podem visualizar este relatório.";
            require __DIR__ . '/../Views/relatorio-venda/acesso_negado.php';
            return;
        }

        require __DIR__ . '/../Views/relatorio-venda/venda_por_periodo.php';
    }

    public function gerar()
    {
        if (!$this->verificarAcesso()) {
            $erroAcesso = "Acesso negado. Apenas Administradores e Tesoureiros podem visualizar este relatório.";
            require __DIR__ . '/../Views/relatorio-venda/acesso_negado.php';
            return;
        }

        $dataInicial = $_POST['data_inicial'] ?? null;
        $dataFinal   = $_POST['data_final'] ?? null;

        if ($dataInicial && $dataFinal) {
            if ($dataInicial > $dataFinal) {
                $erroData = "A data inicial não pode ser maior que a data final.";
                require __DIR__ . '/../Views/relatorio-venda/venda_por_periodo.php';
                return;
            }

            $vendas = RelatorioVenda::listarPorPeriodo($dataInicial, $dataFinal);

            $totalVendas = count($vendas);
            $valorTotal = array_sum(array_column($vendas, 'valor_total'));

            require __DIR__ . '/../Views/relatorio-venda/venda_por_periodo.php';
        } else {
            echo "<h3>Por favor, selecione um período válido.</h3>";
        }
    }

}
