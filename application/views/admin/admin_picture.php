			<div class="col-md-9">
				<table class="table table-striped table-hover">
			        <thead>
			          <tr style="color: #ff5f83">
			            <th>图片</th>
			            <th>操作</th>
			            <th>作者</th>
			            <th>日期</th>
			          </tr>
			        </thead>
			        <tbody>
					<tr>

						<td></td>
						<td>
							<input class="btn btn-primary border btn-sm" type="button" value="全选" onClick="selectBox('all')" />
							<input class="btn btn-primary border btn-sm" type="button" value="反选" onClick="selectBox('reverse')" />
						</td>
<td></td><td></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input class="btn btn-primary border btn-sm" type="button" value="全不" onClick="noselect()" />
							<input class="btn btn-primary border btn-sm" type="button" value="删除" onClick="all_delete()" />
						</td>
<td></td><td></td>
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
			            	<img src="<?php echo $image_u ?>" class="img-rounded" width="60">
			            </td>
			            <td>
								<input type="checkbox" name="id" value=<?php echo $item['pic_uuid'] ?>>								
									<a href="javascript:void(0)" onClick="Delete('<?php echo $item['pic_uuid'] ?>')">
									<label class="icon-trash"></label>删除
								</a>
							
							
								|  
			            		<a href="<?php echo base_url('view') . '/' . $item['ID'] ?>"  target="_black">
								<label class=" icon-search"></label>查看
								</a>
								
			            </td>
			            <td><?php echo $item['pic_user'] ?></td>
			            <td><?php echo $item['pic_datetime'] ?></td>
			          </tr>
			         <?php endforeach ?>

					<script>
						function noselect(){                          //全不选  
							 var checkall=document.getElementsByName("id"); 
							for(var $i=0;$i<checkall.length;$i++){  
								checkall[$i].checked=false;  
							}  
						} 
						 function selectBox(selectType){  
							var checkboxis = document.getElementsByName("id");  
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
	function Delete (uuid) {
		$.get("<?php echo base_url('admin/delete') . '/'  ?>" + uuid,function(data){
			location.reload();
		});
	}
	function all_delete(){

		var checkboxis = document.getElementsByName("id");
		//array[]=uuid_all.join(",")
		//var uuid=document.getElementsByName("ceshi").value=uuid_all;
		

		for (var i=0; i<checkboxis.length; i++){  
		 
			if(checkboxis[i].checked == true)
			{
				var uuid1=document.getElementsByName("id")[i].value;
				 
				Delete(uuid1);
			}
			  
		} 

	}
</script>