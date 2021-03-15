<?php

namespace App\Domain\User;

use App\Domain\Wallet\Wallet;

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
     * @var Wallet
     */
    protected Wallet $wallet;

    /**
     * User constructor.
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
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->wallet = $wallet;
        $this->password = $password;
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
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * @return Wallet
     */
    public function wallet(): Wallet
    {
        return $this->wallet;
    }
}
