<?php
  require '../functions.php';
  require '../config.php';
  $id=$_POST['id'];
  $connect=connect();
  $sql="delete from categories where id={$id}";
  $queryResult=mysqli_query($connect,$sql);
  $response=["code"=>0,"msg"=>'删除失败'];
  if($queryResult){
      $response["code"]=1;
      $response["msg"]="删除成功";
  }
  echo json_encode($response);
?>