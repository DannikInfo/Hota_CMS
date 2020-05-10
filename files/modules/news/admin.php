<?
	function news_list(){
		require 'files/config/config.php';
		require 'files/lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."news";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		echo '<tr><th>ID</th><th>Заголовок</th><th>Дата</th><th>Действия</th></tr>';
		do{
			if($result['id'] != ''){
				echo '<tr><td>'.$result['id'].'</td><td>'.$result['header'].'</td><td>'.$result['date'].'</td><td> 
				<button class="btn btn-success btn-sm" onClick="news_edit(\''.$result['id'].'\')">Изменить</button>
	 			<button class="btn btn-danger btn-sm"	onClick="news_remove(\''.$result['id'].'\')">Удалить</button></td></tr>';
 			}else{
 				echo '<tr><td colspan="4">На данный момент новостей еще не создано</td></tr>';
 			}
		}while($result = mysqli_fetch_assoc($stmt));
	}

	function news_add($nheader, $ncontent, $type){
		require 'files/config/config.php';
		require 'files/lib/db_connection.php';
		if($type != '' & $nheader != '' & $ncontent != ''){
			$ndate = date("Y-m-d");
			$query = "INSERT INTO ".$sconfig['DBTablePrefix']."news (header, content, date, type) VALUES ('".$nheader."', '".$ncontent."', '".$ndate."', '".$type."')";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			if($stmt == true){
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Ноллллвость добавлена успешно!</div><?php
			}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
		}
	}

	function news_add_view(){
		echo '
			<script src="/files/admin/js/jquery.wysibb.min.js"></script>
			<link rel="stylesheet" href="/files/admin/css/wbbtheme.css">
			<script>
			$(function() {
				$("#editor").wysibb();
			})
			</script>
			<form method="POST" id="news_add_form">
				<input name="nheader" type="text" class="form-control" placeholder="заголовок"><br>
				Тип новости:<br>
				<input type="radio" name="type" value="news-primary"><span style="color:rgb(66,139,202); padding-left:5px;">Обычная</span>
				<input type="radio" name="type" value="news-success"><span style="color:rgb(92,184,92); padding-left:5px;">Успешная</span></span>
				<input type="radio" name="type" value="news-info" checked><span style="color:rgb(91,192,222); padding-left:5px;">Информационная</span>
				<input type="radio" name="type" value="news-warning"><span style="color:rgb(240,173,78); padding-left:5px;">Предупреджающая</span>
				<input type="radio" name="type" value="news-danger"><span style="color:rgb(204,78,74); padding-left:5px;">Предостерегающая</span><br>	
				<textarea placeholder="Контент" rows="10" id="editor" name="ncontent"></textarea><br>
				<button class="btn btn-primary">Применить</button>
			</form><p></p>
			<button class="btn btn-danger" onClick="block_hider(\'.page-add\', \'#page-main\')">Отмена</button>
		';
	}
	function news_edit_view($nid){
		require '../../config/config.php';
		require_once '../../handler/error.php';
		require '../../lib/db_connection.php';
		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."news WHERE id='".$nid."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		if($stmt == true){
			echo '
			<script src="/files/admin/js/jquery.wysibb.min.js"></script>
			<link rel="stylesheet" href="/files/admin/css/wbbtheme.css">
			<script>
			$(function() {
				$("#editor").wysibb();
			})
			</script>
				<h4>ID: '.$result['id'].'</h4>
	 			<form method="POST" id="news_edit_form">
	 				<input name="pheader" type="text" class="form-control" placeholder="заголовок" value="'.$result['header'].'">
	 				Тип новости:<br>
	 				<input type="radio" name="type" value="news-primary"><span style="color:rgb(66,139,202); padding-left:5px;">Обычная</span>
					<input type="radio" name="type" value="news-success"><span style="color:rgb(92,184,92); padding-left:5px;">Успешная</span></span>
					<input type="radio" name="type" value="news-info" checked><span style="color:rgb(91,192,222); padding-left:5px;">Информационная</span>
					<input type="radio" name="type" value="news-warning"><span style="color:rgb(240,173,78); padding-left:5px;">Предупреджающая</span>
					<input type="radio" name="type" value="news-danger"><span style="color:rgb(204,78,74); padding-left:5px;">Предостерегающая</span><br>
	 				<input type="hidden" name="pid" value="'.$result['id'].'">
	 				<input type="hidden" name="edit" value="1">
	 				<textarea placeholder="Контент" rows="10" id="editor" name="ncontent">'.$result['content'].'</textarea><br>
		 			<button class="btn btn-primary">Применить</button>
				</form><p></p>
				<button class="btn btn-danger" onClick="block_hider(\'.page-edit\', \'#page-main\')">Отмена</button>
			';	
		}
	}

	function news_remove($nid){
		require '../../config/config.php';
		require '../../handler/error.php';
		require '../../lib/db_connection.php';
		$query = "DELETE FROM ".$sconfig['DBTablePrefix']."news WHERE id='".$nid."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		if($stmt == true){
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Новость удалена успешно!</div><?php
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
		}
	}

	function news_edit($nid, $nheader, $ncontent, $type){
		require 'files/config/config.php';
		require 'files/lib/db_connection.php';
		if($type != '' & $nheader != '' & $ncontent != ''){
			$query = "UPDATE ".$sconfig['DBTablePrefix']."news SET header='".$nheader."', content='".$ncontent."', type='".$type."' WHERE id='".$nid."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			if($stmt == true){
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Новость обновлена успешно!</div><?php
			}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
		}
	}

	//обработка js запросов

	if(isset($_POST['nheader']) || isset($_POST['ncontent']) || isset($_POST['type'])){
		if(!isset($_POST['edit']) & !isset($_POST['nid']) & !isset($_POST['delete'])){
			news_add($_POST['nheader'], $_POST['ncontent'], $_POST['type']);
		}
	}
	if(isset($_POST['nid']) & isset($_POST['edit'])){
		if($_POST['edit'] == 1){
			news_edit($_POST['nid'], $_POST['nheader'], $_POST['ncontent'], $_POST['type']);
		}
		if($_POST['edit'] == 0){
			news_edit_view($_POST['nid']);
		}
	}
	if(isset($_POST['addv'])){
		if($_POST['addv'] == 1){
			news_add_view();
		}
	}	
	if(isset($_POST['nid']) & isset($_POST['delete'])){
		if($_POST['delete'] == 1){
			news_remove($_POST['nid']);
		}
	}
?>