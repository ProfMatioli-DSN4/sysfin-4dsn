<?php
// Retorna uma função que define todas as rotas para o dispatcher
return function (FastRoute\RouteCollector $r) {
    //home;
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    
    //clientes;
    $r->addRoute('GET', '/clientes', [ 'App\Controllers\ClienteController', 'index']);

    //produtos;
    $r->addRoute('GET', '/produtos', [ 'App\Controllers\ProdutoController', 'index']);
    $r->addRoute('GET', '/produtos/novo', [ 'App\Controllers\ProdutoController', 'create']);


};