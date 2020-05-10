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
* /files/admin/pages/install.php - install page DELETE THIS FILE AFTER INSTALL SYSTEM!!!
* -Last update: 30.12.2018
* 
*
*/
	if(!file_exists('../../config/config.php') or isset($_GET['step']) <= 6){
		require '../header.php';
		if(isset($_GET['step']))
			$step = $_GET['step'];
		else 
			$step = '';
?>
<div class="all"></div>
<div class="adm">
	<div class="panel panel-default panel-fix" id="page-main">
		<div class="panel-heading panel-fix">  	
			<b>Установка 
		  		<span id="loading" style="display: none;">
		    		<i class="fa fa-cog fa-spin fa-1x " aria-hidden="true"></i>
		    		<span class="sr-only">Saving. Hang tight!</span>
				</span>
			</b>
		</div>
		<div class="panel-body">
			<?if($step == 1 or $step == ''){?>
			<form method="POST" id="install_step_db">
			   	<input name="dhost" type="text" class="form-control input-fix" placeholder="localhost - хост базы"><br>
			   	<input name="db" type="text" class="form-control input-fix" placeholder="HOTA - имя базы"><br>
			   	<input name="duser" type="text" class="form-control input-fix" placeholder="root - пользователь базы"><br>
			   	<input name="dpass" type="password" class="form-control input-fix" placeholder="password - пароль базы"><br>
			   	<input name="dprefix" type="text" class="form-control input-fix" placeholder="Hota_ - префикс таблиц"><br>
			   	<button class="btn btn-lg btn-primary btn-block">Дальше</button>
		   	</form>
		   	<?}
		   	if($step == 2){
			?>
			<form method="POST" id="install_step_config">
			   	<input name="sname" type="text" class="form-control input-fix" placeholder="example - название"><br>
			   	<input name="sdomain" type="text" class="form-control input-fix" placeholder="example.ru - домен"><br>
			   	<input name="stitle" type="text" class="form-control input-fix" placeholder="<title></title> - title сайта"><br>
			   	<button class="btn btn-lg btn-primary btn-block">Дальше</button>
		   	</form>
		   	<?}
		   	if($step == 3){
		   	?>
		   	<h3>Регистрация в WolfEco</h3>
		   	<form method="POST" id="install_step_wolfeco">
			   	<input name="uname" type="text" class="form-control input-fix" placeholder="User - логин"><br>
			 	<input name="upass1" type="password" class="form-control input-fix" placeholder="Password - пароль"><br>
				<input name="upass2" type="password" class="form-control input-fix" placeholder="Password - повтор пароля"><br>
			   	<input name="uemail" type="email" class="form-control input-fix" placeholder="user@example.com - EMail"><br>
			   	<button class="btn btn-lg btn-primary btn-block">Дальше</button>
		   	</form>
		   		<button class="btn btn-lg btn-primary btn-block install-area">У меня есть аккаунт WolfEco</button>
		   	<?}
		   	if($step == 4){
		   	?>
		   	<h3>Авторизация в WolfEco</h3>
		   	<form method="POST" id="install_step_wolfeco_login">
			   	<input name="uname_l" type="text" class="form-control input-fix" placeholder="User - логин"><br>
			   	<input name="upass" type="password" class="form-control input-fix" placeholder="Password - пароль"><br>
				<button class="btn btn-lg btn-primary btn-block">Дальше</button>
		   	</form>
		   	<?}
		   	if($step == 5){
		   	?>
		   	<h3>Аккаунт администратора</h3>
		   	<form method="POST" id="install_step_admin">
			   	<input name="aname" type="text" class="form-control input-fix" placeholder="User - логин"><br>
			   	<input name="apass1" type="password" class="form-control input-fix" placeholder="Password - пароль"><br>
				<input name="apass2" type="password" class="form-control input-fix" placeholder="Password - повтор пароля"><br>
			   	<input name="aemail" type="email" class="form-control input-fix" placeholder="user@example.com - EMail"><br>
			   	<button class="btn btn-lg btn-primary btn-block">Дальше</button>
		   	</form>
		   	<?}
		   	if($step == 6){
		   	?>
		   	<h3>Окончание установки:</h3><br>
				<h4>WolfEco Public License v1.0</h4>
	 			<span>Программное обеспечение команды WolfEco может быть выпущено из 3-х типов - полное публичное, смешанное публичное, закрытое.<br><br>
					HOTA CMS - это смешанное публичное программное обеспечение<br>
					Команда WolfEco может закрыть часть кода из открытого доступа (или сделать обфускацию этой части) по своему усмотрению.<br>
					Вы не можете получить доступ к закрытой части кода или изменить его.<br><br>
					Нажимая кнопку <b>закончить установку</b> вы принимаете данное лицензионное соглашение.<br><br>
					<b>Удалите файлы из дирректорий /files/admin/pages/install.php и /files/admin/handler/install.php во избежании переустановки системы третьими лицами.</b>
					<br><br>
				</span>

				<a href="/admin/main"><button class="btn btn-primary btn-lg btn-block">Закончить установку</button></a>
		   	<?}?>
		</div>
	</div>
</div>
<?
	require '../footer.php';
	}else{
		header('Location: /index.php');
	}
?>