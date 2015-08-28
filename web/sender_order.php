<?php
$sender_id=$_POST['user'];
$password=$_POST['passwd'];

include('conn.php');  
mysql_query("set names 'utf8'");

$check_query = mysql_query('select id from sender where id='.$sender_id.' and password='.$password );  
if($check_result = mysql_fetch_array($check_query)){  
    //登录成功  
    $order_query=mysql_query('select * from orderlist where sender_id='.$sender_id.' and state=1 ORDER BY place_id' );
    while ($order_result=mysql_fetch_array($order_query)) {
    	$place_query =mysql_query('select * from place where id='.$order_result['place_id']);
    	$place_result=mysql_fetch_array($place_query);
    	$place_name=$place_result['name'];

    	$meal_query =mysql_query('select * from meal where id='.$order_result['meal_id']);
    	$meal_result=mysql_fetch_array($meal_query);
    	$meal_name=$meal_result['name'];

     	echo $order_result['id'].'or'.$order_result['phone'].'or'.$place_name.'or'.$meal_name.'or'.$order_result['remark'].'and';
     } 
} else{
	echo "登陆失败or0or0or0or0";
}


	
?>
