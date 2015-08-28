<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

$place_id=$_POST['place'];
$remark=$_POST['remark'];


//echo my_utf8_unicode("哈哈ABC");

echo '<br/>';

session_start(); 
$order_list = $_SESSION['order_list']; 
$user_phone=$_SESSION['user_phone'] ;
$user_name= $_SESSION['user_name'] ;
$restaurant_id=$_SESSION['restaurant_id'];




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
				<li><a href="#">'.$user_name.'</a></li>
			</ul>
		</div>
	</div>
</nav>';

$flag=1;
for($i=0;$i<count($order_list)/2;$i++){
	$count=mysql_query("select count(*) as numberofid from orderlist");
	$result = mysql_fetch_array($count);
	$id=60000000+$result['numberofid'];

	$meal_id=$order_list[$i*2];
	$meal_number=$order_list[$i*2+1];


	$sale=mysql_query("select sale from meal where id='$meal_id'");
	$sale_result=mysql_fetch_array($sale);
	$sale_number=$sale_result['sale'];
	$sale_number=$sale_number+$meal_number;
	mysql_query("update meal set sale='$sale_number' where id='$meal_id'");


	//mysql_query("insert into orderlist(id,restaurant_id,phone,meal_id,sender_id,place_id,state,number,remark) values($id,$restaurant_id,$user_phone,$meal_id[$i],0,$place_id,0,$_SESSION['@'.$meal_id[$i]],$remark)");
	$res=mysql_query("insert into orderlist(id,restaurant_id,phone,meal_id,sender_id,place_id,state,number,remark) values($id,$restaurant_id,$user_phone,$meal_id,0,$place_id,0,$meal_number,'$remark')");
	if ( !$res )
	{
    		echo('<h1>订单提交失败！点击此处<a href="order_meal.php?restaurant_id=1000000#1000000">返回</a> 重试</h1>');
    		$flag=0;
	}
	echo '<br/>';
}
if($flag==1){
	echo('<h1>订单提交成功！点击此处 <a href="order_meal.php?restaurant_id=1000000#1000000">返回</a> </h1>');
}






?>

</body>
</html>