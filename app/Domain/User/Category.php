<?php


namespace App\Domain\User;

class Category
{
    const USER = 'user';
    const SHOPMAN = 'shopman';

    private string $category;

    public function __construct(string $category)
    {
        if (!($category == self::USER || $category == self::SHOPMAN)) {
            throw new \Exception('invalid category');
        }

        $this->category = $category;
    }

    public function __toString(): string
    {
        return $this->category;
    }
}