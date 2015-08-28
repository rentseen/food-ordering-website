<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <meta name="description" content="login">
  <meta name="author" content="yelinsheng">

  <title>登陆</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">

</head>

<body>

  <?php
  $flag=$_GET['type'];
  if(strlen($flag)==0 or $flag=='user'){
    echo '<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" >用户登陆</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
        <li><a href="restaurant_register.php">餐厅注册</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="user_register.php">用户注册</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?type=restaurant">餐厅登陆</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a>用户登陆</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">

    <form name="LoginForm1" method="post" action="login_user_process.php" class="form-signin">
      <h2 class="form-signin-heading">用户登录</h2>
      <h2/>
      <label for="user_phone" class="sr-only">手机</label>  
      <input id="user_phone" name="user_phone" type="text" class="form-control" placeholder="手机" required autofocus/> 

      <label for="password" class="sr-only">密 码:</label>  
      <input id="password" name="password" type="password" class="form-control" placeholder="密 码" required/> 
      
      <h2/>
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">登录</button>
    </form>

  </div> <!-- /container -->';
}
if($flag=='restaurant'){
  echo '<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" >餐厅登陆</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
        <li><a href="restaurant_register.php">餐厅注册</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="user_register.php">用户注册</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a>餐厅登陆</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?type=user">用户登陆</a></li>
        </ul>
      </div>
    </div>
  </nav>



  <div class="container">

    <form name="LoginForm2" method="post" action="login_restaurant_process.php" class="form-signin">
      <h2 class="form-signin-heading">餐厅登录</h2>
      <h2/>
      <label for="restaurant_id" class="sr-only">餐厅ID</label>  
      <input id="restaurant_id" name="restaurant_id" type="text" class="form-control" placeholder="餐厅ID" required autofocus/> 

      <label for="password" class="sr-only">密 码:</label>  
      <input id="password" name="password" type="password" class="form-control" placeholder="密 码" required/> 
      
      <h2/>
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">登录</button>
    </form>


  </div> <!-- /container -->';
}




?>

</body>
</html>
