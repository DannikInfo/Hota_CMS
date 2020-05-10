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
* /files/handler/templates.php - handler of template tags
* -Last update: 25.02.2019
* 
*
*/
	if(!function_exists('tag_replace')){
		function tag_replace($filename){
			include 'tag.php';
			include 'files/config/tags.php';
			$file = file_get_contents($filename, true);
			preg_replace_callback('[include:(.*)]', function($matches){
				$str = explode(']', $matches[1]);
				$link = site('SiteTemplate').'/'.$str[0];
				require_once('templates.php');
				echo tag_replace($link);
			}, $file);
			return preg_replace($tag, $tag_handler, $file);
		}
	}
?>