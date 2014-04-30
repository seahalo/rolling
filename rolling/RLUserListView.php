<?php 
require_once("RLValidate.php");

require_once("RLIView.php");

require_once("model/RLDB.php");
require_once("model/RLUser.php");


// This view is a sub section of view and it does not contain any 
// header, footer content.

// Display a list of menu items for major work items.
//

class RLUserListView extends RLIView
{
    public function __construct()
    {
    }
    
    public function display()
    {
    	global $RL__;

        $sql = "SELECT * from users";
        $stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
        $stmt->execute();
        
        $html_rows = " ";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $user_id = $row['user_id'] ;
            $user_name = $row['user_name'] ;
            $region = $row['user_region'];
            $user_group = $row['user_group'];
            $html_rows .= <<<EOF
            <tr>
                <td>$user_id</td> 
                <td>$user_name</td>
                <td>$region</td>
                <td>$user_group</td>
                <td class="update"> <a href="RLUpdateUserView.php?user_id={$user_id}"> {$RL__('Update')} </a> </td>
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

        return <<<EOF
        <div id="users">
        $form
        </div>
EOF;
    }
}

?>

