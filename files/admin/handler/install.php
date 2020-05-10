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
* /files/admin/handler/install.php - install handler DELETE THIS FILE AFTER INSTALL SYSTEM!!!
* -Last update: 20.02.2019
* 
*
*/
	function db_step($host, $db, $user, $pass, $prefix){
		$connect = mysqli_connect($host, $user, $pass, $db);
		if($connect == true){
			mysqli_set_charset($connect, 'utf8');
			$today = date('Y-m-d');
			$query = "
			CREATE TABLE `".$prefix."admin` (
			  `id` int(255) NOT NULL,
			  `login` varchar(255) NOT NULL,
			  `password` varchar(255) NOT NULL,
			  `email` varchar(255) NOT NULL,
			  `hash` varchar(255) NOT NULL,
			  `time` int(255) NOT NULL,
			  `timed` int(255) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			$stmt = mysqli_query($connect, $query);
			if($stmt == true){
				$query = "CREATE TABLE `".$prefix."pages` (
				  `id` int(100) NOT NULL,
				  `name` varchar(255) NOT NULL,
				  `category` varchar(255) NOT NULL,
				  `header` text NOT NULL,
				  `lead` text NOT NULL,
				  `content` text NOT NULL,
				  `bbcode` int(1) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
				$stmt = mysqli_query($connect, $query);
				if($stmt == true){
					$query = "INSERT INTO `".$prefix."pages` (`id`, `name`, `category`, `header`, `lead`, `content`,`bbcode`) VALUES
					(1, 'info', 'main', 'Информация', 'Демонстрация возможностей HOTA CMS', '[b]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. [/b]\r\n[i]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. [/i]\r\n[u]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. [/u]\r\n[s]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. [/s]\r\n[sup]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. [/sup]\r\n[sub]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. [/sub]\r\n[url=http://google.com/]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. [/url]\r\n[url]http://google.com[/url]\r\n[list]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.[/list]\r\n[list=1]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\n[/list]\r\n[color=#666666]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.[/color]\r\n[font=Comic Sans MS]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.[/font]\r\n[left]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.[/left]\r\n[center]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.[/center]\r\n[right]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.[/right]\r\n[quote]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.[/quote]\r\n[code]Donec id elit non mi porsdasdta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.[/code]', 1);";
					$stmt = mysqli_query($connect, $query);
					if($stmt == true){
						$query = "CREATE TABLE `".$prefix."settings` (
						  `id` int(255) NOT NULL,
						  `argument` varchar(255) NOT NULL,
						  `value` varchar(255) NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
						$stmt = mysqli_query($connect, $query);
						if($stmt == true){
							$query = "
								CREATE TABLE `".$prefix."sys_info` (
								  `id` int(255) NOT NULL,
								  `argument` varchar(255) NOT NULL,
								  `value` varchar(255) NOT NULL
								) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
							$stmt = mysqli_query($connect, $query);
							if($stmt == true){
								$query = "CREATE TABLE `".$prefix."templates` (
								  `id` int(255) NOT NULL,
								  `name` varchar(255) NOT NULL,
								  `content` text NOT NULL
								) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
								$stmt = mysqli_query($connect, $query);
								if($stmt == true){
									$query = "INSERT INTO `".$prefix."templates` (`id`, `name`, `content`) VALUES
										(1, '404', '<p>Произошла ошибка при попытке перейти на неизвестную страницу.<br>\r\nПроверьте адрес страницы или вернитесь назад.<br>\r\nЕсли вы считаете, что допущена ошибка на странице сайта, то сообщите нам:<br></p>\r\nTelegram: тут типо должна быть ссылка<br>\r\nVK: тут типо должна быть ссылка<br>\r\nTwitter: тут типо должна быть ссылка<br>'),
										(2, '403', 'Попытка получить доступ к закрытой информации!!');";
									$stmt = mysqli_query($connect, $query);
									if($stmt == true){
										$query = "ALTER TABLE `".$prefix."admin`
			  								ADD PRIMARY KEY (`id`);";
			  							$stmt = mysqli_query($connect, $query);
										if($stmt == true){
											$query = "ALTER TABLE `".$prefix."pages`
			  									ADD PRIMARY KEY (`id`);";
											$stmt = mysqli_query($connect, $query);
											if($stmt == true){
												$query = "ALTER TABLE `".$prefix."settings`
			  										ADD PRIMARY KEY (`id`);";
												$stmt = mysqli_query($connect, $query);
												if($stmt == true){
													$query = "ALTER TABLE `".$prefix."sys_info`
			  											ADD PRIMARY KEY (`id`);";
													$stmt = mysqli_query($connect, $query);
													if($stmt == true){
														$query = "ALTER TABLE `".$prefix."templates`
			 												ADD PRIMARY KEY (`id`);";
														$stmt = mysqli_query($connect, $query);
														if($stmt == true){
															$query = "ALTER TABLE `".$prefix."admin`
			  													MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;";
															$stmt = mysqli_query($connect, $query);
															if($stmt == true){
																$query = "ALTER TABLE `".$prefix."pages`
			  														MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;";
																$stmt = mysqli_query($connect, $query);
																if($stmt == true){
																	$query = "ALTER TABLE `".$prefix."settings`
			 															MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;";
			 														$stmt = mysqli_query($connect, $query);
																	if($stmt == true){
																		$query = "ALTER TABLE `".$prefix."sys_info`
			  																MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;";
																		$stmt = mysqli_query($connect, $query);
																		if($stmt == true){
																			$query = "	ALTER TABLE `".$prefix."templates`
			 		 															MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;";
			 		 														$stmt = mysqli_query($connect, $query);
																			if($stmt == true){
																				$query = "CREATE TABLE `".$prefix."tags` (
																				  `id` int(11) NOT NULL,
																				  `type` varchar(255) NOT NULL,
																				  `tag` varchar(255) NOT NULL,
																				  `handler` varchar(255) NOT NULL,
																				  `param` text NOT NULL
																				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
																				$stmt = mysqli_query($connect, $query);
																				if($stmt = true){
																					$query = "INSERT INTO `".$prefix."tags` (`id`, `type`, `tag`, `handler`, `param`) VALUES
																					(1, 'system', '*/\[header-page/\]*', 'header_page', ''),
																					(2, 'system', '*/\[lead-page/\]*', 'lead_page', ''),
																					(3, 'system', '*/\[content-page/\]*', 'content_page', ''),
																					(4, 'system', ' */\[template/\]*', 'site', 'SiteTemplate'),
																					(5, 'system', '*/\[site-name/\]*', 'site', 'SiteName'),
																					(6, 'system', '*/\[site-title/\]*', 'site', 'SiteTitle'),
																					(7, 'system', '*/\[meta/\]*', 'meta', ''),
																					(8, 'system', '*/\[breadcrumb/\]*', 'breadcrumb', ''),
																					(9, 'system', '*/\[header-error/\]*', 'header_error', ''),
																					(10, 'system', '*/\[content-error/\]*', 'content_error', '')";
																					$stmt = mysqli_query($connect, $query);
																					if($stmt = true){
																						$query = "ALTER TABLE `".$prefix."tags`
																						  ADD PRIMARY KEY (`id`);";
																						$stmt = mysqli_query($connect, $query);
																						if($stmt = true){
																							$query = "ALTER TABLE `".$prefix."tags`
																							  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;";
																							$stmt = mysqli_query($connect, $query);
																							if($stmt = true){
																							create_config($host, $user, $pass, $db, $prefix);
																								?><script type="text/javascript">relocation('install?step=2');</script><?
																							}else{
																								?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 1</div><?
																							}
																						}else{
																							?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 2</div><?
																						}
																					}else{
																						?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 3</div><?
																					}
																				}else{
																					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 4</div><?
																				}	
																			}else{
																				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 5</div><?
																			}	
																		}else{
																			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 6</div><?
																		}	
																	}else{
																		?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 7</div><?
																	}	
																}else{
																	?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 8</div><?
																}
															}else{
																?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 9</div><?
															}		
														}else{
															?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 10</div><?
														}	
													}else{
														?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 11</div><?
													}
												}else{
													?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 12</div><?
												}
											}else{
												?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 13</div><?
											}
										}else{
											?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 14</div><?
										}
									}else{
										?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 15</div><?
									}
								}else{
									?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 16</div><?
								}
							}else{
								?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 17</div><?
							}
						}else{
							?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 18</div><?
						}
					}else{
						?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 19</div><?
					}
				}else{
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 20</div><?
				}
			}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 21</div><?
			}							
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 1 22</div><?
		}
	}

	function config_step($sname, $sdomain, $stitle){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		$query_sn = "INSERT INTO ".$sconfig['DBTablePrefix']."settings (argument,value) VALUES ('SiteName','".$sname."')";
		$stmt1 = mysqli_query($connect, $query_sn);
		$query_sd = "INSERT INTO ".$sconfig['DBTablePrefix']."settings (argument,value) VALUES ('SiteDomain','".$sdomain."')";
		$stmt2 = mysqli_query($connect, $query_sd);
		$query_ste = "INSERT INTO ".$sconfig['DBTablePrefix']."settings (argument,value) VALUES ('SiteTemplate','Default')";
		$stmt3 = mysqli_query($connect, $query_ste);
		$query_sti = "INSERT INTO ".$sconfig['DBTablePrefix']."settings (argument,value) VALUES ('SiteTitle','".$stitle."')";
		$stmt4 = mysqli_query($connect, $query_sti);
		$query_u = "INSERT INTO ".$sconfig['DBTablePrefix']."settings (argument,value) VALUES ('Update','')";
		$stmt5 = mysqli_query($connect, $query_u);
		$query_uh = "INSERT INTO ".$sconfig['DBTablePrefix']."settings (argument,value) VALUES ('UpdateHash','')";
		$stmt6 = mysqli_query($connect, $query_uh);
		$query_ul = "INSERT INTO ".$sconfig['DBTablePrefix']."settings (argument,value) VALUES ('UpdateLink','')";
		$stmt7 = mysqli_query($connect, $query_ul);
		if($stmt1 & $stmt2 & $stmt3 & $stmt4 & $stmt5 & $stmt6 & $stmt7){
			?><script type="text/javascript">relocation('install?step=5');</script><?
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 2</div><?
		}
	}

	function wolfeco_step($name, $pass1, $pass2, $email){
		if($pass1 == $pass2){
			$pass_hash = sha1(md5(md5($pass1)));
			?><script type="text/javascript">register_wolfeco('<?$name?>', '<?$pass_hash?>', '<?$email?>');</script><?
		}
	}

	function wolfeco_step_login($name, $pass){
		$pass_hash = sha1(md5(md5($pass)));
		?><script type="text/javascript">login_wolfeco('<?$name?>', '<?$pass_hash?>');</script><?
	}

	function user_step($name, $pass1, $pass2, $email){
		require '../../config/config.php';
		require '../../lib/db_connection.php';
		if($name != '' & $pass1 != '' & $email != ''){
			if($pass1 == $pass2){
				$pass_hash = sha1(md5(md5($pass1)));
				$query_admin = "INSERT INTO ".$sconfig['DBTablePrefix']."admin (login,password,email,hash,time,timed) VALUES ('".$name."','".$pass_hash."','".$email."','',0,0)";
				$stmt1 = mysqli_query($connect, $query_admin);
				$query_wu = "INSERT INTO ".$sconfig['DBTablePrefix']."sys_info (argument,value) VALUES ('WolfecoUser','Later')";
				$stmt2 = mysqli_query($connect, $query_wu);
				$query_sid = "INSERT INTO ".$sconfig['DBTablePrefix']."sys_info (argument,value) VALUES ('SiteID','Later')";
				$stmt3 = mysqli_query($connect, $query_sid);
				$query_li = "INSERT INTO ".$sconfig['DBTablePrefix']."sys_info (argument,value) VALUES ('License','alpha license')";
				$stmt4 = mysqli_query($connect, $query_li);
				$query_v = "INSERT INTO ".$sconfig['DBTablePrefix']."sys_info (argument,value) VALUES ('Version','alpha 1.0')";
				$stmt5 = mysqli_query($connect, $query_v);
				$query_lk = "INSERT INTO ".$sconfig['DBTablePrefix']."sys_info (argument,value) VALUES ('LicesnseKey','NULL')";
				$stmt6 = mysqli_query($connect, $query_lk);
				if($stmt1 & $stmt2 & $stmt3 & $stmt4 & $stmt5 & $stmt6){
					?><script type="text/javascript">relocation('install?step=6');</script><?
				}else{
					?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 3</div><?
				}
			}else{
				?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 3: несовпадают пароли!</div><?
			}
		}else{
			?><script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-danger al'>Ошибка 3: поля не могут быть пустыми!</div><?
		}
	}


	function create_config($host, $user, $pass, $db, $prefix){
		$data = "<?php
	\$sconfig = [
		//Настройки базы данных
		'DBHost'		=>	'".$host."',
		'DBUser'		=>	'".$user."',
		'DBPass'		=>	'".$pass."',
		'DB'			=>	'".$db."',
		'DBTablePrefix'	=>	'".$prefix."',
	];
?>";//Да выглядит криво, но тем не менее в файле конфига это будет выглядеть более правильно чем ранее.
		file_put_contents('../../config/config.php', $data);
	}


	//обработка js запросов
	if(isset($_POST['dhost'])){
		db_step($_POST['dhost'], $_POST['db'], $_POST['duser'], $_POST['dpass'], $_POST['dprefix']);
	}
	if(isset($_POST['sname'])){
		config_step($_POST['sname'], $_POST['sdomain'], $_POST['stitle']);
	}
	if(isset($_POST['uname'])){
		hota_step($_POST['uname'], $_POST['upass'], $_POST['upass2'], $_POST['uemail']);
	}
	if(isset($_POST['uname_l'])){
		hota_step_login($_POST['uname_l'], $_POST['upass']);
	}
	if(isset($_POST['aname'])){
		user_step($_POST['aname'], $_POST['apass1'], $_POST['apass2'], $_POST['aemail']);
	}
?>