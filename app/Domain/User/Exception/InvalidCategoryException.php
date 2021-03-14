<?php

namespace App\Domain\User\Exception;

class InvalidCategoryException extends \InvalidArgumentException
{
    public function __construct(string $category)
    {
        parent::__construct("The category '{$category}' is invalid", 400);
    }
}
