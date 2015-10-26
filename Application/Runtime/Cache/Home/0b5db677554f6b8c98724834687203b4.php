<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>ND安全 - App在线审计平台</title>
    <!--[if lte IE 6]></base><![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" >
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/css/bootstrap.css"/>
    <link rel="stylesheet" href="/Public/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/css/font-awesome.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-ie6.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/ie.css">
    <![endif]-->
    <script type="text/javascript" src="/Public/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.js"></script>
    <script src="/Public/js/jquery.form.js"></script>
    <!--[if lte IE 8]>
    <script type="text/javascript" src="/Public/js/bootstrap-ie.js"></script>
    <script src="/Public/js/html5.js"></script>
    <script src="/Public/js/json3.min.js"></script>
    <script src="/Public/js/es5-shim.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/Public/css/service.css">
    <!--[if lte IE 9]>
    <script>
        function beforesend(){
            $('#apk_label').text('正在上传');
            $('.modal-body').html('<div class="row" ><img src="/Public/images/waiting.gif"></div>');
            $('#apk_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }
    </script>
    <![endif]-->
    <!--ie9+-->
    <!--[if gt IE 9]>
    <script>
        function beforesend(){
            $('#apk_label').text('正在上传');

            $('.modal-body').html('<div class="row" ><div class="progress">\
                        <div class="bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">\
                       0%\
                        </div>\
                    </div></div>');
            $('#apk_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }
    </script>
    <![endif]-->
    <!--chrome and firefox-->
    <!--[if !IE]><!-->
    <script>
        function beforesend(){
            $('#apk_label').text('正在上传');

            $('.modal-body').html('<div class="row" ><div class="progress">\
                        <div class="bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">\
                       0%\
                        </div>\
                    </div></div>');
            $('#apk_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }
    </script>
    <!--<![endif]-->
    <script>
        function show_tips(content){
            $("#tips").html(content);
        }
        function show_modal(title, content, info){
            $('#apk_label').text(title);
            var data = {0:'fa-check',1: 'fa-exclamation', 2: 'fa-check', 3: 'fa-check'};
            var colors = {0: 'green', 1: 'red', 2: 'green', 3: 'green'} ;
            var s = '<div class="pull-left"><span class="fa-stack fa-lg">\
                                <i class="fa fa-circle fa-stack-2x" style="color: '+colors[info]+';"></i>\
                                <i class="fa '+ data[info]+' fa-stack-1x fa-inverse"></i></span></div>';

            $('.modal-body').html('<div class="row">' + s + '<div class="pull-left" style="margin-left: 20px;width: 470px;text-align: left">'+content+'</div></div>');
            if(info.length == 32){
            	//增加email显示
                s = '<hr><div class="row"><label for="txtEmail" class="pull-left" style="height: 30px;line-height: 30px;font-size: 16px;margin-right: 10px;">Email:</label><input type="email" class="input pull-left" id="txtEmail"><label id="lblEmail" for="chkEmail"><input type="hidden" id="hmd5" name="md5" value="'+info+'" />' +
                    '<input type="checkbox" id="chkEmail">审计完成后邮件通知我</label></div><div id="tips"></div><hr> ';
                var t = $('.modal-body').html();
                $('.modal-body').html(t + s);
            }
            $('#apk_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }
        $(function(){
            $('#txtFile').on('change', function(){
                var filename = $(this).val();
                if(filename == "")return;
                var reg_t = /.+\.apk$/ig;
                if(! reg_t.test(filename)){
                    return alert('只允许上传安卓APK包文件');
                }

                $('form').submit();
                $(this).attr("value", "");
            });
            $(".jg-query input.jg-query-text").on('keypress', function(evt){
                if(evt.which == 13){
                    $('.jg-query a.btn-query').click();
                }
            });
            //查询md5
            $('.jg-query a.btn-query').on('click', function(){
                var md5 = $('.jg-query input').val();
                var reg = /[a-f0-9]{32}/i;
                if(reg.test(md5)){
                    $.getJSON('/index.php/Home/Report/search/md5/'+md5, function(r){
                        if(r.ret == 2){
                            window.location.href = r.data;
                        }else{
                            show_modal(r.msg, r.data, r.ret);
                        }
                    });
                }else{
                    alert('请输入正确MD5！');
                }
            });
            //关闭对话框的时候
            $(".modal").on("keyup", "#txtEmail", function(){
                var txt = $(this).val();
                var re = /\S+@\S+\.\S+/;
                var chk = $("#chkEmail");
                if (re.test(txt) && chk && !chk.prop("checked")){
                    chk.prop("checked", true);
                }
            });
            $("#apk_modal .btn-large").on("click", function(){
                var chk = $("#chkEmail");
                if (!chk){
                    return $('#apk_modal').modal('hide');
                };
                var checked = chk.prop('checked');
                if(!checked)
                    return $('#apk_modal').modal('hide');
                var aemail = $("#txtEmail").val();
                var hmd5 = $("#hmd5").val();
                var re = /\S+@\S+\.\S+/;
                if (!re.test(aemail)){
                    show_tips('请输入正确的Email格式');
                    $("#txtEmail").focus();
                    return;
                }
                var data = {
                    email:aemail,
                    __hash__:$(":hidden[name=__hash__]").val(),
                    md5:hmd5
                };
                $.ajax({
                    type: 'POST',
                    url: "<?php echo U('Index/send_email');?>",
                    data: data,
                    success: function(r){
                        show_tips(r.data);
                        if(r.ret == 0){
                            return $('#apk_modal').modal('hide');
                        }
                    },
                    dataType: "json"
                });

            });
            $('form').ajaxForm({
                dataType: 'json',
                url: '<?php echo U('Index/upload');?>',
                beforeSend: beforesend,
                uploadProgress: function(evt,pos, total,percent){
                    var b = $('.modal-body .progress .bar');
                    b.css('width', percent + '%');
                    b.attr('aria-valuenow', percent);
                    b.text(percent + '%');
                },success: function(r){
                    show_modal(r.msg, r.data, r.ret);
                },error: function(r){
                    if(r.readyState == 4){
                        if(r.status == 413){ //文件大小超出限制
                            show_modal('上传提示', '您!上传的文件大小超出系统规定50M！', 1);
                        }
                    }
                }
            });
        });
    </script>
</head>
<body>
<!--[if lte IE 7]>
<div style="line-height:24px;width: 100%;padding: 10px;font-size: 20px;text-align: right;color: red;position: absolute;top: 0;left: 0" id="ietips" onclick="document.getElementById('ietips').style.display='none';">
    目前你使用的是低版本的IE浏览器内核，可能无法正常享受我们提供的服务！<br>请更换高版本浏览器，谢谢！点击隐藏提示！
</div>
<![endif]-->

<div class="row jg-banner">
    <div class="jg-func clearfix">
        <div class="pull-left jg-query clearfix">
            <input type="text" class="input-medium pull-left jg-query-text" maxlength="32" placeholder="请输入MD5查询审计报告">
            <a href="javascript:void(0)" class="pull-right btn-query" title="输入MD5来查询审计报告">
                查询
            </a>
        </div>

        <form action="<?php echo U('Index/upload');?>" method="post" accept-charset="utf-8" style="margin-left: 50px;float:left;position: relative; overflow: hidden;" enctype="multipart/form-data">
        	<div style="display:none">
        	{__TOKEN__}
        	</div>
        	<input type="file"  accept=".apk" id="txtFile" name="apkFile">
        	<label for="txtFile" class="btn btn-appcheck">APP提交</label>
        </form>
    </div>
</div>
<div id="content" class="row">
    <img src="/Public/images/func-jg-1.png">
    <!--<img src="/Public/images/func-jg-2.png">-->
    <img src="/Public/images/func-jg-3.png">
</div>

<div id="apk_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="apk_label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="apk_label">正在上传</h3>
    </div>
    <div class="modal-body">
        <div class="row"></div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default btn-large" >确定</button>
    </div>
</div>
<div class="row footer">
    <div id="footer">
        <p>
        	<a href="http://www.nd.com.cn/" target="_blank">关于网龙</a>
        	|<a href="http://www.nd.com.cn/about/overview.shtml" target="_blank">About ND</a>
        	|<a href="http://www.nd.com.cn/about/contact-us.shtml" target="_blank">服务条款</a>
        	|<a href="http://hr.nd.com.cn/" target="_blank">加入我们</a>
        	|<a href="#" target="_self">报告漏洞</a>
        	|<a href="http://www.nd.com.cn/about/our-partners.shtml">合作伙伴</a>
        	|<a href="#" target="_blank">NDST</a>
        </p>
        <p>
            Copyright &copy; 1999 - 2015 NetDragon Websoft Inc. All Rights Reserved
        </p>
        <p>System Designer & Developer by tr</p>
    </div>
</div>
</div>
</body>
</html>