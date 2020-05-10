<?
	global $template;
	if(isset($_GET['news'])){
		require_once 'site.php';
		echo tag_replace($template.'/header.tpl');
		full_news($_GET['news']);
		echo tag_replace($template.'/footer.tpl');
		exit;
	}
?>
