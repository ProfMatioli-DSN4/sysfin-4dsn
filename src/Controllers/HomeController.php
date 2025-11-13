<?php

namespace App\Controllers;

// Importa os models que serão necessários para o dashboard
use App\Models\MovimentoCaixa;
use App\Models\Venda;
use App\Models\Produto;

/**
 * Classe HomeController
 *
 * Responsável por controlar a página inicial/dashboard do sistema.
 */
class HomeController
{
    /**
     * Exibe a tela principal (Dashboard).
     *
     * Este método busca todos os dados necessários dos models
     * e carrega a view do dashboard para exibi-los em cards.
     */
    public function index()
    {
        // Instancia os models
        $caixaModel = new MovimentoCaixa();
        $vendaModel = new Venda();
        $produtoModel = new Produto();

        // Busca os dados para os cards do dashboard
        $saldoCaixa = $caixaModel->getSaldoAtual();
        $totalVendidoHoje = $vendaModel->getTotalVendidoHoje();
        $produtosEstoqueBaixo = $produtoModel->countEstoqueBaixo();
        $ultimosLancamentos = $caixaModel->getUltimosLancamentos(5);

        // Define o título da página
        $titulo = "Dashboard - Painel Principal";

        // Carrega a view do dashboard e passa todas as variáveis para ela.
        require_once '../src/Views/home/index.php';
    }
}