<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="order">
	<meta name="author" content="yelinsheng">

	<title>配送人员工资管理</title>

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
			<a class="navbar-brand" >配送人员工资管理</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a >'.$restaurant_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="sender_salary.php">返回</a></li>
			</ul>
		</div>
	</div>
</nav>';

echo '<div class="container">';
      echo '<div > 
      <div class="page-header"><h1>以下工资修改成功：</h1></div>
      </div>';

          echo '<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th><h3>配送人员id</h3></th>
				<th><h3>配送人员姓名</h3></th>
				<th><h3>配送单数</h3></th>
				<th><h3>工资</h3></th>
			</tr>
		</thead>
		<tbody>';

		$sender_all=mysql_query("select id,name from sender where restaurant_id=$restaurant_id");
		while($result_sender=mysql_fetch_array($sender_all)){
			$sender_id=$result_sender['id'];
			$sender_name=$result_sender['name'];
			$salary=$_POST[$sender_id];
			echo '<tr>';
			if($salary){
				mysql_query("update sendersalary set salary=$salary where id=".$sender_id);
				$salary_query=mysql_query("select salary,ordernumber from sendersalary where id=".$sender_id);
				$salary_result=mysql_fetch_array($salary_query);
				$salary=$salary_result['salary'];
				$ordernumber=$salary_result['ordernumber'];
				echo '<td>'.$sender_id.'</td>';
				echo '<td>'.$sender_name.'</td>';
				echo '<td>'.$ordernumber.'</td>';
				echo '<td>'.$salary.'</td>';
			}
			echo '</tr>';
		}

	echo '</tbody>';
	echo '</table>';
	echo '</div>';
	echo '</div>';

?>


</body>
</html>