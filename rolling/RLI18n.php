<?php

// Define the internationalization messages.

class RLLocale {
	const EN = 0;
	const CN = 1;
}

$RLMessages = array (
		'Rolling' => array (
				'Rolling',
				'顺风'),

		'Login' => array (
				'Login',
				'登陆'),

		'Logout' => array (
				'Logout',
				'退出系统'),

		'Display Delivery Package Trace' => array (
				'Display Delivery Package Trace',
				'包裹跟踪信息'),

		'Work Area' => array (
				'Work Area',
				'工作区'),

		'UserName' => array (
				'User Name',
				'用户名'),

		'Password' => array (
				'Password',
				'密码'),

		'Submit' => array (
				'Submit',
				'提交'),

		'New Package Trace' => array (
				'New Package Trace',
				'添加跟踪记录'),

		'Welcome' => array (
				'Login sucessful! Welcome',
				'登陆成功! 欢迎您'),

		'Continue'=>array (
				'Click here to continue.',
				'点击此处进入工作区'),

		'YourIDIs'=>array (
				'Your user id is',
				'您的用户编号是'),

		'WorkArea'=>array (
				'Work Area',
				'工作区'),


		'New User'=>array (
				'New User',
				'新建用户'),

		'User Name'=>array (
				'User Name',
				'用户名'),

		'User Password'=>array (
				'User Password',
				'用户密码'),
		'User ID'=>array(
				'User ID',
				'用户编号'),
		'User Group'=>array(
				'User Group',
				'用户组'),

		'User Region'=>array (
				'User Region',
				'用户区域'),

		'User Group'=>array (
				'User Group',
				'用户组'),

		'Admin'=>array (
				'Admin',
				'管理员'),

		'Control Panel'=>array (
				'Control Panel',
				'控制面板'),

		'Account Control'=>array (
				'Account Control',
				'帐号管理'),


		'The user'=>array (
				'The user',
				'用户'),

		'is deleted'=>array (
				'is deleted',
				'已被删除'),

		'New Record'=>array (
				'New Record',
				'新建包裹记录'),

		'Package ID'=>array(
				'Package ID',
				'包裹编号'),

		'Delivery Time'=>array(
				'Delivery Time',
				'发送时间'),

		'Package Content'=>array(
				'Package Content',
				'包裹描述'),
		'Delivery Fee'=>array(
				'Delivery Fee',
				'快递费'),
		'Courier Fee'=>array(
				'Courier Fee',
				'货款'),

		'Delivery Final Fee'=>array(
				'Delivery Final Fee',
				'实收快递费'),
		'Courier Final Fee'=>array(
				'Courier Final Fee',
				'实收货款'),

		'Telephone'=>array(
				'Phone Number',
				'联系电话'),

		'Source'=>array(
				'Source',
				'出发地'),

		'Destination'=>array(
				'Destination',
				'目的地'),

		'Misc'=>array(
				'Misc',
				'其他'),

		'Total Fee'=>array(
				'Total Fee',
				'运费应收合计'),

		'Actual Total Fee'=>array(
				'Actual Total Fee',
				'运费实收合计'),

		'Update'=>array(
				'Update',
				'更新'),

		'Query with delivery date'=>array(
				'Query with delivery date',
				'根据发送日期查询'),
		'Query with package ID'=>array(
				'Query with package ID',
				'根据包裹编号查询'),

		'Query'=>array(
				'Query',
				'查询'),

		'Query with user region'=>array(
				'Query with user region',
				'根据用户区域查询'),
		'Region'=>array(
				'Region',
				'区域'),

		'Package List' => array(
				'Package List',
				'包裹列表'),

		'Update Delivery Package'=>array(
				'Update Delivery Package',
				'更新包裹信息'),

		'Update User Information'=>array(
				'Update User Information',
				'更新用户信息'),

		'Remove the user'=>array(
				'Remove the user',
				'删除用户'),
		'Execution is successful'=>array(
				'Execution is successful',
				'操作成功'),
		'already existed'=>array(
				'already existed',
				'已经存在'),
		'Back to'=>array(
				'Go back to',
				'返回'),

		'Receive Time'=>array(
				'Receive Time',
				'接收时间'),
		
		'Print Preview'=>array(
				'Print Preview',
				'打印预览'),
);


function RL__($s) {
	$RLLANG = $_SESSION['lang'];
	global $RLMessages;
	if (isset($RLMessages[$s][$RLLANG])) {
		return $RLMessages[$s][$RLLANG];
	} else {
		error_log("l10n error: LANG: $RLLANG, message: '$s'");
	}
}

$RL__ = "RL__";

?>