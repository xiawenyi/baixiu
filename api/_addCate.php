<?php
 require '../config.php';
 require '../functions.php';
  $name=$_POST['name'];
  $slug=$_POST['slug'];
  $classname=$_POST['classname'];
  $connect=connect();
  $countSql="select count(*) as count from categories where name='{$name}'";
  $countResult=query($connect, $countSql);
  $count=$countResult[0]['count'];
  $response=["code"=>0,"msg"=>'分类名字已存在，不许重复添加'];
  if($count>0){
     $response['msg']="分类名字已存在，不许重复添加";
  }else{
    $addsql="INSERT INTO categories(name,slug,classname) 
    VALUES('{$name}','{$slug}','{$classname}')";
    $addResult=mysqli_query($connect,$addsql);
    if($addResult){
        $response['code']=1;
        $response['msg']='添加成功';
        header("Location:");
        header('Location: ../admin/categories.php');
    }
  }
  echo json_encode($response);
  
?>