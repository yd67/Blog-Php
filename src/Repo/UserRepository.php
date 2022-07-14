<?php 

namespace App\Repo ;

use App\Db\Database;
use PDO;
use App\Model\User;

class UserRepository extends MainRepository
{
    public function createUser(User $user)
    {
        $pdo = $this->getPdo();

        $sql = "INSERT INTO user (name, firstName,role,email,password,image) VALUES (:name, :firstName,:role,:email,:password,:image)";

        $req = $pdo->prepare($sql);
        $req->bindValue(':name', $user->getName(),PDO::PARAM_STR);
        $req->bindValue(':firstName', $user->getFirstName(),PDO::PARAM_STR);
        $req->bindValue(':role', $user->getRole(),PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(),PDO::PARAM_STR);
        $req->bindValue(':password', $user->getPassword(),PDO::PARAM_STR);
        $req->bindValue(':image', $user->getImage(),PDO::PARAM_STR);

        $req->execute();

    }   
 
}
