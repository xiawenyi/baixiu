<?php
require '../config.php';
require '../functions.php';
//得到前端发来的数据 邮箱密码
$email=$_POST['email'];
$password=$_POST['password'];
//去数据库 擦汗寻有没有这个邮箱和密码
$connect=connect();
$sql="SELECT * FROM users WHERE email='{$email}' AND password='{$password}' AND status='activated'";
$queryResult=query($connect,$sql);
$response=["code"=>0,"msg"=>'登录失败'];
if($queryResult){
    session_start();
    $_SESSION['isLogin']=1;
    $_SESSION['userId']=$queryResult[0]['id'];
    $response["code"]=1;
    $response["msg"]="登录成功";
}
  echo json_encode($response);
?>