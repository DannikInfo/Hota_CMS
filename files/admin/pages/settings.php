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
* /files/admin/pages/settings.php - settings sytstem page
* -Last update: 04.02.2018
* 
*
*/
	require 'files/admin/handler/settings.php';
	global $we_user, $site_id, $license, $version
?>

<div class="all"></div>
<div class="adm">
	<div class="panel panel-default panel-fix">
		<div class="panel-heading panel-fix">
			<h3 class="panel-title">Главные настройки</h3>
		</div>
		<div class="panel-body main-settings">
 			<script>
 				settings_main_view('<?=$_SESSION['hash']?>','<?=$_SESSION['admin']?>');
 			</script>
		</div>
	</div>
	<div class="panel panel-default panel-fix">
		<div id="modalS"></div>
		<div class="panel-heading panel-fix">
			<h3 class="panel-title">Администраторы</h3>
		</div>
		<div class="panel-body admin-settings">
			<script>
 				admin_main_view('<?=$_SESSION['hash']?>','<?=$_SESSION['admin']?>');
 			</script>
		</div>
	</div>
	<div class="panel panel-default panel-fix">
		<div class="panel-heading panel-fix">
			<h3 class="panel-title">Системная информация</h3>
		</div>
		<div class="panel-body">
			<h4>WolfEco Account: <span class="lead"><?=$we_user?></span></h4>
			<h4>Идентификатор сайта: <span class="lead"><?=$site_id?></span></h4>
			<h4>Статус лицензии: <span class="lead"><?=$license?></span></h4>
			<h4>Версия системы: <span class="lead"><?=$version?></span></h4>
			<?update_list();?>
			<button class="btn btn-success" onClick="update_check('<?=$version?>', '<?=$license?>', '<?=$we_user?>', '<?=$site_id?>')">Проверить наличие обновления</button>
			<h4><a href="//doc.wolfeco.ru/cms" target="blank">Документация</a></h4>
			<h4><a href="//wolfeco.ru/page/help-us" target="blank">Помочь проекту</a></h4>
		</div>
	</div>
</div>