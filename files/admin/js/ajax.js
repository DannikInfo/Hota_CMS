jQuery.support.cors = true;

function isEmpty(str) {
  if (str.trim() == '') 
    return true;
  return false;
}

var editor; 
var quill;
var quillC = '';
var editorC = '';
var toolbarOptions = [
	'bold', 'italic', 'underline',      // toggled buttons
  	'blockquote', 'code-block',
	'link', 'image',
 	{ 'list': 'ordered'}, { 'list': 'bullet' },
 	{ 'script': 'sub'}, { 'script': 'super' },     // superscript/subscript

 	{ 'header': [1, 2, 3, 4, 5, false] },

	{ 'color': [] },         // dropdown with defaults from theme
	{ 'align': [] },

 	'clean' // remove formatting button
];

function exit_session(){
	$.ajax({
	  	type: "POST",
	  	url: "/files/admin/handler/login.php",
	 	data: "exit=1",
	  	success: function(){
	  		window.location.href = "/admin/main";
		}
	});
}
function relocation(page){
	window.location.href = page;
}
/**
*
*	============MAIN SETTINGS FUNCTIONS
*
*/
function settings_main_view(shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/settings.php',
		data: {
			hash: shash,
			login: slogin,
			view: 'main'
		},
		success: function(result){
			$('.main-settings').html(result);
		}
	});
}
function admin_main_view(shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/settings.php',
		data: {
			hash: shash,
			login: slogin,
			view: 'admin'
		},
		success: function(result){
			$('.admin-settings').html(result);
		}
	});
}
function admin_view(shash, slogin, id, type){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/settings.php',
		data: {
			hash: shash,
			login: slogin,
			aid: id,
			view: type
		},
		success: function(result){
			$('#modalS').html(result);
			$('#'+type).modal('show');
		}
	});
}
function admin_edit(shash, slogin, id){
	var glogin, pass, pass2, email;
	glogin = $('#aname').val();
	pass = $('#apass').val();
	pass2 = $('#apass2').val();
	email = $('#aemail').val();
	if(!isEmpty(glogin) && !isEmpty(email)){
		if(pass == pass2){
			$.ajax({
				type: "POST",
				url: '/files/admin/handler/settings.php',
				data: {
					hash: shash,
					login: slogin,
					alogin: glogin,
					apass: pass,
					apass2: pass2,
					aemail: email,
					aid: id,
					handle: 'admin_edit'
				},
				success: function(result){
					$('.all').html(result);
					$('#admin_edit').modal('hide');
					admin_main_view(shash, slogin);
				}
			});
		}else
			$('.all').html("<script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-warning al'>Пароли должны совпадать!</div>");
	}else
		$('.all').html("<script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-warning al'>Поля логин и e-mail должны быть заполнены!</div>");
}

function admin_remove(id, shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/settings.php',
		data: {
			hash: shash,
			login: slogin,
			aid: id,
			handle: 'admin_remove'
		},
		success: function(result){
			$('.all').html(result);
			admin_main_view(shash, slogin);
		}
	});
}
function admin_add(shash, slogin){
	var login, pass, pass2, email;
	glogin = $('#aname').val();
	pass = $('#apass').val();
	pass2 = $('#apass2').val();
	email = $('#aemail').val();
	if(!isEmpty(glogin) && !isEmpty(pass) && !isEmpty(pass2) && !isEmpty(email)){
		if(pass == pass2){
			$.ajax({
				type: "POST",
				url: '/files/admin/handler/settings.php',
				data: {
					hash: shash,
					login: slogin,
					alogin: glogin,
					apass: pass,
					apass2: pass2,
					aemail: email,
					handle: 'admin_add'
				},
				success: function(result){
					$('.all').html(result);
					$('#admin_add').modal('hide');
					admin_main_view(shash, slogin);
				}
			});
		}else
			$('.all').html("<script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-warning al'>Пароли должны совпадать!</div>");
	}else
		$('.all').html("<script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-warning al'>Все поля должны быть заполнены!</div>");
}
function settings_edit(shash, slogin){
	var name, domain, template, title;
	name = $('#sname').val();
	domain = $('#sdomain').val();
	template = $('#stemplate').val();
	title = $('#stitle').val();
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/settings.php',
		data: {
			hash: shash,
			login: slogin,
			sname: name,
			sdomain: domain,
			stemplate: template,
			stitle: title,
			handle: 'main'
		},
		success: function(result){
			$('.all').html(result);
			settings_main_view(shash, slogin);
		}
	});
}
//block function
function block_shower(block, block2){
    $(block).show();
    $(block2).hide();
}
function block_hider(block, block2){
    $(block).hide();
    $(block2).show();
}
//page function
function page_list(shash, slogin){
	$.ajax({
		type: 'POST',
		url: '/files/admin/handler/pages.php',
		data: {
			hash:shash,
			login:slogin,
			view:'list'
		},
		success: function(result){
			$('.panel-body').html(result);
		}
	});
}
function page_edit(id, shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/pages.php',
		data: {
			pid:id,
			hash:shash,
			login:slogin,
			view:'edit'
		},
		success: function(result){
			$('.panel-body').html(result);
			$.ajax({
				type: "POST",
				url: '/files/admin/handler/pages.php',
				data: {
					pid:id,
					hash:shash,
					login:slogin,
					view:'edit_content'
				},
				success: function(result){
					if($('#bb').is(':checked')){
						quill.root.innerHTML = result;
					}else{
						editor.setValue(result);
					}
				}
			});
		}
	});
}
function page_add(hash, login){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/pages.php',
		data: "addv=1&hash=" + hash + "&login=" + login,
		success: function(result){
			$('.panel-body').html(result);
		}
	});
}
function page_remove_modal(id, shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/pages.php',
		data: {
			pid: id,
			hash: shash,
			login: slogin,
			view: 'delete'
		},
		success: function(result){
			$('.mod').html(result);
			$('#removeModal').modal('show');
		}
	});
}
function page_remove(id, shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/pages.php',
		data: {
			pid: id,
			hash: shash,
			login: slogin,
			handle: 'delete'
		},
		success: function(result){
			$('.all').html(result);
			$('#removeModal').modal('hide');
			page_list(shash, slogin);
		}
	});
}
function page_db(shash, slogin, shandle){
	var checked = $('#bb').is(':checked');
	var content, name, cat, header, lead, id;
	name = $('#pname').val();
	cat = $('#pcat').val();
	header = $('#pheader').val();
	lead = $('#plead').val();
	if(shandle != 'add')
		id = $('#pid').val();
	if(checked)
		content = quill.root.innerHTML;
	else
		content = editor.getValue();
	$.ajax({
		type: 'POST',
		url: '/files/admin/handler/pages.php',
		data: {
			pid: id,
			pname: name,
			pcat: cat,
			pheader: header,
			plead: lead,
			pcontent: content,
			pbbcode: checked,
			hash: shash,
			login: slogin,
			handle: shandle
		},
		success: function(result){
			$('.all').html(result);
			page_list(shash, slogin);
		}
	});
}
function bbChose(){
	if($('#bb').is(':checked')){
		$('.CodeMirror').hide();
		$('#content-area').show();
		quillC = quill.root.innerHTML;
		quill.clipboard.dangerouslyPasteHTML(editor.getValue());
	}else{ 
		$('#content-area').hide();
		$('.CodeMirror').show();
		editorC = editor.getValue();
		editor.setValue(quill.root.innerHTML);
	}
}
function undoBB(){
	if($('#bb').is(':checked')){
		if(quillC != '')
			quill.clipboard.dangerouslyPasteHTML(quillC);
		else
			$('.all').html("<script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-warning al'>Отклонено! Действие может привести к потери данных!</div>");
	}
	else{
		if(editorC != '')
			editor.setValue(editorC);
		else
			$('.all').html("<script>setTimeout(function(){$('.alert').fadeOut('fast')},5000);</script><div class='alert alert-warning al'>Отклонено! Действие может привести к потери данных!</div>");
	}
	$('#undoModal').modal('hide');
}
function undoModal(shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/pages.php',
		data: {
			hash: shash,
			login: slogin,
			view: 'undo'
		},
		success: function(result){
			$('.mod').html(result);
			$('#undoModal').modal('show');
		}
	});
}
//news function
function news_add(){
	block_shower('.page-add', '#page-main');
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/news.php',
		data: "addv=1",
		success: function(result){
			$('.add_content').html(result);
		}
	});
}
function news_remove(id){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/news.php',
		data: "nid=" + id + "&delete=1",
		success: function(result){
			window.location.href = "/admin/news";
			$('.all').html(result);
		}
	});
}
function news_edit(id){
	block_shower('.page-edit', '#page-main');
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/news.php',
		data: "nid=" + id + "&edit=0",
		success: function(result){
			$('.edit_content').html(result);
		}
	});
}
$(function(){
	$('#news_add_form').submit(function(e){
		e.preventDefault();
		var m_method=$(this).attr('method');
		var m_data=$(this).serialize();
		$.ajax({
			type: m_method,
			url: '/files/admin/handler/news.php',
			data: m_data,
			success: function(result){
				$('.all').html(result);
			}
		});
	});
});
$(function(){
	$('#news_edit_form').submit(function(e){
		e.preventDefault();
		var m_method=$(this).attr('method');
		var m_data=$(this).serialize();
		$.ajax({
			type: m_method,
			url: '/files/admin/handler/news.php',
			data: m_data,
			success: function(result){
				$('.all').html(result);
			}
		});
	});
});
//update function
function update_check(version, license, user, id){
	$.ajax({
		type: "POST",
		url: 'http://update.wolfeco.ru/check/cms',
		data: 'version=' + version + '&license=' + license + '&hotauser=' + user + '&siteid=' + id,
		success: function(result){
			if(result != 'latest'){
				$('.all').html('<script>setTimeout(function(){$(".alert").fadeOut("fast")},5000);</script><div class="alert alert-info al">Найдено обновление!</div>');
				$.ajax({
					type: "POST",
					url: '/files/admin/handler/update.php',
					data: 'type=0&update=' + result,
					success: function(result){
						window.location.href = '/admin/settings';
					}
				});
			} 
			if(result == 'latest'){
				$('.all').html('<script>setTimeout(function(){$(".alert").fadeOut("fast")},5000);</script><div class="alert alert-info al">У вас последняя версия!</div>');
			}
		}
	});
}
function update(updateversion){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/update.php',
		data: 'type=1&update=' + updateversion,
		success: function(result){
			window.location.href = '/admin/settings';
			$('.all').html('<script>setTimeout(function(){$(".alert").fadeOut("fast")},5000);</script><div class="alert alert-info al">Система успешно обновлена!</div>');
		}
	});
}
//template function
function template_main(type, hash, login){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: "function=1&type=" + type + "&hash=" + hash + "&login=" + login,
		success: function(result){
			$('.template_content').html(result);
		}
	});
}
function template_changedir(dir, hash, login){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: "function=2&dir=" + dir + "&hash=" + hash + "&login=" + login,
		success: function(result){
			$('.template_content').html(result);
		}
	});
}
function template_openfile(file, ext, hash, login){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: "function=3&file=" + file + "&hash=" + hash + "&login=" + login,
		success: function(result){
			$('.template_content').html(result);
			if(ext == 'css')
				var m = "text/css";
			if(ext == 'tpl')
				var m = "text/html";
			if(ext == 'js')
				var m = "application/javascript";
			editor = CodeMirror.fromTextArea(document.getElementById('area'), {
			  lineNumbers: true,               // показывать номера строк
			  matchBrackets: true,             // подсвечивать парные скобки
			  mode: m, // стиль подсветки
			  indentUnit: 4                    // размер табуляции
			});
		}
	});
}
function template_view(template, hash, login){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: "function=4&template=" + template + "&hash=" + hash + "&login=" + login,
		success: function(result){
			$('.template_content').html(result);
			editor = CodeMirror.fromTextArea(document.getElementById('area'), {
			  lineNumbers: true,               // показывать номера строк
			  matchBrackets: true,             // подсвечивать парные скобки
			  mode: 'text/html', 		   // стиль подсветки
			  indentUnit: 4                    // размер табуляции
			});
		}
	});
}
function template_add_view(hash, login){
		$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: "function=5" + "&hash=" + hash + "&login=" + login,
		success: function(result){
			$('.template_content').html(result);
			editor = CodeMirror.fromTextArea(document.getElementById('area'), {
			  lineNumbers: true,               // показывать номера строк
			  matchBrackets: true,             // подсвечивать парные скобки
			  mode: 'text/html', 		       // стиль подсветки
			  indentUnit: 4                    // размер табуляции
			});
		}
	});
}
function template_delete(template, hash, login){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: "function=6&template=" + template + "&hash=" + hash + "&login=" + login,
		success: function(result){
			$('.all').html(result);
			template_main('error', hash, login);
		}
	});
}
function template_update_f(file, shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: {file:file,data:editor.getValue(),hash:shash,login:slogin}, 
		success: function(result){
			$('.all').html(result);
		}
	});
}
function template_update_d(template, shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: {template:template,tdata:editor.getValue(),hash:shash,login:slogin},
		success: function(result){
			$('.all').html(result);
		}
	});
}
function template_add_db(shash, slogin){
	$.ajax({
		type: "POST",
		url: '/files/admin/handler/templates.php',
		data: {name:$('#area-name').val(),content:editor.getValue(),hash:shash,login:slogin},
		success: function(result){
			$('.all').html(result);
			template_main('error', shash, slogin);
		}
	});
}
//install function
$(function(){
	$('#install_step_db').submit(function(e){
		$('#loading').show();
		e.preventDefault();
		var m_method=$(this).attr('method');
		var m_data=$(this).serialize();
		$.ajax({
			type: m_method,
			url: '/files/admin/handler/install.php',
			data: m_data,
			success: function(result){
				$('.all').html(result);
				$('#loading').hide();
			}
		});
	});
});
$(function(){
	$('#install_step_config').submit(function(e){
		$('#loading').show();
		e.preventDefault();
		var m_method=$(this).attr('method');
		var m_data=$(this).serialize();
		$.ajax({
			type: m_method,
			url: '/files/admin/handler/install.php',
			data: m_data,
			success: function(result){
				$('.all').html(result);
				$('#loading').hide();
			}
		});
	});
});
$(function(){
	$('#install_step_hota').submit(function(e){
		$('#loading').show();
		e.preventDefault();
		var m_method=$(this).attr('method');
		var m_data=$(this).serialize();
		$.ajax({
			type: m_method,
			url: '/files/admin/handler/install.php',
			data: m_data,
			success: function(result){
				$('.all').html(result);
				$('#loading').hide();
			}
		});
	});
});
$(function(){
	$('#install_step_user').submit(function(e){
		$('#loading').show();
		e.preventDefault();
		var m_method=$(this).attr('method');
		var m_data=$(this).serialize();
		$.ajax({
			type: m_method,
			url: '/files/admin/handler/install.php',
			data: m_data,
			success: function(result){
				$('.all').html(result);
				$('#loading').hide();
			}
		});
	});
});
$(function(){
	$('#install_step_admin').submit(function(e){
		$('#loading').show();
		e.preventDefault();
		var m_method=$(this).attr('method');
		var m_data=$(this).serialize();
		$.ajax({
			type: m_method,
			url: '/files/admin/handler/install.php',
			data: m_data,
			success: function(result){
				$('.all').html(result);
				$('#loading').hide();
			}
		});
	});
});
function register_hota(name, pass, email){
	$.ajax({
		type: 'POST',
		url: '//id.wolfeco.su/register/c',
		data: 'name=' + name + '&pass=' + pass + '&email=' + email,
		success: function(result){
			$.ajax({
				type: 'POST',
				url: '/files/admin/handler/install.php',
				data: result,
				success: function(result){
					$('.all').html(result);
				}
			});
		}
	});
}
function login_hota(name, pass){
	$.ajax({
		type: 'POST',
		url: '//id.wolfeco.ru/login/c',
		data: 'name=' + name + '&pass=' + pass,
		success: function(result){
			$.ajax({
				type: 'POST',
				url: '/files/admin/handler/install.php',
				data: result,
				success: function(result){
					$('.all').html(result);
				}
			});
		}
	});
}