<?php

namespace App\Domain\User;

class UserFactory
{
    public static function create(string $name, string $cpf, string $email, string $category)
    {
        $newCpf = new CPF($cpf);
        $newEmail = new Email($email);

        if ($category == Category::USER) {
            return new CommonUser($name, $newCpf, $newEmail);
        }

        if ($category == Category::SHOPMAN) {
            return new ShopmanUser($name, $newCpf, $newEmail);
        }

        throw new \Exception('invalid user category');
    }
}