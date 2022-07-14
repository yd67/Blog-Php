<?php

namespace App\Model ;

class Model
{

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value){
            $method = 'set'.ucfirst($key);
            
            // if setter existe.
            if (method_exists($this, $method)){
                // call the setter.
                $this->$method($value);
            }
        }
        return $this;
    }

}
