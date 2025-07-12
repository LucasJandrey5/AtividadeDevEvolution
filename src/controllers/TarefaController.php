<?php

namespace App\controllers;


use App\models\Tarefa;

class TarefaController
{


    public function listar()
    {

        $filtro = $_GET['filtro_prioridade'];

        $tarefaModel = new Tarefa();
        $tarefas =  $tarefaModel->listar($filtro);
        $tarefa = $tarefas[0];

        include __DIR__ . '../../../views/tarefas.php';
    }

    public function criar()
    {
        $tarefaId = $_GET['id'];

        $tarefa = null;

        if ($tarefaId) {
            $tarefaModel = new Tarefa();
            $tarefa = $tarefaModel->get($tarefaId);
        }

        include __DIR__ . '../../../views/criar_tarefa.php';
    }

    public function salvarTarefa()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            $tarefaModel = new Tarefa();

            $dadosTarefa = [
                'user_id'    => filter_var($_POST['user_id'] ?? null, FILTER_VALIDATE_INT),
                'titulo'     => filter_var($_POST['titulo'] ?? null, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
                'descricao'  => filter_var($_POST['descricao'] ?? null, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
                'prioridade' => filter_var($_POST['prioridade'] ?? null, FILTER_SANITIZE_STRING),
            ];

            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $sucesso = $tarefaModel->atualizar($_POST['id'], $dadosTarefa);
            } else {
                $sucesso = $tarefaModel->criar($dadosTarefa);
            }

            if ($sucesso) {
                echo "DEBUG: Tarefa criada com sucesso! Redirecionando...<br>";
                // Redireciona para a lista de tarefas após o sucesso
                header('Location: index.php?page=tarefas');
                exit(); // É importante chamar exit() após um header('Location')
            } else {
                echo "DEBUG: Falha ao criar a tarefa.<br>";
                // Em um cenário real, você renderizaria uma view de erro ou voltaria ao formulário com mensagens.
                echo "<h1>Erro ao criar tarefa.</h1><p>Por favor, tente novamente.</p>";
            }
        } else {
            echo "DEBUG: Requisição inválida para salvar tarefa (não é POST ou dados vazios).<br>";

            header('Location: index.php?page=criar-tarefa-form'); // Assumindo que você terá um formulário
            exit();
        }
    }

    public function ExcluirTarefa()
    {


        if ($_GET['id']) {
            $tarefaModel = new Tarefa();
            $sucesso = $tarefaModel->deletar($_GET['id']);

            if ($sucesso) {
                header('Location: index.php?page=tarefas');
                exit(); // É importante chamar exit() após um header('Location')
            } else {
                echo "DEBUG: Falha ao criar a tarefa.<br>";
                echo "<h1>Erro ao criar tarefa.</h1><p>Por favor, tente novamente.</p>";
            }
        }
    }
}
