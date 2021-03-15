<?php

namespace App\Domain\Transaction\Exception;

/**
 * Class NotNotifiedException
 * @package App\Domain\Transaction\Exception
 */
class NotNotifiedException extends \Exception
{
    /**
     * NotNotifiedException constructor.
     */
    public function __construct()
    {
        parent::__construct("The transaction wasn't notify the payee", 500);
    }
}
