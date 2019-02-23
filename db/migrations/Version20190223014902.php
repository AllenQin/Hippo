<?php

declare(strict_types=1);

namespace db\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190223014902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        /*
        $table = $schema->createTable('posts');
        $table->addColumn('id', 'integer')->setUnsigned(true)->setAutoincrement(true);
        $table->addColumn('name', 'string')->setDefault('')->setLength(20);
        $table->setPrimaryKey(['id']);
        */
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('posts')) {
            $schema->dropTable('posts');
        }
    }
}
