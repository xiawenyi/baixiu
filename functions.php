<?php
//强制跳转登录页面
function checkLogin(){
  session_start();
  if(!isset($_SESSION['isLogin'])||$_SESSION['isLogin']!=1){
   header("location:login.php");
  }
}
//连接数据库 封装
  function connect(){
   $connect=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
   return $connect;
  }
  //查询的封装 返回二维数组
  function query($connect,$sql){
       $result=mysqli_query($connect,$sql);
      
       return fetch($result);
  }

  //循环生成二维数组
  function fetch($result){
  $arr=[];
  while($row=mysqli_fetch_assoc($result)){
     $arr[]=$row;
  }
  return $arr;
  }
?>