<?php
// App/Controllers/FornecedoresController.php
namespace App\Controllers;
use App\Models\Fornecedores;
use Dompdf\Dompdf;

class FornecedoresController
{
    public function index()
    {
        $busca = $_GET['busca'] ?? null;
        $fornecedores = Fornecedores::getAll($busca);
        require __DIR__ . '/../Views/fornecedores/listar.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cnpj = preg_replace('/\D/', '', $_POST['cnpj'] ?? '');
            if (strlen($cnpj) !== 14) {
                $error = 'CNPJ inválido. Deve conter 14 dígitos.';
                require __DIR__ . '/../Views/fornecedores/form.php';
                return;
            }
            $fornecedor = new Fornecedores();
            $fornecedor->nome = $_POST['nome'] ?? '';
            $fornecedor->cnpj = $cnpj;
            $fornecedor->email = $_POST['email'] ?? '';
            $fornecedor->telefone = $_POST['telefone'] ?? '';
            $fornecedor->save();
            header('Location: /fornecedores');
        } else {
            $fornecedor = null;
            require __DIR__ . '/../Views/fornecedores/form.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cnpj = preg_replace('/\D/', '', $_POST['cnpj'] ?? '');
            if (strlen($cnpj) !== 14) {
                $error = 'CNPJ inválido. Deve conter 14 dígitos.';
                $fornecedor = Fornecedores::find($id);
                require __DIR__ . '/../Views/fornecedores/form.php';
                return;
            }
            $fornecedor = new Fornecedores();
            $fornecedor->id = $id;
            $fornecedor->nome = $_POST['nome'] ?? '';
            $fornecedor->cnpj = $cnpj;
            $fornecedor->email = $_POST['email'] ?? '';
            $fornecedor->telefone = $_POST['telefone'] ?? '';
            $fornecedor->save();
            header('Location: /fornecedores');
        } else {
            $fornecedor = Fornecedores::find($id);
            require __DIR__ . '/../Views/fornecedores/form.php';
        }
    }

    public function delete($id)
    {
        Fornecedores::delete($id);
        header('Location: /fornecedores');
    }

    public function relatorio()
    {
        $fornecedores = Fornecedores::getAll();
        ob_start();
        require __DIR__ . '/../Views/fornecedores/relatorio_html.php';
        $html = ob_get_clean();

        require_once __DIR__ . '/../../vendor/autoload.php';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="fornecedores_relatorio.pdf"');
        echo $dompdf->output();
        exit;
    }
}