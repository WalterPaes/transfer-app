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

    public function name(): string
    {
        return $this->name;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function password(): string
    {
        return $this->password;
    }
}