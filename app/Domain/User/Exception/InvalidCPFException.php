<?php

namespace App\Domain\User\Exception;

/**
 * Class InvalidCPFException
 * @package App\Domain\User\Exception
 */
class InvalidCPFException extends \InvalidArgumentException
{
    /**
     * InvalidCPFException constructor.
     * @param string $cpf
     */
    public function __construct(string $cpf)
    {
        parent::__construct("The CPF: {$cpf} is invalid", 400);
    }
}
