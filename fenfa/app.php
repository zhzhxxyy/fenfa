<?php
include 'source/system/db.class.php';
$app = explode('/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : NULL);
$id = intval(isset($app[1]) ? $app[1] : NULL);
empty($id) and exit(header('location:'.IN_PATH));
$tips = SafeRequest("tips","get");
$isPreview = SafeRequest("isPreview","get");
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);


if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
   $system="IOS";
}else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
    $system="Android";
}else{
    $system="Android";
}

if(!$isPreview&&$row&&strtolower($row['in_form'])!=strtolower($system)&&$row['releateId']>0){
	$rowNew = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$row['releateId']);
	if($rowNew ){
		$row=$rowNew;
		$id=$rowNew["in_id"];
	}
}


if($row){
	if(substr($row['in_plist'],0,4)!="http"){
       if(substr($row['in_plist'],0,1)=="/"){
		   $row['in_plist']= 'https://'.$_SERVER['HTTP_HOST'].$row['in_plist'];
	   }else{
		   $row['in_plist'] = 'https://'.$_SERVER['HTTP_HOST']."/".$row['in_plist'];
	   }
	}
}

?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>">
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>">
<title><?php echo $row['in_name']; ?> - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/app/download.css" rel="stylesheet">
</head>
<body>
<span class="pattern left"><img src="<?php echo IN_PATH; ?>static/app/left.png"></span>
<span class="pattern right"><img src="<?php echo IN_PATH; ?>static/app/right.png"></span>
<div class="out-container">
	<div class="main">
		<header>
		<div class="table-container">
			<div class="cell-container">
				<div class="app-brief">
					<div class="icon-container wrapper">
						<i class="icon-icon_path bg-path"></i>
						<span class="icon"><img src="<?php echo geticon($row['in_icon']).'?time='.time(); ?>"></span>
						<span class="qrcode"><img src="<?php echo IN_PATH; ?>source/pack/weixin/qrcode.php?link=<?php echo getlink($id); ?>"></span>
					</div>
					
					<h1 class="name wrapper"><span class="icon-warp"><?php if(strtolower($row['in_form'])=="android"){?>
					<i class="icon-android"></i>
					<?php }else{ ?>
					<i class="icon-ios"></i>
					<?php } ?><?php echo $row['in_name']; ?></span></h1>
					<p class="scan-tips">扫描二维码下载<br />或用手机浏览器输入这个网址：<span class="text-black"><?php echo getlink($id); ?></span></p>
					<div class="release-info">
						<p><?php echo $row['in_bsvs']; ?>（Build <?php echo $row['in_bvs']; ?>）- <?php echo $row['in_size']; ?></p>
						<p>更新于：<?php echo $row['in_addtime']; ?></p>
					</div>
					<!--
					<?php if(checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){ ?>
					<div class="actions">
						<button onclick="location.href='<?php echo IN_PATH; ?>source/pack/upload/install/install.php?en=<?php echo bin2hex('itms-services://?action=download-manifest&url='.$row['in_plist']); ?>&id=<?php echo $id; ?>'"><?php echo $tips ? '开发者点数不足' : '下载安装'; ?></button>
					</div>
					<?php } ?>
					-->
					
					
					<?php if(strtolower($row['in_form'])=="android"){?>
						<div class="actions">
						<button onclick="location.href='<?php echo IN_PATH; ?>source/pack/upload/install/install.php?en=<?php echo bin2hex('itms-services://?action=download-manifest&url='.$row['in_plist']); ?>&id=<?php echo $id; ?>'"><?php echo $tips ? '开发者点数不足' : '下载安装'; ?></button>
					   </div>
					<?php }else{ ?>
						<div class="actions">
						<button onclick="location.href='<?php echo IN_PATH; ?>source/pack/upload/install/install.php?en=<?php echo bin2hex('itms-services://?action=download-manifest&url='.$row['in_plist']); ?>&id=<?php echo $id; ?>'"><?php echo $tips ? '开发者点数不足' : '下载安装'; ?></button>
					    </div>
					<?php } ?>
					
					
					
				</div>
			</div>
		</div>
		</header>
		<div class="footer"><?php echo $_SERVER['HTTP_HOST']; ?> 是应用内测平台，请自行甄别应用风险！如有问题可通过邮件反馈。<a class="one-key-report" href="mailto:<?php echo IN_MAIL; ?>">联系我们</a></div>
	</div>
</div>
</body>
</html>