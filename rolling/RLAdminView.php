<?php 

require_once("RLValidate.php");

require_once("RLIView.php");

// This view is a sub section of view and it does not contain any 
// header, footer content.

// Display a list of menu items for major work items.
//

class RLAdminView extends RLIView
{
    public function __construct()
    {
    }
    
    public function display()
    {
    	global $RL__;
    	
        $navigatorItemAdmin= " ";

        $user = RLContext::instance()->getActiveUser();
        
        $content =<<<EOF
<div>
    <ul class="main_menu admin_menu">
        <li class="user_id"> {$user->userName()} </li>
        <li><a href="RLWorkspace.php"> {$RL__('Work Area')}</a></li>
        <li><a href="RLAdminPanel.php">{$RL__('Account Control')}</a></li>
        <li><a href="RLAdminNewUser.php">{$RL__('New User')}</a></li>
        <li><a href="RLLogout.php">{$RL__('Logout')}</a></li>
    </ul>
</div>
EOF;
        return $content;
    }
}

?>
