<?php
include '../../../system/db.class.php';
close_browse();
//checkmobile() or strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') or exit('Access denied');
$id = intval(SafeRequest("id","get"));
$en = SafeRequest("en","get");
$uid = getfield('app', 'in_uid', 'in_id', $id);
$points = getfield('user', 'in_points', 'in_userid', $uid);
$points > 0 or exit(header('location:'.getlink($id).'/?tips=on'));

$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
if(!$row){
	exit('不存在');
}
$GLOBALS['db']->query("update ".tname('user')." set in_points=in_points-1 where in_userid=".$uid);
$GLOBALS['db']->query("update ".tname('app')." set in_hits=in_hits+1 where in_id=".$id);
if(strtolower($row['in_form'])=="android"){
	if(substr($row['in_plist'],0,4)!="http"){
		if(substr($row['in_plist'],0,1)=="/"){
			$url = 'https://'.$_SERVER['HTTP_HOST'].$row['in_plist'];
		}else{
			$url = 'https://'.$_SERVER['HTTP_HOST']."/".$row['in_plist'];
		}
	}else{
		$url = $row['in_plist'];
	}
	header('location:'.$url);
}else{
	if(substr($row['in_plist'],0,4)!="http"){
		if(substr($row['in_plist'],0,1)=="/"){
			$url = 'https://'.$_SERVER['HTTP_HOST'].$row['in_plist'];
		}else{
			$url = 'https://'.$_SERVER['HTTP_HOST']."/".$row['in_plist'];
		}
	}else{
		$url = $row['in_plist'];
	}
	$url="itms-services://?action=download-manifest&url=".$url;
	header('location:'.$url);
	//header('location:'.pack('H*', $en));
}

?>