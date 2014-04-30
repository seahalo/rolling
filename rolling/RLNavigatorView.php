<?php 

require_once("RLValidate.php");

require_once("RLIView.php");

// This view is a sub section of view and it does not contain any 
// header, footer content.

// Display a list of menu items for major work items.
//

class RLNavigatorView extends RLIView
{
    public function __construct()
    {
    }
    
    public function display()
    {
    	global $RL__;
    	
        $navigatorItemAdmin= " ";

        $user = RLContext::instance()->getActiveUser();
        
        if($user->isAdministrator())
        {
            $navigatorItemAdmin =<<<EOF
                <li><a href="RLAdminPanel.php">{$RL__('Account Control')}</a></li>
EOF;
        }
        
        $content =<<<EOF
<div>
    <ul class="main_menu">
        <li class="user_id"> {$user->userName()} </li>
        <li><a href="RLWorkspace.php">{$RL__('Work Area')}</a></li>
        <li><a href="RLNewPackageView.php">{$RL__('New Record')}</a></li>
        $navigatorItemAdmin
        <li><a href="RLLogout.php">{$RL__('Logout')}</a></li>
    </ul>
</div>
EOF;
        return $content;
    }
}

?>
