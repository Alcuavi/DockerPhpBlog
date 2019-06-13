<?php
namespace App\controllers;
use App\services\UsersService;
use App\services\PostsService;
use App\DoctrineManager;
use App\models\entities\Post;

class PostController extends ControllerAuth
{

 public function index(){
      $this->viewManager->renderTemplate('form-post.view.html', ['user'=>$this->user->email]);
 }

 public function create(DoctrineManager $doctrine){
    $title = $_POST['title'];
    $body= $_POST['body'];
    $idUser = $this->user->id;

    $post = new Post();
    $post->title = $title;
    $post->body= $body;
    $post->idUser = $idUser;
    $doctrine->em->persist($post);
    $doctrine->em->flush();
    $this->redirectTo('dashboard');
    
}

    public function delete($id){
        $postService = $this->container->get(PostsService::class);
        try{
        $postService->deletePostUserById($this->user->id, $id);
        $this->redirectTo('dashboard');    
        } catch(\Exception $e) 
        {
            $this->logger->error($e->getMessage());
            $this->redirectTo('dashboard');
        }
        
    }

    public function edit($id){
        $postService =$this->container->get(PostsService::class);
        try{
         $post = $postService-> getPostUserById($this->user->id, $id);
        $this->viewManager->renderTemplate('edit-post.view.html',['post'=>$post,'user'=>$this->user->email]);
        } catch( \Exception $e)
        {
            $this->logger->error($e->getMessage());
        }
    }

    public function update($id){
        $postService =$this->container->get(PostsService::class);
        try{
         $post = $postService-> getPostUserById($this->user->id, $id);
     
         $title = $_POST['title'];
         $body= $_POST['body'];
         $post->title = $title;
         $post->body= $body;
        $postService->pullPostUserById($this->user->id, $post);
        $this->redirectTo('dashboard');
        }catch (\Exception $e){
            $this->logger->error($e->getMessage());
        }
    }
}