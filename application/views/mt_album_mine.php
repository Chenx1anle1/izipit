	<div class="container top">
<style>
				.sim-anim-2{
					position: relative;
					}	
				.sim-anim-2 img{
					position: absolute;
						-webkit-transition: all 0.5s;
					-moz-transition: all 0.5s;
					-o-transition: all 0.5s;
					transition: all 0.5s;
					}
				.sim-anim-2:hover img{
					z-index: 1;
					}			
				.sim-anim-2:hover img:nth-child(1){
					-ms-transform: scale(1.1,1.1) rotate(-0deg); 
					-webkit-transform: scale(1.1,1.1) rotate(-0deg); 
					transform: scale(1.1,1.1) rotate(-0deg);
					}
	
</style>		
		<div class="row" id="album">
		</div>
	</div>
	<div id="loader"><i class="icon-spinner icon-spin icon-5x" style="color: #ff5f83"></i></div>
</div>
<script>
	$(function() {
		var album = $('#album');
		var page  = 1;
		var url   = Home + "/album/albuminfo_mine/";

		function xixiAlbum() {

			var surl = url + page;
			page++;

			$.getJSON(surl, function(json) {
				if ($.isEmptyObject(json)) {
					return;
				};
				$('#loader').show();
				$.each(json, function(index, obj) {
					/*
					封面_pic_大盒子
					*/
					var col_div = $('<div>');
					col_div.addClass("col-xs-6 col-md-4 col-lg-3");
					album.append(col_div);

					var album_div = $('<div style="height:475px">');
					album_div.addClass("album albums-tab");
					col_div.append(album_div);

					var cover_div = $('<div>');
					cover_div.addClass("album_cover albums-tab-thumb");
					album_div.append(cover_div);

					var album_url = Home + "album/" + obj.albumID;
					var objalbumUser = obj.albumUser;
					var objalbumUser2 = obj.albumUser;
					var mine = '的';
					var meme = '专辑';
					if(obj.me == obj.albumUser){objalbumUser2='is me!';objalbumUser='my album!';mine='';meme=''}//判断用户是否为登录用户 是则 is me！ 在数组里添加了'me' =>$this->user, 
					/*
					album_info
					*/

					var info_div = $('<div style="margin-top:0px;height:50px;width: 215px;margin-left:15px">');
					info_div.addClass("album_info");
					album_div.append(info_div);

					var info_title = $('<h4 style="margin-top:0px;color:#ff5f83;font-size:6px">');
					info_title.append('<label class="icon-list-alt">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>'+obj.albumName+' 收录 '+obj.albumNum+' 张');
					info_title.attr('title','专辑'+obj.albumName)
					info_div.append(info_title);//结束以父盒子<div>最大级+自己<h4>

/*给创建者一个连接<a href="<?php echo base_url('user/index/'.$user) ?>"><?php echo $user ?></a>*/

					var user_a = $('<a>');
					user_a.attr('href', 'user/index/' + obj.albumUser);
					user_a.attr('title', obj.albumUser);
					info_div.append(user_a);//结束以父盒子<div>最大级+自己<a>

					var info_user = $('<h5 style="margin-bottom:0px;color:#ff5f83;font-size:6px">');
					info_user.addClass('text-right');
					info_user.append('<label class="icon-user">&nbsp&nbsp</label>'+'创建者：' + objalbumUser2);
					user_a.append(info_user);//结束以父盒子<a>最大级+自己<h5>

					
					/*cover*/

					var cover_a = $('<a>');
					cover_a.attr('href', album_url);
					cover_a.attr('title', objalbumUser + mine + meme + "'" + obj.albumName + "'");
					cover_div.append(cover_a);

					var cover_img = $('<img />');
					cover_img.addClass('all studio');
					cover_img.css("width","100%");
					cover_img.css("height","100%");

					var coverImg = new Image();
					coverImg.onload = function() {
						cover_img.attr('src', this.src);
					}
					coverImg.src = obj.albumCover;
					cover_a.append(cover_img);

					/*bottom_picture_01_02_03*/
					//001
					var pic001_div = $('<div>');
					pic001_div.addClass("album_picture pull-left albums-tab-thumb sim-anim-2");
					album_div.append(pic001_div);

					var pic001_a = $('<a>');
					pic001_a.attr('href', album_url);
					pic001_a.attr('title', obj.albumName);
					pic001_div.append(pic001_a);

					var pic001_img = $('<img />');
					pic001_img.addClass('all studio');
					pic001_img.css("width","100%");
					pic001_img.css("height","100%");

					var pic001Img = new Image();
					pic001Img.onload = function() {
						pic001_img.attr('src', this.src);
					}
					pic001Img.src = obj.albumPic001;
					pic001_a.append(pic001_img);
					//002
					var pic002_div = $('<div>');
					pic002_div.addClass("album_picture pull-left albums-tab-thumb sim-anim-2");
					album_div.append(pic002_div);

					var pic002_a = $('<a>');
					pic002_a.attr('href', album_url);
					pic002_a.attr('title', obj.albumName);
					pic002_div.append(pic002_a);

					var pic002_img = $('<img />');
					pic002_img.addClass('all studio');
					pic002_img.css("width","100%");
					pic002_img.css("height","100%");

					var pic002Img = new Image();
					pic002Img.onload = function() {
						pic002_img.attr('src', this.src);
					}
					pic002Img.src = obj.albumPic002;
					pic002_a.append(pic002_img);
					//003
					var pic003_div = $('<div>');
					pic003_div.addClass("album_picture pull-left albums-tab-thumb sim-anim-2");
					album_div.append(pic003_div);

					var pic003_a = $('<a>');
					pic003_a.attr('href', album_url);
					pic003_a.attr('title', obj.albumName);
					pic003_div.append(pic003_a);

					var pic003_img = $('<img />');
					pic003_img.addClass('all studio');
					pic003_img.css("width","100%");
					pic003_img.css("height","100%");

					var pic003Img = new Image();
					pic003Img.onload = function() {
						pic003_img.attr('src', this.src);
					}
					pic003Img.src = obj.albumPic003;
					pic003_a.append(pic003_img);

					setTimeout(function() {
						$('#loader').hide();
					},1000);
				})
			});
		}

		xixiAlbum();

/*		$(window).on('scroll', function() {
			var window_h   = $(window).scrollTop() + $(window).innerHeight();
			if (album.innerHeight() + 100 < window_h) {
				xixiAlbum();
			}
		})*/
	})
</script>
<script src="<?php echo base_url('dist/js/top.js') ?>"></script>