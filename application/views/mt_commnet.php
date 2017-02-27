<div class="container top">
	<ul class="nav nav-pills" role="tablist">
	  	<li role="presentation" class="active"><a href="<?php echo base_url('comment') ?>"><label class=" icon-glass"><label class="font-size:18px">@me</label>&nbsp&nbsp&nbsp</label>评论</a></li>
	</ul>
	<table class="table table-bordered">
		<thead>
	        <tr>
	        	<th style="color: #ff5f83"><label class="  icon-minus-sign">&nbsp</label>操作</th>
	          	<th style="color: #ff5f83"><label class=" icon-bullhorn">&nbsp</label>内容</th>
	          	<th style="color: #ff5f83"><label class="icon-calendar">&nbsp</label>日期</th>
				<th></th>
	        </tr>
			<tr>
			<th>
				<input class="btn btn-primary border btn-sm" type="button" value="全选" onClick="dselectBox('all')" />
				<input class="btn btn-primary border btn-sm" type="button" value="反选" onClick="dselectBox('reverse')" />
			</th>
			<th>
			</th>
			<th>
				<input class="btn btn-primary border btn-sm" type="button" value="全选" onClick="selectBox('all')" />
				<input class="btn btn-primary border btn-sm" type="button" value="反选" onClick="selectBox('reverse')" />
			</th>

			<th>
			</th>
	        </tr>
	        <tr>
			<th>
				<input class="btn btn-primary border btn-sm" type="button" value="全不" onClick="dnoselect()" />
				<input class="btn btn-primary border btn-sm" type="button" value="delete" onClick="all_dele()" />
			</th>
			<th>
			</th>
			<th>
				<input class="btn btn-primary border btn-sm" type="button" value="全不" onClick="noselect()" />
				<input class="btn btn-primary border btn-sm" type="button" value="mark" onClick="all_mark()" />
			</th>

			<th>
			</th>
			</tr>
      	</thead>
<script>
	function dnoselect(){                          //全不选  
		var checkall=document.getElementsByName("dele"); 
		for(var $i=0;$i<checkall.length;$i++){  
			checkall[$i].checked=false;  
		}  
	} 
	function dselectBox(selectType){  
		var checkboxis = document.getElementsByName("dele");  
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
		var checkall=document.getElementsByName("mark"); 
		for(var $i=0;$i<checkall.length;$i++){  
			checkall[$i].checked=false;  
		}  
	} 
	function selectBox(selectType){  
		var checkboxis = document.getElementsByName("mark");  
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
      	<tbody>

      	<?php foreach ($letter as $value) { ?>
       		<tr>
       			<td>
					<input type="checkbox" name="dele" value=<?php echo $value['ID'] ?>>
					<a style="cursor: pointer;" onClick="DelLetter('<?php echo $value['ID'] ?>')">
						<?php ?>
						<?php if($value['letter_status'] == 0) { echo "未读"; } else { echo "已读"; } ?>
						<label class="icon-trash">&nbsp</label>删除
					</a></input>
				</td>
	          	<td>
					<a href="#">
					<?php echo $value['letter_text'] ?>
					</a>
				</td>
				<td>
					<input type="checkbox" name="mark" value=<?php echo $value['ID'] ?>>					
					<a onclick="watchmsg('<?php echo $value['ID'] ?>')" href="#">
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label class="icon-folder-open">标为已读</label>
					</a></input>
				</td>
	          	<td>
					<label class="icon-calendar">&nbsp</label>
					<?php echo $value['letter_datetime'] ?>
				</td>
	        </tr>
	    <?php } ?>



      </tbody>
	</table>
</div>
<script>
	function DelLetter (id) {
		$.get("<?php echo base_url('letter/delete') . '/'  ?>" + id,function(data){
			location.reload();
		});
	}
	function watchmsg (id) {
		$.get("<?php echo base_url('letter/watchmsg') . '/'  ?>" + id,function(data){
			location.reload();
		});
	}
	function all_dele(){
	var checkboxis = document.getElementsByName("dele");
	//array[]=uuid_all.join(",")
	//var uuid=document.getElementsByName("ceshi").value=uuid_all;
	
	//alert(checkboxis);
	for (var i=0; i<checkboxis.length; i++){  
			if(checkboxis[i].checked == true)
			{
				var id1=document.getElementsByName("dele")[i].value;
				DelLetter(id1);
			}
		} 
	}
	function all_mark(){
		var checkboxis = document.getElementsByName("mark");
		//array[]=uuid_all.join(",")
		//var uuid=document.getElementsByName("ceshi").value=uuid_all;
		

		for (var i=0; i<checkboxis.length; i++){  
		 
			if(checkboxis[i].checked == true)
			{
				var id2=document.getElementsByName("mark")[i].value;
				 
				watchmsg(id2);
			}
			  
		} 

	}
</script>
