	<div class="col-xs-1 col-sm-8" style="margin: 100px auto;">
		<p id="swfContainer">
            本组件需要安装Flash Player后才可使用，请下载安装。
		</p>
	</div>
	<div class="col-xs-12 col-sm-4" style="margin: 100px auto;">
		<span>随机一个</span>
		<div class="funnyNewsTicker fnt-radius fnt-shadow fnt-easing" id="funnyNewsTicker3">
			<ul>
				<li id="pic_1">
				<div class="col-xs-6">
					<?php $hots = $this->pic_model->random();
					foreach ($hots as $hot) {
						$str = " ";
						$thumb    = explode(".",$hot['pic_url']);
						$thumbtags    = explode(" ",$hot['pic_tag']);
						if(substr_count($hot['pic_tag'],$str))
						{
						for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++)
						{$thumbtags1[$i] = $thumbtags[$i];}
						}
						$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
						$imageurl  = base_url($thumbpic);
					?>
					
					<a target="_black" title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
					<?php }?>
					<div tabindex="1" id="dinwei" style="color: #ff5f83;border:1px solid #EEEEEE"> </div>
					</div>
				</li>
				<li id="pic_2">
				<div class="col-xs-6">
					<?php $hots = $this->pic_model->random();
					foreach ($hots as $hot) {
						$str = " ";
						$thumb    = explode(".",$hot['pic_url']);
						$thumbtags    = explode(" ",$hot['pic_tag']);
						
						if(substr_count($hot['pic_tag'],$str))
						{
						for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++)
						{$thumbtags1[$i] = $thumbtags[$i];}
						}
						$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
						$imageurl  = base_url($thumbpic);
					?>
					
					<a target="_black" title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
					<?php } ?>
				</div>
				</li>
				<li id="pic_3">
				<div class="col-xs-6">
					<?php $hots = $this->pic_model->random();
					foreach ($hots as $hot) {
						$str = " ";
						$thumb    = explode(".",$hot['pic_url']);
						$thumbtags    = explode(" ",$hot['pic_tag']);
						
						if(substr_count($hot['pic_tag'],$str))
						{
						for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++)
						{$thumbtags1[$i] = $thumbtags[$i];}
						}
						$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
						$imageurl  = base_url($thumbpic);
					?>
					
					<a target="_black" title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
					<?php } ?>
				</div>
				</li>
				<li id="pic_4">
				<div class="col-xs-6">
					<?php $hots = $this->pic_model->random();
					foreach ($hots as $hot) {
						$str = " ";
						$thumb    = explode(".",$hot['pic_url']);
						$thumbtags    = explode(" ",$hot['pic_tag']);
						
						if(substr_count($hot['pic_tag'],$str))
						{
						for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++)
						{$thumbtags1[$i] = $thumbtags[$i];}
						}
						$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
						$imageurl  = base_url($thumbpic);
					?>
					
					<a target="_black" title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
					<?php } ?>
				</div>
				</li>
				<li id="pic_5">
				<div class="col-xs-6">
					<?php $hots = $this->pic_model->random();
					foreach ($hots as $hot) {
						$str = " ";
						$thumb    = explode(".",$hot['pic_url']);
						$thumbtags    = explode(" ",$hot['pic_tag']);
						
						if(substr_count($hot['pic_tag'],$str))
						{
						for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++)
						{$thumbtags1[$i] = $thumbtags[$i];}
						}
						$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
						$imageurl  = base_url($thumbpic);
					?>
					
					<a target="_black" title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
					<?php } ?>
				</div>
				</li>

			</ul>
		</div>
	</div>
    <script type="text/javascript" src="dist/js/swfobject.js" chaset="UTF-8"></script>
    <script type="text/javascript" src="dist/js/fullAvatarEditor.js"></script>
	<script type="text/javascript">
	// console.log(swfobject);
			// if ($random_pic){}
            swfobject.addDomLoadEvent(function (src) {
            // function edit(src) {
                var swf = new fullAvatarEditor("swfContainer", {
				    id                 : 'swf',
				    // src_url            : src,
				    src_url            : "<?php echo $image ?>",
					upload_url         : "<?php echo base_url('setting/upload') ?>",
					src_upload         : 1,
					tab_visible        : false,
					button_upload_text : '保存',
					button_cancel_text : 'new one',
					avatar_sizes       : "150*150|70*70|32*32",
					avatar_sizes_desc  : "150*150像素|70*70像素|32*32像素"
				}, function (json) {
				 	if (json.code == 5)
				    {
				        switch(json.type)
				        {
				            case 0:
				                window.location.href = "<?php echo base_url('user/collect/' . $user) ?>";
				            break;
				            case 1:
				                alert('头像上传失败，原因：' + json.content.msg);
				            break;
				            case 2:
				                alert('头像上传失败，原因：指定的上传地址不存在或有问题！');
				            break;
				            case 3:
				                alert('头像上传失败，原因：发生了安全性错误！');
				            break;
				        }
				    }
				}
			);
        });
    </script>
</div>
<script src="<?php echo base_url('dist/js/jQuery.js') ?>"></script>
<script>
$(document).ready(function(){	
	$("#funnyNewsTicker3").funnyNewsTicker({
	width:"50%",itemheight:50,infobarvisible:false,pagenavi:false,timer:1500,itembgcolor:"#EEEEEE",bordercolor:"#EEEEEE"});	
});	
</script>