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

	$deliver_time = strtotime(mysqli_real_escape_string($dbc, trim($_POST['delivery_time'])));

	$deliver_fee = mysqli_real_escape_string($dbc, trim($_POST['delivery_fee']));

	$package_type = mysqli_real_escape_string($dbc, trim($_POST['package_type']));

	$courier_fee = mysqli_real_escape_string($dbc, trim($_POST['courier_fee']));

	$misc= mysqli_real_escape_string($dbc, trim($_POST['misc']));

	$ret=false;

	if (!empty($pkgID) && !empty($pkgSrc) && !empty($pkgDest))   {
		// Initialize DB connection


		$sql = "SELECT PACKAGE_ID FROM packages WHERE PACKAGE_ID='$pkgID'";
		$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
		$stmt->execute();
		if( $stmt->rowCount()==0)
		{
			try
			{
				$sql = "INSERT INTO packages (package_id, package_from, package_to, deliver_fee, courier_fee, deliver_time, misc)
				VALUES ('$pkgID', '$pkgSrc', '$pkgDest', '$deliver_fee', '$courier_fee', '$deliver_time', '$misc')";
				$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
				//$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
				//$stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
				$stmt->execute();

				echo '<p>' . RL__('Execution is successful') .'</p>';

				echo '<table>';
				echo
				'<tr>' .
				'<td>' . $pkgID . '</td>' .
				'<td>' . $pkgSrc . '</td>' .
				'<td>' . $pkgDest . '</td>' .
				'</tr>';
				echo '</table>';

			}
			catch(PDOException $e)
			{
				echo '<p>Failed.</p>';
				echo '<p> Error'.$e->getMessage().'</p>';
			}
		}
		else
		{
			echo "<p>$pkgID {$RL__('already existed')}</p>";
		}
	}


	echo "<p>" . RL__('Back to') . "<a href=\"RLWorkspace.php\">". RL__('Work Area') . '</a> </p>';

}
?>