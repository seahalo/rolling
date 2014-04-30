<?php

require_once("../RLValidate.php");

require_once("../model/RLDB.php");
require_once("../model/RLUser.php");

if (isset($_POST['package_id'])) {

	// Connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	$pkgID = mysqli_real_escape_string($dbc, trim($_POST['package_id']));

	$pkgSrc = mysqli_real_escape_string($dbc, trim($_POST['package_from']));

	$pkgDest = mysqli_real_escape_string($dbc, trim($_POST['package_to']));

	$delivery_time = strtotime(mysqli_real_escape_string($dbc, trim($_POST['delivery_time'])));

	$delivery_fee = mysqli_real_escape_string($dbc, trim($_POST['delivery_fee']));

	$courier_fee = mysqli_real_escape_string($dbc, trim($_POST['courier_fee']));

	$ret=false;

	if (!empty($pkgID) && !empty($pkgSrc) && !empty($pkgDest))   {
		// Initialize DB connection
		try
		{
				
			$sql =  "INSERT INTO package_traces (package_id, place_start, place_end, delivery_fee, time_start) " .
					"SELECT packages.id, pa.place_id, pb.place_id, $delivery_fee, $delivery_time FROM packages, places pa, places pb ".
					"WHERE packages.package_id='$pkgID' AND pa.place_name='$pkgSrc' AND pb.place_name='$pkgDest'";
				

			$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
			//$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
			//$stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
			$stmt->execute();

			
			$jsonReturn = json_encode(array(
					"result"=>1,
					"package_id"=>$pkgID,
					"sql"=>$sql
					));

			echo $jsonReturn;
		}
		catch(PDOException $e)
		{
			$jsonReturn = json_encode(array(
					"result"=>0,
					"package_id"=>$pkgID,
					"error"=>$e->getMessage(),
					"sql"=>$sql,
			));

			echo $jsonReturn;
		}
	}
}
?>
