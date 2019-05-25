<?php

       
        $filename=$_FILES['file']['name'];
        $ext=strrchr($filename,".");
        $myname=uniqid().$ext;
        $bool=move_uploaded_file($_FILES['file']['tmp_name'],'../static/uploads/'.$myname);
        $response=['code'=>0,'msg'=>"上传失败"];
        if($bool){
            $response['code']=1;
            $response['msg']="文件上传成功";
            $response['src']='../static/uploads/'.$myname;
        }
        echo json_encode($response);
    
?>