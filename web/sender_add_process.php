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
				<li><a >'.$restaurant_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="sender_add.php">返回</a></li>
			</ul>
		</div>
	</div>
</nav>';

echo '<div class="container">';
      echo '<div > 
      <div class="page-header"><h1>以下配送人员增加成功：</h1></div>
      </div>';

          echo '<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th><h3>姓名</h3></th>
				<th><h3>手机</h3></th>
				<th><h3>密码</h3></th>
			</tr>
		</thead>
		<tbody>';

		$i=0;
		
		while($_POST["name".$i]!=''){
			$query=mysql_query("select count(*) as number from sender");
    			$result = mysql_fetch_array($query);
    			$id=4000000+$result['number'];
			$res=mysql_query("insert into sender(id,name,phone,restaurant_id,password,state) values('$id','".$_POST["name".$i]."' , '".$_POST["phone".$i]."' ,'$restaurant_id',".$_POST["pass".$i].",'0')");
			$res=mysql_query("insert into sendersalary(id,ordernumber,salary) values('$id','0','0')");
			echo '<tr>';
			echo '<td>'.$_POST["name".$i].'</td>';
			echo '<td>'.$_POST["phone".$i].'</td>';
			echo '<td>'.$_POST["pass".$i].'</td>';
			echo '</tr>';
			$i++;
		}

	echo '</tbody>';
	echo '</table>';
	echo '</div>';
	echo '</div>';

?>


</body>
</html>