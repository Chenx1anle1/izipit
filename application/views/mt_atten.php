<div class="container" style="border-style: none">
	<table class="table table-striped table-hover" style="border-spacing: 0px;border-style: none">
		<thead style="border-spacing: 0px;border-style: none">
			<tr>
	        	<th style="color: #ff5f83;border-style: none">关注用户AttenU</th>
	        </tr>
		</thead>
		<thead style="border-spacing: 0px;">
			<tr>
	        </tr>
		</thead>
		<tbody style="border-spacing: 0px;">
		<div class="row" style="margin-top: 0px;">
		<div class="col-xs-2" style="margin-top: 0px;">
		   			
           <?php foreach ($myfollow as $key=>$item){ ?> 	
			<?php
			  $picture = 'upload/user/' . $this->user_model->picture($item['follow_to']) . '_3.jpg';
			  if (file_exists($picture)) {
				$userpic = base_url('upload/user/' . $this->user_model->picture($item['follow_to']) . '_3.jpg');
			  } else {
				$userpic = base_url('upload/user/default_3.jpg');
			  }
			?>
			<?php if($key % 5 == 0){?>
			<tr>
			<?php } ?>
			<td>
			
				<a title="<?php echo $item['follow_to'] ?>" href="<?php echo base_url('user/index') . '/' . $item['follow_to'] ?>" style="float:left;padding: 0px 0px;">
					<img src="<?php echo $userpic ?>" class="img-circle" style="height: 55px">
					<?php if($item['follow_to'] != $this->session->userdata('Username')) { ?>
					<label>
						<?php echo '&nbsp&nbsp&nbsp&nbsp'.$item['follow_to'] ?>&nbsp&nbsp&nbsp
					</label>
				</a>
			      <?php }else{ ?><label><center>&nbsp&nbsp&nbspit's me</center></label><?php } ?>
		        <?php
		        	$user = $item['follow_to'];
		        	if ($this->session->userdata('online')) {
						$form_name = $this->session->userdata('Username');
						if($this->follow_model->is_follow($user,$form_name)){
							$follow = 1;
						} else {
							$follow = 0;
						}
					} else {
						$follow = 0;
					}
		        ?>
				<?php if($item['follow_to'] != $this->session->userdata('Username')) { ?>
		        <p style="width:100px">
		        	<a style="width: 100%;" onClick="Followss('<?php echo $user ?>')" class="btn btn-primary border" role="button">
		        		<span id="<?php echo $user ?>"><?php if($follow) { echo "取消关注"; } else { echo "关注"; } ?></span>
		        	</a>

		        </p>								
				<?php } ?>
			</td>
				
			<?php } ?>	

		</div>
		</div>
		</tbody>	
		</table>
</div>
<script>
	function Followss (username) {
		$.get("<?php echo base_url('user/addfollow') . '/' ?>" + username,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
				if (obj.is_follow) {
					$('#' + username).html("取消关注");				
				} else {
					$('#' + username).html("关注");
				};
			});
		});
	}
	
</script>