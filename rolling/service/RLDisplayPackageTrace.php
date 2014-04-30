<?php 

require_once("../RLValidate.php");

require_once("../model/RLDB.php");
require_once("../model/RLUser.php");


global $RL__;

if (isset($_GET['package_id']))
{
	// Initialize DB connection

	$sql = "SELECT packages.package_id package_id, pa.place_name package_from, pb.place_name package_to, delivery_fee deliver_fee,".
			"user_id uid, time_start deliver_time, time_end receive_time ".
			"FROM package_traces traces, packages, places pa, places pb ".
			"WHERE traces.package_id=packages.id and packages.package_id={$_GET['package_id']} and pa.place_id = place_start and pb.place_id = place_end ";
	// $sql = "SELECT * from packages WHERE package_id={$_GET['id']}";
	$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
	$stmt->execute();

	$phpdate = time();
	$receive_time = date( 'Y-m-d H:i:s', $phpdate );

	$html_rows = " ";

	$jsonReturn = array();
		
	$jsonReturn['return'] = 1; //true
	$jsonReturn['columns'] = array(
			RL__('Package ID'),
			
			RL__('Source'),
			RL__('Destination'),
			RL__('Delivery Fee'),
			RL__('Delivery Time'),);
	$jsonReturn['rows'] = array();
		
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$package_id = $row['package_id'] ;
		$package_from = $row['package_from'];
		$package_to = $row['package_to'];
		$deliver_fee = $row['deliver_fee'];
		$deliver_time = date( 'Y-m-d H:i:s', $row['deliver_time'] );

		$jsonReturn['rows'] [] = array(
				$package_id,
				$package_from,
				$package_to,
				$deliver_fee,
				$deliver_time,
		);
	}


	echo json_encode($jsonReturn);
}



?>