<?php

use App\Library\Core\MVC\Controller;
use App\Services\User\UserSignInService;
use App\Services\User\UserSignUpService;

class UserController extends Controller
{
    /**
     * User SignIn
     */
    public function signInAction()
    {
        $errorMsg = [];
        if ($this->isPost()) {
            $userSignInSrv = new UserSignInService($this->di->get('userRepository'));
            $user = $userSignInSrv->signIn($this->getPost());

            if ($user) {
                return $this->redirect(['web', 'index', 'index']);
            } else {
                $errorMsg = $this->assert->getErrorMessage();
            }
        }

        $this->display('signIn', ['errorMsg' => $errorMsg]);
    }

    /**
     * User SignUp
     */
    public function signUpAction()
    {
        $errorMsg = [];
        if ($this->isPost()) {
            $userSignUpSrv = new UserSignUpService($this->di->get('userRepository'));
            $user = $userSignUpSrv->signUp($this->getPost(), true);

            if ($user) {
                return $this->redirect('/web/index/index');
            } else {
                $errorMsg = $this->assert->getErrorMessage();
            }
        }

        $this->display('signUp', ['errorMsg' => $errorMsg]);
    }

    /**
     * User Logout
     */
    public function logOutAction()
    {
        $this->userIdentity->logoutUser();
        return $this->redirect('/web/index/index');
    }
}
