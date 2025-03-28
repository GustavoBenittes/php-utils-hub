<?php 

class DatabaseConnection {
    private $config;
    protected $connection;

    public function __construct($dbName) {
        $this->config = include('../databaseConfig.php');

        if (!isset($this->config[$dbName])) {
            throw new Exception("Configuração para o banco '$dbName' não encontrada.");
        }

        $dbConfig = $this->config[$dbName];
        $dsn = $this->buildDsn($dbConfig);

        try {
            $this->connection = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if (isset($dbConfig['charset'])) {
                $this->connection->exec("SET NAMES '{$dbConfig['charset']}'");
                $this->connection->exec("SET character_set_connection={$dbConfig['charset']}");
                $this->connection->exec("SET character_set_client={$dbConfig['charset']}");
                $this->connection->exec("SET character_set_results={$dbConfig['charset']}");
            }

        } catch (PDOException $e) {
            die("Não foi possível conectar ao banco de dados: " . $e->getMessage());
        }
    }

    // cosntroi dsn com base no tipo do banco
    protected function buildDsn($config) {
        switch ($config['driver']) {
            case 'mysql':
                return "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
            case 'pgsql':
                return "pgsql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
            case 'sqlite':
                return "sqlite:{$config['dbname']}";
                // mais case para mais drivers
            default:
                throw new Exception("Driver de banco de dados desconhecido: " . $config['driver']);
        }
    }
    
    protected function getConnection() {
        return $this->connection;
    }
}