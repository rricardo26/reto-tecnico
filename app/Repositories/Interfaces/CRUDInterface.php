<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CRUDInterface
{
    public function getAll(): Collection;
    public function create(array $data): Model;
    public function update(int $id, array $data): bool;
    public function findById(int $id): Model;
    public function deleteById(int $id);
}
