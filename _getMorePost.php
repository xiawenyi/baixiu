<?php 
  require './config.php';
  require './functions.php';
  $currentPage=$_POST['currentPage'];
  $pageSize=$_POST['pageSize'];
  $id=$_POST['id'];
  $offset=($currentPage-1)*$pageSize;
  $connect=connect();
  $sql="SELECT p.id,p.title,p.feature,p.created,p.content,p.views,p.likes,c.name,u.nickname,
  (SELECT COUNT(*) FROM comments WHERE post_id=p.id) commentsCount FROM posts p 
  LEFT JOIN categories c ON p.category_id=c.id
  LEFT JOIN users u ON p.user_id=u.id
  WHERE p.category_id={$id}
  ORDER BY p.created DESC 
  LIMIT {$offset},{$pageSize} ";
  $postArr=query($connect,$sql);
  $response=["code"=>0,"msg"=>"操作失败"];
  if($postArr){
   $response["code"]=1;
   $response["msg"]='操作成功';
   $response["data"]=$postArr;

  }
  echo json_encode($response);

?>