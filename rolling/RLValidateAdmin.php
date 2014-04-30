<?php
require_once "RLValidate.php";

if(!RLContext::instance()->getActiveUser()->isAdministrator()) 
{
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/RLWorkspace.php'; 
    header('Location: ' . $home_url); 
}





