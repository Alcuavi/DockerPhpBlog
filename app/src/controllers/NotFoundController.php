<?php
namespace App\controllers;
use App\services\PostsService;
use App\models\entities\Post;

class NotFoundController extends ControllerAuth
{
    public function index(){
        $this->viewManager->renderTemplate("404.view.html",['user'=> (! $this->user)?null: $this->user->email]);
    }
}