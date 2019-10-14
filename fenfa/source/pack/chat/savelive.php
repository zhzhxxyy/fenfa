<?php
if(!empty($_FILES)){
        $dir = '../../../data/tmp/';
        if(!is_dir($dir)){
                @mkdir($dir, 0777, true);
        }
        @move_uploaded_file($_FILES['live']['tmp_name'], $dir.'live.wav');
}
?>