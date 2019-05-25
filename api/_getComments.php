<?php
   require '../functions.php';
   require '../config.php';
   
   $currentPage=$_POST['currentPage'];
   $pageSize=$_POST['pageSize'];
   $offset=($currentPage-1)*$pageSize;
   $connect=connect();
 
   $sql="select c.id,c.author,c.created,c.status,c.content,p.title
   FROM comments c
   left join posts p on c.post_id=p.id
   
   limit {$offset},{$pageSize}";

   $countSql="select count(*) as count from comments";
   $countArr=query($connect,$countSql);
   $comCount=$countArr[0]['count'];
   $pageCount=ceil($comCount/$pageSize);
   
   $queryResult=query($connect,$sql);
   $response=["code"=>0,"msg"=>'查询评论失败'];
   if($queryResult){
       $response["code"]=1;
       $response["msg"]="查询评论成功";
       $response['data']=$queryResult;
       $response['pageCount']=$pageCount;
   }
   echo json_encode($response);
