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
* WolfEco team can close a part of code from public access (or make obfuscation of this part) at own discretion.
* You are not allowed to access the closed part of the code, nor modify it.
*
* @author WoflEco team
* @link http://wolfeco.ru/page/cms
*
* /files/admin/pages/templates.php - file manager page
* -Last update: 27.01.2018
* 
*
*/
	require 'files/admin/handler/templates.php';
?>
<div class="all"></div>
<div class="adm">
	<div class="panel panel-default panel-fix" id="page-main">
		<div class="panel-heading panel-fix">
			<h3 class="panel-title">Шаблоны</h3>
		</div>
		<div class="panel-body">
 			<div class="template_content">
	 			<?template_main_list();?>
 			</div>
		</div>
	</div>
</div>