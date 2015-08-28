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
    $user_name=$_POST['username'];
    $user_phone = $_POST['phonenum'];  
    $password = $_POST['passwd'];

//包含数据库连接文件  
    include('conn.php');  
    mysql_query("set names 'utf8'");
    $result=mysql_query("select phone from user where phone=".$user_phone);
    if(!$result){
        echo('<h1>此手机已注册，可直接登陆！点击此处 <a href="index.php">返回</a> </h1>');
    }
    else{
        $res=mysql_query("insert into user(phone,name,password) values('$user_phone','$user_name','$password')");
        if ( !$res )
        {
                echo('<h1>注册失败！点击此处 <a href="user_register.php">返回</a> 重试</h1>');
        }
        else{
            echo('<h1>注册成功！点击此处 <a href="index.php">登陆</a> </h1>');
        }
    }

    

    ?>  
</body>
</html>