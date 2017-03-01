    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        .container {
            max-width: 50rem;
            margin-left: 1rem;
            margin-right: auto;
            margin-bottom: 50px;
            margin-top: 50px;
        }
        h1 {
            font-size: 54px;
            margin: 30px 0 10px;
        }

		.now {
		    color: #fff;
		    background-color: #F7B5C4;
		    border-color: #F8C1CE;
		}
        hr {
            display: block;
            width: 7rem;
            height: 1px;
            margin: 2.5rem 0;
            background-color: #eee;
            border: 0;
        }
		.ol-li{ display:inline}
		.key_box{display:none;}
        p {
            font-size: 18px;
        }
    </style>
    <div class="container">
        <h1>player</h1>
		<ul>
		<?php
			$total_page = ceil($total%5);
			$uid = 0;
			if ($uid_key) {
				$uid = $this->session->userdata('id');
			}
			$total_page = $total_page<8?8:$total_page;
		?>
        <?php for ($i=0; $i<=$total_page; $i++) { ?>
        	<?php if (2<$i && $i!=$offset/5 && $i<$total_page) { ?>
        		<li style="list-style:none;float:left;">·</li>
			<?php } else { ?>
	        	<li style="list-style:none;float:left;">
	        	<a<?php if ($i*5 == $offset) :?> class="now btn btn-primary"<?php endif; ?> style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.(5*$i) ?><?php echo $uid ? '&uid='.$uid : '' ?>"><?php echo '第'.($i+1).'页' ?></a>
				</li>
			<?php } ?>
        <?php } ?>
        <?php if (($offset-5)>-5) { ?>
			<li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset-5) ?><?php echo $uid ? '&uid='.$uid : '' ?>"><?php echo '上一页' ?></a></li>
		<?php } ?>
        <?php if (($offset)<$total_page*5) { ?>
			<li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset+5) ?><?php echo $uid ? '&uid='.$uid : '' ?>"><?php echo '下一页' ?></a></li>
		<?php } ?>
		<?php if (!$uid_key) { ?>
			<li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page=0&uid='.$this->session->userdata('id') ?>"><?php echo '我的' ?></a></li>
		<?php } ?>
		<?php if ($uid_key) { ?>
			<li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page=0' ?>"><?php echo '退出收藏' ?></a></li>
		<?php } ?>
		</ul>
        <hr>
        <div id="player" class="aplayer"></div>
    	<div class="moreli_com">
			<div>
	            <button class="icon-align-justify" style="color:#818181;font-size:10px;" type="button"></button>
				<ul class="key_box" id="programlist">
				<li><h4 class="morel_bt">点击去播放 可以复制播放链接 提交到列表内播放</h2></li>
				</ul>  
	        </div>		
	        <!--分页start-->
	        <div id="Pagination" class="pagination">
	        </div>
	        <!--分页end-->
		</div>
    </div>
	<script type="text/javascript">
		$(document).ready(function(){
		  $("button").click(function(){
		  $(".key_box").toggle(2000);
		  });
		});
	</script>
    <script src="<?php echo base_url('dist/js/player/APlayer.min.js') ?>"></script>
	<script>
		var url   = Home + "yedeng/listinfo/";
		var page = 0;
 		var href = window.location.search;
		var page = 0;
		var uid = '';
		if (href) {
			if (href.lastIndexOf('&')>0) {
					var length = href.lastIndexOf('&');
					uid = href.substring(length+5, href.length);
					uid = '/'+uid;
					page = href.substring(href.lastIndexOf('page=')+5, length);
			} else {
				page = href.substring(href.lastIndexOf('=')+1, href.length);
			}
		}
		function list () {
			var surl = url + page +  uid;
			$.getJSON(surl, function(json) {
				if ($.isEmptyObject(json)) {
					return;
				};
				if (page) {
					$('.aplayer').empty();

				}
				if (json.album.length != 0) {
					var ap5 = new APlayer({
					    element: document.getElementById('player'),
					    narrow: false,
					    autoplay: false,
					    showlrc: 3,
					    mutex: true,
					    theme: '#ad7a86',
					    mode: 'order',
					    listmaxheight: '180px',
					    music: json.album
					});
					$(".aplayer-controller").append('<i id="love" onclick="love()" class="icon-heart-empty"></i>');
					ap5.on('play', function(){
						if(document.getElementById('love')!=undefined) {
						} else {
							$(".aplayer-controller").append('<i id="love" onclick="love()" class="icon-heart-empty"></i>');
						}
					});
				} else {$("#player").append('<p><p>暂未收录</p><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset-5) ?>"><?php echo '上一页' ?></a></p></p>');}
				$.each(json.list, function(i, item) {
					if (!json.user_id) {
						$("#programlist").append(

						"<li id="+item.id+"><span class='btn btn-primary border btn-sm' style='padding: 1px 12px;font-size: 10px;min-width: 62px;'>"+'&nbsp'+item.title+"</span><span class=morel_xz><a class='btn btn-primary border btn-sm' href="+item.url+" style='padding: 1px 12px;font-size: 10px;min-width: 62px;' target=_blank>&nbsp去播放</a></span><form id="+item.id+" method = 'post'  action = http://www.izipit.top/yedeng/save_data ><input style='padding: 1px 12px;font-size: 10px;min-width: 62px;' type=txt name=url><input type=hidden name=id value="+item.id+" required><input type=hidden name=time value="+item.uptime+" required><input type=hidden name=title value="+item.title+" required><input type=hidden name=uid value="+json.user_id+" required><input style='font-size: 10px;min-width: 40px;' class='btn-primary' border type=submit></form></li>"
						  );
					}
				});
			});
		}
		list();
		function love(){
			var mid = $(".aplayer-list-light input").val();
			$.getJSON("<?php echo base_url('yedeng/love') . '/' ?>" + mid, function(json){
				//收藏图标处理
				if ($.isEmptyObject(json)) {
					return;
				};
				if (json.is_login) {
					if (json.is_love) {
						if ($(".aplayer-list-light>i").length != 0) {
							$(".aplayer-list-light i").remove();
						} else {
							$(".aplayer-list-light").append('<i style="float:left" id="heart" class="icon-heart"></i>');
						}
					}						
				}
			});
		}
	</script>
	<script type="text/javascript">
		 var livemmsURL = "http://bk2.radio.cn/mms4";
		 var oldmmsURL = "http://aodadm.cnr.cn:8081/mms3.2";
		 var ttxmmsURL = "http://bk1.radio.cn/mms4"; 
		 var cisURL = "http://www.radio.cn";
		 var terminalTypeCbb ="515104503";
		 var terminalType ="117111052";
		 var locatsite = "http://www.radio.cn";
		 var locationhttp = encodeURI(locatsite);
	</script>