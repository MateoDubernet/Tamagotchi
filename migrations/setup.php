<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Database\Database;

// Nom de la base
$databaseName = 'tamagotchi';

// Création de la base via PDO direct
$pdo = new PDO(
    sprintf(
        "mysql:host=%s;port=%s",
        getenv('DB_HOST') ?: 'localhost',
        3306
    ),
    getenv('DB_USER') ?: 'root',
    getenv('DB_PASS') ?: 'root',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
$pdo->exec("CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

// Reconnecter Database sur la nouvelle base
Database::useDatabase($databaseName);

// Fonction générique pour créer une table
function createTable(string $tableName, array $columns, array $constraints = []): void
{
    $colsSql = [];
    foreach ($columns as $col => $type) {
        $colsSql[] = "`$col` $type";
    }

    $sql = "CREATE TABLE IF NOT EXISTS `$tableName` ("
        . implode(", ", $colsSql)
        . (!empty($constraints) ? ", " . implode(", ", $constraints) : "")
        . ")";
    Database::query($sql);
}

// Liste des tables à créer
$tables = [
    'users' => __DIR__ . '/../tables/users.php',
    'tamago' => __DIR__ . '/../tables/tamago.php'
];

// Création des tables
foreach ($tables as $name => $file) {
    $tableConfig = require $file;
    createTable($name, $tableConfig['columns'], $tableConfig['constraints']);
}