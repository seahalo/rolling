<?php 

require_once("RLValidateAdmin.php");

require_once("RLIView.php");

require_once("RLHeader.php");
require_once("RLFooter.php");
require_once("model/RLDB.php");
require_once("model/RLUser.php");

require_once("RLAdminView.php");
require_once("RLContentAreaView.php");

class RLUpdateUserView extends RLIView
{
  public function __construct()
  {
  }
  
  public function display()
  {
  	
  	global $RL__;
  	
    if (isset($_GET['user_id']))
      {
        $sql = "SELECT * from users WHERE user_id={$_GET['user_id']}";
        $stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
        $stmt->execute();
        
        $phpdate = time();
        $receive_time = date( 'Y-m-d H:i:s', $phpdate );
        
        $html_rows = " ";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
          {
            $user_id = $row['user_id'] ;
            $user_name = $row['user_name'];
            $user_region = $row['user_region'];
            $user_group = $row['user_group'];

            $htmlForm =<<<EOF
                            <div>
                              <form>
                                <fieldset>  <legend>{$RL__('Update User Information')}</legend>
                                  <table>
                                    <tr>
                                      <td>
                                        <label>{$RL__('User ID')}</label> 
                                      </td>
                                      <td>   
                                        <label name="user_name">$user_name</label>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td>
                                        <label>{$RL__('User Region')}</label>
                                      </td>
                                      <td>    
                                        <input name="user_region" type="text" value="$user_region"></input>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td>
                                        <label>{$RL__('User Group')}</label>
                                      </td>
                                      <td>    
                                        <input name="user_group" type="text" value="$user_group"></input>
                                      </td>
                                    </tr>
                                    </table>
                                    <input type="button" onclick="updateUser()" value="{$RL__('Submit')}"/>
                                  </fieldset>
                                  
                                  <fieldset>  <legend>{$RL__('Remove the user')}</legend>
                                  <a href="RLDeleteUserView.php?user_name='$user_name'">{$RL__('Submit')}</a>
                                  </fieldset>
                                  <!-- a whole load of form fields -->
                                </form>
                              </div>
                              <div id="users"></div>
EOF;
          }

        return $htmlForm;
      }

  }
}

$page_title = 'Update User';
$header = new RLHeader();
$header->setIncludeCSS(true);
$header->setIncludeScript(true);
$html = $header->display($page_title);

$navigatorView = new RLAdminView();
$html .= $navigatorView->display();

// Create content area
$contentAreaView = new RLContentAreaView();

// Create fast query view, and add it into content area.
$updateView = new RLUpdateUserView();
$contentAreaView->addView( $updateView );

$html .= $contentAreaView->display();

$html .= RLFooter::display();

echo $html;
?>
