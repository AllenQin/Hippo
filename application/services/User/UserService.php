<?php
namespace App\Services\User;

use App\Library\Core\Service\ServiceWrapper;
use App\Model\Domains\Entity\User;
use App\Model\Domains\Repositories\AbstractRepository;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService extends ServiceWrapper
{
    /**
     * @var AbstractRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param AbstractRepository $userRepository
     */
    public function __construct(AbstractRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $password
     * @param string $slat
     * @return bool|string
     */
    protected function generatePassword($password, $slat = '')
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    protected function assertPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * @param int $length
     * @return string
     */
    protected function generateToken($length = 64)
    {
        // will generate a 128-bit string
        return bin2hex(openssl_random_pseudo_bytes($length));
    }

    /**
     * @param User $user
     * @return array
     */
    protected function filterSessionSensitive(User $user)
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'nickname' => $user->nickname,
            'status' => (int)$user->status,
        ];
    }
}