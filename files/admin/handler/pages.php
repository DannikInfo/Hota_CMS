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
* /files/admin/handler/pages.php - pages handler
* -Last update: 13.03.2018
* 
*
*/

	if(!isset($_SESSION)){
		session_start();
	}

	function page_list(){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."pages";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		echo '<table class="table table-striped">';
		echo '<tr><th class="table-thl-fix">Название</th><th>Заголовок</th><th>Категория</th><th class="table-thr-fix"></th></tr>';
		do{
			if($result['id'] != ''){
				echo '<tr><td><a href="/page/'.$result['name'].'">'.$result['name'].'</a></td><td>'.$result['header'].'</td><td>'.$result['category'].'</td><td> 
				<button class="btn btn-success btn-sm" onClick="page_edit(\''.$result['id'].'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-pencil" aria-hidden="true"></i></button>
	 			<button class="btn btn-danger btn-sm"	onClick="page_remove_modal(\''.$result['id'].'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>';
 			}else{
 				echo '<tr><td colspan="4">На данный момент страниц еще не создано</td></tr>';
 			}
		}while($result = mysqli_fetch_assoc($stmt));
		echo '</table>
 			<button class="btn btn-primary" id="bt-add" onClick="page_add(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Добавить</button>';
	}

	function page_add($pname, $pheader, $pcat, $pcontent, $plead, $pbbcode){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		if($pcat == '')
			$pcat = 'main';
		if($pbbcode == 'true')
			$pbbcode = '1';
		else
			$pbbcode = '0';
		$query1 = "SELECT * FROM ".$sconfig['DBTablePrefix']."pages WHERE name='".$pname."'";
		$stmt1 = mysqli_query($connect, $query1)or die(mysqli_error($connect));
		$result1 = mysqli_fetch_assoc($stmt1);
		if($result1['category'] != $pcat){
			if($pname != '' & $pheader != '' & $pcontent != ''){
				if($plead == ''){
					$query = "INSERT INTO ".$sconfig['DBTablePrefix']."pages (name, header, category, content, bbcode) VALUES ('".$pname."', '".$pheader."', '".$pcat."', '".$pcontent."', '".$pbbcode."')";
				}else{
					$query = "INSERT INTO ".$sconfig['DBTablePrefix']."pages (name, header, category, lead, content, bbcode) VALUES ('".$pname."', '".$pheader."', '".$pcat."', '".$plead."', '".$pcontent."', '".$pbbcode."')";
				}
				$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
				if($stmt == true){
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Страница добавлена успешно!</div><?php
				}else{
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
				}
			}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
			}
		}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
		}
	}

	function page_add_view(){
		echo '
			<script src="../../files/admin/js/quill.min.js"></script>
			<link rel="stylesheet" href="../../files/admin/css/quill.bubble.css">
			<script>                          
				quill = new Quill(\'#content-area\', {
				    placeholder: \'Контент\',
				    theme: \'bubble\',
				    modules: {
						toolbar: toolbarOptions
					}
				});
				editor = CodeMirror.fromTextArea(document.getElementById(\'code-area\'), {
				  lineNumbers: true,               // показывать номера строк
				  matchBrackets: true,             // подсвечивать парные скобки
				  mode: \'text/html\', 				// стиль подсветки
				  indentUnit: 4                    // размер табуляции
				});
				$(\'.CodeMirror\').hide();
			</script>
			<input id="pname" type="text" class="form-control input-fix" placeholder="Название"><br>
			<input id="pcat" type="text" class="form-control input-fix" placeholder="Категория"><br>
			<input id="pheader" type="text" class="form-control input-fix" placeholder="Заголовок"><br>
			<input id="plead" type="text" class="form-control input-fix" placeholder="Краткое описание"><br>
			<input type="checkbox" class="checkbox" id="bb" checked onClick="bbChose()"> 
			<label class="tagLabel" for="bb">BB</label>
			<button class="btn btn-default pull-right" onClick="undoModal()" title="Отмена"><i class="fa fa-undo fa-2x"></i></button>			
			<button class="btn btn-default pull-right" title="Сохранить" onClick="page_db(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\', \'edit\')"><i class="fa fa-save fa-2x"></i></button>
			<button class="btn btn-default pull-right" title="Назад" onClick="page_list(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-2x fa-angle-left"></i></button>
			<br><br>
			<textarea id="code-area"></textarea>
			<div class="page_add_content" id="content-area"></div>
		';
	}

	function page_edit_content($pid){
		require '../../config/config.php';
		require '../../handler/error.php';
		require '../../lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."pages WHERE id='".$pid."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		if($stmt == true)
			print $result['content'];
	}

	function page_edit_view($pid){
		require '../../config/config.php';
		require '../../handler/error.php';
		require '../../lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."pages WHERE id='".$pid."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		if($stmt == true){
			echo '
			<script src="../../files/admin/js/quill.min.js"></script>
			<link rel="stylesheet" href="../../files/admin/css/quill.bubble.css">
			<script>                          
				quill = new Quill(\'#content-area\', {
				    placeholder: \'Контент\',
				    theme: \'bubble\',
				    modules: {
						toolbar: toolbarOptions
					}
				});
				editor = CodeMirror.fromTextArea(document.getElementById(\'code-area\'), {
				  lineNumbers: true,               // показывать номера строк
				  matchBrackets: true,             // подсвечивать парные скобки
				  mode: \'text/html\', 				// стиль подсветки
				  indentUnit: 4                    // размер табуляции
				});
				$(\'.CodeMirror\').hide();
			</script>
			';
			echo '<script>$(\'#bb\').prop(\'checked\', true);</script>';
			if($result['bbcode'] == '0')
				echo '<script>$(\'#bb\').click();</script>';
			echo '
			<input id="pname" type="text" class="form-control input-fix" placeholder="Название" value="'.$result['name'].'"><br>
			<input id="pcat" type="text" class="form-control input-fix" placeholder="Категория" value="'.$result['category'].'"><br>
			<input id="pheader" type="text" class="form-control input-fix" placeholder="Заголовок" value="'.$result['header'].'"><br>
			<input id="plead" type="text" class="form-control input-fix" placeholder="Краткое описание" value="'.$result['lead'].'"><br>
			<input id="pid" type="hidden" value="'.$result['id'].'">
			<input id="bb" type="checkbox" class="checkbox" onClick="bbChose()"> 
			<label class="tagLabel" for="bb">BB</label>
			<button class="btn btn-default pull-right" onClick="undoModal(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')" title="Отмена"><i class="fa fa-undo fa-2x"></i></button>			
			<button class="btn btn-default pull-right" title="Сохранить" onClick="page_db(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\', \'edit\')"><i class="fa fa-save fa-2x"></i></button>
			<button class="btn btn-default pull-right" title="Назад" onClick="page_list(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-2x fa-angle-left"></i></button>
			<br><br>
			<textarea id="code-area"></textarea>
			<div class="page_add_content" id="content-area"></div>
		';
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
		}
	}

	function page_remove($pid){
		require '../../config/config.php';
		require '../../handler/error.php';
		require '../../lib/db_connection.php';
		$query = "DELETE FROM ".$sconfig['DBTablePrefix']."pages WHERE id='".$pid."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		if($stmt == true){
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Страница удалена успешно!</div><?php
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
		}
	}

	function page_remove_modal($pid){
		echo '<div id="removeModal" class="modal fade">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		         			<span aria-hidden="true">&times;</span>
		        		</button>
		        		<h5 class="modal-title">Вы действительно хотите удалить эту страницу?</h5>
		      		</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-primary" onClick="page_remove(\''.$pid.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Да</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
			      	</div>
		    	</div>
		  	</div>
		</div>';
	}

	function undo_modal(){
		echo '<div id="undoModal" class="modal fade">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		         			<span aria-hidden="true">&times;</span>
		        		</button>
		        		<h5 class="modal-title">Вы действительно хотите откатить все изменения до последнего переключения кнопки BB?</h5>
		      		</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-primary" onClick="undoBB()">Да</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
			      	</div>
		    	</div>
		  	</div>
		</div>';
	}

	function page_edit($pid, $pname, $pheader, $pcat, $pcontent, $plead, $pbbcode){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$pbb = '';
		if($pbbcode == 'true')
			$pbbcode = 1;
		else
			$pbbcode = 0;
		if($pcat == ''){
			$pcat = 'main';
		}
		if($pname != '' && $pheader != '' && $pcontent != ''){
			$query = "UPDATE ".$sconfig['DBTablePrefix']."pages SET name='".$pname."', header='".$pheader."', category='".$pcat."', lead='".$plead."', content='".$pcontent."', bbcode='".$pbbcode."' WHERE id='".$pid."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			if($stmt == true){
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Страница обновлена успешно!</div><?php
			}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка2!</div><?php
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка1!</div><?
		}
	}

	//обработка js запросов
	if(isset($_POST['hash']) && isset($_POST['login'])){
		require 'sequrity.php';
		if(checkHash($_POST['hash'], $_POST['login'])){
			if(isset($_POST['handle']) && $_POST['handle'] == 'add'){
				page_add($_POST['pname'], $_POST['pheader'], $_POST['pcat'], $_POST['pcontent'], $_POST['plead'], $_POST['pbbcode']);
			}

			if(isset($_POST['view'])){
				if($_POST['view'] == 'edit')
					page_edit_view($_POST['pid']);
				if($_POST['view'] == 'edit_content')
					page_edit_content($_POST['pid']);
			}

			if(isset($_POST['handle']) && $_POST['handle'] == 'edit'){
				page_edit($_POST['pid'], $_POST['pname'], $_POST['pheader'], $_POST['pcat'], $_POST['pcontent'], $_POST['plead'], $_POST['pbbcode']);
			}

			if(isset($_POST['addv'])){
				if($_POST['addv'] == 1){
					page_add_view();
				}
			}
			if(isset($_POST['view']) && $_POST['view'] == 'undo')
				undo_modal();
			if(isset($_POST['view']) && $_POST['view'] == 'delete')
				page_remove_modal($_POST['pid']);
			if(isset($_POST['handle']) && $_POST['handle'] == 'delete')
				page_remove($_POST['pid']);
			if(isset($_POST['view']) && $_POST['view'] == 'list')
				page_list();
			
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 0!</div><?
		}
	}
?>