<?php

namespace App\Domain\User\Exception;

class InvalidCPFException extends \InvalidArgumentException
{
    public function __construct(string $cpf)
    {
        parent::__construct("The CPF: {$cpf} is invalid", 400);
    }
}
