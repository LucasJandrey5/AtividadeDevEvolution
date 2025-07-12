<?php
require __DIR__ . '/../vendor/autoload.php';

use App\controllers\TarefaController;

$controller = new TarefaController();

$page = $_GET['page'] ?? 'home';


switch ($page) {
    case 'tarefas':
        $controller->listar();
        break;
    case 'criar':
        $controller->criar();
        break;
    case 'editar':
        $controller->criar();
        break;
    case 'salvarTarefa':
        $controller->salvarTarefa();
        break;
    case 'excluir':
        $controller->ExcluirTarefa();
        break;
    case 'home':
    default:
        include __DIR__ . '/../views/home.php';
        break;
}
