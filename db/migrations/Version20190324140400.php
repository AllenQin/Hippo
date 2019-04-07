<?php

declare(strict_types=1);

namespace db\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190324140400 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'create Article table';
    }

    private $table = 'articles';

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable($this->table);

        $table->addColumn('id', 'integer')
            ->setUnsigned(true)
            ->setAutoincrement(true);

        $table->addColumn('title', 'string')
            ->setNotnull(true)
            ->setLength(40)
            ->setDefault('')
            ->setComment('article title');

        $table->addColumn('content', 'text')
            ->setNotnull(true)
            ->setDefault('')
            ->setComment('article content');

        $table->addColumn('author_id', 'integer')
            ->setNotnull(true)
            ->setUnsigned(true)
            ->setDefault(0)
            ->setComment('article author uid');

        $table->addColumn('status', 'tinyint')
            ->setLength(1)
            ->setNotnull(true)
            ->setDefault(0)
            ->setComment('article status 0:pending 1:publish 2:deleted');

        $table->addColumn('created_at', 'integer')
            ->setUnsigned(true)
            ->setDefault(0)
            ->setComment('create unix timestamp');

        $table->addColumn('updated_at', 'integer')
            ->setUnsigned(true)
            ->setDefault(0)
            ->setComment('last update unix timestamp');

        $table->setPrimaryKey(['id']);

        $table->addIndex(['title'], 'idx_title');
        $table->addIndex(['author_id'], 'idx_author_id');

        $table->addOption('charset', 'utf8');
        $table->addOption('comment', 'user article table');
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable($this->table)) {
            $schema->dropTable($this->table);
        }
    }
}
