<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <meta name="description" content="login">
  <meta name="author" content="yelinsheng">

  <title>注册</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">

</head>

<body>

  <?php
    echo '<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" >用户注册</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
        <li><a href="restaurant_register.php">餐厅注册</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a>用户注册</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?type=restaurant">餐厅登陆</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?type=user">用户登陆</a></li>
        </ul>
      </div>
    </div>
  </nav>

<div class="container">

  <form name="user_register_form" method="post" class="form-signin">
  <h2 class="form-signin-heading">填写以下信息</h2>
  <h2/>
 <div class="form-group">
      <input type="text" name="username" id="username" class="form-control" placeholder="姓名" />
   </div>
    <div class="form-group">
      <input type="text" name="phonenum" id="phonenum" class="form-control" placeholder="手机"/>
   </div>
   <div class="form-group">
      <input type="password" name="passwd" id="passwd" class="form-control" placeholder="密码"/>
   </div>
   <div class="form-group">
      <input type="password" name="conformpasswd" id="conformpasswd" class="form-control" placeholder="确认密码"/>
   </div>
   <div class="form-group">
   <p class="text-right"><button class="btn btn-lg btn-primary btn-success" name="submit" type="submit" onclick="FormSubmit()">注册</button></p>
   </div>
    </form>


  </div>';


  echo '<script   language="javascript" type="text/javascript">   
    function   FormSubmit()   
    {   
      var username= document.getElementById("username").value;
      var phonenum= document.getElementById("phonenum").value;
      var passwd= document.getElementById("passwd").value;
      var conformpasswd= document.getElementById("conformpasswd").value;

      if(username==null || username==""){
           alert("姓名不能为空");
      }
      else if(phonenum==null || phonenum==""){
        alert("手机号码不能为空");
      }
      else if(passwd==null || passwd==""){
        alert("密码不能为空");
      }
      else if(conformpasswd==null || conformpasswd==""){
        alert("确认密码不能为空");
      }
      else if(passwd != conformpasswd){
        alert("确认密码与密码不一致");
      }
      else{
          user_register_form.action = "user_register_process.php" ;
          user_register_form.submit();
      }
    }
    </script> ';

?>

</body>
</html>
