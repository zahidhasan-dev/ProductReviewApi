<?php

namespace Core;

use PDO;
use PDOException;
use Core\Response;

class Database {
    private $pdo;

    public function __construct($host, $dbname, $username = 'root', $password = '') {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname";

            $this->pdo = new PDO($dsn, $username, $password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            Response::json([
                'status' => 'error',
                "error" => [
                    'code' => 500,
                    'message' => "Connection error: " . $e->getMessage()
                ],
            ], 500);
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}