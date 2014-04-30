<?php 
require_once("../RLValidate.php");

require_once("../RLIView.php");

require_once("../model/RLDB.php");
require_once("../model/RLUser.php");

// Initialize DB connection


if (isset($_POST['query_package_id']))
{
	$package_id= $_POST['query_package_id'];

	$sql = "SELECT * from packages WHERE package_id='$package_id'";
	$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
	//$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
	//$stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);

	$stmt->execute();

	$html_rows = " ";

	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$package_id = $row['package_id'] ;
		$package_from = $row['package_from'];
		$package_to = $row['package_to'];
		$deliver_fee = $row['deliver_fee'];
		$deliver_time = date( 'Y-m-d H:i:s', $row['deliver_time']);
		$html_rows .= <<<EOF
       <tr>
                           <td>$package_id</td>
                           <td>$package_from </td>
                           <td>$package_to</td>
                           <td>$deliver_fee </td>
                           <td>{$row['courier_fee']} </td>
                           <td>$deliver_time</td>
                           <td> <a href="RLUpdatePackageView.php?id={$package_id}"> Update </a> </td>
                         </tr>
EOF;
	}

	echo <<<EOF
                <form>
					<fieldset> <legend>Package List</legend>
 					<table>
						<tr>
						<th>{$RL__('Package ID')}</th>
                        <th>{$RL__('Source')}</th>
                        <th>{$RL__('Destination')}</th>
                        <th>{$RL__('Deliver Fee')}</th>
                        <th>{$RL__('Courier Fee')}</th>
						</tr>
						$html_rows
					</table>
					</fieldset>
				</form>
EOF;
}




