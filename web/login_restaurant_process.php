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

    <title>登陆</title>

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
    $restaurant_id = $_POST['restaurant_id'];  
    $password = $_POST['password'];

//包含数据库连接文件  
   include('conn.php');  
    mysql_query("set names 'utf8'");
//检测用户名及密码是否正确  
    $check_query = mysql_query("select * from restaurant where id=$restaurant_id and password='$password'" );  
    if($result = mysql_fetch_array($check_query)){  
    //登录成功  
        session_start();  
        $_SESSION['restaurant_id'] = $restaurant_id;  
        $_SESSION['restaurant_name'] = $result['name'];  

        echo '<script>window.location.assign("manage_home.php")</script>';
    } else {  
        echo '<div class="container">';
        echo('<h1>密码或ID有误！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试</h1>'); 
        echo '</div>'; 
    }  



//注销登录  
    /*if($_GET['action'] == "logout"){  
        unset($_SESSION['userid']);  
        unset($_SESSION['username']);  
        echo '注销登录成功！点击此处 <a href="userlogin.php">登录</a>';  
        exit;  
    }  */

    ?>  
</body>
</html>