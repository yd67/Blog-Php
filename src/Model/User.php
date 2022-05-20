<?php

namespace App\Model ;

use App\Db\Database ;
use \PDO ;

class User extends Database
{

    public function newUser($name,$firstName,$role,$email,$password,$image)
    {
        $pdo = $this->getPdo();

        $sql = "INSERT INTO user (name, firstName,role,email,password,image) VALUES (:name, :firstName,:role,:email,:password,:image)";

        $req = $pdo->prepare($sql);
        $req->bindParam(':name', $name,PDO::PARAM_STR);
        $req->bindParam(':firstName', $firstName,PDO::PARAM_STR);
        $req->bindParam(':role', $role,PDO::PARAM_STR);
        $req->bindParam(':email', $email,PDO::PARAM_STR);
        $req->bindParam(':password', $password,PDO::PARAM_STR);
        $req->bindParam(':image', $image,PDO::PARAM_STR);

        $req->execute();
    }

    
}