<?php

use App\Library\Core\Auth\UserIdentity;
use App\Library\Core\MVC\Controller;
use App\Services\User\UserSignInService;
use App\Services\User\UserSignUpService;

/**
 * Class UserController
 *
 * @property UserSignInService $userSignInSrv
 * @property UserSignUpService $userSignUpSrv
 * @property UserIdentity $userIdentity
 */
class UserController extends Controller
{
    /**
     * User SignIn
     */
    public function signInAction()
    {
        $errorMsg = [];
        if ($this->isPost()) {
            $user = $this->userSignInSrv->signIn($this->getPost());
            if ($user) {
                return $this->redirect(['index', 'index']);
            } else {
                $errorMsg = $this->assert->getErrorMessage();
            }
        }

        $this->display('signIn', [
            'errorMsg' => $errorMsg,
            'token' => $this->di->get('verifyCsrfToken')->createToken(),
        ]);
    }

    /**
     * User SignUp
     */
    public function signUpAction()
    {
        $errorMsg = [];
        if ($this->isPost()) {
            $user = $this->userSignUpSrv->signUp($this->getPost(), true);
            if ($user) {
                return $this->redirect('/index/index');
            } else {
                $errorMsg = $this->assert->getErrorMessage();
            }
        }

        $this->display('signUp', [
            'errorMsg' => $errorMsg,
            'token' => $this->di->get('verifyCsrfToken')->createToken(),
        ]);
    }

    /**
     * User Logout
     */
    public function logOutAction()
    {
        $this->userIdentity->logoutUser();
        return $this->redirect('/index/index');
    }
}
