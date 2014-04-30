<?php

require_once("../RLValidate.php");

require_once("../model/RLDB.php");
require_once("../model/RLUser.php");

if (isset($_POST['package_id'])) {

	// Connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	$pkgID = mysqli_real_escape_string($dbc, trim($_POST['package_id']));

	$receive_time = strtotime(mysqli_real_escape_string($dbc, trim($_POST['receive_time'])));

	$deliver_final_fee = mysqli_real_escape_string($dbc, trim($_POST['deliver_final_fee']));

	$courier_final_fee = mysqli_real_escape_string($dbc, trim($_POST['courier_final_fee']));

	$misc= mysqli_real_escape_string($dbc, trim($_POST['misc']));


	if (!empty($pkgID))   {
		// Initialize DB connection
		try {

			$sql = "UPDATE packages SET deliver_final_fee='$deliver_final_fee', courier_final_fee='$courier_final_fee',".
					"receive_time='$receive_time', misc='$misc' WHERE package_id='$pkgID'";
			$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			echo '<p>Failed.</p>';
			echo '<p> Error'.$e->getMessage().'</p>';
		}

		echo '<p>' . RL__('Execution is successful') .'</p>';
	}


	echo "<p>" . RL__('Back to') . "<a href=\"RLWorkspace.php\">". RL__('Work Area') . '</a> </p>';


}
?>