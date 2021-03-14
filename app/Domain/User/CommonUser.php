<?php

namespace App\Domain\User;

class CommonUser extends User
{
    public function __construct(string $name, CPF $cpf, Email $email)
    {
        parent::__construct($name, $cpf, $email);
        $this->category = new Category(Category::USER);
    }
}