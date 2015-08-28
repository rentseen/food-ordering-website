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
				<li><a href="index.php?type=restaurant">注销</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a >'.$restaurant_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a  >配送人员工资管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="sender_add.php" > 添加配送人员</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="meal_manage.php" >菜单管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="manage_home.php">餐厅订单管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" onclick="FormSubmit()">工资结算提交</a></li>
			</ul>
		</div>
	</div>
</nav>';

echo '
    <div class="container">

      <div > 
      <div class="page-header"><h1>工资结算清单：</h1></div>
      </div>';

      echo '<form name="salary_form" method="post">';

      echo '<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th><h3>配送人员id</h3></th>
				<th><h3>配送人员姓名</h3></th>
				<th><h3>配送单数</h3></th>
				<th><h3>工资</h3></th>
				<th><h3>修正工资</h3></th>
			</tr>
		</thead>
		<tbody>'; 

		$sender_all=mysql_query("select id,name from sender where restaurant_id=$restaurant_id");
		while($result_sender=mysql_fetch_array($sender_all)){
			$sender_id=$result_sender['id'];
			$sender_name=$result_sender['name'];
			echo '<tr>
				<td>'.$sender_id.'</td>
				<td>'.$sender_name.'</td>';
			$salary_query=mysql_query("select ordernumber,salary from sendersalary where id=$sender_id");
			$salary_result=mysql_fetch_array($salary_query);
			$salary=$salary_result['salary'];
			$ordernumber=$salary_result['ordernumber'];

			echo '
				<td>'.$ordernumber.'</td>
				<td>'.$salary.'</td>';
			echo     '<td><label for="password" class="sr-only">'.$sender_id.'</label>  
      				<input id="'.$sender_id.'" name="'.$sender_id.'" type="text"  placeholder="修正" required/></td>';
			echo '</tr>';

		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
	echo '</form>';
	echo '</div>';


	echo '<script   language="javascript" type="text/javascript">   
		function   FormSubmit()   
		{   
			salary_form.action   =   "sender_salary_process.php" ;
			salary_form.submit();   
		}   
		</script> ';


?>

</body>
</html>