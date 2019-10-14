<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>">
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>">
<title>产品价格 - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/main.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/main.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/lib.js"></script>
<script type="text/javascript">var in_path = '<?php echo IN_PATH; ?>';</script>
</head>
<body class="page-Pricing">
<nav class="navbar navbar-transparent" role="navigation">
<div class="navbar-header">
	<a class="navbar-brand" href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:<?php echo checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') ? 30 : 40; ?>px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" ng-controller="NavbarController">
	<div class="dropdown">
		<div>
			<i class="icon-brace-left"></i>
			<ul class="navbar-bracket">
				<li><a href="<?php echo IN_PATH; ?>">首页</a><i class="icon-comma"></i></li>
				<li><a href="<?php echo IN_PATH.'index.php/buy'; ?>">产品价格</a><i class="icon-comma"></i></li>
				<li><a href="mailto:<?php echo IN_MAIL; ?>">联系我们</a><i class="icon-comma"></i></li>
				<?php if($GLOBALS['userlogined']){ ?>
				<li><a href="<?php echo IN_PATH.'index.php/home'; ?>">应用管理</a><i class="icon-comma"></i></li>
				<li class="signup"><a href="<?php echo IN_PATH.'index.php/logout'; ?>">退出</a></li>
				<?php }else{ ?>
				<li><a href="<?php echo IN_PATH.'index.php/login'; ?>">立即登录</a><i class="icon-comma"></i></li>
				<li class="signup"><a href="<?php echo IN_PATH.'index.php/reg'; ?>">免费注册</a></li>
				<?php } ?>
			</ul>
			<i class="icon-brace-right"></i>
		</div>
	</div>
</div>
</nav>
<div class="menu-toggle">
	<i class="icon-menu"></i>
</div>
<menu>
<ul>
	<li><a href="<?php echo IN_PATH; ?>">首页</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/buy'; ?>">产品价格</a></li>
	<li><a href="mailto:<?php echo IN_MAIL; ?>">联系我们</a></li>
	<?php if($GLOBALS['userlogined']){ ?>
	<li><a href="<?php echo IN_PATH.'index.php/home'; ?>">应用管理</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/logout'; ?>">退出</a></li>
	<?php }else{ ?>
	<li><a href="<?php echo IN_PATH.'index.php/reg'; ?>">免费注册</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/login'; ?>">立即登录</a></li>
	<?php } ?>
</ul>
</menu>
<div id="root-packages">
	<div class="banner banner-packages">
		<h1>
		<div class="brackets">
			<i class="icon-brace-left"></i><span>Pricing</span><i class="icon-brace-right"></i>
		</div>
		<small>价格</small>
		</h1>
		<div class="pattern-bg"></div>
	</div>
	<div class="section packages-content">
		<h3>
		<div>选择下载点数包</div>
		<small>新注册用户有&nbsp;<?php echo IN_REGPOINTS; ?>&nbsp;免费下载点数，下载点数耗尽的用户可按需求自行购买下载点数包</small></h3>
		<div class="package-cards-wrap">
			<div class="package-cards" id="package_content">
				<div class="package-card">
					<div class="package-header">
						<h2><?php echo number_format(IN_RMBPOINTS * 10); ?></h2>
						<small>下载点数</small>
					</div>
					<div class="package-content">
						<div>￥10</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="pay(10)">购买</button>
					</div>
				</div>
				<div class="package-card active">
					<div class="package-header">
						<h2><?php echo number_format(IN_RMBPOINTS * 100); ?></h2>
						<small>下载点数</small>
					</div>
					<div class="package-content">
						<div class="package-badge">
							<div class="badge-wrap"><span>推荐</span><span class="arraw"></span></div>
						</div>
						<div>￥90</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="pay(90)">购买</button>
					</div>
				</div>
				<div class="package-card">
					<div class="package-header">
						<h2><?php echo number_format(IN_RMBPOINTS * 1000); ?></h2>
						<small>下载点数</small>
					</div>
					<div class="package-content">
						<div>￥800</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="pay(800)">购买</button>
					</div>
				</div>
			</div>
		</div>
		<small>如需包年或私有方案定制，请联系&nbsp;<a href="mailto:<?php echo IN_MAIL; ?>"><?php echo IN_MAIL; ?></a></small>
	</div>
	<div class="section packages-cert">
		<div class="cert-header">
			<i class="icon icon-users"></i>
		</div>
		<div class="cret-row-wrap">
			<div class="cert-row">
				<div class="half text-right">
					<div class="cert-item">注册初始</div>
					<ul class="list-unstyled cert-list">
						<li><?php echo IN_REGPOINTS; ?> 免费下载点数</li>
						<li>先体验后选择</li>
					</ul>
				</div>
				<div class="half text-left">
					<div class="cert-item">充值汇率</div>
					<ul class="list-unstyled cert-list">
						<li><?php echo IN_RMBPOINTS; ?> 下载点数/每元</li>
						<li>签约微信支付</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="dialog-mask" style="display:none"></div>
<div class="dialog buy-confirm" style="display:none">
	<header class="text-center">微信扫码支付（该功能暂时关闭，扫码无效）</header>
	<div class="content" style="display:none"><center><img id="qrcode"></center></div>
	<div class="actions text-center">
		<button class="btn btn-default" style="margin-bottom:10px" onclick="$('.dialog-mask').hide(),$('.buy-confirm').hide()">放弃购买</button><button class="btn btn-yellow" style="margin-bottom:10px" onclick="location.href='<?php echo IN_PATH.'index.php/home'; ?>'">购买成功，马上查看</button>
	</div>
</div>
</body>
</html>