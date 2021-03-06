<?php

namespace App\Db;

use PDO;

class Database 
{
    private $db_host = 'localhost';
    private $db_user = 'root' ;
    private $db_pass = '' ;
    private $db_name = '01Blogoc';
    private $pdo ;

    public function getPdo() 
    {
        if ($this->pdo === null ) {
            $this->pdo = new PDO(
                'mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8',
                $this->db_user ,$this->db_pass,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return $this->pdo ;
    }

    public function pdoQuery($query)
    {
        $pdo = $this->getPdo();

        $request = $pdo->prepare($query);
        $request->execute();
        $result = $request->fetchAll();
        
        return $result ;
    }

}
