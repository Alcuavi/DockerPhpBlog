<?php
namespace App\services;
use App\DoctrineManager;
use App\models\entities\Post;
use Kint;
class PostsService
{
    private $repository;
    private $doctrine;
    public function __construct(DoctrineManager $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->repository = $doctrine->em->getRepository(Post::class);

    }
    public function getPosts()
    {
        return $this->repository->findAll();
    }

    public function getPostsByIdUser(int $id)
    {
        return $this->repository->findByIdUser($id);
    }

    public function deletePostUserById(int $idUser, int $idPost)
    {
        $post = $this->repository->find($idPost);
        if(!$post) throw new \Exception("El post no existe");
        if($post->idUser !== $idUser) throw new \Exception("El usuario no tiene permisos");
        $this->doctrine->em->remove($post);
        $this->doctrine->em->flush();
    }

    public function getPostUserById(int $idUser, int $idPost):Post
    {
        $post= $this->repository->find($idPost);
        if(!$post) throw new \Exception("El post no existe");
        if($post->idUser !== $idUser) throw new \Exception("El uusario no tiene permisos para verlo");
        return $post;
    }

    public function pullPostUserById(int $idUser, Post $post):Post
    {
        if($post->idUser !== $idUser) throw new \Exception("El usuario no tiene permisos para modificar");
        $this->doctrine->em->merge($post);
        $this->doctrine->em->flush();
        return $post;
    }
}