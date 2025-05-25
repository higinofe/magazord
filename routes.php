<?php

use App\Controllers\PessoaController;
use App\Controllers\ContatoController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    /** Pagina Home */
    case '/':
        require __DIR__ . '/views/home.php';
        break;

    /** Rotas da Pagina de Pessoas */
    case '/pessoas':
        (new PessoaController())->index();
        break;

    case '/pessoa/create':
        (new PessoaController())->create();
        break;

    case '/pessoa/store':
        (new PessoaController())->store();
        break;

    case '/pessoa/edit':
        (new PessoaController())->edit();
        break;

    case '/pessoa/update':
        (new PessoaController())->update();
        break;

    case '/pessoa/delete':
        (new PessoaController())->delete();
        break;

     /** Rotas da Pagina de Contatos */
     case '/contatos':
        (new ContatoController())->index();
        break;

    case '/contatos/create':
        (new ContatoController())->create();
        break;

    case '/contatos/store':
        (new ContatoController())->store();
        break;

    case '/contatos/edit':
        (new ContatoController())->edit();
        break;

    case '/contatos/update':
        (new ContatoController())->update();
        break;

    case '/contatos/delete':
        (new ContatoController())->delete();
        break;
        
    default:
        echo "404 - Página não encontrada.";
        break;
}
