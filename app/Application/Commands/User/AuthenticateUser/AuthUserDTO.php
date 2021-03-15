<?php

namespace App\Application\Commands\User\AuthenticateUser;

class AuthUserDTO
{
    public string $email;
    public string $password;

    /**
     * AuthUserDTO constructor.
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }


}
