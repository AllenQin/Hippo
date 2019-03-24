<?php
namespace App\Services\User;

use App\Library\Core\Service\ServiceWrapper;
use App\Model\Domains\Entity\User;
use App\Model\Domains\Repositories\AbstractRepository;
use App\Model\Domains\Repositories\User\UserRepository;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService extends ServiceWrapper
{
    /**
     * Injection userRepository
     *
     * @var UserRepository AbstractRepository
     */
    protected $userRepository;

    /**
     * UserService constructor
     *
     * @param AbstractRepository $userRepository
     */
    public function __construct(AbstractRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Generate user hash password
     * return a 64-bit string
     *
     * @param string $password
     * @param string $slat
     * @return bool|string
     */
    protected function generatePassword($password, $slat = '')
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verity that the password is correct
     *
     * @param string $password
     * @param string $hash
     * @return bool
     */
    protected function assertPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * Generate user access token
     *
     * @param int $length
     * @return string
     */
    protected function generateToken($length = 64)
    {
        // will generate a 128-bit string
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}