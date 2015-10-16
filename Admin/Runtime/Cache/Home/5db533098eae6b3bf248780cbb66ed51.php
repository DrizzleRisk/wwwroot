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
<form class="form-inline definewidth m20" action="<?php echo U('Risk/index');?>" method="get">  
    风险名称：
    <input type="text" name="riskname" id="rolename"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">新增风险项</button>
</form>
	<table class="table table-bordered table-hover definewidth m10" >
	    <thead>
		    <tr>
		        <th>编号</th>
		        <th>评估类型</th>
		        <th>风险类型</th>
		        <th>风险等级</th>
		        <th>风险名称</th>
		        <th>状态</th>
		        <th>管理操作</th>
		    </tr>
	    </thead>
	    	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	            <td><?php echo ($vo["risk_id"]); ?></td>
	            <td><?php echo ($vo["assesstype"]); ?></td>
	            <td><?php echo ($vo["class"]); ?></td>
	            <td><?php echo ($vo["risklevel"]); ?></td>
	            <td><?php echo ($vo["riskname"]); ?></td>
	            <?php if($vo["ischeck"] == 1 ): ?><td>启用</td>
	            <?php else: ?>
	            	<td>禁用</td><?php endif; ?>
	            <td>
	                  <a href="<?php echo U('Risk/edit','id='.$vo['risk_id']);?>">编辑</a>
	                  <a href="javascript:del(<?php echo ($vo['risk_id']); ?>)">删除</a>
	            </td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
<div class="inline pull-right page">
         10122 条记录 1/507 页  <a href='#'>下一页</a>     <span class='current'>1</span><a href='#'>2</a><a href='/chinapost/index.php?m=Label&a=index&p=3'>3</a><a href='#'>4</a><a href='#'>5</a>  <a href='#' >下5页</a> <a href='#' >最后一页</a>    </div>
</body>
</html>
<script>
    $(function () {
        
		$('#addnew').click(function(){

				window.location.href="<?php echo U('Risk/add');?>";
		 });


    });

	function del(id)
	{
		
		
		if(confirm("确定要删除吗？"))
		{
		
			var url = "<?php echo U('Risk/del','id='.$vo['risk_id']);?>";
			
			window.location.href=url;		
		
		}
	
	
	
	
	}
</script>