<?php
namespace PngFile;
require_once 'depng/pngCompote.php';
require_once 'Apkparser.php';
namespace CFPropertyList;
require_once 'deplist/CFPropertyList.php';
include '../../system/db.class.php';
include '../../system/user.php';
error_reporting(0);
$GLOBALS['userlogined'] or exit('-1');
$id = $_GET['id'];
$time = $_GET['time'];
$size = $_GET['size'];
$path = '../../../data/attachment/'.$time;
$dir = '../../../data/tmp/'.$time.'/Payload';


if(file_exists($path.'.apk')){
	
	$xml_name= detect_encoding("未知");//apk 名称
	$xml_type="1";//类型 1 企业 0 内测
	$xml_size=formatsize($size);//大小
	$xml_form="Android";//
	$xml_mnvs="9.0";
	$xml_bid="";//
	$xml_bsvs="V";//版本号
	$xml_nick="weizhi";
	$xml_team="weizhi CO.Ltd";
	
	 $appObj  = new \Apkparser();
     $targetFile =$path.'.apk';//apk所在的路径地址
     $res   = $appObj->open($targetFile);
	 if($res){
		 $xml_name=detect_encoding($appObj->getAppName());
		 $xml_bid=$appObj->getPackage();
		 $xml_bsvs=$appObj->getVersionName();
		 $xml_mnvs=$appObj->getMinSdkVersion();
	 }
	$newfile = $path.'.png';
    copy('../../../static/app/icon_android.png', $newfile);
	$xml_icon = $time.'.png';
	$url="";
	$xml_plist= $url.'data/attachment/'.$time.'.apk';
	    if($id > 0){
		  $GLOBALS['db']->query("update ".tname('app')." set in_name='".$xml_name."',in_type=".$xml_type.",in_size='".$xml_size."',in_form='".$xml_form."',in_mnvs='".$xml_mnvs."',in_bid='".$xml_bid."',in_bsvs='".$xml_bsvs."',in_bvs='".$xml_bvs."',in_nick='".$xml_nick."',in_team='".$xml_team."',in_icon='".$xml_icon."',in_plist='".$xml_plist."',in_addtime='".date('Y-m-d H:i:s')."' where in_uid=".$GLOBALS['erduo_in_userid']." and in_id=".$id);
        }else{
		  $GLOBALS['db']->query("Insert ".tname('app')." (in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_plist,in_hits,in_addtime) values ('".$xml_name."',".$GLOBALS['erduo_in_userid'].",'".$GLOBALS['erduo_in_username']."',".$xml_type.",'".$xml_size."','".$xml_form."','".$xml_mnvs."','".$xml_bid."','".$xml_bsvs."','".$xml_bvs."','".$xml_nick."','".$xml_team."','".$xml_icon."','".$xml_plist."',0,'".date('Y-m-d H:i:s')."')");
        }
	echo "1";
	die;
}


if(is_dir($dir)){
        rename($path.'.zip', $path.'.ipa');
        $d = NULL;
        $h = opendir($dir);
        while($f = readdir($h)){
                if($f != '.' && $f != '..' && is_dir($dir.'/'.$f)){
                        $d = $dir.'/'.$f;
                }
        }
        closedir($h);
        $info = file_get_contents($d.'/Info.plist');
        $plist = new CFPropertyList();
        $plist->parse($info);
        $plist = $plist->toArray();
        $xml_size = formatsize($size);
        $xml_name = detect_encoding($plist['CFBundleDisplayName']);
        $xml_mnvs = $plist['MinimumOSVersion'];
        $xml_bid = $plist['CFBundleIdentifier'];
        $xml_bsvs = $plist['CFBundleShortVersionString'];
        $xml_bvs = $plist['CFBundleVersion'];
        $newfile = $path.'.png';
        $icon = $plist['CFBundleIcons']['CFBundlePrimaryIcon']['CFBundleIconFiles'];
        if(preg_match('/\./', $icon[0])){
		for($i = 0; $i < count($icon); $i++){
			$array[] = filesize($d.'/'.$icon[$i]);
		}
		sort($array);
		for($p = 0; $p < count($icon); $p++){
			if($array[0] == filesize($d.'/'.$icon[$p])){
                		$oldfile = $d.'/'.$icon[$p];
			}
		}
        }else{
		for($i = 0; $i < count($icon); $i++){
			$array[] = filesize($d.'/'.$icon[$i].'@2x.png');
		}
		sort($array);
		for($p = 0; $p < count($icon); $p++){
			if($array[0] == filesize($d.'/'.$icon[$p].'@2x.png')){
                		$ext = preg_match('/20x20/', $icon[$p]) ? '@3x.png' : '@2x.png';
                		$oldfile = $d.'/'.$icon[$p].$ext;
			}
		}
        }
        $png = new \PngFile\PngFile($oldfile);
        if(!$png->revertIphone($newfile)){
		copy('../../../static/app/icon.png', $newfile);
        }
        $xml_icon = $time.'.png';
        $em = file_get_contents($d.'/embedded.mobileprovision');
        $xml_form = preg_match('/<key>Platform<\/key>([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? $m[2] : 'iOS';
        $xml_aid = preg_match('/<key>application-identifier<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? $m[2] : NULL;
        $xml_nick = preg_match('/<key>Name<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : NULL;
        $xml_type = preg_match('/^iOS Team Provisioning Profile:/', $xml_nick) ? 0 : 1;
        $xml_team = preg_match('/<key>TeamName<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : NULL;
        $url = 'https://'.$_SERVER['HTTP_HOST'].IN_PATH;
		$url="";
	$str = file_get_contents('../../../static/app/down.plist');
	$str = str_replace(array('{ipa}', '{icon}', '{bid}', '{bvs}', '{name}'), array($url.'data/attachment/'.$time.'.ipa', $url.'data/attachment/'.$xml_icon, $xml_aid,$xml_bsvs, $xml_name), $str);
	fwrite(fopen($path.'.plist', 'w'), convert_charset($str));
        $xml_plist = $url.'data/attachment/'.$time.'.plist';
        if($id > 0){
		$GLOBALS['db']->query("update ".tname('app')." set in_name='".$xml_name."',in_type=".$xml_type.",in_size='".$xml_size."',in_form='".$xml_form."',in_mnvs='".$xml_mnvs."',in_bid='".$xml_bid."',in_bsvs='".$xml_bsvs."',in_bvs='".$xml_bvs."',in_nick='".$xml_nick."',in_team='".$xml_team."',in_icon='".$xml_icon."',in_plist='".$xml_plist."',in_addtime='".date('Y-m-d H:i:s')."' where in_uid=".$GLOBALS['erduo_in_userid']." and in_id=".$id);
        }else{
		$GLOBALS['db']->query("Insert ".tname('app')." (in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_plist,in_hits,in_addtime) values ('".$xml_name."',".$GLOBALS['erduo_in_userid'].",'".$GLOBALS['erduo_in_username']."',".$xml_type.",'".$xml_size."','".$xml_form."','".$xml_mnvs."','".$xml_bid."','".$xml_bsvs."','".$xml_bvs."','".$xml_nick."','".$xml_team."','".$xml_icon."','".$xml_plist."',0,'".date('Y-m-d H:i:s')."')");
        }
	echo '1';
}
?>