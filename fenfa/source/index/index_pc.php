<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<link href="<?php echo IN_PATH; ?>static/index/home.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/home.js"></script>
<nav class="navbar navbar-transparent" role="navigation">
<div class="navbar-header">
	<a class="navbar-brand" href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:40px;font-weight:bold"><?php echo $_SERVER['HTTP_HOST']; ?></i></a>
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
<div class="super-container">
	<div class="section section-1 ready">
		<div class="beta-app-host">
			<pre class="typed-finish">
				BetaAppHost
				<br>
				{
				<br>
				     return "<?php echo $_SERVER['HTTP_HOST']; ?>"
				<br>
				}
			</pre>
			<b></b>
		</div>
		<div class="plane-wrapper" style="left: 320px;">
			<img class="plane" src="<?php echo IN_PATH; ?>static/index/plane.svg">
			<div class="rotate-container">
				<img class="propeller" src="<?php echo IN_PATH; ?>static/index/propeller.svg">
			</div>
		</div>
	</div>
	<div class="section section-2 ready">
		<div class="features">
			<div class="cols" style="width: 480px;">
				<div class="back">
				</div>
				<div class="front">
					<div class="group expanded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-launch"></i>
									</div>
									<div class="title">
										内测托管
									</div>
									<div class="text">
										一键上传应用，扫描二维码下载
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<div class="group folded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-user-access"></i>
									</div>
									<div class="title">
										权限控制
									</div>
									<div class="text">
										灵活的访问权限控制，可添加团队成员
										<br>
										共同上传、管理应用
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="cols" style="width: 480px;">
				<div class="back">
				</div>
				<div class="front">
					<div class="group folded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-plugin"></i>
									</div>
									<div class="title">
										开放 API
									</div>
									<div class="text">
										使用 <?php echo $_SERVER['HTTP_HOST']; ?> 的 API 接口可以方便搭建
										<br>
										Jenkins 等自动集成的系统
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<div class="group expanded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-combo"></i>
									</div>
									<div class="title">
										应用合并
									</div>
									<div class="text">
										扫描同一个二维码，根据设备类型自动下载对应的 iOS 
										<br>
										或 Android 应用。
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="cols" style="width: 480px;">
				<div class="back">
				</div>
				<div class="front">
					<div class="group expanded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-console"></i>
									</div>
									<div class="title">
										命令行工具
									</div>
									<div class="text">
										2sx-cli 可以通过命令行查看、上传、编译、打包应用
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<div class="group folded">
						<div class="content-wrapper">
							<table>
							<tbody>
							<tr>
								<td>
									<div class="icon">
										<i class="icon-webhooks"></i>
									</div>
									<div class="title">
										Web Hooks
									</div>
									<div class="text">
										应用更新时团队成员会收到更新邮件，添加Web Hooks的第三方平台也会有更新消息提醒。（已支持 Slack、简聊、BearyChat、纷云、瀑布 IM等）
									</div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-3">
		<table>
		<tbody>
		<tr>
			<td>
				<div class="tools">
					<div class="title">
						Utility Tools
					</div>
					<div class="boxes-container">
						<div class="cols">
							<div class="box-wrapper">
								<p class="tool-desc">
									让测试用户快速获取 UDID 并发送给开发者
								</p>
								<div class="brace">
									<i class="icon-brace-box"></i>
								</div>
								<div class="box">
									<div class="side left">
									</div>
									<div class="side top">
										<div class="lid-left">
										</div>
										<div class="lid-right">
										</div>
									</div>
									<div class="side front">
										<i class="icon-udid"></i>
									</div>
									<div class="side right">
										GET
										<br>
										UDID
									</div>
									<div class="side back">
									</div>
								</div>
							</div>
						</div>
						<div class="cols">
							<div class="box-wrapper">
								<p class="tool-desc">
									读取手机日志，快速定位无法安装的原因
								</p>
								<div class="brace">
									<i class="icon-brace-box"></i>
								</div>
								<div class="box">
									<div class="side left">
									</div>
									<div class="side top">
										<div class="lid-left">
										</div>
										<div class="lid-right">
										</div>
									</div>
									<div class="side front">
										<i class="icon-filter"></i>
									</div>
									<div class="side right">
										LOG
										<br>
										GURU
									</div>
									<div class="side back">
									</div>
								</div>
							</div>
						</div>
						<div class="cols">
							<div class="box-wrapper">
								<p class="tool-desc">
									添加 SDK，灵活实现应用的检测更新功能
								</p>
								<div class="brace">
									<i class="icon-brace-box"></i>
								</div>
								<div class="box">
									<div class="side left">
									</div>
									<div class="side top">
										<div class="lid-left">
										</div>
										<div class="lid-right">
										</div>
									</div>
									<div class="side front">
										<i class="icon-update"></i>
									</div>
									<div class="side right">
										AUTO-
										<br>
										UPDATE
									</div>
									<div class="side back">
									</div>
								</div>
							</div>
						</div>
						<div class="cols">
							<div class="box-wrapper">
								<p class="tool-desc">
									快速检测本机在 <?php echo $_SERVER['HTTP_HOST']; ?> 的上传下载速度
								</p>
								<div class="brace">
									<i class="icon-brace-box"></i>
								</div>
								<div class="box">
									<div class="side left">
									</div>
									<div class="side top">
										<div class="lid-left">
										</div>
										<div class="lid-right">
										</div>
									</div>
									<div class="side front">
										<i class="icon-test-speed"></i>
									</div>
									<div class="side right">
										SPEED
										<br>
										TEST
									</div>
									<div class="side back">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="section section-4">
		<table>
		<tbody>
		<tr>
			<td>
				<div class="content-wrapper">
					<p class="title">
						What Our Users Say
					</p>
					<div class="users-wrapper">
						<div class="item jumei" data-item="jumei">
							<span class="logo"><i class="icon-logo-jumei"></i></span>
							<p class="words">
								就像送自己的孩子去托儿所一样，安全、便捷，<?php echo $_SERVER['HTTP_HOST']; ?> 将我们这些“父母”从发包内测中解放！期待越办越好，小美会一如既往支持 <?php echo $_SERVER['HTTP_HOST']; ?>！
							</p>
						</div>
						<div class="item jiecao" data-item="jiecao">
							<span class="logo"><i class="icon-logo-jiecao"></i></span>
							<p class="words">
								节操精选的公司内部测试到小范围用户群灰度测试，<?php echo $_SERVER['HTTP_HOST']; ?> 极大方便帮我们解决了安装包传输的问题；安全放心、操作便捷、界面简洁！
							</p>
						</div>
						<div class="item jd" data-item="jd">
							<span class="logo"><i class="icon-logo-jd"></i></span>
							<p class="words">
								<?php echo $_SERVER['HTTP_HOST']; ?> 解决了京东阅读客户端每日测试发布的难题，大大减轻了跨地域开发测试的难度，<?php echo $_SERVER['HTTP_HOST']; ?> 加油！
							</p>
						</div>
						<div class="item ebaoyang" data-item="ebaoyang">
							<span class="logo"><i class="icon-logo-ebaoyang"></i></span>
							<p class="words">
								e 保养一直在用 <?php echo $_SERVER['HTTP_HOST']; ?> 进行测试托管分发，喜欢 <?php echo $_SERVER['HTTP_HOST']; ?> 的 UI 和用户体验设计，硅谷范儿的产品！
							</p>
						</div>
						<div class="item xiachufang" data-item="xiachufang">
							<span class="logo"><i class="icon-logo-xiachufang"></i></span>
							<p class="words">
								<?php echo $_SERVER['HTTP_HOST']; ?> 与下厨房一样，都在 UI 和 UE 上下功夫，将开发者工具做到简洁极致，提高效率的同时也令人赏心悦目。
							</p>
						</div>
					</div>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="section section-5">
		<table>
		<tbody>
		<tr>
			<td>
				<div class="imfir">
					<div class="brand-animate">
						<span class="cursor"></span>
					</div>
					<div class="thumbsup-wrapper">
						<div class="brace-group">
							<i class="icon-brace-left"></i>
							<div class="brace-content">
								<i class="icon-thumbsup"></i><span class="face"><i class="icon-comma-eye left"></i><i class="icon-comma-eye right"></i><i class="icon-mouth"></i></span>
							</div>
							<i class="icon-brace-right"></i>
						</div>
						<p class="are-you-like">
							&nbsp;
						</p>
					</div>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>