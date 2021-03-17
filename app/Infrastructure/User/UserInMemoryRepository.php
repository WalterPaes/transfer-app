<?php

namespace App\Infrastructure\User;

use App\Domain\User\Email;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserRepository;

class UserInMemoryRepository implements UserRepository
{
    /**
     * @var array
     */
    private array $users;

    /**
     * UserInMemoryRepository constructor.
     */
    public function __construct()
    {
        $this->users = [];
    }

    /**
     * @param User $user
     */
    public function saveOrUpdate(User $user): void
    {
        if ((bool)$user->id()) {
            $this->users[$user->id() - 1] = $user;
        }
        $this->users[] = $user;
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        return $this->users[$id - 1];
    }

    /**
     * @param Email $email
     * @return User
     */
    public function findByEmail(Email $email): User
    {
        foreach ($this->users as $user) {
            if ($user->email() === $email->mail()) {
                return $user;
            }
        }
        throw new UserNotFoundException(0, $email->mail());
    }
}
