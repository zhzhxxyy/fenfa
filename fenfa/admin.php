<?php
include 'source/system/db.class.php';
include 'source/admincp/include/function.php';
$frames = array('login', 'index', 'body', 'config', 'app', 'user', 'backup', 'clean', 'admin', 'paylog', 'talk');
$iframe = !empty($_GET['iframe']) && in_array($_GET['iframe'], $frames) ? $_GET['iframe'] : 'login';
include_once $iframe == 'talk' ? 'source/pack/chat/talk.php' : 'source/admincp/module/'.$iframe.'.php';
?>