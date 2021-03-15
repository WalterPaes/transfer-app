<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidCategoryException;
use App\Domain\Wallet\Wallet;

/**
 * Class UserFactory
 * @package App\Domain\User
 */
class UserFactory
{
    /**
     * @param array $data
     * @param int|null $id
     * @param string|null $password
     * @return User
     */
    public static function create(array $data, int $id = null, string $password = null): User
    {
        $category = $data['category'];
        if (!($category == Category::USER || $category == Category::SHOPMAN)) {
            throw new InvalidCategoryException($category);
        }

        $name = $data['name'];
        $userCpf = new CPF($data['cpf']);
        $userEmail = new Email($data['email']);
        $userWallet = new Wallet($data['balance']);

        if ($category == Category::SHOPMAN) {
            return new ShopmanUser($name, $userCpf, $userEmail, $userWallet, $id, $password);
        }
        return new CommonUser($name, $userCpf, $userEmail, $userWallet, $id, $password);
    }
}
