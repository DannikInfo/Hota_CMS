<?php
	require_once 'files/admin/handler/modules.php';
	$mdecode = get_mdecode("news.info");
	if(!function_exists('full_news')){
		function full_news($id){
			global $template;
			require 'files/config/config.php';
			require 'files/lib/db_connection.php';
			require_once 'files/admin/handler/modules.php';
			$mdecode = get_mdecode('news.info');
			if($id != 'archive'){
				if($mdecode->{'Enable'}){
					$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."news WHERE id='".$id."'";
					$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
					$result = mysqli_fetch_assoc($stmt);
					$news = '';
					$file = file_get_contents($template.'/modules/news/full-news.tpl', true);
					$id2 = $id - 1;
					$id1 = $id + 1;
					if($id == 1){
							$back = '#" disabled=disabled';
					}else{
						$query2 = "SELECT * FROM ".$sconfig['DBTablePrefix']."news WHERE id='".$id2."'";
						$stmt2 = mysqli_query($connect, $query2)or die(mysqli_error($connect));
						$result2 = mysqli_fetch_assoc($stmt2);
						if($result2['content'] == ''){
							$id3 = $id2;
							do{
								$query3 = "SELECT * FROM ".$sconfig['DBTablePrefix']."news WHERE id='".$id3."'";
								$stmt3 = mysqli_query($connect, $query3)or die(mysqli_error($connect));
								$result3 = mysqli_fetch_assoc($stmt3);
								$id3--;
							}while($result3['id'] == '');
								$id3++;
							$back = '/news/'.$id3;
						}else{
							$back = '/news/'.$id2;
						}
					}
					$query2 = "SELECT * FROM ".$sconfig['DBTablePrefix']."news ORDER BY id DESC LIMIT 1";
					$stmt2 = mysqli_query($connect, $query2)or die(mysqli_error($connect));
					$result2 = mysqli_fetch_assoc($stmt2);
					if($result2['id'] == $id){
						$forward = '#" disabled=disabled';
					}else{
						$query2 = "SELECT * FROM ".$sconfig['DBTablePrefix']."news WHERE id='".$id1."'";
						$stmt2 = mysqli_query($connect, $query2)or die(mysqli_error($connect));
						$result2 = mysqli_fetch_assoc($stmt2);
						if($result2['content'] == ''){
							$id3 = $id1;
							do{
								$query3 = "SELECT * FROM ".$sconfig['DBTablePrefix']."news WHERE id='".$id3."'";
								$stmt3 = mysqli_query($connect, $query3)or die(mysqli_error($connect));
								$result3 = mysqli_fetch_assoc($stmt3);
								$id3++;
							}while($result3['id'] == '');
							$id3--;
							$forward = '/news/'.$id3;
						}else{
							$forward = '/news/'.$id1;
						}
					}
					$news_tag = [
						"*\[news_header\]*",
						"*\[news_date\]*",
						"*\[news_content\]*",
						"*\[news_link_back\]*",
						"*\[news_link_forward\]*",
						"*\[news_type\]*"
					];
					$news_tag_handler = [
						$result['header'],
						$result['date'],
						$result['content'],
						$back,
						$forward,
						$result['type']
					];
					echo preg_replace($news_tag, $news_tag_handler, $file);
					
				}else{
					echo 'Модуль отключен';
				}
			}else{
				if($mdecode->{'Enable'}){
					$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."news ORDER BY id DESC";
					$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
					$result = mysqli_fetch_assoc($stmt);
					$news = '';
					$news_tag = [
						"*\[news_header\]*",
						"*\[news_date\]*",
						"*\[news_content\]*",
						"*\[news_link\]*",
						"*\[news_type\]*"
					];
					do{
						$news_tag_handler = [
							$result['header'],
							$result['date'],
							$result['content'],
							'/news/'.$result['id'],
							$result['type']
						];
						$file = file_get_contents($template.'/modules/news/archive.tpl', true);
						$news .= preg_replace($news_tag, $news_tag_handler, $file);

					}while($result = mysqli_fetch_assoc($stmt));
					echo $news;
				}else{
					return 'Модуль отключен';
				}
			}
		}
	}
	if(!function_exists('news')){
		function news(){
			require_once 'files/admin/handler/modules.php';
			$mdecode = get_mdecode('news.info');
			if($mdecode->{'Enable'} == true){
				global $template;
				require 'files/config/config.php';
				require 'files/lib/db_connection.php';
				$query = "SELECT * FROM ".$sconfig['DBTablePrefix']."news ORDER BY id DESC LIMIT 6";
				$stmt = mysqli_query($connect, $query)or die(mysqli_error($connect));
				$result = mysqli_fetch_assoc($stmt);
				$news = '';
				$news_tag = [
					"*\[news_header\]*",
					"*\[news_date\]*",
					"*\[news_content\]*",
					"*\[news_link\]*",
					"*\[news_type\]*"
				];
				do{
					$news_tag_handler = [
						$result['header'],
						$result['date'],
						$result['content'],
						'/news/'.$result['id'],
						$result['type']
					];
					$file = file_get_contents($template.'/modules/news/news.tpl', true);
					$news .= preg_replace($news_tag, $news_tag_handler, $file);

				}while($result = mysqli_fetch_assoc($stmt));
				return $news;
			}else{
				return 'Модуль отключен';
			}
		}
	}
?>