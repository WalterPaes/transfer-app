<?php

namespace App\Domain;

/**
 * Class Amount
 * @package App\Domain
 */
class Amount
{
    /**
     * @var float
     */
    private float $amount;

    /**
     * Amount constructor.
     * @param float $amount
     */
    public function __construct(float $amount)
    {
        if ($amount > 0) {
            if (!filter_var($amount, FILTER_VALIDATE_FLOAT)) {
                throw new InvalidAmountException($amount);
            }
        }
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
