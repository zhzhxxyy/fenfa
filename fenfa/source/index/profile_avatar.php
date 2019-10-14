<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php if(!$GLOBALS['userlogined']){exit(header('location:'.IN_PATH.'index.php/login'));} ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<title>更新头像 - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/application.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/user_info.css" rel="stylesheet">
<script type="text/javascript">var updateavatar = function () {location.reload();}</script>
</head>
<body>
<header>
<div class="brand">
	<a href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:<?php echo checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') ? 25 : 35; ?>px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a>
</div>
<nav>
	<ul><li><a id="signoutLink" href="<?php echo IN_PATH.'index.php/home'; ?>">我的应用</a></li></ul>
</nav>
</header>
<div class="user-info">
	<form class="avatar">
		<label><img src="<?php echo getavatar($GLOBALS['erduo_in_userid']); ?>" width="120" height="120"></label>
	</form>
	<form class="auto-save-form">
		<div class="form-group floated">
			<span class="name"><?php echo substr($GLOBALS['erduo_in_username'], 0, strpos($GLOBALS['erduo_in_username'], '@')); ?></span>
		</div>
	</form>
	<div class="user_pro_tabs">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_info'; ?>"><span><i class="icon icon-user"></i></span>个人资料</a>
				</div>
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_pwd'; ?>"><span><i class="icon icon-lock"></i></span>修改密码</a>
				</div>
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_avatar'; ?>" class="active"><span><i class="icon icon-badge"></i></span>更新头像</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-container">
		<div class="profile-form-wrap form-wrap">
			<div class="partials-user-profile">
				<form class="show_profile">
					<embed src="<?php echo IN_PATH; ?>static/pack/upload/camera.swf?ucapi=<?php echo urlencode((is_ssl() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/upload/avatar/avatar.php?'); ?>&input=<?php echo urlencode('uid=').$GLOBALS['erduo_in_userid'].':'.$GLOBALS['erduo_in_userpassword']; ?>" width="450" height="253" wmode="transparent" type="application/x-shockwave-flash"></embed>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>