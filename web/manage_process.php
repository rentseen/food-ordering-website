<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="order">
	<meta name="author" content="yelinsheng">

	<title>餐厅订单管理</title>

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
			<a class="navbar-brand" >餐厅订单管理</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a >'.$restaurant_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="manage_home.php">返回</a></li>
			</ul>
		</div>
	</div>
</nav>';

echo '<div class="container">';
      echo '<div > 
      <div class="page-header"><h1>以下订单处理成功：</h1></div>
      </div>';

          echo '<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th><h3>订单号</h3></th>
				<th><h3>美食名称</h3></th>
				<th><h3>单价</h3></th>
				<th><h3>数量</h3></th>
				<th><h3>备注</h3></th>
				<th><h3>用户手机</h3></th>
				<th><h3>地点</h3></th>
				<th><h3>配送人员</h3></th>
			</tr>
		</thead>
		<tbody>';

	$order_all= mysql_query("select * from orderlist where restaurant_id=$restaurant_id and state=0");
	while($result_order = mysql_fetch_array($order_all)){
		$sender_id=$_POST[$result_order['id']];
		if ($sender_id!=0){
			mysql_query("update orderlist set sender_id=$sender_id ,state=1 where id=".$result_order['id']);

			$order_insert= mysql_query("select * from orderlist where id=".$result_order['id']);
			$result_insert=mysql_fetch_array($order_insert);

			echo '<tr>
				<td>'.$result_insert['id'].'</td>';

			$meal=mysql_query("select name,price from meal where id=".$result_insert['meal_id']);
			$result_meal=mysql_fetch_array($meal);
			$meal_name=$result_meal['name'];
			$meal_price=$result_meal['price'];

			echo '
				<td>'.$meal_name.'</td>
				<td>'.$meal_price.'</td>
				<td>'.$result_insert['number'].'</td>
				<td>'.$result_insert['remark'].'</td>
				<td>'.$result_insert['phone'].'</td>';

		         	$place=mysql_query("select name from place where id=".$result_insert['place_id']);
			$result_place=mysql_fetch_array($place);
			$place_name=$result_place['name'];

			$sender=mysql_query("select name from sender where id=".$result_insert['sender_id']);
			$result_sender=mysql_fetch_array($sender);
			$sender_name=$result_sender['name'];

			echo '<td>'.$place_name.'</td>
			          <td>'.$sender_name.'</td>
		         	          </tr>';
		}

	}

	echo '</tbody>';
		echo '</table>';
		echo '</div>';
	echo '</div>';



?>


</body>
</html>