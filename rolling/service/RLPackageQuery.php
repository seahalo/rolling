<?php 
require_once("../RLValidate.php");

require_once("../RLIView.php");

require_once("../model/RLDB.php");
require_once("../model/RLUser.php");

// Initialize DB connection


if (isset($_POST['deliver_time_start']) && isset($_POST['deliver_time_end'])) {
	$start_time = strtotime($_POST['deliver_time_start']);
	$end_time = strtotime($_POST['deliver_time_end']);

	$sql = "SELECT * from packages WHERE deliver_time>'$start_time' and deliver_time<'$end_time'";
	$stmt = RLContext::instance()->getActiveDB()->getHandler()->prepare($sql);
	//$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
	//$stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);

	$stmt->execute();

	$html_rows = " ";

	$total_deliver_final_fee = 0;
	$total_deliver_fee = 0;

	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		 
		$package_id = $row['package_id'] ;
		$package_from = $row['package_from'];
		$package_to = $row['package_to'];
		$deliver_fee = $row['deliver_fee'];
		$deliver_time = date( 'Y-m-d H:i:s', $row['deliver_time']);
		$deliver_final_fee = $row['deliver_final_fee'];
		$total_deliver_final_fee = $total_deliver_final_fee + $deliver_final_fee;
		$total_deliver_fee = $total_deliver_fee + $deliver_fee;
		$html_rows .= <<<EOF
            <tr>
                <td>$package_id</td>
                <td>$package_from </td>
                <td>$package_to</td>
                <td>$deliver_fee </td>
                <td>{$row['courier_fee']} </td>
                <td>$deliver_final_fee</td>
                <td>{$row['courier_final_fee']} </td>
                <td>$deliver_time</td>
                <td class="update"> <a href="RLUpdatePackageView.php?id={$package_id}"> {$RL__('Update')} </a> </td>
           </tr>
EOF;

	}


	$form = <<<EOF
        <hr/>
        <div class="package_list">

        <ul class="section_menu">
        <li>
             {$RL__('Package List')}
        </li>
          <li >
          <a class="print_link" href="javascript:printPackageList()"> &gt;&gt;Print Preview</a>
          </li>
        </ul>

        <div class="package_content">
        <table>
            <tr>
                <th>{$RL__('Package ID')}</th>
                <th>{$RL__('Source')}</th>
                <th>{$RL__('Destination')}</th>
                <th>{$RL__('Delivery Fee')}</th>
                <th>{$RL__('Delivery Final Fee')}</th>
                <th>{$RL__('Courier Fee')}</th>
                <th>{$RL__('Courier Final Fee')}</th>
                <th>{$RL__('Delivery Time')}</th>
                <th>{$RL__('Update')}</th>
            </tr>
            $html_rows
        </table>
        <p>{$RL__('Total Fee')} $total_deliver_fee </p>
        <p>{$RL__('Actual Total Fee')} $total_deliver_final_fee </p>
        </div>
        </div>
EOF;
             echo $form;
}



