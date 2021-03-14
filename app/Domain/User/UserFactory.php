<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidCategoryException;

class UserFactory
{
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
}
