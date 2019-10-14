<?php
include '../../system/config.inc.php';
$size = intval(ini_get('upload_max_filesize'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>文件上传</title>
<link href="../../../static/pack/upload/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../static/pack/upload/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../../../static/pack/upload/swfobject.js"></script>
<script type="text/javascript" src="../../../static/pack/upload/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#uploadify").uploadify({
		'uploader' : '../../../static/pack/upload/uploadify.swf',
		'script' : './uplog.php',
		'cancelImg' : '../../../static/pack/upload/cancel.png',
		'folder' : 'UploadFile',
		'method' : 'GET',
		'scriptData' : {'time':'<?php echo time(); ?>'},
		'buttonText' : 'Upload',
		'buttonImg' : '../../../static/pack/upload/up.png',
		'width' : '110',
		'height' : '30',
		'queueID' : 'fileQueue',
		'auto' : true,
		'multi' : false,
		'fileExt' : '*.ipa',
		'fileDesc' : '请选择*.ipa文件',
		'sizeLimit' : <?php echo ($size*1024*1024); ?>,
		'onError' : function (a, b, c, d) {
			if (d.status == 404){
				ReturnError("上传异常，请重试！");
			}else if (d.type === "HTTP"){
				ReturnError("error "+d.type+" : "+d.status);
			}else if (d.type === "File Size"){
				ReturnError("上传失败，大小不能超过<?php echo $size; ?>MB！");
			}else{
				ReturnError("error "+d.type+" : "+d.text);
			}
		},
		'onComplete' : function (event, queueID, fileObj, response, data) {
			if (response == -1){
				ReturnError("文件不规范，请重新选择！");
			}else{
				ReturnValue(eval('(' + response + ')'));
			}
		}
	});
});
</script>
<script type="text/javascript">
function ReturnValue(response){
        $("#fileQueue").html('<div class="uploadifyQueueItem">正在解析应用，请稍等...</div>');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
                processAJAX();
        };
        xhr.open("GET", "./admin-uping.php?time=" + response.time + "&size=" + response.size, true);
        xhr.send(null);
        function processAJAX() {
                if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                                var data = eval('(' + xhr.responseText + ')');
                                parent.$("#in_name").val(data.name);
                                parent.$("#in_mnvs").val(data.mnvs);
                                parent.$("#in_bid").val(data.bid);
                                parent.$("#in_bsvs").val(data.bsvs);
                                parent.$("#in_bvs").val(data.bvs);
                                parent.$("#in_form").val(data.form);
                                parent.$("#in_nick").val(data.nick);
                                parent.$("#in_type").val(data.type);
                                parent.$("#in_team").val(data.team);
                                parent.$("#in_icon").val(data.icon);
                                parent.$("#in_plist").val(data.plist);
                                parent.$("#in_size").val(data.size);
                                parent.$("#btnsave").click();
                        }
                }
        }
}
function ReturnError(msg){
	parent.asyncbox.tips(msg, "error", 3000);
	parent.layer.closeAll();
}
</script>
</head>
<body>
<div id="fileQueue"></div>
<input type="file" id="uploadify">
</body>
</html>