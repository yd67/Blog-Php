<?php

namespace App\Repo ;

use App\Db\Database;

class PostRepository extends MainRepository
{

    public function findAll()
    {
       $result =  $this->pdoQuery(" SELECT * FROM post "); 
       return $result ;
    }
    
    

}