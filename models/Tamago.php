<?php
namespace Models;

class Tamago extends Model {
    protected static string $table = "tamago";
    protected static string $idColumn = "id";
    protected static array $columns = [
        "name",
        "niveaux",
        "faim",
        "soif",
        "sommeil",
        "ennui",
        "etat",
        "user_id",
        "actions",
        "born_at",
        "died_at"
    ];

    public static function getByUserId(int $user_id): array {
        $rows = \Database\Database::fetchAll(
            "SELECT * FROM " . static::$table . " WHERE user_id = :user_id",
            ['user_id' => $user_id]
        );
        return array_map(fn($data) => self::hydrate($data), $rows);
    }
}
