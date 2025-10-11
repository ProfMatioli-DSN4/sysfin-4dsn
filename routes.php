<?php
// Retorna uma função que define todas as rotas para o dispatcher
return function (FastRoute\RouteCollector $r) {
    //home;
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    
    //clientes;
    $r->addRoute('GET', '/clientes', [ 'App\Controllers\ClienteController', 'index']);

        //fornecedores;
    $r->addRoute('GET', '/fornecedores', ['App\Controllers\FornecedoresController', 'index']);
    $r->addRoute('GET', '/fornecedores/relatorio', ['App\Controllers\FornecedoresController', 'relatorio']);
    $r->addRoute('GET', '/fornecedores/{id:\d+}/edit', ['App\Controllers\FornecedoresController', 'edit']);
    $r->addRoute('POST', '/fornecedores/{id:\d+}/edit', ['App\Controllers\FornecedoresController', 'edit']);
    $r->addRoute('GET', '/fornecedores/create', ['App\Controllers\FornecedoresController', 'create']);
    $r->addRoute('POST', '/fornecedores/create', ['App\Controllers\FornecedoresController', 'create']);
    $r->addRoute('GET', '/fornecedores/{id:\d+}/delete', ['App\Controllers\FornecedoresController', 'delete']);

};