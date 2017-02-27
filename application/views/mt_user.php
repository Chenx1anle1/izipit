	<div class="container top" style="margin-bottom: 100px;">
        <div class="row">
    		<div class="user-details">
                <div class="user-image">
                	<div class="row">
                    	<div class="col-xs-2"><img src="<?php echo $picture ?>" class="img-thumbnail"></div>
                    	<div class="col-xs-6" style="margin-top: 50px;color: #ff5f83">
                    		<h3><label class="icon-user icon-large">&nbsp&nbsp&nbsp</label><?php echo $username ?></h3>
                    		
                            <?php if($setting != "") { ?>
                            <a type="button" href="<?php echo base_url('setting') ?>" style="background: #ff5f83;padding:10px;color:#ffffff;margin-top:5px" class=" icon-edit icon-large"><label>&nbsp&nbsp&nbsp</label>编辑头像</a>
                            <?php } ?>
                    	</div>
                            <?php if($username != $this->session->userdata('Username')) { ?>

                    	<div class="col-xs-4" style="margin-top: 100px;">
                    		<a type="button" class="btn btn-success btn-circle-lg" onClick="Follow('<?php echo $username ?>')"><p id="follow" style="color:#ffffff"><?php if($follow) { echo "取消关注"; } else { echo "关注"; } ?></p></a>
                    		
                    	</div>
                            <?php } ?>

                    </div>
                </div>
                <div class="user-info-block">
                    <ul class="navigation">
<!--	                    <li class="<?php if($active == 'album') { ?> active <?php } ?>">
                            <a href="<?php echo base_url('user/album2/') ?>">专辑（未完成）</a>
                        </li >
-->		
                        <li class="<?php if($active == 'picture') { ?> active <?php } ?>">
    						<a href="<?php echo base_url('user/picture/' . $username) ?>">图片</a>
                        </li>
                        <li class="<?php if($active == 'collect') { ?> active <?php } ?>">
    						<a href="<?php echo base_url('user/collect/' . $username) ?>">收藏</a>
                        </li>
                        <li class="<?php if($active == 'atten') { ?> active <?php } ?>">
                            <a href="<?php echo base_url('user/atten/' . $username) ?>">关注的用户</a>
                        </li>
                        <li class="<?php if($active == 'follow') { ?> active <?php } ?>">
                            <a href="<?php echo base_url('user/follow/' . $username) ?>">粉丝</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>				

    </div>
<script>
	function Follow (username) {
		$.get("<?php echo base_url('user/addfollow') . '/' ?>" + username,function(data){
			$.each($.parseJSON(data), function(idx, obj) {

					var num = $('#follownum').html();
					if (obj.is_follow) {
						$('#follow').html("取消关注");
						num++;					
					} else {
						$('#follow').html("关注");
						num--;
					};
					$('#follownum').html(num);
				
			});
		});
	}




</script>
