<?php
include 'database/internal/databaseConnection.php';
/**
 * Classe responsável por construir condições SQL dinamicamente.
 */
class DatabaseQueryBuilder {
    public static function buildConditions(array $conditions, array &$values): string {
        $queryParts = [];
        foreach ($conditions as $key => $value) {
            if (is_array($value)) {
                $placeholders = implode(',', array_fill(0, count($value), '?'));
                $queryParts[] = "$key IN ($placeholders)";
                $values = array_merge($values, $value);
            } else {
                $queryParts[] = "$key = ?";
                $values[] = $value;
            }
        }
        return implode(" AND ", $queryParts);
    }
}