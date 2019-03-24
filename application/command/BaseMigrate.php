<?php
namespace Command;

use App\Library\Core\Di\InjectionWareTrait;
use Db\Types\TinyIntType;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Tools\Console\ConsoleRunner;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BaseMigrate extends Command
{
    use InjectionWareTrait;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->config;
        $migrateDbConfig = [
            'driver' => 'pdo_mysql',
            'host' => $config['database']['host'],
            'port' => $config['database']['port'],
            'dbname' => $config['database']['database'],
            'user' => $config['database']['username'],
            'password' => $config['database']['password'],
        ];

        try {
            $connection = DriverManager::getConnection($migrateDbConfig);
        } catch (DBALException $e) {
            echo $e->getMessage();
            exit();
        }

        // register all custom mysql file types
        Type::addType(TinyIntType::TYPENAME, 'db\types\TinyIntType');
        $connection->getDatabasePlatform()->registerDoctrineTypeMapping(TinyIntType::TYPENAME, TinyIntType::TYPENAME);

        $configuration = new Configuration($connection);
        $configuration->setName('Doctrine Migrations');
        $configuration->setMigrationsNamespace('db\migrations');
        $configuration->setMigrationsTableName('migrations');
        $configuration->setMigrationsDirectory($config['migrate_db_path']);
        $configuration->setAllOrNothing(true);

        $helperSet = new HelperSet();
        $helperSet->set(new QuestionHelper(), 'question');
        $helperSet->set(new ConnectionHelper($connection), 'db');
        $helperSet->set(new ConfigurationHelper($connection, $configuration));

        try {
            ConsoleRunner::run($helperSet);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }
}
