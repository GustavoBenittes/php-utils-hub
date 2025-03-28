<?php

include 'database/helpers/databaseQueryBuilder.php';
include 'database/helpers/databaseValidator.php';

/**
 * Classe principal que gerencia as operações no banco de dados.
 *  Exemplo de uso:
 *   $db = new DatabaseManager('meu_banco');
 * 
 *    // Criar um registro
 *    $data = [
 *        'username' => 'johndoe',
 *        'email' => 'johndoe@kexample.com',
 *        'password' => '123',
 *    ];
 *    $newUserId = $db->create('users', $data);
 *
 *    // Ler registros com condições
 *    $users = $db->read('tabela','[coluna => valor]', Limite de registros, 'ordenar por', 'ASC');
 *    $users = $db->read('users', ['status' => 'ativo'], 10, 'username', 'ASC');
 *    $users = $db->read('users', ['id' => '1','2','3'], 'username', 'ASC');
 *
 *    // Atualizar um usuário
 *    $db->update('users', ['email' => 'novoemail@kexample.com'], ['id' => 5]);
 *
 *    // Deletar um usuário
 *    $db->delete('users', ['id' => 5]);
 *    $db->delete('users', ['id' => 1,2,3,4,5,6,7,8,9,10]);
 *    $db->delete('users', ['status' => 'inativo']);
 *
 *    // Listar todas as colunas da tabela
 *    $columns = $db->getAllColumns('users');
 **/
class DatabaseManager extends DatabaseValidator {
    public function __construct($dbName) {
        parent::__construct($dbName);
    }

    public function create(string $table, array $data): string|false {
        if (!$this->isValidTable($table)) {
            throw new InvalidArgumentException("Tabela inválida: $table");
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $sql = "INSERT INTO `$table` ($columns) VALUES ($placeholders)";

        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(array_values($data));
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            die("Erro ao inserir dados: " . $e->getMessage());
        }
    }

    public function read(string $table, array $conditions = [], ?int $limit = null, ?string $orderBy = null, string $order = 'ASC'): array {
        if (!$this->isValidTable($table)) {
            throw new InvalidArgumentException("Tabela inválida: $table");
        }

        $query = "SELECT * FROM `$table`";
        $values = [];

        if (!empty($conditions)) {
            $query .= " WHERE " . DatabaseQueryBuilder::buildConditions($conditions, $values);
        }

        if ($orderBy) {
            $query .= " ORDER BY `$orderBy` " . ($order === 'DESC' ? 'DESC' : 'ASC');
        }

        if ($limit !== null) {
            $query .= " LIMIT " . intval($limit);
        }

        $stmt = $this->connection->prepare($query);
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(string $table, array $data, array $conditions) {
        if (!$this->isValidTable($table)) {
            throw new InvalidArgumentException("Tabela inválida: $table");
        }

        $setPart = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));
        $conditionPart = DatabaseQueryBuilder::buildConditions($conditions, $values);

        $sql = "UPDATE `$table` SET $setPart WHERE $conditionPart";
        $stmt = $this->connection->prepare($sql);

        try {
            return $stmt->execute(array_merge(array_values($data), $values));
        } catch (PDOException $e) {
            die("Erro ao atualizar dados: " . $e->getMessage());
        }
    }

    public function delete(string $table, array $conditions) {
        if (!$this->isValidTable($table)) {
            throw new InvalidArgumentException("Tabela inválida: $table");
        }

        $conditionPart = DatabaseQueryBuilder::buildConditions($conditions, $values);
        $sql = "DELETE FROM `$table` WHERE $conditionPart";

        $stmt = $this->connection->prepare($sql);

        try {
            return $stmt->execute($values);
        } catch (PDOException $e) {
            die("Erro ao deletar dados: " . $e->getMessage());
        }
    }

    public function getAllColumns($table) {
        if (!$this->isValidTable($table)) {
            throw new InvalidArgumentException("Tabela inválida: $table");
        }

        $sql = "DESCRIBE `$table`";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}