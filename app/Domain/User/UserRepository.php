<?php

namespace App\Domain\User;

/**
 * Interface UserRepository
 * @package App\Domain\User
 */
interface UserRepository
{
    /**
     * @param User $user
     */
    public function save(User $user): void;

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User;
}
