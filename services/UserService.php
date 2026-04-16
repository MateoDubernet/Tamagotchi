<?php
namespace Services;

use Models\User;
use Database\Database;

class UserService {

    public static function exists(string $username): bool {
        return User::getByName($username) !== null;
    }

    public static function create(string $username): User {
        $user = new User();
        $user->name = $username;
        $user->insert();
        return $user;
    }

    public static function getById(int $id): ?User {
        return User::getById($id);
    }

    public static function getByName(string $username): ?User {
        return User::getByName($username);
    }
}
