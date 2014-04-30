<?php

    require_once("../RLValidateAdmin.php");

    require_once("../model/RLDB.php");
    require_once("../model/RLUser.php");

    if (isset($_POST['user_name'])) {

        // Connect to the database 
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  $user_name = mysqli_real_escape_string($dbc, trim($_POST['user_name']));

  $user_password = mysqli_real_escape_string($dbc, trim($_POST['user_password']));

  $user_region = mysqli_real_escape_string($dbc, trim($_POST['user_region']));
  
  $user_group = mysqli_real_escape_string($dbc, trim($_POST['user_group']));
  
  $ret=false;
  
  if (!empty($user_name) && !empty($user_password) && !empty($user_region) && !empty($user_group))   {
        // Initialize DB connection
        $sql = "SELECT user_id FROM users WHERE user_name='$user_name'";
        $stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
        $stmt->execute();
        if( $stmt->rowCount()==0)
        {
            try
            {
                $sql = "INSERT INTO users (user_name, password, user_region, user_group)" .
                    "VALUES ('$user_name', SHA('$user_password'), '$user_region', '$user_group')";
                $stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
                //$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
                //$stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
                $stmt->execute();
                
                echo '<p>' . RL__('Execution is successful') .'</p>';

                echo '<table>';
  echo
    '<tr>' .
  
    '<td>' . $user_name. '</td>' . 
    '<td>' . $user_region . '</td>' .
    '<td>' . $user_group . '</td>' . 
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
        	echo "<p>$user_name {$RL__('already existed')}</p>";
        }
  }

}
?>