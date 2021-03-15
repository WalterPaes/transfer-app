<?php

namespace App\Domain\User;

use App\Domain\Wallet\Wallet;

/**
 * Class ShopmanUser
 * @package App\Domain\User
 */
class ShopmanUser extends User
{
    /**
     * ShopmanUser constructor.
     * @param string $name
     * @param CPF $cpf
     * @param Email $email
     * @param Wallet $wallet
     * @param int|null $id
     * @param string|null $password
     */
    public function __construct(
        string $name,
        CPF $cpf,
        Email $email,
        Wallet $wallet,
        int $id = null,
        string $password = null
    )
    {
        parent::__construct($name, $cpf, $email, $wallet, $id, $password);
        $this->category = new Category(Category::SHOPMAN);
    }
}
