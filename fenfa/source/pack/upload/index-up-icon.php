<?php
include '../../system/db.class.php';
include '../../system/user.php';
$GLOBALS['userlogined'] or exit('-1');
$id = intval($_GET['id']);
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
$row or exit('-2');
$row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
if(!empty($_FILES)&&!empty($_FILES['Filedata']['tmp_name'])){
	$filepart = pathinfo($_FILES['Filedata']['name']);
	if(in_array(strtolower($filepart['extension']), array('jpg', 'jpeg', 'gif', 'png'))){
		$file = '../../../data/attachment/'.$row['in_icon'];
		$ret=move_uploaded_file($_FILES['Filedata']['tmp_name'], $file);	
		if($ret){
			echo '1';
		}else{
			echo '-5';
		}
	}else{
	 	echo '-4';
	}
}else{
	echo '-5';
}
?>