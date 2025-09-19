<?php
// Retorna uma função que define todas as rotas para o dispatcher
return function (FastRoute\RouteCollector $r) {
    $controller = 'App\Controllers\HomeController';
    $r->addRoute('GET', '/', [$controller, 'index']);
    
    $controller = 'App\Controllers\ClienteController';
    $r->addRoute('GET', '/clientes', [$controller, 'index']);
};