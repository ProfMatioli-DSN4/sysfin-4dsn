<?php
namespace App\Controllers;
use App\Models\Cliente;
use Dompdf\Dompdf;

class ClienteController
{
    public function index()
    {
    if (isset($_GET['busca']) && !empty($_GET['busca'])) {
        $termoBusca = $_GET['busca'];
        $clientes = Cliente::searchByName($termoBusca);
    } else {
 
        $clientes = Cliente::getAll();
    }
        require __DIR__ . '/../Views/cliente/index.php';
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente = new Cliente();
            $cliente->nome = $_POST['nome'];
            $cliente->cpf_cnpj = $_POST['cpf_cnpj'];
            $cliente->email = $_POST['email'];
            $cliente->telefone = $_POST['telefone'];
            $cliente->save();
            header('Location: '. BASE_URL .'/clientes');
        } else {
            require __DIR__ . '/../Views/cliente/create.php';
        }
    }
    public function edit($id)
    {
        $cliente = Cliente::getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente->nome = $_POST['nome'];
            $cliente->cpf_cnpj = $_POST['cpf_cnpj'];
            $cliente->email = $_POST['email'];
            $cliente->telefone = $_POST['telefone'];
            $cliente->save();
            header('Location: '. BASE_URL .'/clientes');
        } else {
            require __DIR__ . '/../Views/cliente/edit.php';
        }
    }
    public function delete($id)
    {
        Cliente::delete($id);
        header('Location:'. BASE_URL .' /clientes');
    }

    public function report()
    {
        $clientes = Cliente::getAll();
        ob_start();
        require __DIR__ . '/../Views/cliente/relatorio-cliente.php';
        $html = ob_get_clean();
        require_once __DIR__ . '/../../vendor/autoload.php';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="clientes_relatorio.pdf"');
        
        echo $dompdf->output();
        
        exit;
    }

}