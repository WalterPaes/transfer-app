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
    public function saveOrUpdate(User $user): void;

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User;

    /**
     * @param Email $email
     * @return User
     */
    public function findByEmail(Email $email): User;
}
