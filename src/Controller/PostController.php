<?php

namespace App\Controller ;

use App\Repo\PostRepository;

class PostController extends MainController
{
    public function __construct()
    {
        parent::__construct();

        $this->postRepo = new PostRepository;
    }

    public function index()
    {
        $post = $this->postRepo->getPublished();
          
        $this->twig->display('post/index.html.twig',[
           'post' => $post 
        ]);
    }

    public function details($id)
    {
        $post = $this->postRepo->findBy('post','id',$id);

        
        $this->twig->display('post/details.html.twig',[
           'post' =>$post
        ]);
    }
}