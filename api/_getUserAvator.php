<?php
  
  require_once '../config.php';
  require_once '../functions.php';
  session_start();
  $userId=$_SESSION['userId'];
  $connect=connect();
  $sql="select * from users where id={$userId}";
  $queryResult=query($connect,$sql);
  $response=['code'=>0,"msg"=>'查询失败'];
  if($queryResult){
   $response["code"]=1;
   $response["msg"]="查询成功";
   $response["nickname"]=$queryResult[0]['nickname'];
   $response['avatar']=$queryResult[0]['avatar'];

  }
  echo json_encode($response);
?>