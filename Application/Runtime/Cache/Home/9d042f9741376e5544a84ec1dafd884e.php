<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>房产信息管理系统</title>
    <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.min.css" />
    <script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
    <style type="text/css">
    	body { 
    		padding-top: 50px; 
    	}
    	#name{
    		margin-left: 120px;
    	}
    	.nav{
    		margin: 50px auto;
    	}
    	#change{
    		margin-left: 100px;
    		margin-top: 20px;
    	}
    	#password{
    		text-align: center;
    		font-family: "微软雅黑";
    		color: red;
    	}
    	#email{
    		text-align: center;
    	}
    	#phone{
    		text-align: center;
    	}
    	#username{
    		text-align: left;
    	}
    </style>
  </head>
  <body>
  	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container">
	    <div class="row">
	    	<div class="col-md-10">
	      		<a class="navbar-brand" href="/index.php/Home/Index/main">
	        		<p>房产信息管理</p>
	      		</a>
	      	</div>
	      	<div class="col-md-2">
	      		<button type="button" class="btn btn-info navbar-btn navbar-right dropdown-toggle"  data-toggle="dropdown">
					<?php echo ($name); ?><span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="name">
					 <li><a tabindex="-1" href="/index.php/Home/Index/main">返回主页</a></li>
   					 <li><a tabindex="-1" href="/index.php/Home/Index/houserentinfo">查看发布信息</a></li>
    				 <li><a tabindex="-1" href="/index.php/Home/Index/loginout">退出</a></li>
    			</ul>
	      	</div>
	    </div>
	  </div>
	</nav>
  	
  	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				    <ul class="nav nav-tabs">
					    <li class="active">
					    	<a href="">个人资料</a>
					    </li>
					</ul>
					<div class="col-md-4" id="head-sculpture">
						<img class="img-thumbnail" src="/Public/i/1.jpg" alt="..." >
						<!--<button class="btn btn-primary btn-lg" type="button" id="change">更改头像</button>-->
					</div>
					<div class="col-md-8">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="control-label col-md-2">用户名</label>
								<label class="control-label col-md-4" id="username">
									<?php echo ($name); ?>
								</label>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-2">登录密码</label>
								<label class="control-label col-md-2" id="password">已设置</label>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-2">邮箱</label>
								<label class="control-label col-md-3" id="email"><?php echo ($email); ?></label>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-2">手机</label>
								<label class="control-label col-md-2" id="phone"><?php echo ($phone); ?></label>
							</div>
							
							<div class="form-group">
								 <label class="control-label col-md-2">性别</label>
					   			 <div class="col-md-6">
					    			  <input class="radio radio-inline" type="radio" value="option1" name="sex" checked="checked" disabled="disabled">男
					    			  <input class="radio radio-inline" type="radio" value="option1" name="sex" disabled="disabled">女
					   			 </div>
							</div>
							
							<div class="form-group">
								<label for="inputBirth" class="col-md-2 control-label">所在城市</label>
								<div class="col-md-4">
									<select class="form-control" disabled="disabled">
										<option selected="selected"><?php echo ($province); ?></option>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control" disabled="disabled">
										<option selected="selected"><?php echo ($city); ?></option>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control" disabled="disabled">
										<option selected="selected"><?php echo ($area); ?></option>
									</select>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="col-md-1"></div>
								<div class="col-md-5 col-md-offset-1">
									<button id="changeinfo" class="btn btn-info btn-lg btn-block" type="button">修改个人资料</button>
								</div>
								<!--<div class="col-md-7"></div>-->
							</div>
							
						</form>
					</div>
			</div>
			<div class="col-md-1"></div>
		</div>  		
  	</div>	 
  </body>
  <script type="text/javascript">
		   $(".add-on").height("25px");
		   $(function(){
				$("#changeinfo").click(function(){
					window.location.href="/index.php/Home/Index/edituserinfo";
				});   
		   });
  </script>
</html>