<?php

namespace App\Domain;

/**
 * Class InvalidAmountException
 * @package App\Domain
 */
class InvalidAmountException extends \InvalidArgumentException
{
    /**
     * InvalidAmountException constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        parent::__construct("'{$value}' is an Invalid Amount Value");
    }
}
