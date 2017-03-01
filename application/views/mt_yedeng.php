    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        .container {
            max-width: 55rem;
            margin-left: 10rem;
            margin-right: auto;
            margin-bottom: 50px;
            margin-top: 50px;
        }
        h1 {
            font-size: 54px;
            color: #333;
            margin: 30px 0 10px;
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
		.key{ float:right;right:0px;}
		.key_on{display:none;}
        p {
            font-size: 18px;
        }
    </style>
    <div class="container">
        <h1>player</h1>
        <hr>
        <div id="player5" class="aplayer"></div>
    </div>
	<div class="moreli_com">       		
		<ul id="programlist">
		</ul>  
		
        <!--分页start-->
        <div id="Pagination" class="pagination">
        </div>
		<h4 class="morel_bt">在原网页播放，同时也可以上传播放链接到列表内播放</h2> 
        <!--分页end-->
	</div>
    <script src="<?php echo base_url('dist/js/player/APlayer.min.js') ?>"></script>
	<script>

		var url   = Home + "yedeng/listinfo/";
		function list (page=0) {
			var surl = url;
			$.getJSON(surl, function(json) {
				if ($.isEmptyObject(json)) {
					return;
				};
				$('#loader').show();
				if (page) {
					$('.aplayer').empty();

				}
				var ap5 = new APlayer({
				    element: document.getElementById('player5'),
				    narrow: false,
				    autoplay: false,
				    showlrc: 3,
				    mutex: true,
				    theme: '#ad7a86',
				    mode: 'random',
				    listmaxheight: '180px',
				    music: json.album
				});
				$.each(json.list, function(i, item) {
					$("#programlist").append(

					"<li id="+item.id+"><span class=morel_date>"+item.title+"</span><span class=morel_xz><a href="+item.url+" target=_blank>去播放</a></span><form id="+item.id+" method = 'post'  action = http://www.izipit.top/yedeng/save_data ><input type=txt name=url><input type=hidden name=id value="+item.id+" required><input type=hidden name=time value="+item.uptime+" required><input type=hidden name=title value="+item.title+" required><input type=submit></form></li>"
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