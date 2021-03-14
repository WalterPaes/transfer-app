<?php

namespace App\Infrastructure\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository;
use Illuminate\Database\ConnectionInterface;

/**
 * Class UserCapsuleRepository
 * @package App\Infrastructure\User
 */
class UserCapsuleRepository implements UserRepository
{
    /**
     * @var ConnectionInterface
     */
    private ConnectionInterface $db;

    /**
     * UserCapsuleRepository constructor.
     * @param ConnectionInterface $db
     */
    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    /**
     * @param User $user
     */
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

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        $user = $this->db->table('users')
            ->where('id', $id)
            ->first();

        if (empty($user)) {
            throw new UserNotFoundException($id);
        }

        return UserFactory::createWithId(
            $user->id,
            $user->name,
            $user->cpf,
            $user->email,
            $user->category
        );
    }
}
