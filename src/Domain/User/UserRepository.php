<?php

namespace App\Domain\User;

interface UserRepository
{
    public function save(User $user): bool;

    public function findById(int $id): User;
}