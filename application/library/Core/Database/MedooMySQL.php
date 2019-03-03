<?php
namespace App\Library\Core\Database;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Medoo\Medoo;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class MySQL
 *
 * @property EventDispatcher $eventManager
 *
 * @package App\Library\Core\Database
 */
class MedooMySQL implements DatabaseInterface, InjectionWareInterface
{
    use InjectionWareTrait;

    private $dbInstance;

    private $eventManager;

    public function __construct($config)
    {
        $this->dbInstance = new Medoo([
            'database_type' => $config['type'],
            'database_name' => $config['name'],
            'server' => $config['host'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset' => $config['charset'],
            'port' => $config['port'],
            'prefix' => $config['prefix'] ?: '',
        ]);

        $this->eventManager = $this->getDi()->get('eventDispatcher');
    }

    public function find($table, $column, $where = [])
    {
        $result = $this->dbInstance->get($table, $column, $where);
        return $result;
    }

    public function findAll($table, $column, $where = [])
    {
        return $this->dbInstance->select($table, $column, $where);
    }

    public function insert($table, $data)
    {
        return $this->dbInstance->insert($table, $data);
    }

    public function update($table, $data, $where)
    {
        // TODO: Implement update() method.
    }

    public function delete($table, $where)
    {
        // TODO: Implement delete() method.
    }

    public function execute($sql)
    {
        // TODO: Implement query() method.
    }
}
