<?php 

require_once("RLValidate.php");

require_once("RLIView.php");

require_once("RLHeader.php");
require_once("RLFooter.php");
require_once("model/RLDB.php");
require_once("model/RLUser.php");

require_once("RLNavigatorView.php");
require_once("RLContentAreaView.php");

class RLNewPackageView extends RLIView
{
	public function __construct()
	{
	}

	public function display()
	{
		
		global $RL__;
		
		$sql = "SELECT place_id, place_name from places";
		$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
		$stmt->execute();

		$placeSelect = " ";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$placeSelect .= "<option value=\"". $row['place_id'] . "\">" . $row['place_name'] . "</option>";
		}

		/*
		 // Initialize DB connection


		$sql = "UPDATE packages SET transfer_id='Rolling'";
		$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
		//$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
		//$stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
		$stmt->execute();

		return "<p>Update is done</p>";
		*/


		/*
		 +-------------------+-------------+------+-----+---------------------+----------------+
		| Field             | Type        | Null | Key | Default             | Extra          |
		+-------------------+-------------+------+-----+---------------------+----------------+
		| id                | int(11)     | NO   | PRI | NULL                | auto_increment |
		| transfer_id       | varchar(32) | NO   |     | NULL                |                |
		| name              | varchar(32) | YES  |     | NULL                |                |
		| source            | varchar(32) | YES  |     | NULL                |                |
		| destination       | varchar(32) | YES  |     | NULL                |                |
		| dispatch_time     | datetime    | YES  |     | NULL                |                |
		| receive_time      | datetime    | YES  |     | 1000-01-01 00:00:00 |                |
		| receiver_name     | varchar(32) | YES  |     | NULL                |                |
		| dispatcher_name   | varchar(32) | YES  |     | NULL                |                |
		| pkg_type          | varchar(32) | YES  |     | NULL                |                |
		| transfer_fee      | float       | YES  |     | NULL                |                |
		| proxy_fee         | float       | YES  |     | NULL                |                |
		| proxy_reduce_fee  | float       | YES  |     | NULL                |                |
		| deliver_final_fee | float       | YES  |     | NULL                |                |
		| deliver_fee_type  | varchar(32) | YES  |     | NULL                |                |
		| telephone         | varchar(32) | YES  |     | NULL                |                |
		| check_deliver_fee | varchar(32) | YES  |     | NULL                |                |
		+-------------------+-------------+------+-----+---------------------+----------------+
		*/
		$phpdate = time();
		$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
		//$phpdate = strtotime( $mysqldate );

		$htmlForm =<<<EOF
        <div>
            <form name="new_query_form">
                <fieldset>  <legend> {$RL__('New Record')} </legend>
                <table>
                <tr>
                <td>
                <label>{$RL__('Package ID')}</label>
                    </td>
                    <td>
                    <input name="package_id" type="text" value=""/>
                    </td>
                    </tr>
                    <tr>
<td>
                    <label>{$RL__('Delivery Time')}</label>
                    </td>
                    <td>
                    <input name="delivery_time" type="text" value="{$mysqldate}"/>
                    </td>
                    </tr>
<tr><td>
                    <label>{$RL__('Package Content')}</label></td>
                    <td>
                    <input name="package_type" type="text" value=""/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <label>{$RL__('Delivery Fee')}</label></td>
                    </td>
                    <td>
                    <input name="delivery_fee" type="text" value="0"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <label>{$RL__('Courier Fee')}</label>
                    </td>
                    <td>
                    <input name="courier_fee" type="text" value="0"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <label>{$RL__('Telephone')}</label>
                    </td>
                    <td>
                    <input name="telephone" type="text" value=""/>
                    </td>
                    </tr>
                    <tr>
                                      <td>
                                        <label>{$RL__('Source')}</label>
                                      </td>
                                      <td>
                                         <select name="package_from">
                                      	     $placeSelect
                                      	 </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <label>{$RL__('Destination')}</label>
                                      </td>
                                      <td>
                                         <select name="package_to">
                                      	     $placeSelect
                                      	 </select>
                                      </td>
                                    </tr>

                    <tr>
                    <td>
                    	<label>{$RL__('Misc')}</label>
                    </td>
                    <td>
                    	<textarea name="misc" rows="2" cols="40">  </textarea>
                    </td></tr>
                    </table>
                    <input name="newpkgrecord" type="button" onclick="newPackage()" value="{$RL__('Submit')}"/>
                 </fieldset>
                <!-- a whole load of form fields -->
            </form>
        </div>

        <div id="packages"> </div>
EOF;
		return $htmlForm;
	}
}



$page_title = 'New Delivery Package';
$header = new RLHeader();
$header->setIncludeCSS(true);
$header->setIncludeScript(true);
$html = $header->display($page_title);


$navigatorView = new RLNavigatorView();
$html .= $navigatorView->display();

// Create content area
$contentAreaView = new RLContentAreaView();

// New package record view
$newPackageView = new RLNewPackageView();
$contentAreaView->addView( $newPackageView);

$html .= $contentAreaView->display();

$html .= RLFooter::display();

echo $html;
?>
