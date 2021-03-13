<?php

namespace App\Application\User\RegisterUser;

use App\Domain\User\PasswordEncrypt;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository;
use Exception;

class RegisterUserCommand
{
    private UserRepository $repository;
    private PasswordEncrypt $passwordEncrypt;

    /**
     * RegisterUserCommand constructor.
     * @param UserRepository $repository
     * @param PasswordEncrypt $passwordEncrypt
     */
    public function __construct(UserRepository $repository, PasswordEncrypt $passwordEncrypt)
    {
        $this->repository = $repository;
        $this->passwordEncrypt = $passwordEncrypt;
    }

    /**
     * @param RegisterUserDTO $registerUserDTO
     * @throws Exception
     */
    public function execute(RegisterUserDTO $registerUserDTO): void
    {
        $user = UserFactory::create(
            $registerUserDTO->name,
            $registerUserDTO->cpf,
            $registerUserDTO->email,
            $registerUserDTO->category
        );
        $user->setPassword($this->passwordEncrypt->encrypt($registerUserDTO->password));
        $this->repository->save($user);
    }
}