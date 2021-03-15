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
     * @param string $password
     */
    public function __construct(
        string $name,
        CPF $cpf,
        Email $email,
        Wallet $wallet,
        string $password = ""
    )
    {
        parent::__construct($name, $cpf, $email, $wallet, $password);
        $this->category = new Category(Category::SHOPMAN);
    }
}
