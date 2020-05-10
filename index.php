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
* /index.php - main system file
* -Last update: 14.01.2018
* 
*
*/
	if(file_exists('files/config/config.php')){
		require_once 'files/config/config.php';
		require 'files/handler/templates.php';
		require 'files/lib/db_connection.php';
		require 'files/handler/base.php';
		$title = base_site('SiteTitle');
		$template = base_site('SiteTemplate');
		$error_type = '';
		if(isset($_GET['error_type'])){
			require 'files/handler/error.php';
			error_send($_GET['error_type']);
		}
		require 'files/handler/content.php';
	}else{
		header('Location: /install');
	}
	mysqli_close($connect);
?>
