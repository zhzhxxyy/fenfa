<?php
include 'source/system/db.class.php';
include 'source/system/user.php';
$index = explode('/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : NULL);
$module = isset($index[1]) ? $index[1] : 'guide';
core_entry('source/index/'.$module.'.php');
?>