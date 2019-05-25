<?php
require '../config.php';
require '../functions.php';
$connect=connect();
$ids=$_POST['ids'];
$idStr=implode(",",$ids);
$sql="delete from categories where id in ({$idStr})";
$queryReslut=mysqli_query($connect,$sql);
$response=["code"=>0,"msg"=>'批量删除失败'];
if($queryReslut){
  $response['code']=1;
  $response['msg']='批量删除成功';
  
}
echo json_encode($response);
?>