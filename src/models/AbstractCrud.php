<?php

namespace App\models;

use App\services\DB;
use PDOException;

abstract class AbstractCrud
{

    abstract public function getTabela(): string;

    abstract public function getColunas(): array;

    public function get($id): array
    {
        $tabela = $this->getTabela();
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT * FROM {$tabela} where id = {$id}");
        $stmt->execute();

        $registros = $stmt->fetch();
        return $registros;
    }


    public function listar($filtro=0): array
    {
        $tabela = $this->getTabela();
        $sql = "SELECT * FROM  {$tabela}";
        if (isset($filtro) && $filtro > 0) {
            $sql = $sql . " WHERE prioridade = {$filtro}";
        }
        

        $db = DB::conectar();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $registros = $stmt->fetchAll();
        return $registros;
    }

    public function criar(array $dados): bool
    {
        $tabela = $this->getTabela();
        $db = null; // Inicializa a conexão como nula

        try {
            $db = DB::conectar(); // Conecta ao banco de dados

            $colunasParaInserir = array_keys($dados);

            $colunasSql = implode(", ", $colunasParaInserir);

            $placeholders = implode(", ", array_map(function ($coluna) {
                return ":{$coluna}";
            }, $colunasParaInserir));

            $sql = "INSERT INTO {$tabela} ({$colunasSql}) VALUES ({$placeholders})";

            $stmt = $db->prepare($sql);
            $sucesso = $stmt->execute($dados); // Executa a consulta, passando os dados diretamente

            // Apenas para fins de depuração, o echo pode ser removido em produção
            echo "Executando CREATE na tabela '{$tabela}' com dados: " . print_r($dados, true) . "\n";

            return $sucesso;
        } catch (PDOException $e) {
            // Lidar com erros de conexão ou consulta
            error_log("Erro ao criar registro na tabela {$tabela}: " . $e->getMessage());
            return false; // Indica falha
        } finally {
            $db = null; // Fecha a conexão
        }
    }


    public function atualizar(int $id, array $dados): bool
    {
        $tabela = $this->getTabela();
        $db = null;

        try {
            $db = DB::conectar();

            $setClauses = [];
            foreach ($dados as $coluna => $valor) {
                if ($coluna !== 'id') {
                    $setClauses[] = "{$coluna} = :{$coluna}";
                }
            }

            if (empty($setClauses)) {
                echo "DEBUG: Nenhum dado válido fornecido para atualização.<br>";
                return false;
            }

            $setSql = implode(", ", $setClauses);


            $sql = "UPDATE {$tabela} SET {$setSql} WHERE id = :id";

            $stmt = $db->prepare($sql);

            // 4. Executa a consulta
            $sucesso = $stmt->execute($dados);

            return $sucesso;
        } catch (PDOException $e) {
            echo "DEBUG: Exceção PDO capturada em atualizar(): " . htmlspecialchars($e->getMessage()) . "<br>";
            error_log("Erro ao atualizar registro na tabela {$tabela} (ID: {$id}): " . $e->getMessage());
            return false; // Indica falha
        } finally {
            $db = null; // Fecha a conexão
            echo "DEBUG: Conexão com o BD fechada após UPDATE.<br>";
        }
    }

    public function deletar(int $id): bool
    {
        $tabela = $this->getTabela();

        try {

            $sql = "DELETE FROM {$tabela} WHERE id = {$id}";
            $db = DB::conectar();
            $stmt = $db->prepare($sql);
            $sucesso = $stmt->execute();
            
            // Apenas para fins de depuração, o echo pode ser removido em produção
            echo "DEBUG: Executando DELETE na tabela '{$tabela}' para o ID: {$id}<br>";
            return $sucesso;
        } catch (PDOException $e) {
            echo "DEBUG: Exceção PDO capturada em atualizar(): " . htmlspecialchars($e->getMessage()) . "<br>";
            error_log("Erro ao atualizar registro na tabela {$tabela} (ID: {$id}): " . $e->getMessage());
            return false; // Indica falha
        }
    }
}
