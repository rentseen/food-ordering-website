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
    $user_phone = $_POST['user_phone'];  
    $password = $_POST['password'];

//包含数据库连接文件  
    include('conn.php');  
    mysql_query("set names 'utf8'");
//检测用户名及密码是否正确  
    $check_query = mysql_query("select * from user where phone=$user_phone and password='$password'" );
    echo $result['phone'];
    if($result = mysql_fetch_array($check_query)){  
    //登录成功 
        session_start();  
        $_SESSION['user_phone'] = $user_phone;  
        $_SESSION['user_name'] = $result['name'];  

        $restaurant = mysql_query("select id from restaurant");
        if($result = mysql_fetch_array($restaurant)){ 
            $initial_page=$result['id'];
            echo '<script>window.location.assign("order_meal.php?restaurant_id='.$initial_page.'#'.$initial_page.'")</script>';
        } else{
            echo '<div class="container">';
            echo('<h1>登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试</h1>'); 
            echo '</div>'; 
        }
        

    } else {  
        echo '<div class="container">';
        echo('<h1>密码或账号有误！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试</h1>'); 
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