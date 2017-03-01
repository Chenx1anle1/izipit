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
			//
			$total_page = $total_page<8?8:$total_page;
		?>
        <?php for ($i=0; $i<=$total_page; $i++) { ?>
        	<?php if (2<$i && $i!=$offset/5 && $i<$total_page) { ?>
        		<li style="list-style:none;float:left;">·</li>
			<?php } else { ?>
	        	<li style="list-style:none;float:left;">
	        	<a<?php if ($i*5 == $offset) :?> class="now btn btn-primary"<?php endif; ?> style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.(5*$i) ?>"><?php echo '第'.($i+1).'页' ?></a>
				</li>
			<?php } ?>
        <?php } ?>
        <?php if (($offset-5)>-5) { ?>
			<li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset-5) ?>"><?php echo '上一页' ?></a></li>
		<?php } ?>
        <?php if (($offset)<$total_page*5) { ?>
			<li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset+5) ?>"><?php echo '下一页' ?></a></li>
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
		var page = href.substring(href.lastIndexOf('=')+1, href.length);
		function list () {
			var surl = url + page;
			$.getJSON(surl, function(json) {
				if ($.isEmptyObject(json)) {
					return;
				};
				$('#loader').show();
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
				} else {$("#player").append('<p><p>暂未收录</p><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset-5) ?>"><?php echo '上一页' ?></a></p></p>');}
				$.each(json.list, function(i, item) {
					$("#programlist").append(

					"<li id="+item.id+"><span class='btn btn-primary border btn-sm' style='padding: 1px 12px;font-size: 10px;min-width: 62px;'>"+'&nbsp'+item.title+"</span><span class=morel_xz><a class='btn btn-primary border btn-sm' href="+item.url+" style='padding: 1px 12px;font-size: 10px;min-width: 62px;' target=_blank>&nbsp去播放</a></span><form id="+item.id+" method = 'post'  action = http://www.izipit.top/yedeng/save_data ><input style='padding: 1px 12px;font-size: 10px;min-width: 62px;' type=txt name=url><input type=hidden name=id value="+item.id+" required><input type=hidden name=time value="+item.uptime+" required><input type=hidden name=title value="+item.title+" required><input style='font-size: 10px;min-width: 40px;' class='btn-primary' border type=submit></form></li>"
					  );
				});
			});
			$('#loader').hide();
		}
		list();
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
<script>

function morelist(programName='财经夜读'){

	var moreescape = encodeURI(programName);
	var moreescape = '财经夜读';
	var channelproid = "";
	channelproid="15";

	var url=livemmsURL+"/videoPlay/getMorePrograms.jspa?programName="+moreescape+"&start=0&limit=20&channelId="+channelproid+"&callback=?";

	$.ajax({
			type:'post',
			dataType:'json',
			url:url,
			data:null,
			error: function(){$('#wait').css('display','');},
			success:function(result){
			$("#programlist").html("");
			   var total = result.total;
			   if (typeof(total) == "undefined") { 
                var total = 0;
                  } 
			   //document.getElementById('moretotal').value=total;
			   var num_entries = total;
	           var showCount = 20;
				$.each(result.programs, function(i, item) {
				$("#programlist").append(

				"<li id="+item.programId+"><span class=morel_xz><a onclick=downloadvodmore("+item.programId+")>下载</a></span><span class=morel_date>"+item.creationTime+"</span>"+
				"<a onclick=playvodmore("+item.programId+") href=javascript:void(0) class=gbl_bt>"+item.programName+"</a></li>"
				  );
				 });
	
	///// 创建分页
	   var initPagination = function() {

		$("#Pagination").pagination(num_entries, {
			num_edge_entries: 0, 
			num_display_entries: 20, 
			callback: pageselectCallback,
			items_per_page:showCount 
		  }
			
			
			
			);
	    };
	 	function pageselectCallback(page_index){
		var max_elem = Math.min((page_index+1) *showCount, num_entries);	

		var num_start =page_index*showCount;
		var num_end =showCount;
         
		   var url=livemmsURL+"/videoPlay/getMorePrograms.jspa?programName="+moreescape+"&start="+num_start+"&limit="+num_end+"&channelId="+channelproid+"&callback=?";
		  
           $.ajax({
			type:'post',
			dataType:'json',
			url:url,
			data:null,
			error: function(){$('#wait').css('display','');},
			success:function(result){
			
			$("#programlist").html("");
			
				$.each(result.programs, function(i, item) {
				$("#programlist").append(

				"<li id="+item.programId+"><span class=morel_xz><a onclick=downloadvodmore("+item.programId+")>下载</a></span><span class=morel_date>"+item.creationTime+"</span>"+
				"<a onclick=playvodmore("+item.programId+") href=javascript:void(0) class=gbl_bt>"+item.programName+"</a></li>"
				  );
				 });
		
				  }
			   });

		 }

		}
			
	 });
}
//morelist();
function downloadvodmore(programId){
  var countjson=livemmsURL+"/reportDataCollectMgr/downloadData.jspa? programId="+programId+"&videoType=PC";//下载统计

 $.getJSON(countjson,function(result){});
      var url=livemmsURL+"/videoPlay/getVodProgramPlayUrlJson.jspa?programId="+programId+"&programVideoId=0&videoType=PC&terminalType="+terminalTypeCbb+"&dflag=1";//new
      //window.open (url);
      console.log(result);

}
</script>