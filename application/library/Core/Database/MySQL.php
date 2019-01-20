<?php
namespace App\Library\Core\Database;

use Medoo\Medoo;

class MySQL implements DatabaseInterface
{
    private $dbInstance;

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
    }

    public function find($table, $column, $where = [])
    {
        return $this->dbInstance->get($table, $column, $where);
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

    public function query($sql)
    {
        // TODO: Implement query() method.
    }
}
