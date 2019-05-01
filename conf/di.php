<?php
use Adbar\Dot;
use App\Library\Core\Auth\PolicyService;
use App\Library\Core\Auth\UserIdentity;
use App\Library\Core\Cache\Redis;
use App\Library\Core\Email\Mail;
use App\Library\Core\Email\PHPMailerClient;
use App\Library\Core\Encrypt\JWTService;
use App\Library\Core\Log\LogWrapper;
use App\Library\Core\Queue\HQueue;
use App\Library\Core\Request\RequestService;
use App\Library\Core\Session\RedisStorage;
use App\Library\Core\Session\SessionBag;
use App\Library\Core\Validators\Assert;
use App\Library\Core\Verify\VerifyCsrfToken;
use App\Model\Domains\Entity\User;
use App\Services\User\UserLogoutService;
use App\Services\User\UserSignInService;
use App\Services\User\UserSignUpService;
use GuzzleHttp\Client;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Yaf\Registry;
use App\Library\Core\Cookie\CookieService;
use App\Model\Domains\Repositories\User\UserRepository;

return [
    'config' => function($c) {
        return new Dot(Registry::get('config'));
    },
    'cache' => function($c) {
        return new Redis($c['config']['redis']);
    },
    'redis' => function($c) {
        return new Redis($c['config']['redis']);
    },
    'queue' => function($c) {
        return new HQueue($c['config']['queue']);
    },
    'eventDispatcher' => function($c) {
        return new EventDispatcher();
    },
    'assert' => function($c) {
        return new Assert($c);
    },
    'httpClient' => function($c) {
        return new Client();
    },
    'logger' => function($c) {
        return (new LogWrapper($c))->getLogInstance();
    },
    'sessionBag' => function($c) {
        return SessionBag::getInstance(new RedisStorage($c));
    },
    'cookieSrv' => function($c) {
        return new CookieService($c);
    },
    'jwtSrv' => function($c) {
        return new JWTService($c);
    },
    'userRepository' => function($c) {
        return new UserRepository();
    },
    'userIdentity' => function($c) {
        return new UserIdentity($c);
    },
    'mailSrv' => function($c) {
        // customer send Email class
        return new Mail(new PHPMailerClient($c['config']['mail']));
    },
    'userSignInSrv' => function($c) {
        return new UserSignInService($c['userRepository']);
    },
    'userSignUpSrv' => function($c) {
        return new UserSignUpService($c['userRepository']);
    },
    'userLogoutSrv' => function($c) {
        return new UserLogoutService($c['userRepository']);
    },
    'verifyCsrfToken' => function($c) {
        return new VerifyCsrfToken($c);
    },
    'request' => function($c) {
        return new RequestService($c);
    },
];
