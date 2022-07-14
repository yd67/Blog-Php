<?php

namespace App\Tools ;

class superglobals
{
    private $_POST;
    private $_FILES ;

    public function __construct()
    {
        $this->define_superglobals();
    }
   
    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function get_POST($key = null)
    {
        if (null !== $key) {
            return (isset($this->_POST["$key"])) ? $this->_POST["$key"] : null;
        } else {
            return $this->_POST;
        }
    }

     /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function get_FILES($key = null)
    {
        if (null !== $key) {
            return (isset($this->_FILES["$key"])) ? $this->_FILES["$key"] : null;
        } else {
            return $this->_FILES;
        }
    }
   
  
    /**
     * Function to define superglobals for use locally.
     * We do not automatically unset the superglobals after
     * defining them, since they might be used by other code.
     *
     * @return mixed
     */
    private function define_superglobals()
    {

        // Store a local copy of the PHP superglobals
        // This should avoid dealing with the global scope directly
        $this->_POST = (isset($_POST)) ? $_POST : null;
        $this->_FILE = (isset($_FILES)) ? $_FILES : null;

    }
    /**
     * You may call this function from your compositioning root,
     * if you are sure superglobals will not be needed by
     * dependencies or outside of your own code.
     *
     * @return void
     */
    public function unset_superglobals()
    {
        unset($_POST);
        unset($_FILES);
    }

}