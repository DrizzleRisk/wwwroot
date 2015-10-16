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

    <title>Android App安全审计报告</title>

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
        <h1><b>App安全审计报告</b></h1>
        <p>
        	<a href="#Information">
		        <button class="btn btn-primary" type="button">
		  			基本信息 
				</button>
			</a>
			<a href="#Vulnerability">
				<button class="btn btn-danger" type="button">
		  			安全漏洞与风险评估<span class="badge"></span>
				</button>
			</a>
			<a href="#Threats">
				<button class="btn btn-warning" type="button">
		  			Drozer安全审计 <span class="badge"></span>
				</button>
			</a>
			<a href="#Tips">
				<button class="btn btn-success" type="button">
		  			敏感信息与权限审计<span class="badge"></span>
				</button>
			</a>
			<a href="#Screenshots">
				<button class="btn btn-default" type="button">
		  			运行截图
				</button>
			</a>
			<a href="/index.php/Home/Report/log/md5/<?php echo ($info["md5"]); ?>.html">
				<button class="btn btn-link" type="button">
		  			-->View Logs
				</button>
			</a>	
		</p>

      </div>

      <div class="page-header">
        
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><a name="Information">基本信息</a></h3>
            </div>
            <div class="panel-body">
		       <div class="row">
		        <div class="col-md-6">
		          <table class="table">
		            <tbody>
		              <tr>
		                <td>文件名</td>
		                <td><?php echo ($info["name"]); ?></td>
		              </tr>
		              <tr>
		                <td>文件大小</td>
		                <td><?php echo ($info["size"]); ?>MB</td>
		              </tr>
		              <tr>
		                <td>MD5</td>
		                <td><?php echo ($info["md5"]); ?></td>
		              </tr>
		              <tr>
		                <td>上传时间</td>
		                <td><?php echo ($info["createtime"]); ?></td>
		              </tr>
		              <tr>
		                <td>审计耗时</td>
		                <td><?php echo ($info["h"]); ?>小时<?php echo ($info["m"]); ?>分钟<?php echo ($info["s"]); ?>秒</td>
		              </tr>
		            </tbody>
		          </table>
		        </div>
		        </div>
              
            </div>
         </div>
         
         <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title"><a name="Vulnerability">安全漏洞与风险评估</a></h3>
            </div>
            <div class="panel-body">
            <div class="row">
            <?php if(is_array($vul)): $i = 0; $__LIST__ = $vul;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vulid): $mod = ($i % 2 );++$i;?><h4 class="panel-title">
        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($vulid["id"]); ?>">
          			<div class="col-md-8">
	          			<?php $_RANGE_VAR_=explode(',',"8,10");if($vulid["risklevel"]>= $_RANGE_VAR_[0] && $vulid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:red">【高危】</b><?php echo ($vulid["riskname"]); endif; ?>
	          			<?php $_RANGE_VAR_=explode(',',"5,7");if($vulid["risklevel"]>= $_RANGE_VAR_[0] && $vulid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:orange">【中危】</b><?php echo ($vulid["riskname"]); endif; ?>
	          			<?php $_RANGE_VAR_=explode(',',"1,4");if($vulid["risklevel"]>= $_RANGE_VAR_[0] && $vulid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:Blue">【低危】</b><?php echo ($vulid["riskname"]); endif; ?>
          			</div>
          			<div class="col-md-4">
	          			<?php if($vulid["verdict"] == 1): ?><b style="color:green">安全</b>
	          			<?php elseif($vulid["verdict"] == 2): ?>
	          				<b style="color:red">风险</b>
	          			<?php else: ?>
	          				<b style="color:orange">未知</b><?php endif; ?>
          			</div>
          			
        		</a>
      			</h4>
      			<div id="collapse<?php echo ($vulid["id"]); ?>" class="panel-collapse collapse">
      				<div class="panel-body">
		        	<p class="bg-info">
		        		<strong>漏洞描述</strong><br>
		        		<?php echo ($vulid["riskdetail"]); ?>
		        	</p>
		        	<p class="bg-danger">
		        		<strong>检测结果</strong><br>
		        		<?php echo ($vulid["result"]); ?>
		        	</p>
		        	<p class="bg-success">
		        		<strong>修复建议</strong><br>
		        		<?php echo ($vulid["fixes"]); ?>
		        	</p>
      				</div>
    			</div><?php endforeach; endif; else: echo "" ;endif; ?>
    		</div>
            </div>
          </div>
          
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title"><a name="Threats">Drozer安全审计</a></h3>
            </div>
            <div class="panel-body">
            <div class="row">
            <?php if(is_array($risk)): $i = 0; $__LIST__ = $risk;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$riskid): $mod = ($i % 2 );++$i;?><h4 class="panel-title">
        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($riskid["id"]); ?>">
          			<div class="col-md-8">
	          			<?php $_RANGE_VAR_=explode(',',"8,10");if($riskid["risklevel"]>= $_RANGE_VAR_[0] && $riskid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:red">【高危】</b><?php echo ($riskid["riskname"]); endif; ?>
	          			<?php $_RANGE_VAR_=explode(',',"5,7");if($riskid["risklevel"]>= $_RANGE_VAR_[0] && $riskid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:orange">【中危】</b><?php echo ($riskid["riskname"]); endif; ?>
	          			<?php $_RANGE_VAR_=explode(',',"1,4");if($riskid["risklevel"]>= $_RANGE_VAR_[0] && $riskid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:Blue">【低危】</b><?php echo ($riskid["riskname"]); endif; ?>
          			</div>
          			<div class="col-md-4">
	          			<?php if($riskid["verdict"] == 1): ?><b style="color:green">安全</b>
	          			<?php elseif($riskid["verdict"] == 2): ?>
	          				<b style="color:red">风险</b>
	          			<?php else: ?>
	          				<b style="color:orange">未知</b><?php endif; ?>
          			</div>
          			
        		</a>
      			</h4>
      			<div id="collapse<?php echo ($riskid["id"]); ?>" class="panel-collapse collapse">
      				<div class="panel-body">
			        	<p class="bg-info">
			        		<strong>漏洞描述</strong><br>
			        		<?php echo ($riskid["riskdetail"]); ?>
			        	</p>
			        	<p class="bg-danger">
			        		<strong>检测结果</strong><br>
			        		<?php echo ($riskid["result"]); ?>
			        	</p>
			        	<p class="bg-success">
			        		<strong>修复建议</strong><br>
			        		<?php echo ($riskid["fixes"]); ?>
			        	</p>

      				</div>
    			</div><?php endforeach; endif; else: echo "" ;endif; ?>
    		</div>
            </div>
          </div>
          
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"><a name="Tips">敏感信息与权限审计</a></h3>
            </div>
            <div class="panel-body">
            <div class="row">
            <?php if(is_array($tips)): $i = 0; $__LIST__ = $tips;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tipsid): $mod = ($i % 2 );++$i;?><h4 class="panel-title">
        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($tipsid["id"]); ?>">
          			<div class="col-md-8">
	          			<?php $_RANGE_VAR_=explode(',',"8,10");if($tipsid["risklevel"]>= $_RANGE_VAR_[0] && $tipsid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:red">【高危】</b><?php echo ($tipsid["riskname"]); endif; ?>
	          			<?php $_RANGE_VAR_=explode(',',"5,7");if($tipsid["risklevel"]>= $_RANGE_VAR_[0] && $tipsid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:orange">【中危】</b><?php echo ($tipsid["riskname"]); endif; ?>
	          			<?php $_RANGE_VAR_=explode(',',"1,4");if($tipsid["risklevel"]>= $_RANGE_VAR_[0] && $tipsid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:Blue">【低危】</b><?php echo ($tipsid["riskname"]); endif; ?>
	          			<?php $_RANGE_VAR_=explode(',',"0,0");if($tipsid["risklevel"]>= $_RANGE_VAR_[0] && $tipsid["risklevel"]<= $_RANGE_VAR_[1]):?><b style="color:Green">【信息】</b><?php echo ($tipsid["riskname"]); endif; ?>
          			</div>
          			<div class="col-md-4">
	          			<?php if($tipsid["verdict"] == 1): ?><b style="color:green">安全</b>
	          			<?php elseif($tipsid["verdict"] == 2): ?>
	          				<b style="color:red">风险</b>
	          			<?php else: ?>
	          				<b style="color:orange">未知</b><?php endif; ?>
          			</div>
        		</a>
      			</h4>
      			<div id="collapse<?php echo ($tipsid["id"]); ?>" class="panel-collapse collapse">
      				<div class="panel-body">
			        	<p class="bg-info">
			        		<strong>漏洞描述</strong><br>
			        		<?php echo ($tipsid["riskdetail"]); ?>
			        	</p>
			        	<p class="bg-danger">
			        		<strong>检测结果</strong><br>
			        		<?php echo ($tipsid["result"]); ?>
			        	</p>
			        	<p class="bg-success">
			        		<strong>修复建议</strong><br>
			        		<?php echo ($tipsid["fixes"]); ?>
			        	</p>

      				</div>
    			</div><?php endforeach; endif; else: echo "" ;endif; ?>
    		</div>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><a name="Screenshots">运行截图</a></h3>
            </div>
            <div class="panel-body">
              <?php if(is_array($picture)): $i = 0; $__LIST__ = $picture;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$picid): $mod = ($i % 2 );++$i;?><a href="<?php echo ($picid); ?>"><img src="<?php echo ($picid); ?>" width="236" height="304"></a><?php endforeach; endif; else: echo "" ;endif; ?>
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