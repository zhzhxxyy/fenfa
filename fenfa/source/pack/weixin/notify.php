<?php
include '../../system/db.class.php';
global $db;
$in_title = preg_match('/CDATA\[(\d+\-\d+)\]/', $GLOBALS['HTTP_RAW_POST_DATA'], $arr) ? $arr[1] : NULL;
if($row = $db->getrow("select * from ".tname('paylog')." where in_title='".$in_title."'")){
        if($row['in_lock'] > 0){
                $db->query("update ".tname('paylog')." set in_lock=0 where in_title='".$in_title."'");
                $db->query("update ".tname('user')." set in_points=in_points+".$row['in_points']." where in_userid=".$row['in_uid']);
        }
}
?>