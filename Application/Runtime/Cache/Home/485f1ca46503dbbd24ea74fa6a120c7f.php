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

    <title>App安全分析日志</title>

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
          <a class="navbar-brand" href="#">Android App Security</a>
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

      <!-- Main jumbotron for a primary marketing message or call to action 
      <div class="jumbotron">
        <h1>Android App安全审计报告</h1>
      </div>-->
      <div class="page-header">
        <h1><b>App安全分析日志</b></h1>
        <p>
			<a href="#AppLog">
				<button class="btn btn-warning" type="button">
		  			分析日志 
				</button>
			</a>
			<a href="#SysLog">
				<button class="btn btn-success" type="button">
		  			系统日志
				</button>
			</a>
			<a href="#Logcat">
				<button class="btn btn-default" type="button">
		  			Logcat
				</button>
			</a>
			<a href="/index.php/Home/Report/show/md5/<?php echo ($md5); ?>.html">
				<button class="btn btn-link" type="button">
		  			-->View Reports
				</button>
			</a>	
		</p>

      </div>

      <div class="page-header">
        
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><a name="AppLog">应用分析日志</a></h3>
            </div>
            <div class="panel-body">
            <p style="word-spacing: 2px">
		   	<?php echo ($outputs); ?>
		   	</p>
            </div>
         </div>
         
         <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title"><a name="SysLog">系统日志</a></h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
          
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title"><a name="Logcat">Logcat</a></h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
          
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