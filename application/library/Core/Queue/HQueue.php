<?php
namespace App\Library\Core\Queue;

/**
 * Class HQueue
 * @package App\Library\Core\Queue
 */
class HQueue
{
    private $delay;

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
        if ($this->delay > 0) {
            return $this->enqueueJobIn($this->delay, $queue, $job, $arguments);
        } else {
            return \Resque::enqueue($queue, $job, $arguments);
        }
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

    /**
     * 延迟执行任务
     *
     * @param int $delay 单位为秒
     * @param string $queue
     * @param Job $job
     * @param array $arguments
     */
    public function enqueueJobIn($delay, $queue, $job, $arguments)
    {
        $this->delay = 0;
        return \ResqueScheduler::enqueueIn($delay, $queue, $job, $arguments);
    }

    /**
     * 定时执行队列
     *
     * @param int $timeAt 触发执行的时间
     * @param string $queue
     * @param Job $job
     * @param array $arguments
     */
    public function enqueueJobAt($timeAt, $queue, $job, $arguments)
    {
        return \ResqueScheduler::enqueueAt($timeAt, $queue, $job, $arguments);
    }

    /**
     * 链式操作设置延迟
     *
     * @param $delay
     *
     * @return HQueue
     */
    public function delay($delay)
    {
        $this->delay = $delay;
        return $this;
    }
}
