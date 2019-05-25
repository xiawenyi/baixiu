<?PHP
require './config.php';
/* 最新发布的功能
      连接数据库
      查询文章信息
      动态生成结构

 
 */
//连接数据库
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
$sql = "SELECT p.id,p.title,p.feature,p.created,p.content,p.views,p.likes,c.name,u.nickname,
  (SELECT COUNT(*)FROM comments WHERE post_id=p.id)commentsCount FROM posts p 
  LEFT JOIN categories c ON p.category_id=c.id
  LEFT JOIN users u ON p.user_id=u.id
  WHERE p.category_id!=1
   ORDER BY p.created DESC LIMIT 0,10
  ";

$result = mysqli_query($connect, $sql);

$postArr = [];
while ($row = mysqli_fetch_assoc($result)) {
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
  <style>
    .like {
      position: relative;
    }

    .dianzan {
      width: 25px;
      height: 25px;
      background: red;
      color: #ffff;
      position: absolute;
      top: -10px;
      left: 10px;
      border-radius: 50%;
      text-decoration: none;
      line-height: 25px;
      text-align: center;
      opacity: 0;

    }
  </style>
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
    <!--模块分离-->
    <!--左边-->
    <?php include_once './public/_header.php' ?>
    <!-- 右边-->
    <?php include_once './public/_aside.php' ?>
    <div class="content">
      <div class="swipe">
        <ul class="swipe-wrapper">
          <li>
            <a href="#">
              <img src="static/uploads/slide_1.jpg">
              <span>XIU主题演示</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="static/uploads/slide_2.jpg">
              <span>XIU主题演示</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="static/uploads/slide_1.jpg">
              <span>XIU主题演示</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="static/uploads/slide_2.jpg">
              <span>XIU主题演示</span>
            </a>
          </li>
        </ul>
        <p class="cursor"><span class="active"></span><span></span><span></span><span></span></p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
        <ul>
          <li class="large">
            <a href="javascript:;">
              <img src="static/uploads/hots_1.jpg" alt="">
              <span>XIU主题演示</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_2.jpg" alt="">
              <span>星球大战：原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_5.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol>
          <li>
            <i>1</i>
            <a href="javascript:;">你敢骑吗？全球第一辆全功能3D打印摩托车亮相</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>2</i>
            <a href="javascript:;">又现酒窝夹笔盖新技能 城里人是不让人活了！</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span class="">阅读 (18206)</span>
          </li>
          <li>
            <i>3</i>
            <a href="javascript:;">实在太邪恶！照亮妹纸绝对领域与私处</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>4</i>
            <a href="javascript:;">没有任何防护措施的摄影师在水下拍到了这些画面</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>5</i>
            <a href="javascript:;">废灯泡的14种玩法 妹子见了都会心动</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
        </ol>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
      <!--最新发布-->
      <div class="panel new">
        <h3>最新发布</h3>
        <?php
        foreach ($postArr as $value) {
          ?>
          <div class="entry">
            <div class="head">
              <span class="sort"><?php echo $value['name'] ?></span>
              <a href="javascript:;"><?php echo $value['title'] ?></a>
            </div>
            <div class="main">
              <p class="info"><?php echo $value['nickname'] ?> 发表于 <?php echo $value['created'] ?></p>
              <p class="brief"><?php echo $value['content'] ?></p>
              <p class="extra">
                <span class="reading"><?php echo $value['views'] ?></span>
                <span class="comment"><?php echo $value['commentsCount'] ?></span>
                <!--点赞-->
                <a href="javascript:;" class="like" data-id="<?php echo $value['id'] ?>">
                  <i class="fa fa-thumbs-up"></i>
                  <s class="dianzan">+1</s>
                  <span><?php echo $value['likes'] ?></span>
                </a>

                <a href="javascript:;" class="tags">
                  分类：<span><?php echo $value['name'] ?></span>
                </a>
              </p>
              <a href="javascript:;" class="thumb">
                <img src="<?php echo $value['feature'] ?>" alt="">
              </a>
            </div>
          </div>
        <?php }
      ?>


      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script src="static/assets/vendors/jquery/jquery.js"></script>
  <script src="static/assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function(index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function() {
      var _this = $(this);

      if (_this.is('.prev')) {
        swiper.prev();
      } else if (_this.is('.next')) {
        swiper.next();
      }
    })
    //最新发布点赞系统
    $(".like").on("click", function() {
      var id = $(this).attr("data-id");
      var dianzan = $(this).find(".dianzan");
      var that = $(this);
      console.log(dianzan);
      $.ajax({
        type: 'post',
        url: './api/_dianzan.php',
        data: {
          "id": id
        },
        dataType: 'json',
        success: function(res) {
          console.log(res);
          if (res.code == 1) {
            dianzan.css({
              top: "-40px",
              opacity: 1,
              transition: "all 1s"
            })
            setTimeout(function() {
              dianzan.css({
                top: "-10px",
                opacity: 0,
                transition: "none"
              })

            }, 1200);
          }

          //  var uname=that.find("span").text();
          // //  console.log(uname);
          // uname++;
          // that.find("span").text(uname);
          that.find("span").text(res.postLi);
        }
      })
    })
  </script>
</body>

</html>