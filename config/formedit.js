$(document).ready(function() {
	flagEditForm = false;

	$('.edit-rec').click(function() {
		if ($(this).is('.on')) {
			formName = $(this).siblings('td.name').children('input').prop('value');
			formIndex = $(this).siblings('td.postcode').children('input').prop('value');
			formId = $(this).siblings('td.city_id').text();

			$(this).siblings('td.name').html(formName);
			$(this).siblings('td.postcode').html(formIndex);

			$(this).css('background', '#fff');
			$(this).css('color', 'black');

			$(this).removeClass('on');

		} else {
			formName = $(this).siblings('td.name').text();
			formIndex = $(this).siblings('td.postcode').text();
			formId = $(this).siblings('td.city_id').text();

			$(this).siblings('td.name').html('<input type="text" name="edit['+formId+'][name]" value="'+formName+'">');
			$(this).siblings('td.postcode').html('<input type="text" name="edit['+formId+'][postcode]" value="'+formIndex+'">');

			$(this).css('background', 'green');
			$(this).css('color', 'white');

			$(this).addClass('on');
		}
	});	



	function getCookie(name) {
 		var matches = document.cookie.match(new RegExp(
 		  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
 		));
 		return matches ? decodeURIComponent(matches[1]) : undefined;
	}

	var cookieAdd = getCookie('add');
	if (cookieAdd == 1) {
		document.cookie = 'add=0';
		$('.add-status').css('background', 'green');
		$('.add-status').css('color', 'white');
	}

	var cookieEdit = getCookie('edit');
	if (cookieEdit != 0) {
		document.cookie = 'edit=0';
		var cookieEdit = cookieEdit.split('.');

		cookieEdit.forEach(function(item, i, arr) {
			$("td.city_id").filter(function(){return $(this).text() == item}).css('background', 'green');
			$("td.city_id").filter(function(){return $(this).text() == item}).css('color', 'white');
		});
	}

	var cookieDel = getCookie('del');
	if (cookieDel != 0) {
		document.cookie = 'del=0';
		var cookieDel = cookieDel.split('.');
		
		delMessage = "Удалены записи с ID:\n";

		cookieDel.forEach(function(item, i, arr){
			item = item + "\n";
			delMessage += item;
		}); 

		alert(delMessage);
		
	}
});