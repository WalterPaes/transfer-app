<?php

namespace App\Domain\User;

abstract class User
{
    protected int $id;
    protected string $name;
    protected CPF $cpf;
    protected Email $email;
    protected Category $category;
    protected string $password;

    public function __construct(string $name, CPF $cpf, Email $email)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
    }

    public function isTransferable(): bool
    {
        return $this->category == Category::USER;
    }
}