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
* /files/admin/handler/modules.php - modules handler
* -Last update: 08.02.2018
* 
*	WARNING! YOU DO NOT CAN EDIT IT IF YOU ACCEPTED LICENSE AGREEMENT
*	IF YOU NEED TO FIX THE BUG IN THIS, PLEASE ADD REPORT: bugs.wolfeco.ru
*/
	$module_list = scandir("files/modules");
	
	function get_modules_list($module_list){
		for($a = 0; $a < count($module_list); $a++){
			$FileInfo = new SplFileInfo($module_list[$a]);
			$ext = $FileInfo->getExtension(); 
			if($ext == 'info'){
				echo '<a href="'.get_module_link($module_list[$a]).'"><div class="col-md-3 adm-block">'.get_module_icon($module_list[$a]).'<h3 class="text-center">'.get_module_name($module_list[$a]).'</h3></div></a>';
			}
		}
	}
	
	function get_mdecode($module){
		$m = file_get_contents("files/modules/".$module);
		return json_decode($m);
	}
	
	function get_module_link($module){}
	
	function get_module_icon($module){
		$mdecode = get_mdecode($module);
		if($mdecode != '' && $mdecode->{'IconType'} == "font"){
			return '<i class="fa '.$mdecode->{"Icon"}.' fa-5x" aria-hidden="true"></i>';
		}
	}
	
	function get_module_name($module){
		$mdecode = get_mdecode($module);
		if($mdecode != '')
			return $mdecode->{'Name'};
	}

	function load_module_list(){
		$module_list = scandir("files/modules");
		return	$module_list; 
	}
	
	function load_handlers($module_list, $type){
		for($a = 0; $a < count($module_list); $a++){
			if($type == 0){
				$FileInfo = new SplFileInfo($module_list[$a]);
				$ext = $FileInfo->getExtension(); 
				if($ext == 'info'){
					$mdecode = get_mdecode($module_list[$a]);
					require_once "files/modules/".get_module_name($module_list[$a]).'/'.$mdecode->{'Files'}->{'SiteHandler'};
				}
			}
			if($type == 1){
				$mdecode = get_mdecode($module_list[$a]);
				require_once "files/modules/".get_module_name($module_list[$a]).'/'.$mdecode->{'Files'}->{'AdmHandler'};
			}
		}
	}

	function set_tag($tag, $handler, $param){
		global $sconfig, $connect;
		
		$query_c = "SELECT * FROM ".$sconfig['DBTablePrefix']."tags WHERE tag='".$tag."'";
		$stmt_c = mysqli_query($connect, $query_c)or die(mysqli_error($connect));
		$result_c = mysqli_fetch_assoc($stmt_c);
		if($result_c['tag'] != $tag){
			$query_a = "INSERT INTO ".$sconfig["DBTablePrefix"]."tags (type, tag, handler, param) VALUES ('module', '".$tag."', '".$handler."', '".$param."')";
			$stmt_a = mysqli_query($connect, $query_a)or die(mysqli_error($connect));
		}else
			return 'error';
	}

	function load_tags($module_list){
		for($a = 0; $a < count($module_list); $a++){
			$FileInfo = new SplFileInfo($module_list[$a]);
			$ext = $FileInfo->getExtension(); 
			if($ext == 'info'){
				$mdecode = get_mdecode($module_list[$a]);
				require_once "files/modules/".get_module_name($module_list[$a]).'/'.$mdecode->{'Files'}->{'Tags'};
				setTags($module_list);
			}
		}
	}

	function load_content($module_list){
		for($a = 0; $a < count($module_list); $a++){
			$FileInfo = new SplFileInfo($module_list[$a]);
			$ext = $FileInfo->getExtension(); 
			if($ext == 'info'){
				$mdecode = get_mdecode($module_list[$a]);
				require_once "files/modules/".get_module_name($module_list[$a]).'/'.$mdecode->{'Files'}->{'Content'};
			}
		}
	}
?>