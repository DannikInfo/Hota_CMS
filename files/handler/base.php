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
* /files/handler/base.php - handler for getting site main settings
* -Last update: 14.01.2018
* 
*
*/
	if(!function_exists('base_site')){
		function base_site($cnfg){
			include 'files/config/config.php';
			require 'files/lib/db_connection.php';
			$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."settings WHERE argument='".$cnfg."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			$result = mysqli_fetch_assoc($stmt);
			if($cnfg == 'SiteTemplate'){
				return 'files/templates/'.$result['value'];
			}else{
				return $result['value'];
			}
		}
	}
	if(!function_exists('sys_info')){
		function sys_info($cnfg){
			include 'files/config/config.php';
			require 'files/lib/db_connection.php';
			$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."sys_info WHERE argument='".$cnfg."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			$result = mysqli_fetch_assoc($stmt);
			return $result['value'];
		}
	}
?>