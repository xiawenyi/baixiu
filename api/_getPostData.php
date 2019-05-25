<?php
  require '../functions.php';
  require '../config.php';
  $connect=connect();
  $currenPage=$_POST['currenPage'];
  $pageSize=$_POST['pageSize'];
  $status=$_POST['status'];
  $catgoryId=$_POST['catgoryId'];

  $offset=($currenPage-1)*$pageSize;
  $where=" where 1=1 "; 
  if($catgoryId!='all'){
        $where.=" and p.category_id={$catgoryId} ";
  }
  if($status!='all'){
     $where.=" and p.status='{$status}' ";
  }
  $sql="select p.id,p.title,p.created,p.status,c.name,u.nickname
  from posts p
  left join categories c on p.category_id=c.id
  left join users u on p.user_id=u.id
  {$where}
  limit {$offset},{$pageSize}";
  $queryResult=query($connect,$sql);

  $countSql="SELECT count(*) as count from posts";
  $querySql=query($connect,$countSql);
  $postCount=$querySql[0]['count'];
  $pageCount=ceil($postCount/$pageSize);

  $response=["code"=>0,"msg"=>'查询文章失败'];
  if($queryResult){
      $response["code"]=1;
      $response["msg"]='查询文章成功';
      $response['data']=$queryResult;
      $response['pageCount']=$pageCount;
  }
  echo json_encode($response);
