<?php


namespace App\Domain\User;

use App\Domain\User\Exception\InvalidCategoryException;

/**
 * Class Category
 * @package App\Domain\User
 */
class Category
{
    const USER = 'user';
    const SHOPMAN = 'shopman';

    /**
     * @var string
     */
    private string $category;

    /**
     * Category constructor.
     * @param string $category
     */
    public function __construct(string $category)
    {
        if (!($category == self::USER || $category == self::SHOPMAN)) {
            throw new InvalidCategoryException($category);
        }

        $this->category = $category;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->category;
    }
}
