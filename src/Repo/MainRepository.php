<?php 

namespace App\Repo ;

use PDO;
use App\Db\Database;

class MainRepository extends Database
{

    public function findBy(string $table,string $criteria,$value)
    {
        $sql = " SELECT * FROM {$table} WHERE {$criteria} = :{$criteria}";

        $pdo = $this->getPdo();
        $req = $pdo->prepare($sql);
        $req->bindValue($criteria,$value,PDO::PARAM_STR);
        $req->execute();
        
        $class = ucfirst($table);
        $req->setFetchMode(PDO::FETCH_CLASS, $class );

        $result = $req->fetch();

        return $result ;    

    }
}