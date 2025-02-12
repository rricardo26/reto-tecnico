<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findBy(string $nameField, string|int $valueField): User
    {
        return User::where($nameField, $valueField)->first();
    }
}
