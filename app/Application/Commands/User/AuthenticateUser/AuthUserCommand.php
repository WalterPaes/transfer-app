<?php


namespace App\Application\Commands\User\AuthenticateUser;


use App\Domain\User\Email;
use App\Domain\User\Exception\PasswordNotMatchException;
use App\Domain\User\PasswordEncrypt;
use App\Domain\User\UserRepository;

class AuthUserCommand
{
    private UserRepository $repository;
    private PasswordEncrypt $encrypter;

    /**
     * AuthUserCommand constructor.
     * @param UserRepository $repository
     * @param PasswordEncrypt $encrypter
     */
    public function __construct(UserRepository $repository, PasswordEncrypt $encrypter)
    {
        $this->repository = $repository;
        $this->encrypter = $encrypter;
    }

    public function execute(AuthUserDTO $dto)
    {
        $user = $this->repository->findByEmail(
            new Email($dto->email)
        );

        if (!$this->encrypter->check($dto->password, $user->password())) {
            throw new PasswordNotMatchException;
        }
    }
}
