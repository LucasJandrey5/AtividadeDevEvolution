<?php 

namespace App\models;

use App\models\AbstractCrud;

class Tarefa extends AbstractCrud {

    private string $tabela = 'tarefas';
    private array $colunas = [
        'id',
        'user_id',
        'titulo',
        'descricao',
        'prioridade',
    ];

    public function getColunas():array {
        return $this->colunas;
    }   

    public function getTabela(): string {
        return $this->tabela;
    }

}