<?php
namespace App\controllers;
use App\DoctrineManager;
class WhoController extends ControllerAuth
{
    public function index(){
        $this->viewManager->renderTemplate("who.view.html");
    }
}