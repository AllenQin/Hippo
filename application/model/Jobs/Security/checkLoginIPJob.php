<?php
namespace App\Model\Jobs\Security;

use App\Library\Core\Queue\IJob;
use App\Library\Core\Queue\Job;

/**
 * Class LoginIpJob
 *
 * @property string ip
 *
 * @package App\Model\Jobs\Security
 */
class checkLoginIPJob extends Job implements IJob
{
    public function perform()
    {
        $this->logger->debug('check user ip', ['ip' => $this->getArgument('ip')]);
    }
}
