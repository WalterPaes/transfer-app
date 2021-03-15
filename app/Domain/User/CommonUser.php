<?php

namespace App\Domain\User;

use App\Domain\Wallet\Wallet;

/**
 * Class CommonUser
 * @package App\Domain\User
 */
class CommonUser extends User
{
    /**
     * CommonUser constructor.
     * @param string $name
     * @param CPF $cpf
     * @param Email $email
     * @param Wallet $wallet
     */
    public function __construct(string $name, CPF $cpf, Email $email, Wallet $wallet)
    {
        parent::__construct($name, $cpf, $email, $wallet);
        $this->category = new Category(Category::USER);
    }
}
