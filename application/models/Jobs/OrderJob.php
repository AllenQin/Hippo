<?php
namespace App\Models\Jobs;

use App\Library\Core\Queue\IJob;
use App\Library\Core\Queue\Job;

/**
 * Class OrderJob
 * @package App\Models\Jobs
 */
class OrderJob extends Job implements IJob
{
    public function perform()
    {
        $this->logger->info('order job perform', $this->args);
    }
}
