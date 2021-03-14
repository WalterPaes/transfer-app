<?php

namespace App\Domain\User;

/**
 * Class User
 * @package App\Domain\User
 */
abstract class User
{
    /**
     * @var int
     */
    protected int $id;
    /**
     * @var string
     */
    protected string $name;
    /**
     * @var CPF
     */
    protected CPF $cpf;
    /**
     * @var Email
     */
    protected Email $email;
    /**
     * @var Category
     */
    protected Category $category;
    /**
     * @var string
     */
    protected string $password;

    /**
     * User constructor.
     * @param string $name
     * @param CPF $cpf
     * @param Email $email
     */
    public function __construct(string $name, CPF $cpf, Email $email)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isTransferable(): bool
    {
        return $this->category == Category::USER;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function cpf(): string
    {
        return $this->cpf;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function category(): string
    {
        return $this->category;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }
}
