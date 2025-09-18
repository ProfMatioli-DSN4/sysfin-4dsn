<?php
// Retorna uma função que define todas as rotas para o dispatcher
return function (FastRoute\RouteCollector $r) {
    $controller = 'App\Controllers\ClienteController';
    // Rota para a página inicial e listagem de tarefas
    $r->addRoute('GET', '/clientes', [$controller, 'index']);
};