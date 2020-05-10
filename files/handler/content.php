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
* /files/handler/content.php - content handler
* -Last update: 14.01.2018
* 
*
*/
	global $template;
	//page prehandler
	if(isset($_GET['page'])){
		$page = $_GET['page'];
		$arraypage = explode('/', $page);
		if(isset($arraypage['1'])){
			$page = $arraypage['1'];
			$cat = $arraypage['0'];
		}else{
			$page = $arraypage['0'];
			$cat = "main";
		}
	}else{
		$page = "";
		$cat = "";
	}
	//Page prehandler end
	
	//Modules
	require_once 'files/admin/handler/modules.php';
	$module_list = load_module_list();
	load_content($module_list);
	//Modules end 

	//System content
	if($page == "" & $cat == ""){
		echo tag_replace($template.'/header.tpl');
		echo tag_replace($template.'/main.tpl');
		echo tag_replace($template.'/footer.tpl');
	}else{
		require 'files/lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."pages WHERE name='".$page."' and category='".$cat."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		if($page != 'search'){
			if($result['id'] == ''){
				require 'files/handler/error.php';
				error_send('404');
			}else{
				echo tag_replace($template.'/header.tpl');
				echo tag_replace($template.'/page.tpl');
				echo tag_replace($template.'/footer.tpl');
			}
		}else{
			echo tag_replace($template.'/header.tpl');
			echo tag_replace($template.'/search.tpl');
			echo tag_replace($template.'/footer.tpl');
		}
	}
	//System content end
?>