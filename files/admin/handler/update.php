<?
/*
*  _ 		 _   __________   ___________    ________ 		 	 __________  ___    ___   _________	
* | |		| | |  ______  | |____   ____| |  ______  | 		|  _______|	|   \  /   | | ________|
* | |_______| | | |		 | |	  | | 	   | |______| |			| |			| |\ \/	/| | | |_______		  
* |  _______  | | |    	 | |	  | |      |  ______  |			| |			| |	\_/	 | | |_______  |
* | |		| | | |______| |      | |      | |		| |			| |_______  | |		 | |  _______| |
* |_|		|_| |__________|      |_|      |_|      |_|			|_________| |_|		 |_| |_________|
*
* WolfEco Public License v1.0
*
* The software of WolfEco team can be released of 3 types - full public, mixed public, closed.
*
* HOTA CMS - it's a mixed public sofware
* WolfEco team can close a part of code from public access (or make obfuscation of this part)  at own discretion.
* You are not allowed to access the closed part of the code, nor modify it.
*
* @author WoflEco team
* @link http://wolfeco.ru/page/cms
*
* /files/admin/handler/update.php - OTA update handler TODO:ПЕРЕДЕЛАТЬ ИБО НЕ РАБОТАЕТ НОРМАЛЬНО!!!
* -Last update: 14.01.2018
* 
*
*/
	require './../../config/config.php';
	require './../../lib/db_connection.php';
	$type = $_POST['type'];

	if($type == 0){
		$update = $_POST['update'];
		$update_a = explode('*', $update);
		$query = "UPDATE ".$sconfig['DBTablePrefix']."settings SET value='".$update_a['1']."' WHERE argument='Update'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$query2 = "UPDATE ".$sconfig['DBTablePrefix']."settings SET value='".$update_a['0']."' WHERE argument='UpdateHash'";
		$stmt2 = mysqli_query($connect, $query2)or die(mysqli_error($connect));
		$query3 = "UPDATE ".$sconfig['DBTablePrefix']."settings SET value='".$update_a['2']."' WHERE argument='UpdateLink'";
		$stmt3 = mysqli_query($connect, $query3)or die(mysqli_error($connect));
	}

	if($type == 1){
		$file = ($_POST['update']);
		$update_file = file_get_contents($file, true);
	    if(!is_dir('../../tmp')){
	    	mkdir('../../tmp');
	    }
		file_put_contents('./../../tmp/update.zip', $update_file);
		$zip = new ZipArchive;
		if ($zip->open('./../../tmp/update.zip') === TRUE) {
		    $zip->extractTo('./../../tmp/update');
		    $zip->close();
		}
		//$change_f = fopen('./../../tmp/update/changes.hota', 'r');
		$i = '1';
		while(!feof($change_f)){
			$change[$i] = fgets($change_f);
			$i++;
		}
		fclose($change_f);
		$i = '1';
		$change_count = count($change);
		while($i <= $change_count){
			$change_a = explode('|', $change[$i]);
			if($change_a['0'] == "+"){
				copy('./../../tmp/update/'.$change_a['1'], './../../../'.$change_a['1']);
			}
			if($change_a['0'] == "-"){
				unlink('./../../../'.$change_a['1']);
			}
			$i++;
		}
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."settings WHERE argument='Update'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		update_version($result['value']);
		del_tree('./../../tmp/update/');
		unlink('./../../tmp/update.zip');
	}
	function del_tree($dir){
	   $files = array_diff(scandir($dir), array('.','..'));
	    foreach ($files as $file) {
	      (is_dir("$dir/$file")) ? del_tree("$dir/$file") : unlink("$dir/$file");
	    }
	    return rmdir($dir);
	}
	function update_version($version){
		require './../../config/config.php';
		require './../../lib/db_connection.php';
		$query = "UPDATE ".$sconfig['DBTablePrefix']."sys_info SET value='".$version."' WHERE argument='Version'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
	} 
?>