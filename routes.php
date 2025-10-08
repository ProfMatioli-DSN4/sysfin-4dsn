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

    // Perfis
    $r->addRoute('GET', '/profiles', ['App\Controllers\ProfileController', 'index']);
    $r->addRoute('GET', '/profiles/create', ['App\Controllers\ProfileController', 'create']);
    $r->addRoute('POST', '/profiles/store', ['App\Controllers\ProfileController', 'store']);
    $r->addRoute('GET', '/profiles/edit/{id:\d+}', ['App\Controllers\ProfileController', 'edit']);
    $r->addRoute('POST', '/profiles/update/{id:\d+}', ['App\Controllers\ProfileController', 'update']);
    $r->addRoute('GET', '/profiles/delete/{id:\d+}', ['App\Controllers\ProfileController', 'delete']);

    // Usuários
    $r->addRoute('GET', '/users', ['App\Controllers\UserController', 'index']);
    $r->addRoute('GET', '/users/create', ['App\Controllers\UserController', 'create']);
    $r->addRoute('POST', '/users/store', ['App\Controllers\UserController', 'store']);
    $r->addRoute('GET', '/users/edit/{id:\d+}', ['App\Controllers\UserController', 'edit']);
    $r->addRoute('POST', '/users/update/{id:\d+}', ['App\Controllers\UserController', 'update']);
    $r->addRoute('GET', '/users/delete/{id:\d+}', ['App\Controllers\UserController', 'delete']);
};