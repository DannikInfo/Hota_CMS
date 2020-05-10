<?
/**
*  _ 		 _   __________   ___________    ________ 		 	 _________   ___    ___   _________	
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
* /files/handler/tag.php - tag template function 
* -Last update: 25.02.2019
* 
*
*/

	//Page function
	if(!function_exists('header_page')){
		function header_page(){
			require 'files/config/config.php';
			require 'files/lib/db_connection.php';
			global $page, $cat;
			$query = "SELECT header FROM ".$sconfig['DBTablePrefix']."pages WHERE name='".$page."' and category='".$cat."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			$result = mysqli_fetch_assoc($stmt);
			return $result['header'];
		}
	}
	if(!function_exists('lead_page')){
		function lead_page(){
			require 'files/config/config.php';
			require 'files/lib/db_connection.php';
			global $page, $cat;
			$query = "SELECT lead FROM ".$sconfig['DBTablePrefix']."pages WHERE name='".$page."' and category='".$cat."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			$result = mysqli_fetch_assoc($stmt);
			return $result['lead'];
		}
	}
	if(!function_exists('content_page')){
		function content_page(){
			require 'files/config/config.php';
			require 'files/lib/db_connection.php';
			require 'bbcode.php';
			global $page, $cat;
			$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."pages WHERE name='".$page."' and category='".$cat."' ";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			$result = mysqli_fetch_assoc($stmt);
			if($result['bbcode'] == 1)
				return replaceBBCode($result['content']);
			else
				return $result['content'];
		}
	}
	if(!function_exists('breadcrumb')){
		function breadcrumb(){
			global $page, $cat;
			if($cat != 'main'){
				if($page == 'main'){
					return   '<ol class="breadcrumb"><li><a href="/">Главная </a></li><li class="active">'.$cat.'</li></ol>';
				}else{
					return   '<ol class="breadcrumb"><li><a href="/">Главная</a></li><li><a href="/page/'.$cat.'/main">'.$cat.'</a></li><li class="active">'.$page.'</li></ol>';
				}
			}else{
				return   '<ol class="breadcrumb"><li><a href="/">Главная</a></li><li class="active">'.$page.'</li></ol>';	
			}
		}
	}
	//Basic function
	if(!function_exists('site')){
		function site($cnfg){
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
	if(!function_exists('meta')){
		function meta(){
			global $template, $title;
			include 'files/config/config.php';
			return '
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>'.$title.'</title>
				<link href="/'.$template.'/system/css/bootstrap.min.css" rel="stylesheet">
				<script src="/'.$template.'/system/js/jquery-3.2.1.min.js"></script>
	    		<script src="/'.$template.'/system/js/bootstrap.min.js"></script>
			';
		}
	}
	if(!function_exists('includer')){
		function includer($file){
			preg_replace_callback('[include:(.*)]', function($matches){
				$str = explode(']', $matches[1]);
				$link = site('SiteTemplate').'/'.$str[0];
				require_once('templates.php');
				echo tag_replace($link);
			}, $file);
		}
	}
	//Error function
	if(!function_exists('header_error')){
		function header_error(){
			global $error_type;
			return $error_type.' Error';
		}
	}
	if(!function_exists('content_error')){
		function content_error(){
			global $error_type;
			require 'files/config/config.php';
			require 'files/lib/db_connection.php';
			$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."templates WHERE name='".$error_type."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			$result = mysqli_fetch_assoc($stmt);
			return $result['content'];
		}
	}
	require_once 'files/admin/handler/modules.php';
	$module_list = load_module_list();
	load_handlers($module_list, 0);
?>