<?php
include 'database/internal/databaseConnection.php';
/**
 * Classe responsável por validação de tabelas.
 */
class DatabaseValidator extends DatabaseConnection {
    public function isValidTable($table): bool {
        $sql = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$table]);
        return $stmt->fetchColumn() > 0;
    }
}