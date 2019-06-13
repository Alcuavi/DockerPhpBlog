<?php

namespace App\controllers;
use App\services\UsersService;
use App\services\PostsService;
use Kint;
class DashBoardController extends ControllerAuth
{

    public function index()
    {
        $PostsService = $this->container->get(PostsService::class);
        if (! $this->user) return $this->redirectTo('login');
        $posts = $PostsService->getPostsByIdUser($this->user->id);
        $this->viewManager->renderTemplate('dashboard.view.html',['user'=>$this->user->email,'posts'=>$posts]);
    }
}