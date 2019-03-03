<?php

declare(strict_types=1);

namespace db\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303113532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'create user table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('users');
        $table->addColumn('id', 'integer')->setLength(1)->setUnsigned(true)->setAutoincrement(true);
        $table->addColumn('username', 'string')->setNotnull(true)->setDefault('')->setLength(40)
            ->setComment('username');
        $table->addColumn('password', 'string')->setNotnull(true)->setDefault('')->setLength(40)
            ->setComment('user password');
        $table->addColumn('token', 'string')->setDefault('')->setLength(40)->setComment('user access token');
        $table->addColumn('status', 'smallint')->setLength(1)->setUnsigned(true)->setDefault(0)
            ->setComment('user status 0:inactivated 1:normal 2:forbidden');
        $table->addColumn('created_at', 'integer')->setLength(1)->setUnsigned(true)->setDefault(0)
            ->setComment('create unix timestamp');
        $table->addColumn('updated_at', 'integer')->setLength(1)->setUnsigned(true)->setDefault(0)
            ->setComment('last update unix timestamp');

        $table->addOption('comment', 'users record');
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('users')) {
            $schema->dropTable('users');
        }
    }
}
