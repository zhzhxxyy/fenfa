<?php
include '../system/db.class.php';
include '../system/user.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
$GLOBALS['userlogined'] or exit('-1');
$ac=SafeRequest("ac","get");
if($ac == 'del'){
	$id = intval(SafeRequest("id","get"));
	$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
	$row or exit('-2');
	$row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
	$GLOBALS['db']->query("delete from ".tname('app')." where in_id=".$id);
	echo '1';
}elseif($ac == 'edit'){
	$id = intval(SafeRequest("id","get"));
	$name = unescape(SafeRequest("name","get"));
	$nick = unescape(SafeRequest("nick","get"));
	$team = unescape(SafeRequest("team","get"));
	$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
	$row or exit('-2');
	$row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
	$GLOBALS['db']->query("update ".tname('app')." set in_name='".$name."',in_nick='".$nick."',in_team='".$team."' where in_id=".$id);
	echo '1';
}elseif($ac == 'info'){
	$mobile = SafeRequest("mobile","get");
	$qq = SafeRequest("qq","get");
	$firm = unescape(SafeRequest("firm","get"));
	$job = unescape(SafeRequest("job","get"));
	updatetable('user', array('in_mobile' => $mobile,'in_qq' => $qq,'in_firm' => $firm,'in_job' => $job), array('in_userid' => $GLOBALS['erduo_in_userid']));
	echo '1';
}elseif($ac == 'pwd'){
	$old = substr(md5(SafeRequest("old","get")), 8, 16);
	$new = substr(md5(SafeRequest("new","get")), 8, 16);
	$old == $GLOBALS['erduo_in_userpassword'] or exit('-2');
	updatetable('user', array('in_userpassword' => $new), array('in_userid' => $GLOBALS['erduo_in_userid']));
	echo '1';
}
?>