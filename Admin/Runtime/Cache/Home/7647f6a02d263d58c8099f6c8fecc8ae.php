<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/style.css" />
    <script type="text/javascript" src="/Public/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/js/ckform.js"></script>
    <script type="text/javascript" src="/Public/js/common.js"></script>
    <script type="text/javascript" src="/Public/ckeditor/ckeditor.js"></script>  

    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
<body>
<form action="<?php echo U('Risk/add');?>" method="post" class="definewidth m20">
<table class="table table-bordered table-hover ">
    <tr>
        <td width="10%" class="tableleft">编号</td>
        <td></td>
    </tr>
    
        <tr>
        <td class="tableleft">评估类别</td>
        <td >
	        <select name="assesstype" id="AssessSelect">
	          <?php if(is_array($AssessList)): $i = 0; $__LIST__ = $AssessList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["assesstype"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
        </td>
    </tr>
    <tr>
        <td class="tableleft">风险类别</td>
        <td ><input type="text" name="class" value=""/></td>
    </tr>
    
    <tr>
        <td class="tableleft">风险等级</td>
        <td ><input type="text" name="risklevel" value=""/></td>
    </tr>
    
    <tr>
        <td class="tableleft">风险名称</td>
        <td ><textarea cols="70" rows="1" id="contactus" name="riskname"></textarea>
        </td>
    </tr>
    
    <tr>
        <td class="tableleft">风险细节</td>
        <td >
        <textarea id="editor1" class="ckeditor"  name="riskdetail"></textarea>
        </td>
    </tr>
     
    <tr>
        <td class="tableleft">检测方法</td>
        <td ><textarea id="editor1" class="ckeditor"  name="test"></textarea></td>
    </tr>
    
    <tr>
        <td class="tableleft">影响范围</td>
        <td ><textarea id="editor1" class="ckeditor"  name="scope"></textarea></td>
    </tr>
    
    <tr>
        <td class="tableleft">修复建议</td>
        <td ><textarea id="editor1" class="ckeditor" name="fixes"></textarea></td>
    </tr>
    
    <tr>
        <td class="tableleft">漏洞引用</td>
        <td ><textarea id="editor1" class="ckeditor" name="reference"></textarea></td>
    </tr>

    <tr>
        <td class="tableleft">状态</td>
        <td >
        	<input type="radio" name="ischeck" value="1" checked/> 启用
          	<input type="radio" name="ischeck" value="0" /> 禁用
        </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
<script>
    $(function () {       
		$('#backid').click(function(){
				window.location.href="<?php echo U('Risk/index');?>";
		 });

    });
</script>