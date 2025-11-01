<?php
// App/Controllers/fornecedorController.php
namespace App\Controllers;
use App\Models\Fornecedor;
use Dompdf\Dompdf;

class FornecedorController
{
    public function index()
    {
        $busca = $_GET['busca'] ?? null;
        $fornecedor = Fornecedor::getAll($busca);
        require __DIR__ . '/../Views/fornecedor/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fornecedor = new Fornecedor();
            $cnpj = $_POST['cnpj'];
            if($fornecedor->validCnpjExists($cnpj)) {
                $error = "CNPJ já cadastrado";
                require __DIR__ . '/../Views/fornecedor/form.php';
                return;
            }

            if (strlen($cnpj) !== 14) {
                $error = 'CNPJ inválido. Deve conter 14 dígitos.';
                require __DIR__ . '/../Views/fornecedor/form.php';
                return;
            }
            $fornecedor->nome = $_POST['nome'] ?? '';
            $fornecedor->cnpj = $cnpj;
            $fornecedor->email = $_POST['email'] ?? '';
            $fornecedor->telefone = $_POST['telefone'] ?? '';
            $fornecedor->save();
            header('Location: ../fornecedores');
        } else {
            $fornecedor = null;
            require __DIR__ . '/../Views/fornecedor/form.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cnpj = preg_replace('/\D/', '', $_POST['cnpj'] ?? '');
            if (strlen($cnpj) !== 14) {
                $error = 'CNPJ inválido. Deve conter 14 dígitos.';
                $fornecedor = Fornecedor::find($id);
                require __DIR__ . '/../Views/fornecedor/form.php';
                return;
            }
            $fornecedor = new Fornecedor();
            $fornecedor->id = $id;
            $fornecedor->nome = $_POST['nome'] ?? '';
            $fornecedor->cnpj = $cnpj;
            $fornecedor->email = $_POST['email'] ?? '';
            $fornecedor->telefone = $_POST['telefone'] ?? '';
            $fornecedor->save();
            header('Location: ../../fornecedores');
        } else {
            $fornecedor = Fornecedor::find($id);
            require __DIR__ . '/../Views/fornecedor/form.php';
        }
    }

    public function delete($id)
    {
        Fornecedor::delete($id);
        header('Location: ../../fornecedores');
    }

    public function report()
    {
        $fornecedor = fornecedor::getAll();
        ob_start();
        require __DIR__ . '/../Views/fornecedor/relatorio_html.php';
        $html = ob_get_clean();

        require_once __DIR__ . '/../../vendor/autoload.php';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="fornecedor_relatorio.pdf"');
        echo $dompdf->output();
        exit;
    }
}