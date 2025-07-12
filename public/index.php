<?php
require __DIR__ . '/../vendor/autoload.php';

use App\controllers\CriarTabelas;
use App\controllers\TarefaController;
use App\models\Tarefa;
use App\models\User;

require_once __DIR__ . './../src/controllers/TarefaController.php';

// CriarTabelas::usuarios();
// CriarTabelas::tarefas();
// CriarTabelas::reset();
$controller = new TarefaController();

$page = $_GET['page'] ?? 'home';


$tarefas;
$tarefa;

// $user = new User();
// $user->criar([
//     'nome' => 'admin',
//     'email' => 'admin@admin.com',
//     'senha' => 'admin123',
// ]);

// $tarefa = new Tarefa();
// $tarefa->criar([
//     'titulo' => 'Tarefa 1',
//     'descricao' => 'Descrição da tarefa 1',
//     'prioridade' => 2,
//     'user_id' => 1,
// ]);




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
