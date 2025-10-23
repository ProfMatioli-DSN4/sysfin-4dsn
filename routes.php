<?php
// Retorna uma função que define todas as rotas para o dispatcher
return function (FastRoute\RouteCollector $r) {
    //home;
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    
    //clientes;
    $r->addRoute('GET', '/clientes', [ 'App\Controllers\ClienteController', 'index']);
    $r->addRoute(['GET','POST'],'/clientes/editar/{id:\d+}', [ 'App\Controllers\ClienteController','edit']);
    $r->addRoute(['GET','POST'],'/clientes/novo', [ 'App\Controllers\ClienteController','create']);
    $r->addRoute('GET', '/clientes/excluir/{id:\d+}', [ 'App\Controllers\ClienteController', 'delete']);
    //produtos;
    $r->addRoute('GET', '/produtos', [ 'App\Controllers\ProdutoController', 'index']);
    $r->addRoute(['GET','POST'], '/produtos/novo', [ 'App\Controllers\ProdutoController', 'create']);
    $r->addRoute('GET', '/produtos/excluir/{id:\d+}', [ 'App\Controllers\ProdutoController', 'delete']);
    $r->addRoute(['GET','POST'], '/produtos/editar/{id:\d+}', [ 'App\Controllers\ProdutoController', 'edit']);


};