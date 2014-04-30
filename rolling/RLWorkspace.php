<?php 

require_once("RLValidate.php");


require_once("RLHeader.php");
require_once("RLFooter.php");
require_once("RLNavigatorView.php");
require_once("RLContentAreaView.php");
require_once("RLQuickQueryPackageView.php");
require_once("RLPackageListView.php");

require_once("model/RLDB.php");
require_once("model/RLUser.php");

$page_title = RL__('WorkArea');
$header = new RLHeader();
$header->setIncludeCSS(true);
$header->setIncludeScript(true);
$html = $header->display($page_title);

assert(RLContext::instance()->getActiveUser()->isValidUser());

$navigatorView = new RLNavigatorView();
$html .= $navigatorView->display();

// Create content area
$contentAreaView = new RLContentAreaView();

// Create fast query view, and add it into content area.
$queryView = new RLQuickQueryPackageView();
$contentAreaView->addView( $queryView );

// Create fast package view form 
$packageListView = new RLPackageListView();
$contentAreaView->addView( $packageListView );

$html .= $contentAreaView->display();


$html .= RLFooter::display();

echo $html;

?>