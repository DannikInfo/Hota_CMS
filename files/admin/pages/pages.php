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
* /files/admin/pages/pages.php - page with pages
* -Last update: 08.06.2018
* 
*
*/
?>
<div class="mod"></div>
<div class="all"></div>
<div class="adm">
	<div class="panel panel-default panel-fix" id="page-main">
		<div class="panel-heading panel-fix">
			<h3 class="panel-title">Страницы</h3>
		</div>
		<div class="panel-body">
 			<script>
 				page_list('<?=$_SESSION['hash']?>','<?=$_SESSION['admin']?>');
 			</script>
		</div>
	</div>
</div>