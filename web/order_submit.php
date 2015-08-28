<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="order">
	<meta name="author" content="yelinsheng">

	<title>提交订单</title>

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
$user_phone=$_SESSION['user_phone'] ;
$user_name= $_SESSION['user_name'] ;
$restaurant_id=$_SESSION['restaurant_id'];
$order_list = array();

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
			<a class="navbar-brand" >提交订单</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php?type=user">注销</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">'.$user_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="order_meal.php?restaurant_id=1000000#1000000">返回</a></li>
			</ul>
		</div>
	</div>
</nav>';

echo '
    <div class="container">

      <div class="page-header"><h1>您的订单信息如下：</h1></div>';

echo '<div class="table-responsive">
<table class="table table-striped">
		<thead>
			<tr>
				<th><h3>美食名称</h3></th>
				<th><h3>价格</h3></th>
				<th><h3>数量</h3></th>
				<th><h3>小计</h3></th>
				
			</tr>
		</thead>
		<tbody>';
		$sum=0;
		$meal_query=mysql_query("select id,name,price from meal where restaurant_id=$restaurant_id");
		while($meal_result = mysql_fetch_array($meal_query)){
			$meal_id = $meal_result['id'];
			if($_POST[$meal_id]!=0){
				$sum+=$meal_result['price']*$_POST[$meal_id];
				echo '<tr>
					<td>'.$meal_result['name'].'</td>
					<td>￥ '.$meal_result['price'].' </td>
					<td>'.$_POST[$meal_id].'</td>
					<td>￥ '.$meal_result['price']*$_POST[$meal_id].'</td>
				</tr>';
				$order_list[]=$meal_id;
				$order_list[]=$_POST[$meal_id];
			}
		}
		
		
		echo '<thead>
			<tr>
				<th><strong>合计</strong></th>
				<th><strong> </strong></th>
				<th><strong> </strong></th>
				<th><strong> ￥ '.$sum.'</strong></th>
			</tr>	
			</thead>';
		echo '</tbody>';
		echo '</table>';
		echo '</div>';


echo '<div class="page-header">
        <h1>请填写以下信息：</h1>
      </div>';


 echo '<div>';


echo '<form method="post" action="order_process.php">';

//didian
	echo '<h3>请选择地点:</h5><br/>';
	echo '<select name="place" class="form-control" class="col-xs-4" >';

	$place = mysql_query("select id,name from place");
	while($result = mysql_fetch_array($place)){ 
		echo '<option value="'.$result['id'].'">'.$result['name'].'</option>';

	} 
	echo '</select>';
	echo '<h3>备注:</h5><br/>';
	echo '<textarea name="remark" class="form-control" rows="3" placeholder="填写备注"></textarea>';
	echo '<br/><br/><br/>';
	echo '<button name="submit" class="btn btn-primary" type="submit">提交订单</button>';
	echo '</form>';
 echo '</div>';
 echo '</div>';

 echo '<h1>  </h1>';

 session_start();
$_SESSION['order_list']=$order_list ;

?>

</body>
</html>