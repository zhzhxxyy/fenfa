<?php
if(!defined('IN_ROOT')){exit('Access denied');}
if(IN_OPEN==0){exit(html_message("ά��֪ͨ",IN_OPENS));}
global $db;
$userid = isset($_COOKIE['in_userid']) ? intval($_COOKIE['in_userid']) : 0;
$username = isset($_COOKIE['in_username']) ? SafeSql($_COOKIE['in_username']) : NULL;
$userpassword = isset($_COOKIE['in_userpassword']) ? SafeSql($_COOKIE['in_userpassword']) : NULL;
$sid = $db->getone("select in_id from ".tname('session')." where in_uid=".$userid);
if($sid){
	$db->query("update ".tname('session')." set in_addtime=".time()." where in_id=".$sid);
	$sql = "select * from ".tname('user')." where in_islock=0 and in_userid=".$userid." and in_username='".$username."' and in_userpassword='".$userpassword."'";
	$result = $db->query($sql);
	if($row = $db->fetch_array($result)){
		$userlogined = true;
		$Field = $db->query("SHOW FULL COLUMNS FROM ".IN_DBTABLE."user");
		while($rows = $db->fetch_array($Field)){
		        $Variable = 'erduo_'.$rows['Field'];
		        $$Variable = $row[$rows['Field']];
		}
	}else{
		$userlogined = false;
	}
}else{
	$userlogined = false;
}
?>