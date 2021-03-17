<?php

use App\Application\Commands\User\RegisterUser\RegisterUserCommand;
use App\Application\Commands\User\RegisterUser\RegisterUserDTO;
use App\Domain\User\Email;
use App\Domain\User\Exception\InvalidCategoryException;
use App\Domain\User\Exception\InvalidCPFException;
use App\Domain\User\Exception\InvalidEmailException;
use App\Infrastructure\User\PasswordHash;
use App\Infrastructure\User\UserInMemoryRepository;

class RegisterUserTest extends TestCase
{
    public function testRegisterNewCommonUser()
    {
        $repository = new UserInMemoryRepository();
        $email = 'email@email.com';
        $category = 'user';
        $dto = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '20505997061',
            'password' => '123456',
            'email' => $email,
            'category' => $category
        ]);

        $command = new RegisterUserCommand(
            $repository,
            new PasswordHash()
        );

        $command->execute($dto);

        $user = $repository->findByEmail(new Email($email));
        $this->assertEquals($user->email(), $email);
        $this->assertEquals($user->category(), $category);
    }

    public function testRegisterNewShopmanUser()
    {
        $repository = new UserInMemoryRepository();
        $email = 'email@email.com';
        $category = 'shopman';
        $dto = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '20505997061',
            'password' => '123456',
            'email' => $email,
            'category' => $category
        ]);

        $command = new RegisterUserCommand(
            $repository,
            new PasswordHash()
        );

        $command->execute($dto);

        $user = $repository->findByEmail(new Email($email));
        $this->assertEquals($user->email(), $email);
        $this->assertEquals($user->category(), $category);
    }

    public function testRegisterNewUserInvalidCategory()
    {
        $this->expectException(InvalidCategoryException::class);

        $dto = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '20505997061',
            'password' => '123456',
            'email' => 'email@email.com',
            'category' => 'category'
        ]);

        $command = new RegisterUserCommand(
            new UserInMemoryRepository(),
            new PasswordHash()
        );

        $command->execute($dto);
    }

    public function testRegisterNewUserInvalidCPF()
    {
        $this->expectException(InvalidCPFException::class);

        $dto = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '2050599706',
            'password' => '123456',
            'email' => 'email@email.com',
            'category' => 'user'
        ]);

        $command = new RegisterUserCommand(
            new UserInMemoryRepository(),
            new PasswordHash()
        );

        $command->execute($dto);
    }

    public function testRegisterNewUserInvalidEmail()
    {
        $this->expectException(InvalidEmailException::class);

        $dto = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '20505997061',
            'password' => '123456',
            'email' => 'emailemail.com',
            'category' => 'user'
        ]);

        $command = new RegisterUserCommand(
            new UserInMemoryRepository(),
            new PasswordHash()
        );

        $command->execute($dto);
    }
}
