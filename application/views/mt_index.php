	
	<div id="picture"></div>
	<div id="loader"><i class="icon-spinner icon-spin icon-5x" style="color: #ff5f83"></i></div>
</div>
<script>
var GetImageURL = "<?php echo $pictureURL ?>";
</script>
<script src="<?php echo base_url('dist/js/xixi.js') ?>"></script>
<script src="<?php echo base_url('dist/js/top.js') ?>"></script>

<script>
	function Like (uuid,imageUrl) {
		$.get("<?php echo base_url('xixi/like') . '/' ?>" + uuid,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
				if (obj.is_login) {
				if (obj.is_like) {
					$('#likeButton'+ uuid).removeClass("btn-default");
					$('#likeButton'+ uuid).addClass("btn-info");
					//setCookie("name",imageUrl);//cookie
					//alert(getCookie("name"));
				} else {
					$('#likeButton'+ uuid).removeClass("btn-info");
					$('#likeButton'+ uuid).addClass("btn-default");
				}
			}else{
				window.location.href = "login";
			}
			});
		});
	}
	function Love (uuid) {
		$.get("<?php echo base_url('xixi/love') . '/' ?>" + uuid,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
				if (obj.is_login) {
					if (obj.is_love) {
						$('#collectButton'+ uuid).removeClass("btn-default");
						$('#collectButton'+ uuid).addClass("btn-info");
						setCookie("name",uuid);
						//alert(getCookie("name"));
					} else {
						$('#collectButton'+ uuid).removeClass("btn-info");
						$('#collectButton'+ uuid).addClass("btn-default");
					}
				} else {
					window.location.href = "login";
				}
			});
		});
	}
//Cookie
	function setCookie(name,value)
	{
		var Days = 30;
		var exp = new Date();
		exp.setTime(exp.getTime()+Days*24*60*60*1000);
		document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
	}
	function getCookie(name)
	{
		var arr,reg = new RegExp("(^|)" + name + "=([^;]*)(;|$)");
		if(arr = document.cookie.match(reg))
			{return unescape(arr[2]);}
		else
			{return null;}
	}
	function delCookie()
	{
		var exp = new Date();
		exp.setTime(exp.getTime() - 1);
		var cval = getCookie(name);
		if(cval != null)
			document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();		
	}

</script>
