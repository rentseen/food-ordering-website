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

</head>
<body>
<?php

include('conn.php'); 
mysql_query("set names 'utf8'");
session_start();
$user_phone=$_SESSION['user_phone'] ;
$user_name= $_SESSION['user_name'] ;

$meal_id=$_GET['meal_id'];

$meal=mysql_query("select name from meal where id=".$meal_id);
$result_meal=mysql_fetch_array($meal);
$meal_name=$result_meal['name'];

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
			<a class="navbar-brand" >'.$meal_name.'</a>
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
		</div>
	</div>
</nav>';

echo '
    <div class="container">';

   echo  '<div class="page-header"><h1>用户评论：</h1></div>';


echo '<div class="table-responsive">
<table class="table table-striped">
		<thead>
			<tr>
				<th><h3>用户</h3></th>
				<th><h3>评价</h3></th>
			</tr>
		</thead>
		<tbody>';

		$comment_all= mysql_query("select user_id,comment from comment where meal_id=$meal_id");
		while($result_comment = mysql_fetch_array($comment_all)){
			$user_id=$result_comment['user_id'];
			$comment=$result_comment['comment'];

			echo '<tr>
				<td>'.substr($user_id,0,3).'***'.substr($user_id,8,11).'</td>
				<td>'.$comment.' </td>
			</tr>';
		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
 echo '</div>';

 echo '<h1>  </h1>';


?>

</body>
</html>