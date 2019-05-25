<?php
  require '../config.php';
  require '../functions.php';
  $connect=connect();
  $sql="select * from categories";
  $querResult=query($connect,$sql);
  $response=["code"=>0,"msg"=>'查询分类失败'];
  if($querResult){
    $response["code"]=1;
    $response["msg"]="查询分类成功";
    $response['data']=$querResult;

  }
  echo json_encode($response);
?>