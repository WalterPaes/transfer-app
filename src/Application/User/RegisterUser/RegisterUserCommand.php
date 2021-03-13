<?php

use App\Domain\Encrypt\PasswordEncrypt;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository;

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
            $registerUserDTO->category,
            $this->passwordEncrypt->encrypt($registerUserDTO->password),
            );

        $this->repository->save($user);
    }
}