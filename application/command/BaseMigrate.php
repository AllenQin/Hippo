<?php
namespace Command;

use App\Library\Core\Di\InjectionWareTrait;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
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

    protected function configure()
    {
        $this->setName('migrations:generate')
            ->setDescription('创建数据库迁移脚本');
    }

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

        $configuration = new Configuration($connection);
        $configuration->setName('Doctrine Migrations');
        $configuration->setMigrationsNamespace('db\migrations');
        $configuration->setMigrationsTableName('migrations');
        $configuration->setMigrationsDirectory($config['migrate_db_path']);

        $helperSet = new HelperSet([
            'question' => new QuestionHelper(),
            'db' => new ConnectionHelper($connection),
            new ConfigurationHelper($connection, $configuration),
        ]);

        $cli = ConsoleRunner::createApplication($helperSet);
        try {
            $cli->run();
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }
}
