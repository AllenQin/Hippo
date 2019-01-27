<?php
namespace App\Library\Core\Queue;

/**
 * Class HQueue
 * @package App\Library\Core\Queue
 */
class HQueue
{
    public function __construct($config)
    {
        \Resque::setBackend($config['host'] . ':' . $config['port']);
    }

    /**
     * 写入队列
     *
     * @param $queue
     * @param $job
     * @param $arguments
     * @param bool $trackStatus
     * @return string
     */
    public function enqueue($queue, $job, $arguments, $trackStatus = false)
    {
        return \Resque::enqueue($queue, $job, $arguments);
    }

    /**
     * 获取队列任务数量
     *
     * @param $queue
     * @return int
     */
    public function size($queue)
    {
        return \Resque::size($queue);
    }

    /**
     * 查询队列中下一个可用的任务
     *
     * @param $queue
     * @return \Resque_Job
     */
    public function reserve($queue)
    {
        return \Resque::reserve($queue);
    }

    /**
     * 获取所有队列名称
     *
     * @return array
     */
    public function queues()
    {
        return \Resque::queues();
    }
}
