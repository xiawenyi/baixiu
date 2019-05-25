<?php
require '../config.php';
require '../functions.php';
$connect=connect();
$id=$_POST['id'];
$sql="UPDATE posts SET likes=likes+1 where id={$id}";

$retuSql="select * from posts where id={$id}";

$queryReslut=mysqli_query($connect,$sql);

$queryPost=query($connect,$retuSql);
// var_dump($queryPost);die;
$response=["code"=>0,"msg"=>'点赞失败'];
if($queryReslut){
  $response['code']=1;
  $response['msg']='点赞成功';
  $response['postLi']=$queryPost[0]['likes'];
  
}
echo json_encode($response);
?>