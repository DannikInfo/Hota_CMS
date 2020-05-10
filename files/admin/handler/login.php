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
* /files/admin/handler/login.php - login handler
* -Last update: 29.01.2018
* 
*
*/
	if(!isset($_SESSION)){
		session_start();
	}
	function check_pass($login, $gpass){
		require 'sequrity.php';
		global $sconfig, $connect;
		if($login != ''){
			$login = mysqli_real_escape_string($connect, $login);
			$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."admin WHERE login='".$login."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			$result = mysqli_fetch_assoc($stmt);
			if($stmt == true){
				$real_pass = $result['password'];
				$hash_pass = sha1(md5(md5($gpass)));
				if($hash_pass == $real_pass){
					$hash = getHash($login);
					$_SESSION['admin'] = $login;
					$_SESSION['login'] = true;
					$_SESSION['hash'] = $hash;
					//setcookie('login', true, time()+14400);
					//setcookie('admin', $login, time()+14400);
					//setcookie('hash', $hash, time()+14400);
					print '<script>relocation("/admin/main");</script>';
				}else{
					print'
						<div class="alert alert-danger">Неправильный логин или пароль!</div>
					';
				}
			}
		}else{
			print'
				<div class="alert alert-danger">Введите логин!</div>
			';
		}
	}

	//обработчики запросов js

	if(isset($_POST['exit']) == "1"){
		$_SESSION['login'] = false;
		$_SESSION['admin'] = false;
		$_SESSION['hash'] = false;
		//setcookie("login", false, time()-1);
		//setcookie("admin", false, time()-1);
		//setcookie("hash", false, time()-1);
	}
?>