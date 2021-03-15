<?php

namespace App\Application\Commands\User\RegisterUser;

/**
 * Class RegisterUserDTO
 * @package App\Application\Commands\User\RegisterUser
 */
class RegisterUserDTO
{
    /**
     * @var mixed|string
     */
    public string $name;
    /**
     * @var mixed|string
     */
    public string $cpf;
    /**
     * @var mixed|string
     */
    public string $email;
    /**
     * @var mixed|string
     */
    public string $password;
    /**
     * @var mixed|string
     */
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
