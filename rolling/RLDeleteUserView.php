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
  	
    if (isset($_GET['user_name']))
      {
        $sql = "DELETE FROM users WHERE user_name={$_GET['user_name']}";
        $stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
        $stmt->execute();
        
        return "<p> {$RL__('The user')} {$_GET['user_name']} {$RL__('is deleted')}. </p>";
      }

  }
}

$page_title = 'Delete User';
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
