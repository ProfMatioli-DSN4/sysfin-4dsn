<?php
// Retorna uma função que define todas as rotas para o dispatcher
return function (FastRoute\RouteCollector $r) {
    //home;
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    
    //clientes;
    $r->addRoute('GET', '/clientes', [ 'App\Controllers\ClienteController', 'index']);

        //fornecedores;
    $r->addRoute('GET', '/fornecedor', ['App\Controllers\FornecedorController', 'index']);
    $r->addRoute('GET', '/fornecedor/relatorio', ['App\Controllers\FornecedorController', 'relatorio']);
    $r->addRoute('GET', '/fornecedor/{id:\d+}/edit', ['App\Controllers\FornecedorController', 'edit']);
    $r->addRoute('POST', '/fornecedor/{id:\d+}/edit', ['App\Controllers\FornecedorController', 'edit']);
    $r->addRoute('GET', '/fornecedor/create', ['App\Controllers\FornecedorController', 'create']);
    $r->addRoute('POST', '/fornecedor/create', ['App\Controllers\FornecedorController', 'create']);
    $r->addRoute('GET', '/fornecedor/{id:\d+}/delete', ['App\Controllers\FornecedorController', 'delete']);

};