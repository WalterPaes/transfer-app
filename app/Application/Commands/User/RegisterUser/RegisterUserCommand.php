<?php

namespace App\Application\Commands\User\RegisterUser;

use App\Domain\User\PasswordEncrypt;
use App\Domain\User\UserFactory;
use App\Domain\User\UserRepository;
use Exception;

/**
 * Class RegisterUserCommand
 * @package App\Application\Commands\User\RegisterUser
 */
class RegisterUserCommand
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;
    /**
     * @var PasswordEncrypt
     */
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
        $user = UserFactory::create([
            'name' => $registerUserDTO->name,
            'cpf' => $registerUserDTO->cpf,
            'email' => $registerUserDTO->email,
        ],
            $registerUserDTO->category
        );
        $user->setPassword($this->passwordEncrypt->encrypt($registerUserDTO->password));
        $this->repository->save($user);
    }
}
