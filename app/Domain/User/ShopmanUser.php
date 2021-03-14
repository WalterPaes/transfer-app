<?php

namespace App\Domain\User;

class ShopmanUser extends User
{
    public function __construct(string $name, CPF $cpf, Email $email)
    {
        parent::__construct($name, $cpf, $email);
        $this->category = new Category(Category::SHOPMAN);
    }
}