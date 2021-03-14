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
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->cpf = $data['cpf'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->category = $data['category'];
    }


}
