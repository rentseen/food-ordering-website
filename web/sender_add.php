<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="order">
	<meta name="author" content="yelinsheng">

	<title>添加配送人员</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/order.css" rel="stylesheet">

</head>
<body>

<?php

	include('conn.php');  
	mysql_query("set names 'utf8'");

	session_start();
	$restaurant_id=$_SESSION['restaurant_id'] ;
	$restaurant_name= $_SESSION['restaurant_name'] ;
	//顶部样式
	echo '<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" >添加配送人员</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php?type=restaurant">注销</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a >'.$restaurant_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="sender_salary.php" >配送人员工资管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a  > 添加配送人员</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="meal_manage.php" >菜单管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="manage_home.php">餐厅订单管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" onclick="FormSubmit()">提交</a></li>
			</ul>
		</div>
	</div>
</nav>';

echo '<div class="container">';


echo '<form name="sender_form" method="post">';

    echo '<div > 
      <div class="page-header"><h1>添加配送人员：</h1></div>
      </div>';

      echo '<div class="table-responsive">';
      
      echo'<table class="table table-hover">';
	echo '<thead>
			<tr >
				<th><h3>姓名</h3></th>
				<th><h3>手机</h3></th>
				<th><h3>密码</h3></th>
			</tr>
		</thead>
		<tbody>';
		

	for ($i=0;$i<3;$i++){
		echo '<tr id="tr'.$i.'">';
		echo '<td><div class="col-lg-10"><input type="text" class="form-control" id="name'.$i.'"  name="name'.$i.'"></div></td>';
		echo '<td><div class="col-lg-7"><input type="text" class="form-control" id="phone'.$i.'" name="phone'.$i.'" ></div></td>';
		echo '<td><div class="col-lg-7"><input type="text" class="form-control" id="pass'.$i.'" name="pass'.$i.'" ></div></td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
	echo '<button type="button" class="btn btn-default btn-lg " onclick="addinput()">增加</button>';

	echo '</form>';

	

	echo '</div>';


?>

<script   language="javascript" type="text/javascript">   
	var count=2;
	function   addinput()   
	{
		var position=document.getElementById("tr"+count) ;
		count=count+1;
		var tmp="<tr id ='tr" +count+ "'><td><div class='col-lg-10'><input type='text' class='form-control' id='name"+count+"' name='name"+count+"'></div></td><td><div class='col-lg-7'><input type='text' class='form-control' id='phone"+count+"'  name='phone"+count+"' ></div></td><td><div class='col-lg-7'><input type='text' class='form-control' id='pass"+count+"'  name='pass"+count+"' ></div></td></tr>";
		position.insertAdjacentHTML("afterEnd", tmp); 
		
	}


</script>

<script   language="javascript" type="text/javascript">     
		function   FormSubmit()   
		{   
			sender_form.action   =   "sender_add_process.php" ;
			sender_form.submit();   
		}   
</script> 

</body>
</html>