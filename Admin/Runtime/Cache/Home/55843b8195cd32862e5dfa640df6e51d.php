<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
 <head>
  <title>后台管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="/Public/assets/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
       <!--<img src="/chinapost/Public/assets/img/top.png">-->
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user">root</span><a href="/chinapost/index.php?m=Public&a=logout" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
        		<li class="nav-item dl-selected"><div class="nav-item-inner nav-home">系统管理</div></li>
        		<li class="nav-item dl-selected"><div class="nav-item-inner nav-order">风险管理</div></li>       

      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="/Public/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="/Public/assets/js/bui-min.js"></script>
  <script type="text/javascript" src="/Public/assets/js/common/main-min.js"></script>
  <script type="text/javascript" src="/Public/assets/js/config-min.js"></script>
  <script>
    BUI.use('common/main',function(){
      var config = [{id:'1',menu:[{text:'系统管理',items:[{id:'12',text:'机构管理',href:'<?php echo U('Node/index');?>'},{id:'3',text:'角色管理',href:'<?php echo U('Role/index');?>'},{id:'4',text:'用户管理',href:'<?php echo U('User/index');?>'},{id:'6',text:'菜单管理',href:'<?php echo U('Menu/index');?>'}]}]},{id:'7',homePage : '9',menu:[{text:'风险管理',items:[{id:'9',text:'风险列表',href:'<?php echo U('Risk/index');?>'},{id:'10',text:'评估类型',href:'<?php echo U('Assess/index');?>'}]}]}];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>