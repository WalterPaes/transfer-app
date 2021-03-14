<?php

namespace App\Domain\User;

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
     */
    public function __construct(string $name, CPF $cpf, Email $email)
    {
        parent::__construct($name, $cpf, $email);
        $this->category = new Category(Category::USER);
    }
}
