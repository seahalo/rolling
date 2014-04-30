<?php

require_once('RLConnectVars.php');

class RLContext
{
    public static function instance()
    {
        static $context;
        if(!isset($context))
            $context = new RLContext();
        return $context;
    } 
    
    public function __construct()
    {
    }

    public function getActiveUser()
    {
        return $this->mActiveUser;
    }
    
    public function setActiveUser($activeUser)
    {
        $this->mActiveUser = $activeUser;
    }
    
    public function getActiveDB()
    {
        return $this->mActiveDB;
    }
    
    public function setActiveDB($activeDB)
    {
        $this->mActiveDB = $activeDB;
    }
    
    protected $mActiveUser;
    protected $mActiveDB;
}
?>
