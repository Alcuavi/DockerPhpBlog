<?php
namespace App\controllers\auth;
use App\controllers\ControllerAuth;

class LogoutController extends ControllerAuth
{
    public function index()
    {
        $this->sessionManager->remove('user');
        $this->redirectTo('login');
    }
}