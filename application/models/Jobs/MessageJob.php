<?php
namespace App\Models\Jobs;

use App\Library\Core\Queue\IJob;
use App\Library\Core\Queue\Job;

/**
 * Class MessageJob
 * @package App\Models\Jobs
 */
class MessageJob extends Job implements IJob
{
    public function perform()
    {
        $this->logger->debug('order placed send msg', [$this->args]);
    }
}
