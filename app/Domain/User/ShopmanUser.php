<?php

namespace App\Domain\User;

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
     */
    public function __construct(string $name, CPF $cpf, Email $email)
    {
        parent::__construct($name, $cpf, $email);
        $this->category = new Category(Category::SHOPMAN);
    }
}
