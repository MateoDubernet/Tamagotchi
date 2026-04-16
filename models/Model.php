<?php
namespace Models;

require_once __DIR__ . '/../vendor/autoload.php';

use Database\Database;
use BadMethodCallException;

abstract class Model {
    protected static string $table = "";
    protected static string $idColumn = "";
    protected static array $columns = [];

    protected array $attributes = [];

    public function __get(string $name) {
        return $this->attributes[$name] ?? null;
    }

    public function __set(string $name, $value): void {
        $this->attributes[$name] = $value;
    }

    public static function getAll(): array {
        $rows = Database::fetchAll("SELECT * FROM " . static::$table);
        return array_map(fn($data) => self::hydrate($data), $rows);
    }

    public static function getById(int $id): ?static {
        $row = Database::fetchOne(
            "SELECT * FROM " . static::$table . " WHERE " . static::$idColumn . " = :id",
            ['id' => $id]
        );
        return $row ? self::hydrate($row) : null;
    }

    public static function getByName(string $name): ?static {
        $row = Database::fetchOne(
            "SELECT * FROM " . static::$table . " WHERE name = :name",
            ['name' => $name]
        );
        return $row ? self::hydrate($row) : null;
    }

    public function insert(): void {
        $placeholders = array_map(fn($c) => ":$c", static::$columns);
        $params = [];
        foreach (static::$columns as $col) {
            $params[$col] = $this->$col ?? null;
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::$table,
            implode(", ", static::$columns),
            implode(", ", $placeholders)
        );

        $this->{static::$idColumn} = Database::insert($sql, $params);
    }

    public function updateAttributes(array $props): void {
        if (empty($props)) return;

        $setParts = [];
        $params = [];
        foreach ($props as $col => $val) {
            if (!in_array($col, static::$columns, true)) {
                throw new BadMethodCallException("Colonne $col inexistante dans " . static::class);
            }
            $setParts[] = "$col = :$col";
            $params[$col] = $val;
            $this->$col = $val;
        }

        $params[static::$idColumn] = $this->{static::$idColumn};

        $sql = sprintf(
            "UPDATE %s SET %s WHERE %s = :%s",
            static::$table,
            implode(", ", $setParts),
            static::$idColumn,
            static::$idColumn
        );

        Database::query($sql, $params);
    }

    public function deleteById(): void {
        if (!$this->{static::$idColumn}) {
            throw new BadMethodCallException("Impossible de supprimer : id manquant");
        }
        Database::query(
            "DELETE FROM " . static::$table . " WHERE " . static::$idColumn . " = :id",
            ['id' => $this->{static::$idColumn}]
        );
    }

    private static function hydrate(array $data): static {
        $obj = new static();
        foreach ($data as $key => $value) {
            $obj->$key = $value;
        }
        return $obj;
    }
}
