<?php
require_once('RLCommon.php');

// Start the session
$res=session_start();

if (!isset($_SESSION['user_id'])) 
{
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/RLLogin.php'; 
    header('Location: ' . $home_url); 
}

require_once("model/RLDB.php");
require_once("model/RLUser.php");
require_once("model/RLContext.php");

function initializeContext()
{
    // Create a user instance from session.
    $activeUser = new RLUser($_SESSION['user_name'], $_SESSION['user_id']);
    $activeUser->initialize();

    // Initialize DB connection
    $activeDB = RLDB::instance();
    
    $context = RLContext::instance();
    $context->setActiveDB($activeDB);
    $context->setActiveUser($activeUser);
}

// Since this is only required once, so it is safe.
initializeContext();

$gActiveContext = RLContext::instance();




