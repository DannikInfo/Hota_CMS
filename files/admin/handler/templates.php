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
* /files/admin/handler/templates.php - file manager handler
* -Last update: 27.01.2018
* 
*
*/
	if(!isset($_SESSION)){
		session_start();
	}

	//Return main list of templates type
	function template_main_list(){
		echo '<ul class="list-group">';
		echo '<button class="list-group-item cat" onClick="template_main(\'error\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Ошибки</button>';
		echo '<button class="list-group-item cat" onClick="template_main(\'\',\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-folder-o" aria-hidden="true"></i> Основные</button>';
		echo '</ul>';
	}

	//Return base variable like a template, version
	if(!function_exists('base_site')){
		function base_site($cnfg){
			include '../../config/config.php';
			require '../../lib/db_connection.php';
			$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."settings WHERE argument='".$cnfg."'";
			$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
			$result = mysqli_fetch_assoc($stmt);
			return $result['value'];
		}
	}

	//Return list of template files or errors from data base 
	function template_main($type, $dir, $function){
		//including all config files
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		require '../../handler/base.php';

		$template = base_site('SiteTemplate'); //Get current template

		if($type == 'errorCancel'){ //Handle click on button cancel in error menu
			template_main_list();
			exit();
		}

		if($function == 1){ //Return first files list or errors list
			chdir('./../../templates/'.$template); //Move to template directory
			if($type != 'error'){ //IF type not error then return files list
				if ($handle = opendir(getcwd())) { //Open dir
				    echo '<ul class="list-group">';
				    while (false !== ($entry = readdir($handle))) { //While directory not end - return files list
				    	if ($entry != "." && $entry != ".DS_Store") { //Filter trash
				    		if(is_dir('../../templates/'.$template.'/'.$entry)){ //IF dir then return button with folder icon 
				       			echo '<button class="list-group-item cat" onclick="template_changedir(\''.$entry.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-folder-o" aria-hidden="true"></i> '.$entry.'</button>';
				       		}else{ //else return file button
				       			$FileInfo = new SplFileInfo($entry); //Get file info
				       			$ext = $FileInfo->getExtension(); //Get file extension.. Why it OOP?
				       			if($ext == "png" or $ext == "jpg" or $ext == "bmp") //IF file is image then return button with image icon
				       				echo '<button class="list-group-item file" onclick="template_openfile(\''.$entry.'\', \''.$ext.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-file-image-o" aria-hidden="true"></i> '.$entry.'</button>';
				       			else //Else return button with file-code icon
				       				echo '<button class="list-group-item file" onclick="template_openfile(\''.$entry.'\', \''.$ext.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-file-code-o" aria-hidden="true"></i> '.$entry.'</button>';
				       		}
				    	}
				    }
				    echo '</ul>';
				    closedir($handle); //Close dir
				    if(!is_dir('../../tmp')){ //Create tmp dir if not found
				    	mkdir('../../tmp');
				    	mkdir('../../tmp/cache');
				    }else{
				    	if(!is_dir('../../tmp/cache')){
				    		mkdir('../../tmp/cache');
				    	}
				    }
				    //in a temporary file write the path
				    file_put_contents('../../tmp/cache/fm.tmp', '../../templates/'.$template);
				}
			}else{ //Else - return list with errors template
				$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."templates";
				$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
				$result = mysqli_fetch_assoc($stmt);
				echo '<ul class="list-group">';
				do{
					echo '<button class="list-group-item file" onclick="template_view(\''.$result['name'].'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$result['name'].'</button>
					';
				}while($result = mysqli_fetch_assoc($stmt));
				echo '</ul>
					<button class="btn btn-primary" onClick="template_add_view(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Добавить</button>
					<button class="btn btn-default" onClick="template_main(\'errorCancel\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Назад</button>
				';
				
			}
		}
		if($function == 2){
			if($dir != '..'){ //if $dir !- '..' then return list as $function=1
				$cache = file_get_contents('../../tmp/cache/fm.tmp');
				if($handle = opendir($cache.'/'.$dir)) {
				    echo '<ul class="list-group">';
				    while (false !== ($entry = readdir($handle))) {
				    	if ($entry != "." && $entry != ".DS_Store") {
				    		if(is_dir($cache.'/'.$dir.'/'.$entry)){
				       			echo '<button class="list-group-item cat" onclick="template_changedir(\''.$entry.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-folder-o" aria-hidden="true"></i> '.$entry.'</button>';
				       		}else{
				       			$FileInfo = new SplFileInfo($entry);
				       			$ext = $FileInfo->getExtension();
				       			if($ext == "png" or $ext == "jpg" or $ext == "bmp") 
				       				echo '<button class="list-group-item file" onclick="template_openfile(\''.$entry.'\', \''.$ext.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')""><i class="fa fa-file-image-o" aria-hidden="true"></i> '.$entry.'</button>';
				       			else
				       				echo '<button class="list-group-item file" onclick="template_openfile(\''.$entry.'\', \''.$ext.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')""><i class="fa fa-file-code-o" aria-hidden="true"></i> '.$entry.'</button>';
				       		}
				    	}
				    }
				    echo '</ul>';
				    closedir($handle);
				    file_put_contents('../../tmp/cache/fm.tmp', $cache.'/'.$dir);
				}
			}else{ //ELSE Move to up dir and return files list
				$cache = file_get_contents('../../tmp/cache/fm.tmp');
				if($cache != '../../templates/'.$template){
					$cache_a = explode('/', $cache);
					$cache_count = count($cache_a);
					$i = 0;
					$cache = '';
					while($i != ($cache_count-1)){
						if($i < $cache_count-2){
							$cache .= $cache_a[$i].'/';
						}else{
							$cache .= $cache_a[$i];
						}
						$i++;

					}
					if($handle = opendir($cache)){
					    echo '<ul class="list-group">';
					    while (false !== ($entry = readdir($handle))) {
					    	if ($entry != "." && $entry != ".DS_Store") {
					    		if(is_dir($cache.'/'.$entry)){
					       			echo '<button class="list-group-item cat" onclick="template_changedir(\''.$entry.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-folder-o" aria-hidden="true"></i> '.$entry.'</button>';
					       		}else{
					       			$FileInfo = new SplFileInfo($entry);
					       			$ext = $FileInfo->getExtension();
					       			if($ext == "png" or $ext == "jpg" or $ext == "bmp") 
					       				echo '<button class="list-group-item file" onclick="template_openfile(\''.$entry.'\', \''.$ext.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')""><i class="fa fa-file-image-o" aria-hidden="true"></i> '.$entry.'</button>';
					       			else
					       				echo '<button class="list-group-item file" onclick="template_openfile(\''.$entry.'\', \''.$ext.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')""><i class="fa fa-file-code-o" aria-hidden="true"></i> '.$entry.'</button>';
					       		}
					    	}
					    }
					    echo '</ul>';
					    closedir($handle);
					    file_put_contents('../../tmp/cache/fm.tmp', $cache);
					}
				}else{
					template_main_list(); //Return - main list
				}
			}
		}
	}

	//Open template file in code editor
	function template_openfile($file){
		$cache = file_get_contents('../../tmp/cache/fm.tmp'); //Get path
		//Like a Function=1 in template_main()
		if($handle = opendir($cache)){
		    echo '<ul class="list-group template">';
		    while (false !== ($entry = readdir($handle))) {
		    	if ($entry != "." && $entry != ".DS_Store") {
		    		if(is_dir($cache.'/'.$entry)){
		       			echo '<button class="list-group-item cat" onclick="template_changedir(\''.$entry.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-folder-o" aria-hidden="true"></i> '.$entry.'</button>';
		       		}else{
		       			$FileInfo = new SplFileInfo($entry);
		       			$ext = $FileInfo->getExtension();
		       			if($ext == "png" or $ext == "jpg" or $ext == "bmp") 
		       				echo '<button class="list-group-item file" onclick="template_openfile(\''.$entry.'\', \''.$ext.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')""><i class="fa fa-file-image-o" aria-hidden="true"></i> '.$entry.'</button>';
		       			else
		       				echo '<button class="list-group-item file" onclick="template_openfile(\''.$entry.'\', \''.$ext.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')""><i class="fa fa-file-code-o" aria-hidden="true"></i> '.$entry.'</button>';
		       		}
		    	}
		    }
		    echo '</ul>';
		    closedir($handle);
		}
		$FileInfo = new SplFileInfo($file); //Get file info
		$ext = $FileInfo->getExtension(); //Get file extension
		if($ext == "png" or $ext == "jpg" or $ext == "bmp") //IF file - image then draw his
			echo '<img src="/files/config/modules/'.$cache.'/'.$file.'" class="col-xs-10">';
		else{ //Else return file content in code editor
			$content = file_get_contents($cache.'/'.$file);
			print '
				<textarea class="template-area" id="area" contenteditable="true">'.$content.'</textarea>
				<button class="btn btn-primary template-area-button area-button" onClick="template_update_f(\''.$file.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Применить</button>
			';
		}
	}

	//Update file template
	function template_update_f($file, $data){
		$cache = file_get_contents('../../tmp/cache/fm.tmp'); //Get path 
		$cache_a = explode('/', $cache);
		$cache_count = count($cache_a);
		$i = 0;
		$cache = "../../";
		//Damn magic to get a normal path
		while($i < $cache_count){
			if($cache_a[$i] != '..' ){
				if($i != $cache_count-1){
					$cache .= $cache_a[$i].'/';
				}else{
					$cache .= $cache_a[$i];
				}
			}
			$i++;
		}
		$result = file_put_contents($cache.'/'.$file, $data); //Write data in file
		if($result == true){
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Шаблон обновлен успешно!</div><?php
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка</div><?php
		}
	}

	//Functions for database work

	//Return - template in code editor
	function template_view($template){
		require '../../config/config.php';
		require '../../lib/db_connection.php';

		$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."templates";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($stmt);
		echo '<ul class="list-group template">';
		do{
			echo '<button class="list-group-item file" onclick="template_view(\''.$result['name'].'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$result['name'].'</button>
			';
		}while($result = mysqli_fetch_assoc($stmt));
		echo '</ul>';

		$query2 = "SELECT * FROM ".$sconfig['DBTablePrefix']."templates WHERE name='".$template."'";
		$stmt2 = mysqli_query($connect, $query2);
		$result2 = mysqli_fetch_assoc($stmt2);
		print '
			<textarea class="template-area" id="area" contenteditable="true">'.$result2['content'].'</textarea>
			<button class="btn btn-primary template-area-button area-button" onClick="template_update_d(\''.$template.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Применить</button>
			<button class="btn btn-danger template-area-button" onclick="template_delete(\''.$template.'\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Удалить</button>
			<button class="btn btn-warning template-area-button" onclick="template_main(\'error\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Отмена</button>
		';
	}


	//Update template in database
	function template_update_d($template, $data){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query = "UPDATE ".$sconfig['DBTablePrefix']."templates SET content='".$data."' WHERE name='".$template."'";
		$stmt = mysqli_query($connect, $query);
		if($stmt == true){
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Шаблон обновлен успешно!</div><?php
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка</div><?php
		}
	}

	//Add view for template
	function template_add_view(){
		print'
			<input name="name" type="text" class="form-control" id="area-name" placeholder="название (смотреть в документации!!)"><br>
			<textarea class="template-area" id="area" contenteditable="true"></textarea>
			<button class="btn btn-primary template-area-button area-button" onClick="template_add_db(\''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Применить</button>
			<button class="btn btn-warning template-area-button" onClick="template_main(\'error\', \''.$_SESSION['hash'].'\', \''.$_SESSION['admin'].'\')">Отмена</button>
		';
	}

	//Add template in database
	function template_add($name, $content){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query1 = "SELECT * FROM ".$sconfig['DBTablePrefix']."templates WHERE name='".$name."'";
		$stmt1 = mysqli_query($connect, $query1)or die(mysqli_error($connect));
		$result1 = mysqli_fetch_assoc($stmt1);
		if($result1['content'] == ''){ //Check for dublicate
			if($name != '' & $content != ''){ //Check for empty data
				$query = "INSERT INTO ".$sconfig['DBTablePrefix']."templates (name, content) VALUES ('".$name."', '".$content."')";
				$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
				if($stmt == true){
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Шаблон добавлен успешно!</div><?php
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

	//Delete template from database
	function template_delete($name){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query = "DELETE FROM ".$sconfig['DBTablePrefix']."templates WHERE name='".$name."'";
		$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
		if($stmt == true){
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-success al'>Шаблон удален успешно!</div><?php
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка!</div><?php
		}
	}


	//Processing of AJAX requests
	if(isset($_POST['hash']) && isset($_POST['login'])){
		require 'sequrity.php';
		if(checkHash($_POST['hash'], $_POST['login'])){
			if(isset($_POST['function'])){
				if($_POST['function'] == 1){
					template_main($_POST['type'], '', '1');
				}
				if($_POST['function'] == 2){
					template_main('', $_POST['dir'], '2');
				}
				if($_POST['function'] == 3){
					template_openfile($_POST['file']);
				}
				if($_POST['function'] == 4){
					template_view($_POST['template']);
				}
				if($_POST['function'] == 5){
					template_add_view();
				}
				if($_POST['function'] == 6){
					template_delete($_POST['template']);
				}
			}	
			if(isset($_POST['data'])){
				template_update_f($_POST['file'], $_POST['data']);
			}
			if(isset($_POST['tdata'])){
				template_update_d($_POST['template'], $_POST['tdata']);
			}
			if(isset($_POST['content'])){
				template_add($_POST['name'], $_POST['content']);
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 0!</div><?
		}
	}