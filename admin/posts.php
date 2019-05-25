<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>

<body>
  <script>
    NProgress.start()
  </script>

  <div class="main">
    <!--头部-->
    <?php include_once './public/_navbar.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select id="category" name="" class="form-control input-sm">
            <option value="all">所有分类</option>
          </select>
          <select id="status" name="" class="form-control input-sm">
            <option value="all">所有状态</option>
            <option value="drafted">草稿</option>
            <option value="published">已发布</option>
            <option value="trashed">已作废</option>
          </select>
          <button id="btn-filt" type="button" class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">
          <!-- <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li> -->
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>


        </tbody>
      </table>
    </div>
  </div>
  <?php $current_page = "posts"; ?>
  <!--左边-->
  <?php include_once './public/_aside.php'
  ?>
  <script src="../static/assets/vendors/jquery/jquery.min.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>
    NProgress.done()
  </script>
  <script>
    //声明一个变量  当前第几页
    var currenPage = 1;
    var pageCount = 10;
    var pageSize = 10;
    //开始=当前-2
    function mak() {
      var stare = currenPage - 2;
      if (stare < 1) {
        stare = 1;
      }
      //结束页码
      var end = stare + 4;
      if (end > pageCount) {
        end = pageCount;
      }

      var html = "";
      if (stare != 1) { //拼接
        html += `<li class="item" data-page="${currenPage-1}"><a href="javascript:;">上一页</a></li>`;
      }
      for (i = stare; i <= end; i++) {
        if (currenPage == i) {
          html += `<li class="item active " data-page="${i}"><a href="javascript:;">${i}</a></li>`;
        } else {
          html += `<li class="item" data-page="${i}"><a href="javascript:;">${i}</a></li>`;
        }
      }
      if (currenPage != pageCount) {
        html += `<li class="item" data-page="${currenPage+1}"><a href="javascript:;">下一页</a></li>`;
      }
      $(".pagination").html(html);
    }
    mak();
    var statusData = {
      "drafted": "草稿",
      "published": "已发布",
      "trashed": "已作废"
    }
    //页面一打开，获取10篇文章
    $(function() {
      $.ajax({
        type: "post",
        url: '../api/_getPostData.php',
        data: {
          "currenPage": currenPage,
          "pageSize": pageSize,
          "catgoryId":$("#category").val(),
          "status": $("#status").val()
        },
        dataType: 'json',
        success: function(res) {
          if (res.code == 1) {
            pageCount = res.pageCount;
            mak();
            var data = res.data;
            console.log(data);
            var str = '';
            $.each(data, function(index, value) {
              str += `<tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>${value.title}</td>
            <td>${value.nickname}</td>
            <td>${value.name}</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">${statusData[value.status]}</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>`;
              $("tbody").html(str);
            })
          }

        }

      })
      //点击获取分页
      $(".pagination").on("click", '.item', function() {
        currenPage = parseInt($(this).attr("data-page"));
        console.log(currenPage);
        $.ajax({
          type: 'post',
          url: '../api/_getPostData.php',
          data: {
            "currenPage": currenPage,
            "pageSize": pageSize,
            "catgoryId":$("#category").val(),
          "status": $("#status").val()
          },
          dataType: 'json',
          success: function(res) {
            console.log(res);
            var data = res.data;
            console.log(data);
            var str = '';
            $.each(data, function(index, value) {
              str += `<tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>${value.title}</td>
            <td>${value.nickname}</td>
            <td>${value.name}</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">${statusData[value.status]}</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>`;
              $("tbody").html(str);
              mak();
            })
          }
        })
      })
      //加载所有数据分类
      $.ajax({
        type: 'post',
        url: '../api/_getCate.php',
        data: {},
        dataType: 'json',
        success: function(res) {
          console.log(res);
          var data = res.data;
          var str = '';
          $.each(data, function(index, value) {
            str += `<option value="${value.id}">${value.name}</option>`;

          })
          $(str).appendTo("#category");
        }
      })
      //筛选
      $("#btn-filt").on("click", function() {
        var catgoryId = $("#category").val();
        var status = $("#status").val();
        //  console.log(categoryId,status);
        $.ajax({
          type: 'post',
          url: '../api/_getPostData.php',
          data: {
            "catgoryId": catgoryId,
            "status": status,
            "currenPage": currenPage,
            "pageSize": pageSize
          },
          dataType: 'json',
          success: function(res) {
            console.log(res);
            if (res.code == 1) {
              pageCount = res.pageCount;
              mak();
              var data = res.data;
              console.log(data);
              var str = '';
              $.each(data, function(index, value) {
                str += `<tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>${value.title}</td>
            <td>${value.nickname}</td>
            <td>${value.name}</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">${statusData[value.status]}</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>`;
                $("tbody").html(str);
              })
            }
          }
        })
      })
    })
  </script>
</body>

</html>