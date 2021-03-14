<?php

namespace App\Domain\User\Exception;

/**
 * Class InvalidCategoryException
 * @package App\Domain\User\Exception
 */
class InvalidCategoryException extends \InvalidArgumentException
{
    /**
     * InvalidCategoryException constructor.
     * @param string $category
     */
    public function __construct(string $category)
    {
        parent::__construct("The category '{$category}' is invalid", 400);
    }
}
