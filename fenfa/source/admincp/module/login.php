<?php
if(!defined('IN_ROOT')){exit('Access denied');}
$action=SafeRequest("action","get");
if($action=="login"){
	if(!submitcheck('form')){ShowMessage("表单验证不符，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,0);}
	global $db;
	$adminname=SafeRequest("adminname","post");
	$adminpassword=md5(SafeRequest("adminpassword","post"));
	$code=SafeRequest("code","post");
	if(IN_CODEOPEN==1 && $code!==IN_CODE){
		ShowMessage("认证码有误，请重试！",$_SERVER['PHP_SELF'],"infotitle3",2000,0);
	}
        $row=$db->getrow("select * from ".tname('admin')." where in_adminname='".$adminname."' and in_adminpassword='".$adminpassword."' and in_islock=0");
	if($row){
		$db->query("update ".tname('admin')." set in_loginnum=in_loginnum+1,in_loginip='".getonlineip()."',in_logintime='".date('Y-m-d H:i:s')."' where in_adminid=".$row['in_adminid']);
		setcookie("in_adminid",$row['in_adminid']);
		setcookie("in_adminname",$row['in_adminname']);
		setcookie("in_adminpassword",md5($row['in_adminpassword']));
		setcookie("in_permission",$row['in_permission']);
		setcookie("in_adminexpire","have",time()+1800);
		ShowMessage("登录成功，正在转向管理中心！","?iframe=index","infotitle2",1000,0);
	}else{
		ShowMessage("登录信息有误或帐号未激活，请重试！",$_SERVER['PHP_SELF'],"infotitle3",3000,0);
	}
}elseif($action=="logout"){
	setcookie("in_adminid","",time()-1);
	setcookie("in_adminname","",time()-1);
	setcookie("in_adminpassword","",time()-1);
	setcookie("in_permission","",time()-1);
	setcookie("in_adminexpire","",time()-1);
	ShowMessage("您已经安全退出管理中心！",$_SERVER['PHP_SELF'],"infotitle1",1000,0);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>登录管理中心</title>
<link rel="stylesheet" href="static/admincp/css/main.css" type="text/css" media="all" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
function CheckLogin(){
	if(document.form.adminname.value==""){
	        asyncbox.tips("用户名不能为空，请填写！", "wait", 1000);
	        document.form.adminname.focus();
	        return false;
	}
	else if(document.form.adminpassword.value==""){
	        asyncbox.tips("密码不能为空，请填写！", "wait", 1000);
	        document.form.adminpassword.focus();
	        return false;
	}
	<?php if(IN_CODEOPEN==1){ ?>
	else if(document.form.code.value==""){
	        asyncbox.tips("认证码不能为空，请填写！", "wait", 1000);
	        document.form.code.focus();
	        return false;
	}
	<?php } ?>
	else {
	        return true;
	}
}
</script>
</head>
<body>
<table class="logintb">
<tr>
	<td class="login">
		<h1>Ear Music Administrator's Control Panel</h1>
		<p><?php echo IN_VERSION; ?> 是 <a href="http://www.earcms.com" target="_blank">Earcms</a> 旗下 <a href="http://www.erduo.in" target="_blank">耳朵音乐</a> 推出的以音乐为基础的专业建站平台，帮助网站实现一站式服务。</p>
	</td>
	<td>	<form method="post" name="form" action="?action=login" target="_top">
		<p class="logintitle">用户名: </p>
		<p class="loginform"><input name="adminname" id="adminname" type="text" class="txt" /></p>
		<p class="logintitle">密　码:</p>
		<p class="loginform"><input name="adminpassword" id="adminpassword" type="password" class="txt" /></p>
		<?php if(IN_CODEOPEN==1){ ?>
		<p class="logintitle">提　问:</p>
		<p class="loginform"><select><option value="认证码">认证码</option></select></p>
		<p class="logintitle">回　答:</p>
		<p class="loginform"><input name="code" id="code" type="password" class="txt" /></p>
		<?php }else{ ?>
		<p class="logintitle">提　问:</p>
		<p class="loginform"><select><option value="无安全提问">无安全提问</option></select></p>
		<p class="logintitle">免　答:</p>
		<p class="loginform"><input class="txt" readonly="readonly" /></p>
		<?php } ?>
		<p class="loginnofloat"><input name="form" value="提交" type="submit" class="btn" onclick="return CheckLogin();" /></p>
		</form>
	</td>
</tr>
</table>
<table class="logintb">
<tr>
	<td colspan="2" class="footer">
		<div class="copyright">
			<p>Powered by <a href="http://www.erduo.in/" target="_blank">Ear Music</a> <?php echo IN_VERSION; ?> </p>
			<p>&copy; 2011-<?php echo date('Y'); ?>, <a href="http://www.earcms.com/" target="_blank">Earcms</a> Inc.</p>
		</div>
	</td>
</tr>
</table>
</body>
</html>