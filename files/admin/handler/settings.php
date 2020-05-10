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
* WolfEco team can close a part of code from public access (or make obfuscation of this part) at own discretion.
* You are not allowed to access the closed part of the code, nor modify it.
*
* @author WoflEco team
* @link http://wolfeco.ru/page/cms
*
* /files/admin/handler/settings.php - settings handler
* -Last update: 04.02.2018
* 
*
*/
	if(!isset($_SESSION))
		session_start();

	function main_view(){
		echo '
		   	<input id="sname" type="text" class="form-control input-fix" placeholder="Название" value="'.config_list('SiteName').'">
		   	<br>
		   	<input id="sdomain" type="text" class="form-control input-fix" placeholder="Домен" value="'.config_list('SiteDomain').'">
		   	<br>
		   	<input id="stemplate" type="text" class="form-control input-fix" placeholder="шаблон" value="'.config_list('SiteTemplate').'">
		   	<br>
		   	<input id="stitle" type="text" class="form-control input-fix" placeholder="<title></title>" value="'.config_list('SiteTitle').'">
		   	<br>
		   	<button class="btn btn-lg btn-primary btn-block" onClick="settings_edit(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')" >Применить</button>
		';
	}

	function admin_add_view(){
		print '
			<div id="admin_add" class="modal fade">
				<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			         			<span aria-hidden="true">&times;</span>
			        		</button>
			        		<h4 class="modal-title">Добавить администратора</h4>
			      		</div>
				     	<div class="modal-body">
				        	<input id="aname" type="text" class="form-control input-fix" placeholder="Логин"><br>
				        	<input id="apass" type="password" class="form-control input-fix" placeholder="Пароль"><br>
				        	<input id="apass2" type="password" class="form-control input-fix" placeholder="Повтор пароля"><br>
				        	<input id="aemail" type="email" class="form-control input-fix" placeholder="e-mail"><br>
				      	</div>
				      	<div class="modal-footer">
				        	<button type="button" class="btn btn-primary" onClick="admin_add(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Добавить</button>
				      	</div>
			    	</div>
			  	</div>
			</div>
		';
	}

	function admin_edit_view($id){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."admin WHERE id='".$id."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		print '
			<div id="admin_edit" class="modal fade">
				<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			         			<span aria-hidden="true">&times;</span>
			        		</button>
			        		<h4 class="modal-title">Изменить администратора</h4>
			      		</div>
				     	<div class="modal-body">
				        	<input id="aname" type="text" class="form-control input-fix" placeholder="Логин" value="'.$result['login'].'"><br>
				        	<input id="apass" type="password" class="form-control input-fix" placeholder="Пароль"><br>
				        	<input id="apass2" type="password" class="form-control input-fix" placeholder="Повтор пароля"><br>
				        	<input id="aemail" type="email" class="form-control input-fix" placeholder="e-mail" value="'.$result['email'].'"><br>
				      	</div>
				      	<div class="modal-footer">
				        	<button type="button" class="btn btn-success" onClick="admin_edit(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\', \''.$id.'\')">Изменить</button>
				      	</div>
			    	</div>
			  	</div>
			</div>
		';
	}

	function admin_view(){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."admin";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		echo '<table class="table table-striped ">';
		echo '<tr><th class="table-thl-fix">Логин</th><th>Email</th><th class="table-thr-fix"></th></tr>';
		$i = 1;
		do{
			if($i == 1)
				$disabled = 'disabled';
			else
				$disabled = '';
			echo '<tr><td>'.$result['login'].'</td><td>'.$result['email'].'</td><td>
			<button class="btn btn-success btn-sm" onClick="admin_view(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\', \''.$result['id'].'\', \'admin_edit\')"><i class="fa fa-pencil" aria-hidden="true"></i></button>
	 		<button class="btn btn-danger btn-sm" '.$disabled.' onClick="admin_remove(\''.$result['id'].'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>';
	 		$i++;
		}while($result = mysqli_fetch_assoc($stmt));
		echo '</table>
 			<button class="btn btn-primary" onClick="admin_view(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\', \'\', \'admin_add\')">Добавить</button>';
	}

	function update_list(){
		require 'files/config/config.php';
		require 'files/lib/db_connection.php';
		global $version, $site_id, $hota_user, $license;
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."settings WHERE argument='Update'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		$query2 = "SELECT * FROM ".$sconfig['DBTablePrefix']."settings WHERE argument='UpdateLink'";
		$stmt2 = mysqli_query($connect, $query2)or die(mysqli_error($connect));
		$result2 = mysqli_fetch_assoc($stmt2);
		if($result['value'] != '' and $result['value'] != $version){
			print('<h4>Доступно обновление: <button class="btn btn-xs btn-info" onclick="update(\''.$result2['value'].'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">'.$result['value'].'</button></h4>');
		}
	}

	function config_list($arg){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."settings WHERE argument='".$arg."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		return $result['value'];
	}

	function admin_add($login, $pass, $pass2, $email){
		require './../../config/config.php';
		require './../../lib/db_connection.php';
		if($login != '' && $pass != '' && $pass2 != '' && $email != ''){
			if($pass == $pass2){
				$passHash = sha1(md5(md5($pass)));
				$query = "INSERT INTO ".$sconfig['DBTablePrefix']."admin (login, password, email) VALUES ('".$login."', '".$passHash."', '".$email."')";
				$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
				if($stmt){
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Администратор добавлен успешно!</div><?
				}else{
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
				}
			}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
		}
	}

	function admin_remove($id){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query = "DELETE FROM ".$sconfig['DBTablePrefix']."admin WHERE id='".$id."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		if($stmt){
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Администратор удален успешно!</div><?
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
		}
	}

	function admin_edit($id, $login, $pass, $pass2, $email){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		if($login != '' && $email != ''){
			if($pass == '' && $pass2 == ''){
				$query = "UPDATE ".$sconfig['DBTablePrefix']."admin SET login='".$login."', email='".$email."' WHERE id='".$id."'";
				$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
				if($stmt){
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Администратор изменен успешно!</div><?
				}else{
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
				}
			}else{
				if($pass != '' && $pass != ''){
					if($pass == $pass2){
						$passHash = sha1(md5(md5($pass)));
						$query = "UPDATE ".$sconfig['DBTablePrefix']."admin SET login='".$login."', password='".$passHash."', email='".$email."' WHERE id='".$id."'";
						$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));	
					}else{
						?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
					}
				}else{
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
				}
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
		}
	}

	function config_edit($sname, $sdomain, $stemplate, $stitle){
		if($sname != '' || $sdomain != '' || $stemplate != '' || $stitle != ''){
			require './../../config/config.php';
			require './../../lib/db_connection.php';
			$query_sname = "UPDATE ".$sconfig['DBTablePrefix']."settings SET value='".$sname."' WHERE argument='SiteName'";
			$query_sdomain = "UPDATE ".$sconfig['DBTablePrefix']."settings SET value='".$sdomain."' WHERE argument='SiteDomain'";
			$query_stemplate = "UPDATE ".$sconfig['DBTablePrefix']."settings SET value='".$stemplate."' WHERE argument='SiteTemplate'";
			$query_stitle = "UPDATE ".$sconfig['DBTablePrefix']."settings SET value='".$stitle."' WHERE argument='SiteTitle'";
			if($sname != ''){$stmt = mysqli_query($connect, $query_sname)or die(mysqli_error($connect));}
			if($sdomain != ''){$stmt = mysqli_query($connect, $query_sdomain)or die(mysqli_error($connect));}
			if($stemplate != ''){$stmt = mysqli_query($connect, $query_stemplate)or die(mysqli_error($connect));}
			if($stitle != ''){$stmt = mysqli_query($connect, $query_stitle)or die(mysqli_error($connect));}
			if($stmt == true){
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Изменения сохранены!</div>
				<?
			}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?
		}
	}

	//обработка js запросов
	if(isset($_POST['hash']) && isset($_POST['login'])){
		require 'sequrity.php';
		if(checkHash($_POST['hash'], $_POST['login'])){
			if(isset($_POST['view'])){
				switch ($_POST['view']){
				    case 'main':
				        main_view();
				        break;
					case 'admin':
						admin_view();
						break;
					case 'admin_add':
						admin_add_view();
						break;
					case 'admin_edit':
						admin_edit_view($_POST['aid']);
						break;
				}
			}
			if(isset($_POST['handle'])){
				switch ($_POST['handle']) {
					case 'main':
						config_edit($_POST['sname'], $_POST['sdomain'], $_POST['stemplate'], $_POST['stitle']);	
						break;
					case 'admin_add':
						admin_add($_POST['alogin'], $_POST['apass'], $_POST['apass2'], $_POST['aemail']);
						break;
					case 'admin_remove':
						admin_remove($_POST['aid']);
						break;
					case 'admin_edit':
						admin_edit($_POST['aid'], $_POST['alogin'], $_POST['apass'], $_POST['apass2'], $_POST['aemail']);
						break;
				}
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 0!</div><?
		}
	}
?>