<?php

namespace App\Infra\User;

use App\Domain\User\User;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository;

class UserPdoRepository implements UserRepository
{
    private PDO $connection;

    public function __construct(PDO $pdo)
    {
        $this->connection = $pdo;
    }

    public function save(User $user): void
    {
        $sql = 'INSERT INTO users (:name, :cpf, :email, :password, :category)';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue('name', $user->name());
        $stmt->bindValue('cpf', $user->cpf());
        $stmt->bindValue('email', $user->email());
        $stmt->bindValue('password', $user->password());
        $stmt->bindValue('category', $user->category());

        $stmt->execute();
    }

    public function findById(int $id): User
    {
        $sql = 'SELECT name, cpf, email, password, category FROM users WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue('id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return UserFactory::create(
            $result['name'],
            $result['cpf'],
            $result['email'],
            $result['category']
        );
    }
}