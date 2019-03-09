<?php

declare(strict_types=1);

namespace db\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * create user table
 *
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190309110209 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'create user table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('users');

        $table->addColumn('id', 'integer')
            ->setUnsigned(true)
            ->setAutoincrement(true);

        $table->addColumn('username', 'string')
            ->setLength(11)
            ->setNotnull(true)
            ->setDefault('')
            ->setComment('user name');

        $table->addColumn('nickname', 'string')
            ->setLength(30)
            ->setDefault('')
            ->setComment('user nickname');

        $table->addColumn('password', 'string')
            ->setLength(32)
            ->setNotnull(true)
            ->setDefault('')
            ->setComment('user password');

        $table->addColumn('token', 'string')
            ->setLength(50)
            ->setNotnull(true)
            ->setDefault('')
            ->setComment('user access token');

        $table->addColumn('status', 'tinyint')
            ->setLength(1)
            ->setNotnull(true)
            ->setDefault(0)
            ->setComment('user status 0:inactivated 1:activated 2:freeze');

        $table->addColumn('created_at', 'integer')
            ->setUnsigned(true)
            ->setDefault(0)
            ->setComment('create unix timestamp');

        $table->addColumn('updated_at', 'integer')
            ->setUnsigned(true)
            ->setDefault(0)
            ->setComment('last update unix timestamp');

        $table->setPrimaryKey(['id']);
        $table->addIndex(['username'], 'idx_username');
        $table->addIndex(['token'], 'idx_token');

        $table->addOption('charset', 'utf8');
        $table->addOption('comment', 'user table');

    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('users')) {
            $schema->dropTable('users');
        }
    }
}
