<div class="container top">
	<div class="row">
		<div class="col-md-3">
    		<ul class="nav nav-pills nav-stacked pinned">
        		<li class="active">
				  	<a href="<?php echo base_url('admin/index') ?>"><label class=" icon-home icon-large"></label>管理中心</a>
				</li>

				<li>
				  	<a class="<?php if(strpos(current_url(),'image')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/image') ?>"><label class=" icon-picture"></label>图片审核</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'picture')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/picture') ?>"><label class=" icon-picture"></label>图片管理</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'usercen')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/usercen') ?>"><label class=" icon-user"></label>会员管理</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'types')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/types') ?>"><label class=" icon-leaf"></label>分类管理</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'tags')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/tags') ?>"><label class=" icon-tags"></label>标签管理</a>
				</li>
			</ul>
		</div>