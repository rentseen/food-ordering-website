<!-- 用户登陆的处理-->

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="login_process">
    <meta name="author" content="yelinsheng">

    <title>用户注册</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/welcome.css" rel="stylesheet">

</head>

<body>
    <?php  
//登录  
    if(!isset($_POST['submit'])){  
        exit('非法访问!');  
    }  
    $restaurant_name=$_POST['restaurantname'];
    $restaurant_phone = $_POST['phonenum'];  
    $password = $_POST['passwd'];

//包含数据库连接文件  
    include('conn.php');  
    mysql_query("set names 'utf8'");
    $query=mysql_query("select count(*) as number from restaurant");
    $result = mysql_fetch_array($query);
    $id=1000000+$result['number'];
    $res=mysql_query("insert into restaurant(id,phone,name,password) values('$id','$restaurant_phone','$restaurant_name','$password')");
    if ( !$res )
    {
             echo('<h1>注册失败！点击此处 <a href="restaurant_register.php">返回</a> 重试</h1>');
     }
     else{
            echo '<h1>您的id为'.$id.'，请牢记！！！</h1>';
            echo('<h1>注册成功！点击此处 <a href="index.php?type=restaurant">进入</a> 登陆界面</h1>');
     }
    

    ?>  
</body>
</html>