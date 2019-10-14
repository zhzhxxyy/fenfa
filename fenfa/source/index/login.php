<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>">
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>">
<title>Á¢¼´µÇÂ¼ - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/application.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/lib.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var home_link = '<?php echo IN_PATH.'index.php/home'; ?>';
</script>
</head>
<body class="page-sessions-new">
<div class="partials-brands">
	<a href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:<?php echo checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') ? 30 : 40; ?>px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a>
</div>
<div class="form-container">
	<div class="form-behavior divider">
		<span>Á¢¼´µÇÂ¼</span>
	</div>
	<div class="form-inner">
		<form class="form-float-label" onsubmit="login();return false">
			<div class="alert-warning hidden" id="alert-warning"></div>
			<div class="form-group">
				<input class="form-control" autofocus placeholder="ÓÊÏä" type="text" id="mail"><span class="float-label"><i class="icon-email"></i></span>
			</div>
			<div class="form-group">
				<input class="form-control" placeholder="ÃÜÂë" type="password" id="pwd"><span class="float-label"><i class="icon-lock"></i></span>
			</div>
			<div class="form-group action">
				<button type="submit" class="btn btn-block btn-primary">Á¢¼´µÇÂ¼</button>
			</div>
		</form>
		<div class="help-section">
			<span class="btn-alternative"><a href="<?php echo IN_PATH.'index.php/reg'; ?>">Ãâ·Ñ×¢²á</a></span><a href="<?php echo IN_PATH.'index.php/lost'; ?>">Íü¼ÇÃÜÂë£¿</a>
		</div>
	</div>
</div>
</body>
</html>