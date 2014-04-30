<?php
$res=session_start();

require_once("RLCommon.php");

// Enable output buffer
ob_start();

if(!isset($_GET['lang']))
{
	$_SESSION['lang'] = RLLocale::CN;
}
else if( $_GET['lang'] == 'en')
{
	$_SESSION['lang'] = RLLocale::EN;
} else if( $_GET['lang'] == 'cn')
{
	$_SESSION['lang'] = RLLocale::CN;
}

//View
require_once('RLHeader.php');
require_once('RLFooter.php');

//Model
require_once('model/RLUser.php');

// Clear the error message
$error_msg = "";

// Check whether session.user_id is valid or not.
// If it it NULL, 
//     If the post argument is NULL, we needs to output login form.
//         When user submit the user name and password, this page is reloading again.
//     If the post argument is not NULL, we needs
//         Create a user instance with user_name.
//             Setup the connection first.
//             Check the user_name and user_password correct or not.
//         Check user is valid or not.
//         If the user is valid, redirect to workspace.php
//         If the user is invalid, prompt error message, and output login form.
// If it is not NULL, we needs to redirect to workspace.php



$page_title = RL__('Login');

$header = new RLHeader();
$header->setIncludeCSS(true);
$header->setIncludeScript(true);
$html = $header->display($page_title);

if($_SESSION['lang'] == RLLocale::CN )
	$html .= <<<EOF
<div> <p> <a href="RLLogin.php?lang=en">English Version</a> </p> </div>
EOF;
else if ($_SESSION['lang'] == RLLocale::EN )
	$html .= <<<EOF
<div> <p> <a href="RLLogin.php?lang=cn">中文版</a> </p> </div>
EOF;

// If the user isn't logged in, try to log them in
if (!isset($_SESSION['user_id'])) 
{
    if (!isset($_POST['submit'])) 
    {
        // Display the form directly.
        $selfURL = $_SERVER['PHP_SELF'];
        $html .= <<<EOF
        
<form method="post" action="$selfURL">
    <fieldset>
        <legend> {$RL__("Login")} </legend> 
        <label for="user_name">  {$RL__("UserName")}:</label>
        <input type="text" name="user_name" value="" /><br />
        <label for="password"> {$RL__("Password")}:</label> 
        <input type="password" name="password" />
    </fieldset>
    <input type="submit" value="{$RL__("Submit")}" name="submit" >  </>
</form>

EOF;
    }
    else 
    {
        //  User provides the user name and password.
        $user = RLUser::createUser(trim($_POST['user_name']));
        $user->login(trim($_POST['password']));
        if($user->isValidUser())
        {
            // Confirm the successful log-in
            $_SESSION['user_id']=$user->userID();
            $_SESSION['user_name']=$user->userName();
            $_SESSION['user']=$user;
         
            $userName = $_SESSION['user_name'];
            $userID = $_SESSION['user_id'];
	        $html .= <<<EOF
	        <p class="login">{$RL__("Welcome")}, $userName! </p>
	        <p class="login">{$RL__("YourIDIs")} $userID </p>
	        <p class="login"> <a href="RLWorkspace.php"> <em> {$RL__("Continue")} </em> </a> </p> 
	        
EOF;
        }
    }
}
else 
{
	// Confirm the successful log-in
    $userName = $_SESSION['user_name'];
    $userID = $_SESSION['user_id'];
            
	$html .= <<<EOF
	   <p class="login">{$RL__("Welcome")}, $userName! </p>
	   <p class="login">{$RL__("YourIDIs")} $userID </p>
	   <p class="login"> <a href="RLWorkspace.php"> <em> {$RL__("Continue")} </em> </a> </p> 
EOF;
}

$html .= RLFooter::display();
echo $html;
?>
