<!DOCTYPE html>
<html>
  <head>
  	<!--  -->
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <meta name="keywords" content="<?php echo $keywords ?>" />
    <meta name="description" content="<?php echo $description ?>" />
    <link rel="icon" href="<?php echo base_url('favicon.ico') ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/bootstrap.min.css') ?>">
    <!-- <link href="http://cdn.bootcss.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/font-awesome.min.css') ?>">
    <!-- <link href="http://cdn.bootcss.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/signin.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/upload.css') ?>">
    <!-- <link href="http://cdn.bootcss.com/normalize/3.0.1/normalize.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/lightbox.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/bootstrap-tagsinput.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/funnyNewsTicker.css') ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url('dist/js/jquery-1.11.1.min.js') ?>"></script>
    <!--<script src="http://cdn.bootcss.com/jquery/2.1.0/jquery.min.js"></script>-->
    <script>
      var Home      = "<?php echo base_url() ?>";
    </script>
    <!--百度统计 -->
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?22450bbe4eb7b5f51344a2941963ebbd";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>

    <style>
      body{ -webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none;}
      *::selection{color:#fff;background:#f36;}
      *::-moz-selection{color:#fff;background:#f36;}
      *::-webkit-selection{color:#fff;background:#f36;}
      option::selection{color:#fff;background:#fff;}
      option::-moz-selection { color:#f60; background-color:#fff;}
      option::-webkit-selection{color:#fff;background:#fff;}
      .navbar-right .menu-hd { position:relative; z-index:100; }
      /*.navbar-right li a { display:block; padding:0 10px; }*/
      .navbar-right .menu-hd a {border-left:1px solid #f5f5f5; border-right:1px solid #f5f5f5; }
      .navbar-right .menu-hd:hover .menu-bd { display:block; }
      .navbar-right .menu-bd { display:none; position:absolute; left:1px; top:50px; width:90px; border-bottom:1px solid #eee; background-color:#fff; text-align:left; z-index:10001; box-shadow:1px 2px 3px rgba(0,0,0,.1); }
      .navbar-right .menu-bd img { width:200px; height:200px; }
      .navbar-right .code { width:200px; }
      .navbar-right .menu-hd1 a {border-left:1px solid #f5f5f5; border-right:1px solid #f5f5f5; }
      .navbar-right .menu-hd1:hover .menu-bd1 { display:block; }
      .navbar-right .menu-bd1 { display:none; position:absolute; left:-200px; top:50px; width:90px; border-bottom:1px solid #eee; background-color:#fff; text-align:right; z-index:10001; box-shadow:1px 2px 3px rgba(0,0,0,.1); }
      .navbar-right .menu-bd1 img { width:400px; height:500px; }
      .navbar-right .code1 { width:400px; }
      .block:hover {
          -webkit-transition: all .5s ease 0s;
          -moz-transition: all .5s ease 0s;
          -o-transition: all .5s ease 0s;
          -moz-transform: translate(0px,-5px);
          -webkit-transform: translate(0px,-5px);
          -o-transform: translate(0px,-5px);
          -ms-transform: translate(0px,-5px);
          transform: translate(0px,-5px);
          -webkit-box-shadow: 0 5px 10px rgba(67,72,84,.3);
          -moz-box-shadow: 0 5px 10px rgba(67,72,84,.3);
          -o-box-shadow: 0 5px 10px rgba(67,72,84,.3);
          box-shadow: 0 5px 10px rgba(67,72,84,.3)
        }
      /*.block:hover {
          -webkit-transform: translate3d(0,-2px,0);
          transform: translate3d(0,-2px,0);
          box-shadow: 0 15px 30px rgba(0,0,0,.1)
        }*/
    </style>
  </head>
  <body>
    <div class="wrap" >
      <nav class="navbar navbar-default border navbar-fixed-top" role="navigation" style="z-index:100000000;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="font-size: 14px; color: #ff5f83; font-weight: bold;" href="<?php echo base_url() ?>"><label>&nbsp</label><label class="icon-heart icon-large">&nbsp&nbsp&nbsp</label>izipit</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown dropdown-large">
			
              <a href="javascript:void()" title="分类" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-align-justify icon-large"></i></a>
              <ul class="dropdown-menu dropdown-menu-large row">
                <li class="col-sm-4">
                  <ul>
					<a href="<?php echo site_url().'album' ?>"><span class="header">&nbsp&nbsp&nbsp专辑&nbsp&nbsp</span></a>
					<a href="<?php echo site_url().'yedeng' ?>">
					<label title='夜灯' class="icon-list-alt icon-2x" style="color: #c1c1c1">&nbsp</label>
					</a>
				  <li class="divider"></li>
                  <?php
                  $query = $this->catalogue_model->catalogue();
                  foreach ($query as $key => $value) {
                    $catalogue_url = base_url('catalogue') . '/' . $value['cat_another_name'];
                    if($key % 3 == 0) {
                  ?>
                  <li><a href="<?php echo $catalogue_url ?>" style="color: #ff5f83"><?php echo $value['cat_name'] ?></a></li>
                  <li class="divider"></li>
                  <?php } } ?> 
                  </ul>
                </li>
                <li class="col-sm-4">
                  <ul>
                    <label>TOP&nbsp
					</label>                    
					<a class="icon-thumbs-up icon-2x" style="color: #c1c1c1" href="<?php echo site_url().'popular_like' ?>"><label></label></a>
					<a class="icon-search icon-2x" style="color: #c1c1c1" href="<?php echo site_url().'popular_view' ?>"><label></label></a>
					<a class="icon-heart icon-2x" style="color: #c1c1c1" href="<?php echo site_url().'popular_love' ?>"><label></label></a>
                    <li class="divider"></li>
                  <?php
                  $query = $this->catalogue_model->catalogue();
                  foreach ($query as $key => $value) {
                    $catalogue_url = base_url('catalogue') . '/' . $value['cat_another_name'];
                    if($key % 3 == 1) {
                  ?>
                  <li><a href="<?php echo $catalogue_url ?>" style="color: #ff5f83"><?php echo $value['cat_name'] ?></a></li>
                  <li class="divider"></li>
                  <?php } } ?> 
                  </ul>
                </li>
                <li class="col-sm-4">
                  <ul>
                    <li><a href="<?php echo site_url().'make' ?>">
						<label class="icon-tags icon-2x" style="color: #c1c1c1">&nbsp&nbsp</label>
						<span class="header">标签</span>
					</a></li>
                    <li class="divider"></li>
                  <?php
                  $query = $this->catalogue_model->catalogue();
                  foreach ($query as $key => $value) {
                    $catalogue_url = base_url('catalogue') . '/' . $value['cat_another_name'];
                    if($key % 3 == 2) {
                  ?>
                  <li><a href="<?php echo $catalogue_url ?>" style="color: #ff5f83"><?php echo $value['cat_name'] ?></a></li>
                  <li class="divider"></li>
                  <?php } } ?> 
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
			  <li>
				<a style="color: #ff5f83" href="<?php echo site_url().'popular_users' ?>">
					<b><i>TopU</i></b><label class="icon-user icon-large" style="font_size:10px"></label>
				</a>
				</li>
				<li>
					<a style="color: #ff5f83" href="<?php echo site_url().'3D' ?>">
					<b><i>Top3D</i></b>
				</a>
				</li>
				<li>
					<a style="color: #ff5f83" href="<?php echo site_url().'yedeng' ?>">
					<b>夜灯</b>
          <!-- flashwall -->
				</a>
				</li>
				<!--
				<li>
					<a style="color: #ff5f83" href="#">
					<b><i>boom</i></b>
				</a>
				</li>
				-->
		</ul>
          <?php
            if (!isset($search)){$search = '';}
          ?>
        <div class="navbar-form search-form navbar-left" style="padding:0;margin-top:0;margin-bottom: 0;" role="search">
            <div class="form-group">
              <input type="text" id="search" value="<?php echo $search ?>" class="search-input form-control border" placeholder="Search" onkeypress="EnterSearch()">
            </div>
            <button type="submit" class="search-submit btn btn-default border" onclick="Search()" style="color: gray;"><i class="icon-search"></i></button>
        </div>
<style>
.search-form {
    float: left
}

.search-form .search-input {
    float: right;
    height: 35px;
    width: 0;
    margin-top: 5px;
    padding: 0;
    color: #eee;
    background: transparent;
    border: none;
    border-radius: 2px;
    -webkit-transition: .6s;
    transition: .6s
}

.search-form:hover .search-input {
    width: 150px;
    margin-right: 10px;
    color: #333;
    background-color: #fff
}

.search-form .search-input:focus {
    width: 150px;
    color: #333;
    background: #fff;
    outline: none
}

.search-form .search-submit {
    border: none;
    background-color: #f8f8f8;
    color: #f8f8f8;
    cursor: pointer;
    -webkit-transition: 1s;
    transition: 1s;
    font-size: 25px
}

.search-form .search-submit:focus {
    outline: none
}

.search-form:hover .search-submit,.search-form .search-input:focus+.search-submit {
    color: #fff;
    -webkit-transform: rotateY(-180deg);
    transform: rotateY(-180deg)
}
</style>

          <ul class="nav navbar-nav navbar-right">
            <li class="menu-hd">
            <a style="color: #ff5f83;font-size：10px;" href=""><b>WeChat</b></a>
            <div class="menu-bd code">
              <img src="<?php echo base_url('/dist/image/code_wx.jpg') ?>" alt="我的不说微信:zipit21087591">
            </div>
            </li>
<!--             <li class="menu-hd1">
            <a style="color: #ff5f83;font-size：10px;" href=""><b>show me</b></a>
            <div class="menu-bd1 code1">
              <img src="<?php echo base_url('/dist/image/code_wx.jpg') ?>" alt="我的不说微信:zipit21087591">
            </div>
            </li> -->
         <?php if( $this->session->userdata('online') ) { ?>
            <?php $username = $this->session->userdata('Username'); ?>
            <?php $myletter = $this->letter_model->myletter($username); ?>
      
      <?php
              $picture = 'upload/user/' . $this->user_model->picture($username) . '_3.jpg';
              if (file_exists($picture)) {
                $userpic = base_url('upload/user/' . $this->user_model->picture($username) . '_3.jpg');
              } else {
                $userpic = base_url('upload/user/default_3.jpg');
              }
            ?>
                <?php if ($this->user_model->is_admin($username)) { ?>
					<ul class="nav navbar-nav navbar-left">
					  <li>
						<a style="color: #ff5f83" href="<?php echo site_url().'popular_mypic' ?>">
							<label class="icon-picture" style="font_size:10px"></label>
							<b><i>MyTopPic</i></b>
						</a>
					  </li>
					</ul>
                <?php } else { ?>
					<ul class="nav navbar-nav navbar-left">
					  <li>
            <a style="color: #ff5f83" href="<?php echo base_url().'popular_mypic' ?>">
						<!--<a style="color: #ff5f83" href="<?php echo base_url().'user/collect/' . $username ?>">-->
							<label class="icon-picture" style="font_size:10px"></label>
							<b><i>MyCollection</i></b>
						</a>
					</li>
					</ul>
                <?php } ?>
            <li>
				<a href="<?php echo base_url('user/collect') . '/' . $username ?>" style="float:left;padding: 9px 10px;">		
				<label class="icon-user icon-large"><?php echo '&nbsp&nbsp&nbsp&nbsp'.$username ?>&nbsp&nbsp<label class="icon-leaf" style="color: #ff5f83"></label>&nbsp</label>
					<img src="<?php echo $userpic ?>" class="img-circle">
				</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle right-border" data-toggle="dropdown"><i class="icon-align-justify icon-large"></i><i class="icon-align-justify icon-large"></i></a>
              <ul class="dropdown-menu" role="menu">

                <?php if ($this->user_model->is_admin($username)) { ?>
                <li>
					<a href="<?php echo site_url().'admin' ?>" style="color:gray">
						<i class="icon-key icon-large" style="color: #ffff00"></i>
						〓admin管理中心
						<strong style="color: #ff6262;"><i></i></strong>
					</a>
				</li>
                <li class="divider"></li>

                <?php } ?>
                <li>
                  <a href="<?php echo site_url().'uploads' ?>" style="color: gray;">
            <i class="icon-upload-alt"  style="color: #0000ff"></i>
            〓本地图片上传
          </a>
        </li>
                <li class="divider"></li>

  				<li><a style="color: #ff5f83" href="<?php echo site_url().'album2' ?>">
  					<label class="icon-list-alt" style="font_size:10px"></label>
  					<label class="header" style="font_size:10px;color:gray">〓my album</label>					  
  				</a></li>
                <li class="divider"></li>
                <li>
        					<a href="<?php echo base_url('comment') ?>" style="color: gray;">
        						<i class="icon-envelope" style="color: #cdcdcd"></i>
        						〓我的收到的评论 
        						<strong style="color: #ff6262;"><i><label class="fa-bell"><label><?php if ($myletter) echo $myletter ?></i></strong>
        					</a>
        				</li>
                <li class="divider"></li>
				
                <li><a data-toggle="modal" data-target="#albumModal" style="cursor: pointer;color: gray">
                <i class="icon-list-alt" style="color: #ff66ff"></i>
                〓创建自己的专辑</a>
                </li>
                <?php ?>
                <li class="divider"></li>
                <li><a href="<?php echo site_url().'user/cellphone' ?>"style="color: gray">
                <i class="icon-user" style="color: #ff3535"></i>
                〓补填手机信息</a>
                </li>
                <?php ?>
                <li class="divider"></li>
                <li><a href="<?php echo site_url().'logout' ?>"style="color: gray">
                <i class="icon-off" style="color: #ff3535"></i>
                〓退出登录</a>
                </li>
              </ul>
            </li>
            <li><a></a></li>
            <?php } else { ?>


            <?php $username = "guest"; ?>
            <a class="icon-leaf" style="float:left; color: #c0c0c0" href="<?php echo site_url().'login' ?>"></a>
            <a type="button" style="float:left;" class="btn btn-success btn-circle navbar-btn" href="<?php echo site_url().'register' ?>">注册</a>
            <a type="button" style="float:left;margin-right:40px;" class="btn btn-success btn-circle navbar-btn" href="<?php echo site_url().'login' ?>">登录</a>
            <?php } ?> 
          </ul>
        </div>
      </nav>

      <!-- 创建专辑框 -->
    <div class="modal fade" id="albumModal" role="dialog" style="margin-top:200px;">
      <div class="modal-dialog">
        <div class="modal-content border">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title"><strong style="color: #ff5f83">创建专辑</strong></h4>
          </div>
          <div class="modal-body">
              <div class="alert alert-info border hide" id="albumalert"></div>
              <div class="alert alert-success border hide" id="albumsuccess"></div>
              <input type="text" id="albumname" class="form-control border" required="true" placeholder="专辑名称" autofocus="true">          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default border" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary border" onClick="javascript:CreatAlbum()">创建专辑</button>
          </div>
        </div>
      </div>
    </div>

<script>
/********创建专辑****************/
function CreatAlbum (argument) {
  var name    = $('#albumname').val();
  var alert   = $('#albumalert');
  var success = $('#albumsuccess');
  if (name.length < 2) {
    alert.html('专辑名称不得少于2个字符');
    alert.removeClass('hide');
    alert.addClass('show');
    setTimeout(function () {
      alert.removeClass('show');
      alert.addClass('hide');
    }, 3000);
    return;
  }
  if (name.length > 8) {
    alert.html('专辑名称不得大于8个字符');
    alert.removeClass('hide');
    alert.addClass('show');
    setTimeout(function () {
      alert.removeClass('show');
      alert.addClass('hide');
    }, 3000);
    return;
  }
    var username = '<?php echo $username; ?>';
    var server   = Home + "album/creat/" + username + "/" + name;
    $.ajax({
        type : "POST",
        url  : server,
        success: function(recvice){
          switch(recvice) {
            case "0":
              success.html("专辑创建成功");
              success.removeClass('hide');
              success.addClass('show');
              setTimeout(function () {
                $('#albumModal').modal('hide');
              }, 1000);
              break;
            case "1":
              alert.html('专辑名称已存在');
              alert.removeClass('hide');
              alert.addClass('show');
              setTimeout(function () {
                alert.removeClass('show');
                alert.addClass('hide');
              }, 3000);
              break;
            case "2":
              alert.html('专辑创建失败');
              alert.removeClass('hide');
              alert.addClass('show');
              setTimeout(function () {
                alert.removeClass('show');
                alert.addClass('hide');
              }, 3000);
              break;
          }
       }
    })
}

/********取得搜索框****************/
var search = document.getElementById("search");
/********搜索函数**********/
function Search() {
    if (search.value != "") {
      window.location.href = Home + "search/" + search.value;
    }
}
/********搜索框回车********/
function EnterSearch() {
  if (event.keyCode == 13 && search.value != "") {
    window.location.href = Home + "search/" + search.value;
  }
}
</script>