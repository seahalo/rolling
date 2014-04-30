<?php 
require_once("RLValidateAdmin.php");

require_once("RLIView.php");

require_once("RLHeader.php");
require_once("RLFooter.php");
require_once("model/RLDB.php");
require_once("model/RLUser.php");

require_once("RLAdminView.php");
require_once("RLContentAreaView.php");

class RLNewUserView extends RLIView
{
    public function __construct()
    {
    }
    
    public function display()
    {
    	global $RL__;
    	
        $phpdate = time();
        $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
        //$phpdate = strtotime( $mysqldate );

        $htmlForm =<<<EOF
        <div>
            <form>
                <fieldset>  <legend> {$RL__("New User")} </legend>
                <table>
                <tr>
                <td>
                    <label >{$RL__("User Name")}</label> 
                    </td>
                    <td>   
                    <input name="user_name" type="text" value=""/>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
                    <label>{$RL__("User Password")}</label> 
                    </td>
                    <td>   
                    <input type="password" name="user_password" type="text" value=""/>
                    </td>
                    </tr>
                
                    
                    <tr>
						<td>
                    		<label >{$RL__("User Region")}</label>
                    	</td>
                    	<td>  
                    <input name="user_region" type="text" value=""/>
                    </td>
                    </tr>
                    
                    <tr><td>
                    <label>{$RL__("User Group")}</label></td>
                    <td>    
                    <input name="user_group" type="text" value=""/>
                    </td>
                    </tr>
                </table>
                <input name="newUserButton" type="button" onclick="newUser()" value="{$RL__("Submit")}"/>
                 </fieldset>
                <!-- a whole load of form fields -->
            </form>
        </div>
        
        <div id="users"> </div>
EOF;
        return $htmlForm;
    }
}



$page_title = RL__("New User");
$header = new RLHeader();
$header->setIncludeCSS(true);
$header->setIncludeScript(true);
$html = $header->display($page_title);

$html .= "<p> <em>" . RLContext::instance()->getActiveUser()->userName() ."</em> </p>";

$navigatorView = new RLAdminView();
$html .= $navigatorView->display();

// Create content area
$contentAreaView = new RLContentAreaView();

// New package record view
$newPackageView = new RLNewUserView();
$contentAreaView->addView( $newPackageView);

$html .= $contentAreaView->display();

$html .= RLFooter::display();

echo $html;
?>
