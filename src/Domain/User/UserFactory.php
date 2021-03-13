<?php

namespace App\Domain\User;

use Exception;

class UserFactory
{
    public static function create(string $name, string $cpf, string $email, string $category): User
    {
        if (!($category == Category::USER || $category == Category::SHOPMAN)) {
            throw new Exception('invalid user category');
        }

        $userCpf = new CPF($cpf);
        $userEmail = new Email($email);

        if ($category == Category::SHOPMAN) {
            return new ShopmanUser($name, $userCpf, $userEmail);
        }

        return new CommonUser($name, $userCpf, $userEmail);
    }
}