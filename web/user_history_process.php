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


		$order_all= mysql_query("select * from orderlist where phone=$user_phone order by restaurant_id");
		while($result_order = mysql_fetch_array($order_all)){
			$order_id=$result_order['id'];
			$comment=$_POST[$order_id];
			if($comment != ''){
				    $meal_id=$result_order['meal_id'];
				    $res=mysql_query("insert into comment(user_id,meal_id,comment) values('$user_phone','$meal_id','$comment')");
				    mysql_query("update orderlist set if_comment=1 where id=$order_id ");
				   
			}
		}
		echo '<script>window.location.assign("user_history.php")</script>';


?>
</body>
</html>