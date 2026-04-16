<?php
namespace Models;

class User extends Model {
    protected static string $table = "users";
    protected static string $idColumn = "id";
    protected static array $columns = ["id", "name"];
}
