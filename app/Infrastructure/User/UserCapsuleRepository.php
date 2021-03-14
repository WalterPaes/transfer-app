<?php

namespace App\Infrastructure\User;

use App\Domain\User\User;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;

class UserCapsuleRepository implements UserRepository
{
    private DB $connection;

    public function __construct(DB $db)
    {
        $this->connection = $db;
    }

    public function save(User $user): void
    {
        DB::table('users')
            ->insert((array)$user);
    }

    public function findById(int $id): User
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        if (empty($user)) {
            throw new Exception('user not found', 404);
        }

        return UserFactory::create(
            $user->name,
            $user->cpf,
            $user->email,
            $user->category
        );
    }
}
