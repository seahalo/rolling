<?php 

require_once("RLValidate.php");


require_once("RLHeader.php");
require_once("RLFooter.php");
require_once("RLNavigatorView.php");
require_once("RLContentAreaView.php");
require_once("RLQuickUserQueryView.php");
require_once("RLUserListView.php");

require_once("model/RLDB.php");
require_once("model/RLUser.php");

$page_title = 'Control Panel';
$header = new RLHeader();
$header->setIncludeCSS(true);
$header->setIncludeScript(true);
$html = $header->display($page_title);

assert(RLContext::instance()->getActiveUser()->isValidUser());

$navigatorView = new RLNavigatorView();
$html .= $navigatorView->display();

// Create content area
$contentAreaView = new RLContentAreaView();

$html .= $contentAreaView->display();


$html .= RLFooter::display();

echo $html;

?>