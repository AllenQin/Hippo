<?php
namespace App\Library\Core\Database;

Interface DatabaseInterface
{
    public function find($table, $column, $where = []);

    public function findAll($table, $column, $where = []);

    public function insert($table, $data);

    public function update($table, $data, $where);

    public function delete($table, $where);

    public function query($sql);

    // other method
    // ...
}
