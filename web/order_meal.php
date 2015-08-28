<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="order">
	<meta name="author" content="yelinsheng">

	<title>餐厅美食</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/order.css" rel="stylesheet">

	<link class="usemin" rel="stylesheet" href="eleme_1.css">
	<link class="usemin" rel="stylesheet" href="eleme_2.css">
	<link class="usemin" rel="stylesheet" href="eleme_3.css">

</head>
<body>

	<?php

	include('conn.php');  
	mysql_query("set names 'utf8'");

	session_start();
	$user_phone=$_SESSION['user_phone'] ;
	$user_name= $_SESSION['user_name'] ;
	$restaurant_id=$_GET['restaurant_id'];
	session_start();
	$_SESSION['restaurant_id'] = $restaurant_id; 
	

	$restaurant = mysql_query("select name from restaurant where id=$restaurant_id");
	$result = mysql_fetch_array($restaurant);
	$restaurant_name=$result['name'];

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
			<a class="navbar-brand" >订餐页面</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php?type=user">注销</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">'.$user_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">'.$restaurant_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="user_history.php">历史订单</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" onclick="FormSubmit()">提交订单</a></li>
			</ul>
		</div>
	</div>
</nav>';



echo '<div class="container-fluid">';
echo '<div class="row">';
echo '<div class="col-sm-3 col-md-2 sidebar">';



//左侧的餐厅
echo '<ul class="nav nav-sidebar">';
echo '<li class="active"><a>餐厅 <span class="sr-only">(current)</span></a></li>';

$restaurant = mysql_query("select name,id from restaurant");
while($result = mysql_fetch_array($restaurant)){ 
	echo '<li><a name="'. $result['id'].'" href="order_meal.php?restaurant_id='.$result['id'].'#'.$result['id'].'"> '.$result['name'].'</a></li>';
} 
echo '</ul>';
echo'</div>';

echo '<form name="meal_form" method="post">';
echo '<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>';

              $i=0;
          	$meal = mysql_query("select name,id,price,sale from meal where restaurant_id=$restaurant_id");
          	echo '<div class="row placeholders">';
              while($result_meal = mysql_fetch_array($meal)){ 
		
		echo  '<div class="col-xs-6 col-sm-3 placeholder">';

		echo '<a href="show_comment.php?meal_id='.$result_meal['id'].'"><img type="image" height = 150 width = 150 src="img/'.$i.'.jpeg" /></a>';
		echo '<h4><a href="show_comment.php?meal_id='.$result_meal['id'].'">'.$result_meal['name'].'</a></h4>';
		echo '<span class="text-muted">销量：'.$result_meal['sale'].' </span>';
		echo '<span class="text-muted">价格：'.$result_meal['price']. ' </span>';
		echo '<span class="text-muted"><select name="'.$result_meal['id'].'"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select><span class="text-muted">';
		echo '</div>';
		$i=$i+1;
	}

          echo '</div>';
echo '</form>';


echo '</div>';//col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main
echo '</div>';
echo '</div>';//container-fluid


		//提交订单
		echo '<script   language="javascript" type="text/javascript">   
		function   FormSubmit()   
		{   
			meal_form.action   =   "order_submit.php" ;
			meal_form.submit();   
		}   
		</script> ';

	?>

</body>
</html>