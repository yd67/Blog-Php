<?php

namespace App\Repo ;

use App\Db\Database;
use App\Model\Post;

class PostRepository extends MainRepository
{
    

    /**
     * return array of objet post 
     *
     * @return array 
     */
    public function findAll()
    {
       $result =  $this->pdoQuery(" SELECT * FROM post "); 
       $value = [] ;

       foreach ($result as $r) { 
        $post = new Post();
        $objet =  $post->hydrate($r);
        array_push($value,$objet);
       }
       
       return $value ;
    }

    public function getPublished()
    {
       $result =  $this->pdoQuery(" SELECT * FROM `post` WHERE `isPublished` = true ORDER BY `created_at` DESC "); 
        $value = [] ;

       foreach ($result as $r) { 
        $post = new Post();
        $objet =  $post->hydrate($r);
        array_push($value,$objet);
       }
       
       return $value ;
    }


    public function delete(int $id)
    {
        $pdo = $this->getPdo();
        $req = $pdo->prepare("DELETE FROM `post` WHERE id = :id ");

        $req->execute(['id'=>$id]);
    }   

}

