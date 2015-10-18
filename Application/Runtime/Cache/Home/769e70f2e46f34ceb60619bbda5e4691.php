<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Android安全,自动化,审计,在线">
    <meta name="author" content="jwt">
    <link rel="icon" href="/favicon.ico">

    <title>App在线安全审计</title>

    <!-- Bootstrap core CSS -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="/Public/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/Public/css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/Public/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/Public/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/Public/js/Ajax/ThinkAjax.js"></script>
    <script language="JavaScript">
	    function complete(data,status){
	        if (status==1){
	            $('result').innerHTML = '<span style="color:blue">'+data+'你好!</span>';
	        }
	    }
	</script>
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/index.php">Android App Security</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/index.php">首页</a></li>
            <li><a href="#about">安全规范</a></li>
            <li><a href="#contact">关于App</a></li>
            <li><a href="#contact">bugs反馈</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Android App自动化安全审计平台</h1>
        <form id="form1"  action="/index.php/Home/Index/upload" method="post" enctype="multipart/form-data">
        <table class="table">
        <tr class="success">
          <td>
          	<label>Upload APK File:</label>
          </td>
          <td>
          	<input type="file"  id="file" name="apkFile"/>
          </td>
          <td>
          	<input type="hidden" name="ajax" value="0">
          </td>
          <td>
          	<input type="submit" class="btn btn-primary" value="上传分析"/>
          </td>
          <td>
          	<div id="result"></div>
          </td>
        </tr>
        </table>
        </form>
      </div>


      <div class="page-header">
        <h1><b>应用列表</b></h1>
        <table class="table">
		   <!-- <caption>上下文表格布局</caption> -->
		   <thead>
		      <tr>
		         <th>ID</th>
		         <th>Time</th>
		         <th>Apk Name</th>
		         <th>Size(MB)</th>
		         <th>MD5</th>
		         <th>Status</th>
		         <th>Total(Sec)</th>
		         <th>Report</th>
		         <th>Outputs</th>
		      </tr>
		   </thead>
		   <tbody>
		   	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; switch($vo["status"]): case "0": ?><tr class="active"><?php break;?>
		         <?php case "1": ?><tr class="warning"><?php break;?>
		         <?php case "2": ?><tr class="success"><?php break;?>
		         <?php case "3": ?><tr class="danger"><?php break; endswitch;?>
		         <td><?php echo ($vo["id"]); ?></td>
		         <td><?php echo ($vo["createtime"]); ?></td>
		         <td><b><?php echo ($vo["name"]); ?></b></td>
		         <td><?php echo ($vo["size"]); ?></td>
		         <td><?php echo ($vo["md5"]); ?></td>
		         <td>
		         	<?php switch($vo["status"]): case "0": ?><b style="color:Brown">Pending</b><?php break;?>
		         		<?php case "1": ?><b style="color:Blue">Running</b><img src="/Public/img/running.gif"/><?php break;?>
		         		<?php case "2": ?><b style="color:green">Done</b><?php break;?>
		         		<?php case "3": ?><b style="color:red">Error</b><?php break; endswitch;?>
		         </td>
		         <td><?php echo ($vo["totaltime"]); ?></td>
		         <td>
		         	<?php switch($vo["status"]): case "0": ?>NULL<?php break;?>
		         		<?php case "1": ?><b>Creating</b><?php break;?>
		         		<?php case "2": ?><a href="/index.php/Home/Report/show/md5/<?php echo ($vo["md5"]); ?>.html"><b style="color:green">Reports</b></a><?php break;?>
		         		<?php case "3": ?>NULL<?php break; endswitch;?>
		         </td>
		         <td>
		         	<?php switch($vo["status"]): case "0": ?>NULL<?php break;?>
		         		<?php case "1": ?><b>Creating</b><?php break;?>
		         		<?php case "2": ?><a href="/index.php/Home/Report/log/md5/<?php echo ($vo["md5"]); ?>.html"><b style="color:green">Logs</b></a><?php break;?>
		         		<?php case "3": ?><a href="/index.php/Home/Report/log/md5/<?php echo ($vo["md5"]); ?>.html">Errors</a><?php break; endswitch;?>
		         </td>
		      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		   </tbody>
		</table>
		<div><?php echo ($page); ?></div>
      </div>

      <div class="well">
        <p align="center"> Copyright © 1999-2015 NetDragon Websoft Inc. All Rights Reserved. </p>
        <p align="center"> System Design By QA Security Team. </p>
      </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/Public/js/jquery.min.js"></script>
    <script src="/Public/js/bootstrap.min.js"></script>
    <script src="/Public/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/Public/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>