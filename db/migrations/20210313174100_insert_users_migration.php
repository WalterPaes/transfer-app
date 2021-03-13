<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class InsertUsersMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('name', 'string')
            ->addColumn('cpf', 'string', ['limit' => 14])
            ->addColumn('email', 'string')
            ->addColumn('category', 'string')
            ->addColumn('password', 'string')
            ->addIndex(['cpf'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}
