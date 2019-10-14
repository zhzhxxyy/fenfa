<?php include '../../../system/config.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>一键切图</title>
<link href="../../../../static/pack/upload/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../../static/pack/upload/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../../../../static/pack/upload/swfobject.js"></script>
<script type="text/javascript" src="../../../../static/pack/upload/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#uploadify").uploadify({
		'uploader' : '../../../../static/pack/upload/uploadify.swf',
		'script' : './save.php',
		'cancelImg' : '../../../../static/pack/upload/cancel.png',
		'folder' : 'UploadFile',
		'method' : 'GET',
		'scriptData' : {'_ext':'<?php echo IN_EXT; ?>'},
		'buttonText' : 'Upload',
		'buttonImg' : '../../../../static/pack/upload/up.png',
		'width' : '110',
		'height' : '30',
		'queueID' : 'fileQueue',
		'auto' : true,
		'multi' : false,
		'fileExt' : '*.jpg;*.jpeg;*.gif;*.png',
		'fileDesc' : '*.jpg;*.jpeg;*.gif;*.png',
		'sizeLimit' : 2097152,
		'onError' : function (a, b, c, d) {
			if (d.status == 404) {
				$(".uploadifyQueueItem").text("上传异常，请重试！");
			} else if (d.type === "HTTP") {
				$(".uploadifyQueueItem").text("error " + d.type + " : " + d.status);
			} else if (d.type === "File Size") {
				$(".uploadifyQueueItem").text("上传失败，大小不能超过2MB！");
			} else {
				$(".uploadifyQueueItem").text("error " + d.type + " : " + d.text);
			}
		},
		'onComplete' : function (event, queueID, fileObj, response, data) {
			if (response == 1) {
				location.href = "../../../../data/icon/icon.zip?" + Math.random();
			} else if (response == -1) {
				$(".uploadifyQueueItem").text("文件不规范，请重新选择！");
			} else if (response == -2) {
				$(".uploadifyQueueItem").text("上传出错，请重试！");
			} else {
				$(".uploadifyQueueItem").text(response);
			}
		}
	});
});
</script>
</head>
<body>
<div id="fileQueue"></div>
<input type="file" id="uploadify">
</body>
</html>