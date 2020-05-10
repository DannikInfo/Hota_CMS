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
* /files/admin/header.php - header of admin panel
* -Last update: 04.02.2018
* 
*
*/
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Hota CMS - админ панель</title>
		<link href="../../files/admin/css/bootstrap.min.css" rel="stylesheet"> 
		<link href="../../files/admin/css/styles.css" rel="stylesheet">
		<link href="../../files/admin/css/font-awesome.min.css" rel="stylesheet">
		<script src="../../files/admin/js/jquery-2.1.0.min.js"></script>
		<script src="../../files/admin/js/ajax.js"></script>
		<script src="../../files/admin/js/codemirror.js"></script>
		<script src="../../files/admin/js/codemirror/mode/javascript/javascript.js"></script>
		<script src="../../files/admin/js/codemirror/mode/php/php.js"></script>
		<script src="../../files/admin/js/codemirror/mode/css/css.js"></script>
		<script src="../../files/admin/js/codemirror/mode/xml/xml.js"></script>
		<script src="../../files/admin/js/editor.js"></script>
		<link rel="stylesheet" href="../../files/admin/css/codemirror.css">
		<link rel="stylesheet" href="../../files/admin/css/codemirror/theme/eclipse.css">
	</head>
	<body>
		<div class="header">
			<nav class="navbar nav-fix navbar-default navfix" role="navigation">
			  	<div class="container-fluid nav-width">
			   	 	<div class="navbar-header">
				     	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				            <span class="sr-only">Меню</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				        </button>
				      	<a class="navbar-brand" href="/admin/main">Hota CMS</a>
			    	</div>
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				    <?php
				      	if(isset($_SESSION['login']) && $_SESSION['login'] == true){
				      		print'
						      	<ul class="nav navbar-nav">
						      		<li><a href="/admin/settings">Настройки</a></li>
						      		<li><a href="/admin/pages">Страницы</a></li>
						      		<li><a href="/admin/modules">Модули</a></li>
						      		<li><a href="/admin/templates">Шаблоны</a></li>
						      		<li><a href="/" target="_blank">На сайт</a></li>
						      	</ul>
						      	<ul class="nav navbar-nav navbar-right">
						    ';
				        	print "
				        	<div class='navbar-form navbar-left'>
				        		<button class='btn btn-default' onClick='exit_session()'>Выход</button>
				        	</div>
				        	";
				        }
				        ?>
						</ul>
				    </div>
			  	</div>
			</nav>
		</div>
		<div class="wrapper">