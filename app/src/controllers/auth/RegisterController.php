<?php
namespace App\controllers\auth;
use  App\DoctrineManager;
use App\models\entities\User;
use App\controllers\ControllerAuth;

class RegisterController extends ControllerAuth
{

    public function index()
    {

       $this->viewManager->renderTemplate('auth\register.view.html');
    }

    public function register(DoctrineManager $doctrine)
    {
        $name = $_POST['name'];
        $email= $_POST['email'];
        $password = $_POST['passwd'];
       
        $user = new User();
        $user->name = $name;
        $user->email= $email;
        $user->password = sha1($password);
        $doctrine->em->persist($user);
        $doctrine->em->flush();
        $this->redirectTo('login');
        
    }
}