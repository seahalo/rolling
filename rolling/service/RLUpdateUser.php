<?php

require_once("../RLValidateAdmin.php");

require_once("../model/RLDB.php");
require_once("../model/RLUser.php");

if (isset($_POST['user_name'])) {

	// Connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	$user_name = mysqli_real_escape_string($dbc, trim($_POST['user_name']));

	$user_region = mysqli_real_escape_string($dbc, trim($_POST['user_region']));

	$user_group = mysqli_real_escape_string($dbc, trim($_POST['user_group']));

	try {
		$sql = "UPDATE users SET user_region='$user_region', user_group='$user_group'".
				"WHERE user_name='$user_name'";
		$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo '<p>Failed.</p>';
		echo '<p> Error'.$e->getMessage().'</p>';
	}

	echo '<p>' . RL__('Execution is successful') .'</p>';

	echo '<table>';
	echo
	'<tr>' .
	'<td>' . $user_name . '</td>' .
	'</tr>';
	echo '</table>';

	echo "<p>" . RL__('Back to') . "<a href=\"RLWorkspace.php\">". RL__('Work Area') . '</a> </p>';
}
?>