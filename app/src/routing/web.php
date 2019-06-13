<?php
namespace App\routing;

use FastRoute\Dispatcher;

class web
{
    public static function getDispatcher(): Dispatcher
    {
        return \FastRoute\simpleDispatcher(
            function (\FastRoute\RouteCollector $route){
                $route->addRoute('GET','/',['App\controllers\HomeController','index']);
                $route->addRoute('GET','/who',['App\controllers\WhoController','index']);
                $route->addRoute('GET','/register',['App\controllers\auth\RegisterController','index']);
                $route->addRoute('POST','/register',['App\controllers\auth\RegisterController','register']);
                $route->addRoute('GET','/login',['App\controllers\auth\LoginController','index']);
                $route->addRoute('POST','/login',['App\controllers\auth\LoginController','login']);
                $route->addRoute('GET','/dashboard',['App\controllers\DashBoardController','index']);
                $route->addRoute('GET','/logout',['App\controllers\auth\LogoutController','index']);
                $route->addRoute('GET','/create-post',['App\controllers\PostController','index']);
                $route->addRoute('POST','/create-post',['App\controllers\PostController','create']);
                $route->addRoute('GET','/delete-post/{id}',['App\controllers\PostController','delete']);
                $route->addRoute('GET','/edit-post/{id}',['App\controllers\PostController','edit']);
                $route->addRoute('POST','/edit-post/{id}',['App\controllers\PostController','update']);
            }
        );
    }
}