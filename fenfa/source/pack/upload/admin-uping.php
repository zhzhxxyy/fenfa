<?php
namespace PngFile;
require_once 'depng/pngCompote.php';
namespace CFPropertyList;
require_once 'deplist/CFPropertyList.php';
include '../../system/db.class.php';
error_reporting(0);
$time = $_GET['time'];
$size = $_GET['size'];
$path = '../../../data/attachment/'.$time;
$dir = '../../../data/tmp/'.$time.'/Payload';
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
	$str = file_get_contents('../../../static/app/down.plist');
	$str = str_replace(array('{ipa}', '{icon}', '{bid}', '{name}'), array($url.'data/attachment/'.$time.'.ipa', $url.'static/app/down.png', $xml_aid, $xml_name), $str);
	fwrite(fopen($path.'.plist', 'w'), convert_charset($str));
        $xml_plist = $url.'data/attachment/'.$time.'.plist';
	echo '{"name":"'.$xml_name.'","mnvs":"'.$xml_mnvs.'","bid":"'.$xml_bid.'","bsvs":"'.$xml_bsvs.'","bvs":"'.$xml_bvs.'","form":"'.$xml_form.'","nick":"'.$xml_nick.'","type":"'.$xml_type.'","team":"'.$xml_team.'","icon":"'.$xml_icon.'","plist":"'.$xml_plist.'","size":"'.$xml_size.'"}';
}
?>