<?php

use App\Application\Commands\Transaction\NotifyTransfer\NotifyTransferCommand;
use App\Application\Commands\Transaction\TransferTransaction\TransferCommand;
use App\Application\Commands\Transaction\TransferTransaction\TransferFacade;
use App\Application\Commands\Transaction\TransferTransaction\TransferTransactionDTO;
use App\Application\Commands\User\RegisterUser\RegisterUserCommand;
use App\Application\Commands\User\RegisterUser\RegisterUserDTO;
use App\Domain\Transaction\Exception\NotNotifiedException;
use App\Domain\Transaction\Exception\UnauthorizedTransactionException;
use App\Domain\User\Email;
use App\Domain\User\Exception\IsNotTransferibleException;
use App\Infrastructure\Transaction\FakeFailNotifier;
use App\Infrastructure\Transaction\FakeFailTransactionAuthorizer;
use App\Infrastructure\Transaction\FakeNotifier;
use App\Infrastructure\Transaction\FakeTransactionAuthorizer;
use App\Infrastructure\Transaction\TransactionInMemoryRepository;
use App\Infrastructure\User\PasswordHash;
use App\Infrastructure\User\UserInMemoryRepository;

class TransferTransactionTest extends TestCase
{
    public function testDoTransferTransaction()
    {
        $userRepository = new UserInMemoryRepository();
        $user = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '20505997061',
            'password' => '123456',
            'email' => 'user@email.com',
            'category' => 'user'
        ]);

        $shopman = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '03125079098',
            'password' => '123456',
            'email' => 'shopman@email.com',
            'category' => 'shopman'
        ]);

        $registerUserCommand = new RegisterUserCommand(
            $userRepository,
            new PasswordHash()
        );

        $registerUserCommand->execute($user);
        $registerUserCommand->execute($shopman);

        $newUser = $userRepository->findByEmail(new Email('user@email.com'));
        $newUser->wallet()->deposit(100.00);

        $dto = new TransferTransactionDTO([
            'value' => 10.00,
            'payee' => 2,
            'payer' => 1
        ]);

        $transferCommand = new TransferCommand(
            new TransactionInMemoryRepository(),
            $userRepository,
            new FakeTransactionAuthorizer()
        );

        $notifyCommand = new NotifyTransferCommand(
            new FakeNotifier()
        );

        $facade = new TransferFacade($transferCommand, $notifyCommand);
        $facade->execute($dto);

        $this->assertEquals($newUser->wallet()->balance(), 100.00 - 10.00);
    }

    public function testTransferTransactionPayerIsNotTransferible()
    {
        $this->expectException(IsNotTransferibleException::class);

        $userRepository = new UserInMemoryRepository();
        $user = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '20505997061',
            'password' => '123456',
            'email' => 'user@email.com',
            'category' => 'user'
        ]);

        $shopman = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '03125079098',
            'password' => '123456',
            'email' => 'shopman@email.com',
            'category' => 'shopman'
        ]);

        $registerUserCommand = new RegisterUserCommand(
            $userRepository,
            new PasswordHash()
        );

        $registerUserCommand->execute($user);
        $registerUserCommand->execute($shopman);

        $newUser = $userRepository->findByEmail(new Email('user@email.com'));
        $newUser->wallet()->deposit(100.00);

        $dto = new TransferTransactionDTO([
            'value' => 10.00,
            'payee' => 1,
            'payer' => 2
        ]);

        $transferCommand = new TransferCommand(
            new TransactionInMemoryRepository(),
            $userRepository,
            new FakeTransactionAuthorizer()
        );

        $notifyCommand = new NotifyTransferCommand(
            new FakeNotifier()
        );

        $facade = new TransferFacade($transferCommand, $notifyCommand);
        $facade->execute($dto);
    }

    public function testTransferTransactionNotAuthorized()
    {
        $this->expectException(UnauthorizedTransactionException::class);

        $userRepository = new UserInMemoryRepository();
        $user = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '20505997061',
            'password' => '123456',
            'email' => 'user@email.com',
            'category' => 'user'
        ]);

        $shopman = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '03125079098',
            'password' => '123456',
            'email' => 'shopman@email.com',
            'category' => 'shopman'
        ]);

        $registerUserCommand = new RegisterUserCommand(
            $userRepository,
            new PasswordHash()
        );

        $registerUserCommand->execute($user);
        $registerUserCommand->execute($shopman);

        $newUser = $userRepository->findByEmail(new Email('user@email.com'));
        $newUser->wallet()->deposit(100.00);

        $dto = new TransferTransactionDTO([
            'value' => 10.00,
            'payee' => 2,
            'payer' => 1
        ]);

        $transferCommand = new TransferCommand(
            new TransactionInMemoryRepository(),
            $userRepository,
            new FakeFailTransactionAuthorizer()
        );

        $notifyCommand = new NotifyTransferCommand(
            new FakeNotifier()
        );

        $facade = new TransferFacade($transferCommand, $notifyCommand);
        $facade->execute($dto);
    }

    public function testTransferTransactionNotNotified()
    {
        $this->expectException(NotNotifiedException::class);

        $userRepository = new UserInMemoryRepository();
        $user = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '20505997061',
            'password' => '123456',
            'email' => 'user@email.com',
            'category' => 'user'
        ]);

        $shopman = new RegisterUserDTO([
            'name' => 'Name',
            'cpf' => '03125079098',
            'password' => '123456',
            'email' => 'shopman@email.com',
            'category' => 'shopman'
        ]);

        $registerUserCommand = new RegisterUserCommand(
            $userRepository,
            new PasswordHash()
        );

        $registerUserCommand->execute($user);
        $registerUserCommand->execute($shopman);

        $newUser = $userRepository->findByEmail(new Email('user@email.com'));
        $newUser->wallet()->deposit(100.00);

        $dto = new TransferTransactionDTO([
            'value' => 10.00,
            'payee' => 2,
            'payer' => 1
        ]);

        $transferCommand = new TransferCommand(
            new TransactionInMemoryRepository(),
            $userRepository,
            new FakeTransactionAuthorizer()
        );

        $notifyCommand = new NotifyTransferCommand(
            new FakeFailNotifier()
        );

        $facade = new TransferFacade($transferCommand, $notifyCommand);
        $facade->execute($dto);
    }
}
