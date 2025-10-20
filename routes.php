<?php
// Retorna uma função que define todas as rotas para o dispatcher
return function (FastRoute\RouteCollector $r) {
    //home;
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    
    //clientes;
    $r->addRoute('GET', '/clientes', [ 'App\Controllers\ClienteController', 'index']);

    //produtos;
    $r->addRoute('GET', '/produtos', [ 'App\Controllers\ProdutoController', 'index']);
    $r->addRoute(['GET','POST'], '/produtos/novo', [ 'App\Controllers\ProdutoController', 'create']);
    $r->addRoute('GET', '/produtos/excluir/{id:\d+}', [ 'App\Controllers\ProdutoController', 'delete']);
    $r->addRoute(['GET','POST'], '/produtos/editar/{id:\d+}', [ 'App\Controllers\ProdutoController', 'edit']);

    //vendas;
    // Exibe a tela de registro de vendas (interface)
    $r->addRoute('GET', '/vendas/novo', ['App\Controllers\VendaController', 'create']);

    // Recebe os dados da venda ao clicar em "Finalizar Venda"
    // (a lógica completa será implementada na Tarefa 9)
    $r->addRoute('POST', '/vendas/finalizar', ['App\Controllers\VendaController', 'store']);

};