<?php

namespace App\Infrastructure\User;

use App\Domain\User\Email;
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
    public function saveOrUpdate(User $user): void
    {
        $data = [
            'name' => $user->name(),
            'cpf' => $user->cpf(),
            'email' => $user->email(),
            'category' => $user->category(),
            'password' => $user->password(),
            'wallet' => $user->wallet()->balance()
        ];

        if ((bool)$user->id()) {
            $this->db->table('users')
                ->where('id', $user->id())
                ->update($data);
            return;
        }

        $this->db->table('users')
            ->insert($data);
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
            [
                'name' => $user->name,
                'cpf' => $user->cpf,
                'email' => $user->email,
                'category' => $user->category,
                'wallet' => $user->wallet,
                'password' => $user->password
            ]
        );
    }

    /**
     * @param Email $email
     * @return User
     */
    public function findByEmail(Email $email): User
    {
        $user = $this->db->table('users')
            ->where('email', $email->mail())
            ->first();

        if (empty($user)) {
            throw new UserNotFoundException(0, $email);
        }

        return UserFactory::createWithId(
            $user->id,
            [
                'name' => $user->name,
                'cpf' => $user->cpf,
                'email' => $user->email,
                'category' => $user->category,
                'wallet' => $user->wallet,
                'password' => $user->password
            ]
        );
    }
}
