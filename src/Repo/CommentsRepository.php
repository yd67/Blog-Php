<?php

namespace App\Repo ;

use PDO;
use App\Model\Comments;

class CommentsRepository extends MainRepository 
{

    public function validateComments($id)
    {
       $sql ="SELECT * FROM comments c INNER JOIN user u on c.user_id = u.id    WHERE `post_id` = {$id} AND `etat` = 1 " ;
        
        $pdo = $this->getPdo();
        $statement = $pdo->query($sql);

        $result = $statement->fetchAll( PDO::FETCH_CLASS, Comments::class ); 
         return $result ;
    }

    public function waitingComment()
    {
        $sql ="SELECT c.id, published_at,c.message,u.email,c.post_id FROM comments c INNER JOIN user u on  u.id = c.user_id WHERE `etat` = 2 " ;
        
        $pdo = $this->getPdo();
        $statement = $pdo->query($sql);

        $result = $statement->fetchAll();
        
         return $result ;
    }

    public function approuveComment($id)
    {
      $pdo = $this->getPdo();
      $req = $pdo->prepare(" UPDATE `comments` SET etat = 1 WHERE id = :id ");

      $req->execute(['id'=>$id]);
    }
}