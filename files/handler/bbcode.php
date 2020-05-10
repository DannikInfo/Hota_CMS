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
* /files/handler/bbcode.php - bbcode handler
* -Last update: 03.03.2018
* 
*
*/
	if(!function_exists('replaceBBCode')){
		function replaceBBCode($text_post) {
	    	$str_search = array(
			    "#\[b\](.+?)\[\/b\]#is",
			    "#\[i\](.+?)\[\/i\]#is",
			    "#\[u\](.+?)\[\/u\]#is",
			    "#\[s\](.+?)\[\/s\]#is",
			    "#\[code\](.+?)\[\/code\]#is",
			    "#\[center\](.+?)\[\/center\]#is",
			    "#\[left\](.+?)\[\/left\]#is",
			    "#\[right\](.+?)\[\/right\]#is",
			    "#\[quote\](.+?)\[\/quote\]#is",
			    "#\[table\](.+?)\[\/table\]#is",
			    "#\[td\](.+?)\[\/td\]#is",
			    "#\[tr\](.+?)\[\/tr\]#is",
			    "#\[font=(.+?)\](.+?)\[\/font\]#is",
			    "#\[video\](.+?)\[\/video\]#is",
			    "#\[sup\](.+?)\[\/sup\]#is",
			    "#\[sub\](.+?)\[\/sub\]#is",
			    "#\[url=(.+?)\](.+?)\[\/url\]#is",
			    "#\[url\](.+?)\[\/url\]#is",
			    "#\[img\](.+?)\[\/img\]#is",
			    "#\[size=(.+?)\](.+?)\[\/size\]#is",
			    "#\[color=(.+?)\](.+?)\[\/color\]#is",
			    "#\[list\](.+?)\[\/list\]#is",
			    "#\[list=1](.+?)\[\/list\]#is",
		      	"#\[\*\](.+?)\[\/\*\]#"
	    	);
	    	$str_replace = array(
			    "<b>\\1</b>",
			    "<i>\\1</i>",
			    "<span style='text-decoration:underline'>\\1</span>",
			    "<s>\\1</s>",
			    "<code class='code'>\\1</code>",
			    "<p class='text-center'>\\1</p>",
			    "<p class='text-left'>\\1</p>",
			    "<p class='text-right'>\\1</p>",
			    "<blockquote>\\1</blockquote>",
			    "<table>\\1</table>",
			    "<td>\\1</td>",
			    "<tr>\\1</tr>",
			    "<span style='font-family:\\1'>\\2</span>",
			    "<iframe width='560' height='315' src='https://www.youtube.com/embed/\\1' frameborder='0' allowfullscreen></iframe>",
			    "<sup>\\1</sup>",
			    "<sub>\\1</sub>",
			    "<a href='\\1'>\\2</a>",
			    "<a href='\\1'>\\1</a>",
			    "<img src='\\1' alt = 'Изображение' />",
			    "<span style='font-size:\\1%'>\\2</span>",
			    "<span style='color:\\1'>\\2</span>",
			    "<ul>\\1</ul>",
			    "<ol>\\1</ol>",
			    "<li>\\1</li>"
	    	);
	    	return preg_replace($str_search, $str_replace, $text_post);
	  	}
	}
?>