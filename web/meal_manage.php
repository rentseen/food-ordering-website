<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="order">
	<meta name="author" content="yelinsheng">

	<title>菜单管理</title>

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
			<a class="navbar-brand" >菜单管理</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php?type=restaurant">注销</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a >'.$restaurant_name.'</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="sender_salary.php" >配送人员工资管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="sender_add.php" > 添加配送人员</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>菜单管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="manage_home.php">餐厅订单管理</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" onclick="FormSubmit()">菜单提交</a></li>
			</ul>
		</div>
	</div>
</nav>';

echo '<div class="container">';


echo '<form name="menu_form" method="post">';

    echo '<div > 
      <div class="page-header"><h1>增加菜单：</h1></div>
      </div>';

      echo '<div class="table-responsive">';
      
      echo'<table class="table table-hover">';
	echo '<thead>
			<tr >
				<th><h3>美食名称</h3></th>
				<th><h3>价格</h3></th>
			</tr>
		</thead>
		<tbody>';
		

	for ($i=0;$i<3;$i++){
		echo '<tr id="tr'.$i.'">';
		echo '<td><div class="col-lg-10"><input type="text" class="form-control" id="name'.$i.'"  name="name'.$i.'"></div></td>';
		echo '<td><div class="col-lg-7"><input type="text" class="form-control" id="price'.$i.'" name="price'.$i.'" ></div></td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
	echo '<button type="button" class="btn btn-default btn-lg " onclick="addinput()">增加</button>';

      echo '<div > 
      <div class="page-header"><h1>已上架菜单：</h1></div>
      </div>';
      

      echo '<div class="table-responsive">';
      echo '<table class="table table-striped">';
      echo '<thead>
			<tr>
				<th><h3>美食id</h3></th>
				<th><h3>美食名称</h3></th>
				<th><h3>价格</h3></th>
				<th><h3>订单数</h3></th>
			</tr>
		</thead>
		<tbody>';

		$meal_all=mysql_query("select id,name,price,sale from meal where restaurant_id=$restaurant_id");
		while($result_meal=mysql_fetch_array($meal_all)){
			$meal_id=$result_meal['id'];
			$meal_name=$result_meal['name'];
			$meal_price=$result_meal['price'];
			$meal_sale=$result_meal['sale'];
			echo '<tr>
				<td>'.$meal_id.'</td>
				<td>'.$meal_name.'</td>
				<td>'.$meal_price.'</td>
				<td>'.$meal_sale.'</td>';
			echo '</tr>';

		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
		echo '</form>';

	echo '</div>';


?>

<script   language="javascript" type="text/javascript">   
	var count=2;
	function   addinput()   
	{
		var position=document.getElementById("tr"+count) ;
		count=count+1;
		var tmp="<tr id ='tr" +count+ "'><td><div class='col-lg-10'><input type='text' class='form-control' id='name"+count+"' name='name"+count+"'></div></td><td><div class='col-lg-7'><input type='text' class='form-control' id='price"+count+"'  name='price"+count+"' ></div></td></tr>";
		position.insertAdjacentHTML("afterEnd", tmp); 
		
	}


</script>

<script   language="javascript" type="text/javascript">     
		function   FormSubmit()   
		{   
			menu_form.action   =   "menu_process.php" ;
			menu_form.submit();   
		}   
</script> 

</body>
</html>