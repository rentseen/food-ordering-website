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

    <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/order.css" rel="stylesheet">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
	<style type="text/css">
		/* Custom Styles */
		ul.nav-tabs{
			width: 140px;
			margin-top: 20px;
			border-radius: 4px;
			border: 1px solid #ddd;
			box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);
		}
		ul.nav-tabs li{
			margin: 0;
			border-top: 1px solid #ddd;
		}
		ul.nav-tabs li:first-child{
			border-top: none;
		}
		ul.nav-tabs li a{
			margin: 0;
			padding: 8px 16px;
			border-radius: 0;
		}
		ul.nav-tabs li.active a, ul.nav-tabs li.active a:hover{
			color: #fff;
			background: #0088cc;
			border: 1px solid #0088cc;
		}
		ul.nav-tabs li:first-child a{
			border-radius: 4px 4px 0 0;
		}
		ul.nav-tabs li:last-child a{
			border-radius: 0 0 4px 4px;
		}
		ul.nav-tabs.affix{
			top: 30px; /* Set the top position of pinned element */
		}
	</style>
</head>
<body data-spy="scroll" data-target="#myScrollspy">

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
				<li><a href="index.php?type=restaurant">注销</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>'.$restaurant_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="sender_salary.php" >配送人员工资管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="sender_add.php" > 添加配送人员</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="meal_manage.php" >菜单管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>餐厅订单管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" onclick="FormSubmit()">提交未处理订单</a></li>
			</ul>
		</div>
	</div>
</nav>';

echo '<div class="container">
	<div class="col-xs-3" id="myScrollspy">
		<ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125">
			<li class="active"><a href="#section-1">未处理的订单</a></li>
			<li><a href="#section-2">正在配送的订单</a></li>
			<li><a href="#section-3">历史订单</a></li>
		</ul>
	</div>
	<div class="col-xs-9">';
  	
  	echo '<div > 
	<div class="page-header"><a  id="section-1" name="section-1"><h1>未处理的订单：</h1></a></div>
	</div>';

echo '<form name="sender_form" method="post">';

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
			<th><h3>选择配送人员</h3></th>
		</tr>
	</thead>
	<tbody>';

		$sender_all=mysql_query("select id,name from sender where restaurant_id=$restaurant_id and state=0");
		$sender_name=array();
		$sender_id=array();
		while($result_sender=mysql_fetch_array($sender_all)){
			$sender_id[]=$result_sender['id'];
			$sender_name[]=$result_sender['name'];
		}


		$order_all= mysql_query("select * from orderlist where restaurant_id=$restaurant_id and state=0 order by place_id");
		while($result_order = mysql_fetch_array($order_all)){
			echo '<tr>
			<td>'.$result_order['id'].'</td>';

			$meal=mysql_query("select name,price from meal where id=".$result_order['meal_id']);
			$result_meal=mysql_fetch_array($meal);
			$meal_name=$result_meal['name'];
			$meal_price=$result_meal['price'];

			echo '
			<td>'.$meal_name.'</td>
			<td>'.$meal_price.'</td>
			<td>'.$result_order['number'].'</td>
			<td>'.$result_order['remark'].'</td>
			<td>'.$result_order['phone'].'</td>';

			$place=mysql_query("select name from place where id=".$result_order['place_id']);
			$result_place=mysql_fetch_array($place);
			$place_name=$result_place['name'];

			echo '<td>'.$place_name.'</td>';

			echo '<td>';
			echo '<select name="'.$result_order['id'].'">';
			echo '<option value="0"=></option>';
			foreach ($sender_name as $key => $value) {
				echo '<option value='.$sender_id[$key].'>'.$value.'</option>';
			}
			echo '</select>';
			echo '</td>';

			echo '</tr>';

		} 
		echo '</tbody>';
		echo '</table>';
		echo '</div>';  //table-responsive
		echo '</form>';

		echo '<div > 
		<div class="page-header"><a  id="section-2" name="section-2"><h1>正在配送的订单：</h1></a></div>
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
			$order_all= mysql_query("select * from orderlist where restaurant_id=$restaurant_id and state=1 order by place_id");
			while($result_order = mysql_fetch_array($order_all)){
				echo '<tr>
				<td>'.$result_order['id'].'</td>';

				$meal=mysql_query("select name,price from meal where id=".$result_order['meal_id']);
				$result_meal=mysql_fetch_array($meal);
				$meal_name=$result_meal['name'];
				$meal_price=$result_meal['price'];

				echo '
				<td>'.$meal_name.'</td>
				<td>'.$meal_price.'</td>
				<td>'.$result_order['number'].'</td>
				<td>'.$result_order['remark'].'</td>
				<td>'.$result_order['phone'].'</td>';

				$place=mysql_query("select name from place where id=".$result_order['place_id']);
				$result_place=mysql_fetch_array($place);
				$place_name=$result_place['name'];

				$sender=mysql_query("select name from sender where id=".$result_order['sender_id']);
				$result_sender=mysql_fetch_array($sender);
				$sender_name=$result_sender['name'];

				echo '<td>'.$place_name.'</td>
				<td>'.$sender_name.'</td>
			</tr>';

		} 
		echo '</tbody>';
		echo '</table>';
		echo '</div>'; //table-responsive



		echo '<div >
		<div class="page-header"><a id="section-3"  name="section-3"><h1>历史订单：</h1></a></div>
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
			$order_all= mysql_query("select * from orderlist where restaurant_id=$restaurant_id and state=2 order by place_id");
			while($result_order = mysql_fetch_array($order_all)){
				echo '<tr>
				<td>'.$result_order['id'].'</td>';

				$meal=mysql_query("select name,price from meal where id=".$result_order['meal_id']);
				$result_meal=mysql_fetch_array($meal);
				$meal_name=$result_meal['name'];
				$meal_price=$result_meal['price'];

				echo '
				<td>'.$meal_name.'</td>
				<td>'.$meal_price.'</td>
				<td>'.$result_order['number'].'</td>
				<td>'.$result_order['remark'].'</td>
				<td>'.$result_order['phone'].'</td>';

				$place=mysql_query("select name from place where id=".$result_order['place_id']);
				$result_place=mysql_fetch_array($place);
				$place_name=$result_place['name'];

				$sender=mysql_query("select name from sender where id=".$result_order['sender_id']);
				$result_sender=mysql_fetch_array($sender);
				$sender_name=$result_sender['name'];

				echo '<td>'.$place_name.'</td>
				<td>'.$sender_name.'</td>
			</tr>';

		} 
		echo '</tbody>';
		echo '</table>';
		echo '</div>';//table-responsive

	echo '</div>
</div>';


//提交订单
echo '<script   language="javascript" type="text/javascript">   
function   FormSubmit()   
{   
	sender_form.action   =   "manage_process.php" ;
	sender_form.submit();   
}   
</script> ';
?>

</body>
</html>