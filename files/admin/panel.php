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
* /files/admin/panel.php - admin panel
* -Last update: 28.01.2018
* 
*
*/
	if($_GET['page'] != 'main'){
		if($_GET['page'] == 'settings' || $_GET['page'] == 'pages' || $_GET['page'] == 'modules' || $_GET['page'] == 'news' || $_GET['page'] == 'templates'){
			require 'files/admin/header.php';
			require 'files/admin/pages/'.$_GET['page'].'.php';
		}else{
			require 'files/config/config.php';
			require 'files/handler/error.php';
			error_send('404');
		}
	}else{
		require 'files/admin/header.php';
?>
<div class="container-fluid adm-main-block">
  <a href="/admin/settings"><div class="col-md-4 adm-block"><i class="fa fa-cogs fa-5" aria-hidden="true"></i><h1 class="text-center">Настройки</h1></div></a>
  <a href="/admin/pages"><div class="col-md-4 adm-block"><i class="fa fa-paperclip fa-5" aria-hidden="true"></i><h1 class="text-center">Страницы</h1></div></a>
  <a href="/admin/templates"><div class="col-md-4 adm-block"><i class="fa fa-pencil-square fa-5" aria-hidden="true"></i><h1>Шаблоны</h1></div></a>
  <div class="col-md-4"></div><a href="/admin/modules"><div class="col-md-4 adm-block"><i class="fa fa-upload fa-5" aria-hidden="true"></i><h1>Модули</h1></div></a><div class="col-md-4"></div>
</div>
<?}?>