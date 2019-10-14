<?php
    header('Content-Type:application/json; charset=utf-8');
if(!empty($_FILES)){
	$filepart = pathinfo($_FILES['fileToUpload']['name']);
	$time="test".time();
	$file = '../../../data/attachment/'.$time.'.ipa';
	$error=$_FILES['fileToUpload']['error'];
 $data["respCode"]="1";
 $data["respMsg"]="成功";
     try{
		 @move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $file);
	 }catch (\Exception $e){

		  $data["respCode"]="0";
          $data["respMsg"]="失败：".$e->getMessage();
     } 		 
	
    
	 echo json_encode($data);
	 die;
}else{
	$data["respCode"]="1";
	 echo json_encode($data);
	 die;
}
?>