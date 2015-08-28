<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="order">
	<meta name="author" content="yelinsheng">

	<title>历史订单</title>

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
	$user_phone=$_SESSION['user_phone'] ;
	$user_name= $_SESSION['user_name'] ;

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
                <li><a href="javascript:history.back(-1);">返回</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" onclick="FormSubmit()">订单提交</a></li>
            </ul>
        </div>
    </div>
</nav>';

echo '<div class="container">
	<div class="col-xs-3" id="myScrollspy">
		<ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125">
			<li class="active"><a href="#section-1">未评论订单</a></li>
			<li><a href="#section-2">已评论订单</a></li>
		</ul>
	</div>
	<div class="col-xs-9">';
  	
  	echo '<form name="comment_form" method="post">';


   echo  '<div class="page-header"><a  id="section-1" name="section-1"><h2>未评论订单：</h2></a></div>';

echo '<div class="table-responsive">
<table class="table table-striped">
        <thead>
            <tr>
                <th><h3>订单号</h3></th>
                <th><h3>美食名称</h3></th>
                <th><h3>餐厅</h3></th>
                <th><h3>价格</h3></th>
                <th><h3>数量</h3></th>
                <th><h3>小计</h3></th>
                <th><h3>评价</h3></th>
                
            </tr>
        </thead>
        <tbody>';

        $order_all= mysql_query("select * from orderlist where phone=$user_phone and if_comment=0 order by restaurant_id");
        while($result_order = mysql_fetch_array($order_all)){
            $order_id=$result_order['id'];
            $meal_id=$result_order['meal_id'];
            $number=$result_order['number'];

            $meal=mysql_query("select name,price from meal where id=".$meal_id);
            $result_meal=mysql_fetch_array($meal);
            $meal_name=$result_meal['name'];
            $meal_price=$result_meal['price'];

            $restaurant_query=mysql_query("select name from restaurant where id=".$result_order['restaurant_id']);
            $result_restaurant=mysql_fetch_array($restaurant_query);
            $restaurant_name=$result_restaurant['name'];


            echo '<tr>
                <td>'.$order_id.'</td>
                <td>'.$meal_name.' </td>
                <td>'.substr($restaurant_name,0,6).'.... </td>
                <td>'.$meal_price.'</td>
                <td>'.$number.'</td>
                <td>'.$number*$meal_price.'</td>
                <td><input type="text" class="form-control" id="'.$order_id.'"  name="'.$order_id.'"></td>
            </tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';

echo  '<div class="page-header"><a  id="section-2" name="section-2"><h2>已评论订单：</h2></a></div>';

    echo '<div class="table-responsive">
        <table class="table table-striped">
        <thead>
            <tr>
                <th><h3>订单号</h3></th>
                <th><h3>美食名称</h3></th>
                <th><h3>餐厅</h3></th>
                <th><h3>价格</h3></th>
                <th><h3>数量</h3></th>
                <th><h3>小计</h3></th>
                
            </tr>
        </thead>
        <tbody>';

        $order_all= mysql_query("select * from orderlist where phone=$user_phone and if_comment=1 order by restaurant_id");
        while($result_order = mysql_fetch_array($order_all)){
            $order_id=$result_order['id'];
            $meal_id=$result_order['meal_id'];
            $number=$result_order['number'];

            $meal=mysql_query("select name,price from meal where id=".$meal_id);
            $result_meal=mysql_fetch_array($meal);
            $meal_name=$result_meal['name'];
            $meal_price=$result_meal['price'];

            $restaurant_query=mysql_query("select name from restaurant where id=".$result_order['restaurant_id']);
            $result_restaurant=mysql_fetch_array($restaurant_query);
            $restaurant_name=$result_restaurant['name'];


            echo '<tr>
                <td>'.$order_id.'</td>
                <td>'.$meal_name.' </td>
                <td>'.substr($restaurant_name,0,6).'.... </td>
                <td>'.$meal_price.'</td>
                <td>'.$number.'</td>
                <td>'.$number*$meal_price.'</td>
            </tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';

echo '</form>';

echo '</div>
</div>';

//提交订单
echo '<script   language="javascript" type="text/javascript">   
function   FormSubmit()   
{   
    comment_form.action   =   "user_history_process.php" ;
    comment_form.submit();   
}   
</script> ';


?>

</body>
</html>