<?php
date_default_timezone_set('Asia/Manila');

class Database
{
    private $serverName;
    private $database;
    private $uid;
    private $pwd;
    private $conn;

    public function __construct()
    {
        $configPath = __DIR__ . '/../config/config.json';
        $config = json_decode(file_get_contents($configPath), true);

        if ($config === null) {
            die("Failed to load database configuration. Please check JSON file.");
        }

        $this->serverName = $config['serverName'];
        $this->database = $config['database'];
        $this->uid = $config['uid'];
        $this->pwd = $config['pwd'];
    }

    public function connect()
    {
        try {
            $dsn = "sqlsrv:Server={$this->serverName};Database={$this->database}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            // Add SQLSRV-specific encoding option only when the constants are available
            if (defined('PDO::SQLSRV_ATTR_ENCODING') && defined('PDO::SQLSRV_ENCODING_UTF8')) {
                $options[constant('PDO::SQLSRV_ATTR_ENCODING')] = constant('PDO::SQLSRV_ENCODING_UTF8');
            }
            $this->conn = new PDO($dsn, $this->uid, $this->pwd, $options);
            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        if ($this->conn === null) {
            $this->connect();
        }
        return $this->conn;
    }
}