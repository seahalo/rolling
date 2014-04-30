<?php 
require_once("../RLValidate.php");

require_once("../RLIView.php");

require_once("../model/RLDB.php");
require_once("../model/RLUser.php");

if (isset($_POST['user_region']))
{
  $user_region= $_POST['user_region'];
  
  $sql = "SELECT user_id,user_name,region,user_group from users WHERE region='$user_region'";
  $stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
  //$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
  //$stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);

  $stmt->execute();

          $html_rows = " ";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $user_id = $row['user_id'] ;
            $user_name = $row['user_name'] ;
            $region = $row['region'];
            $user_group = $row['user_group'];
            $html_rows .= <<<EOF
            <tr>
                <td>$user_id</td> 
                <td>$user_name</td>
                <td>$region</td>
                <td>$user_group</td>
                <td class="update"> <a href="RLUpdateUser.php?id={$user_id}"> Update </a> </td>
           </tr>
EOF;
        }

        
        $form = <<<EOF
        <form>
        
        <fieldset> 
        <legend>User List</legend>
        <table>
           <thead>
            <tr>
                <th>{$RL__('User Name')}</th>
                <th>{$RL__('User ID')}</th>
                <th>{$RL__('User Region')}</th>
                <th>{$RL__('User Group')}</th>
                <th>{$RL__('Update')}</th>
            </tr>
          </thead>
          <tbody>
            $html_rows
          </tbody>
        </table>
        </fieldset>
        
        </form>
EOF;

           echo $form;
  }




