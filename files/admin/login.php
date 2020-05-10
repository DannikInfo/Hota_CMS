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
* /files/admin/login.php - login form of admin panel
* -Last update: 14.01.2018
* 
*
*/
?>
</div>
<form class="form-signin" role="form" action="#" method="post">
	<?php
		if(isset($_POST['login'])){
			require 'files/admin/handler/login.php';
			check_pass($_POST['login'], $_POST['password']);
		}
	?>
	<h2 class="form-signin-heading">Пожалуйста войдите</h2>
	<input name="login" type="login" class="form-control" placeholder="Логин" required autofocus>
	<input name="password" type="password" class="form-control" placeholder="Пароль" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
</form>