<?php

namespace App\Controllers;

use App\Models\PlanoContas; 

class PlanoContasController
{
    
    public function index()
    {
        $contas = PlanoContas::getAllOrdered(); 
        
        require __DIR__ . '/../Views/plano_contas/index.php'; 
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
            require __DIR__ . '/../Views/plano_contas/form.php'; 
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
            
            require __DIR__ . '/../Views/plano_contas/form.php';
        }
    }

    
    public function delete($id):void
        {
        if (PlanoContas::canDelete($id)) {
            PlanoContas::delete($id);
        }
        
        
        header('Location: '. BASE_URL .'/plano-contas');
        exit;
    }
}