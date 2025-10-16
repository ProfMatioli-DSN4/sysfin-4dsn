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

    //vendas
    $r->addRoute('GET', '/relatorio-vendas', ['App\Controllers\RelatorioVendasController', 'index']);
    $r->addRoute('POST', '/relatorio-vendas/gerar', ['App\Controllers\RelatorioVendasController', 'gerar']);



};