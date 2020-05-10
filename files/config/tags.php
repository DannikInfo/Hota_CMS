<?
/**
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
* /files/config/tags.php - variables for replace template tag to function 
* -Last update: 14.01.2018
* 
*
*/

	require_once 'files/admin/handler/modules.php';

	load_tags($module_list);

	global $nnid, $error_type, $sconfig, $connect;

	$tag;
	$tag_handler;


	$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."tags";
	$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
	$result = mysqli_fetch_assoc($stmt);
	do{
		$result['tag'] = preg_replace('*/*', '\\', $result['tag']);
		$tag[] = $result['tag'];
		$f = $result['handler'];
		$tag_handler[] = $f($result['param']);
	}while($result = mysqli_fetch_assoc($stmt));

?>