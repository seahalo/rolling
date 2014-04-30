<?php 

require_once("RLValidate.php");

require_once("RLIView.php");

require_once("RLHeader.php");
require_once("RLFooter.php");
require_once("model/RLDB.php");
require_once("model/RLUser.php");

require_once("RLNavigatorView.php");
require_once("RLContentAreaView.php");

class RLUpdatePackageView extends RLIView
{
	public function __construct()
	{
	}

	public function display()
	{
		global $RL__;

		if (isset($_GET['id']))
		{
			// Initialize DB connection
			
			
			$sql = "SELECT * from packages WHERE package_id={$_GET['id']}";
			$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
			$stmt->execute();

			$phpdate = time();
			$receive_time = date( 'Y-m-d H:i:s', $phpdate );

			$html_rows = " ";
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$package_id = $row['package_id'] ;
				$package_from = $row['package_from'];
				$package_to = $row['package_to'];
				$deliver_fee = $row['deliver_fee'];
				$deliver_time = date( 'Y-m-d H:i:s', $row['deliver_time'] );
				$courier_fee = $row['courier_fee'];

				$htmlForm =<<<EOF
                            <div>
                              <form name="update_query_form">
                                <fieldset>  <legend>{$RL__('Update Delivery Package')} </legend>
                                  <table>
                                    <tr>
                                      <td>
                                        <label>{$RL__('Package ID')}</label>
                                      </td>
                                      <td>
                                        <label name="package_id">$package_id</label>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td>
                                        <label>{$RL__('Delivery Fee')}</label>
                                      </td>
                                      <td>
                                        <label name="deliver_fee">$deliver_fee</label>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <label>{$RL__('Courier Fee')}</label>
                                      </td>
                                      <td>
                                        <label name="courier_fee">$courier_fee</label>
                                      </td>
                                    </tr>
                   
                                    <tr>
                                      <td>
                                        <label>{$RL__('Source')}</label>
                                      </td>
                                      <td>
                                        <label name="package_from">$package_from</label>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <label>{$RL__('Destination')}</label>
                                      </td>
                                      <td>
                                        <label name="package_to">{$row['package_to']}</label>
                                      </td>
                                    </tr>
                                    
                              <!--
                                    <tr>
                                      <td>
                                        <label>{$RL__('Receive Time')}</label>
                                      </td>
                                      <td>
                                        <input name="receive_time" type="text" value="$receive_time"/>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <label>{$RL__('Delivery Final Fee')}</label>
                                      </td>
                                      </td>
                                      <td>
                                        <input name="deliver_final_fee" type="text" value="0" />
                                      </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <label>{$RL__('Courier Final Fee')}</label>
                                        </td>
                                        <td>
                                          <input name="courier_final_fee" type="text" value="0"/>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <label>{$RL__('Misc')}</label>
                                        </td>
                                        <td>
                                          <textarea name="misc" rows="2" cols="40"></textarea>
                                        </td>
                                      </tr>
                              -->
                                    </table>
                              <!--
                                    <input name="updatepkgrecord" type="button" onclick="updatePackage()" value="{$RL__('Submit')}"/>
                              -->
                                  </fieldset>
                                  <!-- a whole load of form fields -->
                                </form>
                              </div>
                              <div id="packages"></div>
EOF;
			}

			return $htmlForm;
		}

	}
}


class RLNewPackageTraceView extends RLIView
{
	public function __construct()
	{
	}

	public function display()
	{
		global $RL__;

		$html_rows = " ";
		
		if (isset($_GET['id']))
		{

			$sql = "SELECT place_id, place_name from places";
			$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
			$stmt->execute();

			$placeSelect = " ";
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$placeSelect .= "<option value=\"". $row['place_id'] . "\">" . $row['place_name'] . "</option>";
			}

			// Initialize DB connection

			$phpdate = time();
			$package_id = $_GET['id'];
			$delivery_time = date( 'Y-m-d H:i:s', $phpdate );

			
				$htmlForm =<<<EOF
                            <div id="new_trace_div">
                              <form name="new_trace_form">
                                <fieldset>  <legend>{$RL__('New Package Trace')} </legend>
                                  <table>
                                    <tr>
                                      <td>
                                        <label>{$RL__('Package ID')}</label>
                                      </td>
                                      <td>
                                        <label name="package_id">$package_id</label>
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
                                        <label>{$RL__('Delivery Time')}</label>
                                      </td>
                                      <td>
                                        <input name="delivery_time" type="text" value="$delivery_time"/>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <label>{$RL__('Delivery Fee')}</label>
                                      </td>
                                      </td>
                                      <td>
                                        <input name="delivery_fee" type="text" value="0" />
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
                                          <label>{$RL__('Misc')}</label>
                                        </td>
                                        <td>
                                          <textarea name="misc" rows="2" cols="10"></textarea>
                                        </td>
                                      </tr>
                                    </table>
                                    <input name="updatepkgrecord" type="button" onclick="newPackageTrace()" value="{$RL__('Submit')}"/>

                                  </fieldset>
                                  <!-- a whole load of form fields -->
                                </form>
                              </div>
                              <div id="packages"></div>
EOF;
		}

		return $htmlForm;

	}
}


class RLDisplayPackageTraceView extends RLIView
{
	public function __construct()
	{
	}

	public function display()
	{
		global $RL__;

		if (isset($_GET['id']))
		{
			// Initialize DB connection

			$sql = "SELECT packages.package_id package_id, pa.place_name package_from, pb.place_name package_to, delivery_fee deliver_fee,".
					"user_id uid, time_start deliver_time, time_end receive_time ".
					"FROM package_traces traces, packages, places pa, places pb ".
					"WHERE traces.package_id=packages.id and packages.package_id={$_GET['id']} and pa.place_id = place_start and pb.place_id = place_end ";
			// $sql = "SELECT * from packages WHERE package_id={$_GET['id']}";
			$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
			$stmt->execute();

			$phpdate = time();
			$receive_time = date( 'Y-m-d H:i:s', $phpdate );

			$html_rows = " ";
				
			$htmlForm =<<<EOF
                 <div id="package_trace_div">
                 <fieldset>  <legend>{$RL__('Display Delivery Package Trace')} </legend>
                                
                         <table id="package_trace_table">
			                 <tr>
			    <th>{$RL__('Package ID')}</th>
			    <th>{$RL__('Delivery Fee')}</th>
			    <th>{$RL__('Source')}</th>
			    <th>{$RL__('Destination')}</th>
			</tr>
EOF;
				
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$package_id = $row['package_id'] ;
				$package_from = $row['package_from'];
				$package_to = $row['package_to'];
				$deliver_fee = $row['deliver_fee'];
				$deliver_time = date( 'Y-m-d H:i:s', $row['deliver_time'] );
				$htmlForm .= <<<EOF
                                    <tr>

                                      <td>
                                        <label name="package_id">$package_id</label>
                                      </td>

                                      
                                      <td>
                                        <label name="deliver_fee">$deliver_fee</label>
                                      </td>

                                    
                                      <td>
                                        <label name="package_from">$package_from</label>
                                      </td>

                                      <td>
                                        <label name="package_to">{$row['package_to']}</label>
                                      </td>

                                      </tr>
EOF;
			}

			$htmlForm .= <<<EOF
			                        </table>
			                        </fieldset>
                              </div>
EOF;
			return $htmlForm;
		}

	}
}


$page_title = RL__('Update Delivery Package');
$header = new RLHeader();
$header->setIncludeCSS(true);
$header->setIncludeScript(true);
$html = $header->display($page_title);


$html .= "<p> <em>" . RLContext::instance()->getActiveUser()->userName() ."</em> </p>";

$navigatorView = new RLNavigatorView();
$html .= $navigatorView->display();

// Create content area
$contentAreaView = new RLContentAreaView();

// Create fast query view, and add it into content area.
$updateView = new RLUpdatePackageView();
$contentAreaView->addView( $updateView );

$newTraceView = new RLNewPackageTraceView();
$contentAreaView->addView( $newTraceView );

$displayTraceView = new RLDisplayPackageTraceView();
$contentAreaView->addView( $displayTraceView );

$html .= $contentAreaView->display();

$html .= RLFooter::display();

echo $html;
?>
