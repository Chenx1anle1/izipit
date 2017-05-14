<div class="jumbotron">
<div class="container">
	<table class="table table-striped table-hover" style="border-spacing: 0px;">
		<thead style="border-spacing: 0px;border-style: none">
			<tr>
	        	<th style="color: #ff5f83;border-style: none">前50名活跃用户TopUSer</th>
	        </tr>
		</thead>
		<thead style="border-spacing: 0px;border-style: none">
			<tr>
	        	<th style="color: #ff5f83">Top.1</th>
	        	<th style="color: #ff5f83">Top.2</th>
	        	<th style="color: #ff5f83">Top.3</th>
	        	<th style="color: #ff5f83">Top.4</th>
	        	<th style="color: #ff5f83">Top.5</th>

	        </tr>
		</thead>
		<tbody style="border-spacing: 0px;border-style: none">
		<div class="row" style="margin-top: 0px;border-style: none">
		<div class="col-xs-2" style="margin-top: 0px;border-style: none">
		   			
           <?php foreach ($image as $key=>$item){ ?> 	
			<?php
			  $picture = 'upload/user/' . $this->user_model->picture($item['user_login']) . '_3.jpg';
			  if (file_exists($picture)) {
				$userpic = base_url('upload/user/' . $this->user_model->picture($item['user_login']) . '_3.jpg');
			  } else {
				$userpic = base_url('upload/user/default_3.jpg');
			  }
			?>
			<?php if($key % 5 == 0){?>
			<tr style="border-style: none">
			<?php } ?>
			<td style="border-style: none">
				<a href="<?php echo base_url('user/picture') . '/' . $item['user_login'] ?>" style="float:left;padding: 0px 0px;">
					<img src="<?php echo $userpic ?>" class="img-circle" style="height: 35px">
				    <?php if($item['user_login'] != $this->session->userdata('Username')) { ?>
					
					<label>
						<?php echo '&nbsp&nbsp&nbsp&nbsp'.$item['user_login'] ?>&nbsp&nbsp&nbsp
					</label>
				    <?php }else{ ?>
				    <label>&nbsp&nbsp&nbspit's me!&nbsp第&nbsp<?php echo $key+1 ?>&nbsp名</label>
				    <?php } ?>
				</a>
			</td>
				
			<?php } ?>	

		</div>
		</div>
		</tbody>	
		</table>
</div>
</div>
