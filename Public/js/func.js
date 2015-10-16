$(function() {
	$('#form1').ajaxForm({
		beforeSubmit : checkForm, // pre-submit callback
		success : complete, // post-submit callback
		dataType : 'json'
	});
	function checkForm() {
		if ('' == $.trim($('#file').val())) {
			$('#result').html('请选择一个APK文件！').show();
			return false;
		}
		//可以在此添加其它判断
	}
	function complete(data) {
		if (data.status == 1) {
			$('#result').html(data.info).show();
			// 更新列表
		} else {
			$('#result').html(data.info).show();
		}
	}

});
function check() {
	$.post('__URL__/checkTitle', {
		'title' : $('#title').val()
	}, function(data) {
		$('#result').html(data.info).show();
	}, 'json');
}