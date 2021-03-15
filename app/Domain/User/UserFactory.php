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
     * @param array $personalData
     * @param string $category
     * @param float $balance
     * @return User
     */
    public static function create(array $personalData, string $category, float $balance = 0): User
    {
        if (!($category == Category::USER || $category == Category::SHOPMAN)) {
            throw new InvalidCategoryException($category);
        }

        $name = $personalData['name'];
        $userCpf = new CPF($personalData['cpf']);
        $userEmail = new Email($personalData['email']);
        $userWallet = new Wallet($balance);

        if ($category == Category::SHOPMAN) {
            return new ShopmanUser($name, $userCpf, $userEmail, $userWallet);
        }

        return new CommonUser($name, $userCpf, $userEmail, $userWallet);
    }

    /**
     * @param int $id
     * @param array $personalData
     * @param string $category
     * @param float $balance
     * @return User
     */
    public static function createWithId(int $id, array $personalData, string $category, float $balance = 0): User
    {
        $user = self::create([
            'name' => $personalData['name'],
            'cpf' => $personalData['cpf'],
            'email' => $personalData['email'],
        ],
            $category,
            $balance
        );
        $user->setId($id);
        return $user;
    }
}
