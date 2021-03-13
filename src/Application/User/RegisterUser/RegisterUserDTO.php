<?php

namespace App\Application\User\RegisterUser;

class RegisterUserDTO
{
    public string $name;
    public string $cpf;
    public string $email;
    public string $password;
    public string $category;

    /**
     * RegisterUserDTO constructor.
     * @param string $name
     * @param string $cpf
     * @param string $email
     * @param string $password
     * @param string $category
     */
    public function __construct(string $name, string $cpf, string $email, string $password, string $category)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->password = $password;
        $this->category = $category;
    }


}