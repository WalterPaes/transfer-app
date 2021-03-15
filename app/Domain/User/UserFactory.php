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
     * @param string|null $password
     * @return User
     */
    public static function create(array $data, string $password = ""): User
    {
        $category = $data['category'];
        if (!($category == Category::USER || $category == Category::SHOPMAN)) {
            throw new InvalidCategoryException($category);
        }

        $name = $data['name'];
        $userCpf = new CPF($data['cpf']);
        $userEmail = new Email($data['email']);

        $wallet = isset($data['wallet']) ? $data['wallet'] : 0;
        $userWallet = new Wallet($wallet);

        if ($category == Category::SHOPMAN) {
            return new ShopmanUser($name, $userCpf, $userEmail, $userWallet, $password);
        }
        return new CommonUser($name, $userCpf, $userEmail, $userWallet, $password);
    }

    public static function createWithId(int $id, array $data, string $password = ""): User
    {
        $user = self::create($data, $password);
        $user->setId($id);
        return $user;
    }
}
