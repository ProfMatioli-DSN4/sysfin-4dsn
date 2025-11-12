<?php
namespace App\Controllers;

use App\Models\Venda;
use Exception;

class VendaController
{
    public function finalizarVenda()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) $input = $_POST;

        $idCliente = intval($input['id_cliente'] ?? 0);
        $itens = $input['itens'] ?? [];

        header('Content-Type: application/json');

        try {
            $idVenda = Venda::processar($idCliente, $itens);
            echo json_encode([
                'success' => true,
                'id_venda' => $idVenda,
                'mensagem' => "Venda #{$idVenda} finalizada com sucesso!"
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'erro' => $e->getMessage()
            ]);
        }
    }
}
