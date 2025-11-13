<?php

namespace App\Controllers;

use App\Models\PlanoContas; 

class PlanoContasController
{
    
    public function index()
    {
        $contas = PlanoContas::getAllOrdered(); 
        

        require __DIR__ . '/../Views/layout/header.php'; 
        require __DIR__ . '/../Views/plano_contas/index.php'; 
        require __DIR__ . '/../Views/layout/footer.php'; 
    }

    
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $conta = new PlanoContas();
            $conta->descricao = $_POST['descricao'] ?? '';
            $conta->tipo = $_POST['tipo'] ?? 'Despesa';

            if ($conta->save()) {
                
                header('Location: '. BASE_URL .'/plano-contas');
                exit;
            }
        } else {
            
            $conta = new PlanoContas(); 
            require __DIR__ . '/../Views/layout/header.php'; 
            require __DIR__ . '/../Views/plano_contas/form.php'; 
            require __DIR__ . '/../Views/layout/footer.php'; 
        }
    }

    
    public function edit($id)
    {
        $conta = PlanoContas::getById($id); 

        if (!$conta) {
            header('Location: '. BASE_URL .'/plano-contas');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $conta->descricao = $_POST['descricao'] ?? $conta->descricao;
            $conta->tipo = $_POST['tipo'] ?? $conta->tipo;

            if ($conta->save()) {
                
                header('Location: '. BASE_URL .'/plano-contas');
                exit;
            }
        } else {
            
    
            require __DIR__ . '/../Views/layout/header.php';
            require __DIR__ . '/../Views/plano_contas/form.php';
            require __DIR__ . '/../Views/layout/footer.php';
        }
    }

    
    public function delete($id) 
        {
        if (PlanoContas::canDelete($id)) {
            PlanoContas::delete($id);
        }
        
        
        header('Location: '. BASE_URL .'/plano-contas');
        exit;
    }

    public function report()
    {
   
        $contas = PlanoContas::getAllOrdered(); 

        ob_start();
        require __DIR__ . '/../Views/plano_contas/relatorio_html.php'; 
        $html = ob_get_clean();

        require_once __DIR__ . '/../../vendor/autoload.php'; 
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); 
        $dompdf->render();

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="plano_contas_relatorio.pdf"');
        echo $dompdf->output();
        exit;
    }
}