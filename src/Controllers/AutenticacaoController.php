<?php
namespace App\Controllers;

class AutenticacaoController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
        } else {
            require __DIR__ . '/../Views/autenticacao/login.php';
        }
    }

    public static function require_auth(array $perfisPermitidos)
    {
        if (!isset($_SESSION['user_id'])) { /* Redireciona para login */
            header('Location: '. BASE_URL . '/login');
        }
        $temPermissao = count(array_intersect(
            $perfisPermitidos,
            $_SESSION['user_perfis']
        )) > 0;
        if (!$temPermissao) {
            http_response_code(403); // Forbidden
            echo "<h1>Acesso Negado</h1>";
            exit();
        }
    }
}