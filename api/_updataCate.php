<?php
 require '../config.php';
 require '../functions.php';
 $slug=$_POST['slug'];
 $name=$_POST['name'];
 $id=$_POST['id'];
 $classname=$_POST['classname'];
 $connect=connect();
 $sql="update categories set slug='{$slug}',name='{$name}',classname='{$classname}' where id={$id}";
 $queryResult=mysqli_query($connect,$sql);
 $response=['code'=>0,"msg"=>'更新失败'];
if($queryResult){
    $response['code']=1;
    $response['msg']='修改成功';

}
echo json_encode($response);
?>