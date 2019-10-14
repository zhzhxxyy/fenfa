<?php
if(!defined('IN_ROOT')){exit('Access denied');}
if($GLOBALS['userlogined']){
        if($GLOBALS['db']->getone("select in_id from ".tname('session')." where in_uid=".$GLOBALS['erduo_in_userid'])){
                $GLOBALS['db']->query("delete from ".tname('session')." where in_uid=".$GLOBALS['erduo_in_userid']);
        }
}
setcookie('in_userid', '', time()-1, IN_PATH);
setcookie('in_username', '', time()-1, IN_PATH);
setcookie('in_userpassword', '', time()-1, IN_PATH);
header('location:'.IN_PATH.'index.php/login');
?>