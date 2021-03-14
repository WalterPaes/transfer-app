<?php

namespace App\Infrastructure\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository;
use Illuminate\Database\ConnectionInterface;

class UserCapsuleRepository implements UserRepository
{
    private ConnectionInterface $db;

    /**
     * UserCapsuleRepository constructor.
     * @param ConnectionInterface $db
     */
    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }


    public function save(User $user): void
    {
        $this->db->table('users')
            ->insert([
                'name' => $user->name(),
                'cpf' => $user->cpf(),
                'email' => $user->email(),
                'category' => $user->category(),
                'password' => $user->password()
            ]);
    }

    public function findById(int $id): User
    {
        $user = $this->db->table('users')
            ->where('id', $id)
            ->first();

        if (empty($user)) {
            throw new UserNotFoundException($id);
        }

        return UserFactory::create(
            $user->name,
            $user->cpf,
            $user->email,
            $user->category
        );
    }
}
