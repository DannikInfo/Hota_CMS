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
* /admin.php - main admin panel file
* -Last update: 28.01.2018
* 
*
*/
	if(!isset($_SESSION))
		session_start();

	require_once 'files/config/config.php';
	require 'files/handler/templates.php';
	require 'files/lib/db_connection.php';
	require 'files/handler/base.php';
	$we_user = sys_info('HotaUser');
	$site_id = sys_info('SiteID');
	$version = sys_info('Version');
	$license = sys_info('License');
	$template = base_site('SiteTemplate');
	if(isset($_SESSION['login']) && $_SESSION['login'] == true){
		require 'files/admin/panel.php';
	}else{
		require 'files/admin/header.php';
		require 'files/admin/login.php';
	}
	require 'files/admin/footer.php';
	mysqli_close($connect);
?>