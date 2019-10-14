<?php
if(!empty($_FILES)){
	$filepart = pathinfo($_FILES['Filedata']['name']);
	if(strtolower($filepart['extension']) == 'ipa'){
		$time = $_REQUEST['time'];
		$dir = '../../../data/tmp/'.$time.'/';
        	if(!is_dir($dir)){
                	@mkdir($dir, 0777, true);
        	}
		$file = '../../../data/attachment/'.$time.'.ipa';
		@move_uploaded_file($_FILES['Filedata']['tmp_name'], $file);
		@rename($file, str_replace('ipa', 'zip', $file));
		include_once '../zip/zip.php';
		$zip = new PclZip(str_replace('ipa', 'zip', $file));
		$zip->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_REPLACE_NEWER);
	 	echo '{"time":"'.$time.'","type":"ipa","size":"'.$_FILES['Filedata']['size'].'"}';
	}else if(strtolower($filepart['extension']) == 'apk'){
		$time = $_REQUEST['time'];
		$dir = '../../../data/tmp/'.$time.'/';
        	if(!is_dir($dir)){
                	@mkdir($dir, 0777, true);
        	}
		$file = '../../../data/attachment/'.$time.'.apk';
		@move_uploaded_file($_FILES['Filedata']['tmp_name'], $file);
	//	@rename($file, str_replace('apk', 'zip', $file));
		//include_once '../zip/zip.php';
		//$zip = new PclZip(str_replace('apk', 'zip', $file));
		//$zip->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_REPLACE_NEWER);
	 	echo '{"time":"'.$time.'","type":"apk","size":"'.$_FILES['Filedata']['size'].'"}';
	}else{
	 	echo '-1';
	}
}
?>