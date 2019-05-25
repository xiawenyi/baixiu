<?php
require_once './config.php';
require_once './functions.php';
$id = $_GET['id'];
echo $id;
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
$sql = "SELECT p.id,p.title,p.feature,p.created,p.content,p.views,p.likes,c.name,u.nickname,
   (SELECT COUNT(*) FROM comments WHERE post_id=p.id) commentsCount FROM posts p 
   LEFT JOIN categories c ON p.category_id=c.id
   LEFT JOIN users u ON p.user_id=u.id
   WHERE p.category_id={$id}
   ORDER BY p.created DESC 
   LIMIT 0,10 ";
$postREsult = mysqli_query($connect, $sql);
$postArr = [];
while ($row = mysqli_fetch_assoc($postREsult)) {
  $postArr[] = $row;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="static/assets/css/style.css">
  <link rel="stylesheet" href="static/assets/vendors/font-awesome/css/font-awesome.css">

</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="list.php"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="list.php"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="list.php"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="list.php"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <!--左边-->
  <?php include_once './public/_header.php' ?>
    <!-- 右边-->
    <?php include_once './public/_aside.php'?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $postArr[0]['name']?></h3>
        <?php
        foreach ($postArr as $value) { ?>
          <div class="entry">
            <div class="head">
              <a href="detail.php?postId=<?php echo $value['id']?>"><?php echo $value['title']?></a>
            </div>
            <div class="main">
              <p class="info"><?php echo $value['nickname']?> 发表于 <?php echo $value['created']?></p>
              <p class="brief"><?php echo $value['content']?></p>
              <p class="extra">
                <span class="reading">阅读(<?php echo $value['views']?>)</span>
                <span class="comment">评论(<?php echo $value['commentsCount']?>)</span>
                <a href="javascript:;" class="like">
                  <i class="fa fa-thumbs-up"></i>
                  <span>赞(<?php echo $value['likes']?>)</span>
                </a>
                <a href="javascript:;" class="tags">
                  分类：<span><?php echo $value['name']?></span>
                </a>
              </p>
              <a href="javascript:;" class="thumb">
                <img src="<?php echo $value['feature']?>" alt="">
              </a>
            </div>
          </div>

        <?php }
      ?>
        <div class="loadmore">
          <span class="btn"> 加载更多</span>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  
   <script src="./static/assets/vendors/jquery/jquery.min.js">
   </script>
   <script>
    //点击加载更多  发送ajax 获取下一次的十篇文章
    var currentPage=1;
    var pageSize=10;
    var id=location.search.split("=")[1];
   
    $(".loadmore").on("click",function(){
      currentPage++;
       $.ajax({
            type:'post',
            url:'./_getMorePost.php',
            data:{
              "currentPage":currentPage,
              "pageSize":pageSize,
              "id":id
            },
            dataType:"json",
            success:function(res){
              console.log(res);
              if(res.code==1){
              var data=res.data;
              var str='';
              $.each(data,function(index,value){
                str+=`<div class="entry">
                   
                        <div class="head">
                          <a href="detail.php">${value.title}</a>
                        </div>
                        <div class="main">
                          <p class="info">${value.nickname} 发表于${value.created}</p>
                          <p class="brief">${value.content}</p>
                          <p class="extra">
                            <span class="reading">阅读(${value.views})</span>
                            <span class="comment">评论(${value.commentsCount})</span>
                            <a href="javascript:;" class="like">
                              <i class="fa fa-thumbs-up"></i>
                              <span>赞(${value.likes})</span>
                            </a>
                            <a href="javascript:;" class="tags">
                              分类：<span>${value.name}</span>
                            </a>
                          </p>
                          <a href="javascript:;" class="thumb">
                            <img src="${value.feature}" alt="">
                          </a>
                        </div>
                      </div>`
                            
              })
              $(str).insertBefore(".loadmore");
              }
            }
            
       })
    })
   </script>
</body>

</html>