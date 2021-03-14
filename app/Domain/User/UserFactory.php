<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidCategoryException;

/**
 * Class UserFactory
 * @package App\Domain\User
 */
class UserFactory
{
    /**
     * @param string $name
     * @param string $cpf
     * @param string $email
     * @param string $category
     * @return User
     */
    public static function create(string $name, string $cpf, string $email, string $category): User
    {
        if (!($category == Category::USER || $category == Category::SHOPMAN)) {
            throw new InvalidCategoryException($category);
        }

        $userCpf = new CPF($cpf);
        $userEmail = new Email($email);

        if ($category == Category::SHOPMAN) {
            return new ShopmanUser($name, $userCpf, $userEmail);
        }

        return new CommonUser($name, $userCpf, $userEmail);
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $cpf
     * @param string $email
     * @param string $category
     * @return User
     */
    public static function createWithId(int $id, string $name, string $cpf, string $email, string $category): User
    {
        $user = self::create($name, $cpf, $email, $category);
        $user->setId($id);
        return $user;
    }
}
