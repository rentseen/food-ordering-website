<?php
$submit=$_POST['submit'];
$list=split('and',$submit);
include('conn.php');  
mysql_query("set names 'utf8'");

foreach ($list as $key => $value) { 
    mysql_query("update orderlist set state=2 where id=".$value); 

    $sender_query = mysql_query("select sender_id from orderlist where id=".$value);
    if($result = mysql_fetch_array($sender_query)){ 
            $sender_id=$result['sender_id'];
            mysql_query("update sendersalary set ordernumber=ordernumber+1 where id=".$sender_id); 
        }
}

?>
