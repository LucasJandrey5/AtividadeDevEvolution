<?php 

namespace App\models;

use App\controllers\AbstractCrud;

class User extends AbstractCrud {

    private string $tabela = 'usuarios';
    private array $colunas = [
        'id',
        'nome',
        'email',
        'senha',
        'criado_em',
    ];

    public function getColunas():array {
        return $this->colunas;
    }   

    public function getTabela(): string {
        return $this->tabela;
    }

    

}