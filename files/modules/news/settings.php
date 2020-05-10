<?php
	require 'files/admin/handler/news.php';
?>
<div class="jumbotron">
  <h1>Новости</h1>
</div>
<div class="all"></div>
<div class="adm-settings">
	<div class="panel panel-default" id="page-main">
		<div class="panel-heading">
			<h3 class="panel-title">Новости</h3>
		</div>
		<div class="panel-body">
		   	<table class="table table-striped">
 			<?php
 				news_list();
 			?>
 			</table>
 			<button class="btn btn-primary" id="bt-add" onClick="news_add()">Добавить</button>

		</div>
	</div>
	<div class="panel panel-default page-add">
		<div class="panel-heading">
			<h3 class="panel-title">Добавить</h3>
		</div>
		<div class="panel-body">
 			<div class="add_content"></div>
		</div>
	</div>
	<div class="panel panel-default page-edit">
		<div class="panel-heading">
			<h3 class="panel-title">Изменить</h3>
		</div>
		<div class="panel-body">
			<div class="edit_content"></div>
		</div>
	</div>
</div>