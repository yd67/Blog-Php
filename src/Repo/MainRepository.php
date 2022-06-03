<?php

namespace App\Repo;

use PDO;
use App\Db\Database;

class MainRepository extends Database
{

    public function findBy(string $table, string $criteria, $value)
    {
        $sql = " SELECT * FROM {$table} WHERE {$criteria} = :{$criteria}";

        $pdo = $this->getPdo();
        $req = $pdo->prepare($sql);
        $req->bindValue($criteria, $value, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetch();

        return $result;
    }

    public function create(string $table, $data)
    {
        $sqlReplace1 = "";
        $valeurs = [];
        $q = [];
        $i = 1;

        foreach ($data as $key => $value) {
            $virgule = ",";
            if ($i == count(get_object_vars($data))) {
                $virgule = "";
            }
            $sqlReplace1 .= "{$key}{$virgule} ";
            $q[] = "?";
            $valeurs[] = $value;
            $i++;
        }

        $inter = implode(', ', $q);
        $sql = "INSERT INTO {$table} ( {$sqlReplace1} ) VALUES ( {$inter} )";

        $pdo = $this->getPdo();
        $req = $pdo->prepare($sql);

        $req->execute($valeurs);
    }

}
