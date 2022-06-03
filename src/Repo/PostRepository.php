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

    
    public function update(int $id , $data)
    {
        $sqlReplace = "";
        $i = 1 ;

        foreach ($data as $key => $value) {
            $virgule = "," ;
            if ($i == count($data)) {
                $virgule = "" ;
            }
            $sqlReplace .= "{$key} = :{$key}{$virgule} " ;
            $i++ ;
        }
        $data['id'] = $id ;

        $sql = "UPDATE post SET {$sqlReplace} WHERE id = :id " ;
        $pdo = $this->getPdo();        
        $req = $pdo->prepare($sql);

        $req->execute($data);
    }

    public function delete(int $id)
    {
        $pdo = $this->getPdo();
        $req = $pdo->prepare("DELETE FROM `post` WHERE id = :id ");

        $req->execute(['id'=>$id]);
    }
    
    

}