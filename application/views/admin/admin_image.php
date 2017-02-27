			<div class="col-md-9">
				<table class="table table-striped table-hover">
			        <thead>
			          <tr style="color: #ff5f83">
			            <th>图片</th>
			            <th>分类</th>
			            <th>标题</th>
			            <th>用户</th>
			            <th>标签</th>
			            <th>操作</th>
			          </tr>
			        </thead>
			        <tbody>
										<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<input class="btn btn-primary border btn-sm" type="button" value="全选" onClick="pselectBox('all')" />
							<input class="btn btn-primary border btn-sm" type="button" value="反选" onClick="pselectBox('reverse')" />
							</td>

						<td>
							<input class="btn btn-primary border btn-sm" type="button" value="全选" onClick="selectBox('all')" />
							<input class="btn btn-primary border btn-sm" type="button" value="反选" onClick="selectBox('reverse')" />
							</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
						<td>
							<input class="btn btn-primary border btn-sm" type="button" value="全不" onClick="pnoselect()" />
							<input class="btn btn-primary border btn-sm" type="button" value="pass" onClick="all_pass()" />
						</td>
						<td>
							<input class="btn btn-primary border btn-sm" type="button" value="全不" onClick="noselect()" />
							<input class="btn btn-primary border btn-sm" type="button" value="reject" onClick="all_reject()" />
						</td>
					</tr>
			        <?php foreach ($image as $item): ?>
			          <tr>
			          	<?php
							$is_local = substr_count($item['pic_url'],'http://');
							if ($is_local) {
								$image_u  = $item['pic_url'];
							} else {
								$thumb    = explode(".",$item['pic_url']);
								$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
								$image_u  = base_url($thumbpic);
							}
			            ?>
			            <td>
			            	<a href="<?php echo $image_u ?>" target="_blank"><img src="<?php echo $image_u ?>" class="img-rounded" width="60">
			            </td>
			            <td><?php echo $this->catalogue_model->name_by_another($item['pic_type']) ?></td>
			            <td><?php echo $item['pic_name'] ?></td>
			            <td><?php echo $item['pic_user'] ?></td>
			            <td><?php echo $item['pic_tag'] ?></td>
			            <td>
							<input type="checkbox" name="pass" value=<?php echo $item['pic_uuid'] ?>>	
			            	<a href="javascript:void(0)" onClick="Pass('<?php echo $item['pic_uuid'] ?>')">通过</a>
			            </td>
						<td>
							<input type="checkbox" name="reject" value=<?php echo $item['pic_uuid'] ?>>
							<a href="javascript:void(0)" onClick="Reject('<?php echo $item['pic_uuid'] ?>')">不通过</a>
			            </td>
			          </tr>
			         <?php endforeach ?>
					<script>
						function pnoselect(){                          //全不选  
							var checkall=document.getElementsByName("pass"); 
							for(var $i=0;$i<checkall.length;$i++){  
								checkall[$i].checked=false;  
							}  
						} 
						function pselectBox(selectType){  
							var checkboxis = document.getElementsByName("pass");  
							if(selectType == "reverse"){  
								for (var i=0; i<checkboxis.length; i++){  
									//alert(checkboxis[i].checked);  
									checkboxis[i].checked = !checkboxis[i].checked;  
								}  
							}  
							else if(selectType == "all")  
							{  
								for (var i=0; i<checkboxis.length; i++){  
									//alert(checkboxis[i].checked);  
									checkboxis[i].checked = true;  
								}  
							}  
						 }
					 ///////////////////////////////////////////////////////
						function noselect(){                          //全不选  
							var checkall=document.getElementsByName("reject"); 
							for(var $i=0;$i<checkall.length;$i++){  
								checkall[$i].checked=false;  
							}  
						} 
						function selectBox(selectType){  
							var checkboxis = document.getElementsByName("reject");  
							if(selectType == "reverse"){  
								for (var i=0; i<checkboxis.length; i++){  
									//alert(checkboxis[i].checked);  
									checkboxis[i].checked = !checkboxis[i].checked;  
								}  
							}  
							else if(selectType == "all")  
							{  
								for (var i=0; i<checkboxis.length; i++){  
									//alert(checkboxis[i].checked);  
									checkboxis[i].checked = true;  
								}  
							}  
						 }
					</script>

					
			        </tbody>
			      </table>
			</div>
<script>
	function Pass (uuid) {
		$.get("<?php echo base_url('admin/pass') . '/'  ?>" + uuid,function(data){
			location.reload();
		});
	}

	function Reject (uuid) {
		$.get("<?php echo base_url('admin/reject') . '/'  ?>" + uuid,function(data){
			location.reload();
		});
	}
	function all_pass(){
		var checkboxis = document.getElementsByName("pass");
		//array[]=uuid_all.join(",")
		//var uuid=document.getElementsByName("ceshi").value=uuid_all;
		
		//alert(checkboxis);
		for (var i=0; i<checkboxis.length; i++){  
		 
			if(checkboxis[i].checked == true)
			{
				var uuid1=document.getElementsByName("pass")[i].value;
				 
				Pass(uuid1);
			}
			  
		} 

	}
	function all_reject(){
		var checkboxis = document.getElementsByName("reject");
		//array[]=uuid_all.join(",")
		//var uuid=document.getElementsByName("ceshi").value=uuid_all;
		

		for (var i=0; i<checkboxis.length; i++){  
		 
			if(checkboxis[i].checked == true)
			{
				var uuid2=document.getElementsByName("reject")[i].value;
				 
				Reject(uuid2);
			}
			  
		} 

	}
</script>