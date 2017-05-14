               
<!-- 这里是折叠打开css--> 

<!-- 这里是折叠打开js -->
	<div id="body" class="container top">
		<div class="row layout">
			
			<div class="col-xs-1 col-sm-8">
				<div class="maincontent">
					<h4 class="text-center"><strong style="color: #ff5f83;"><?php echo $name ?></strong></h4>
					<div class="text-center">
						<a id="mepic" title="<?php echo $name.'-'.$user.'-'.$tags.'-'.$catname?>" style="cursor: pointer;" ondblclick="Like('<?php echo $uuid ?>')">
							<img id="mepic" style="max-width: 100%;" data-tag="xixi_picture" src="<?php echo $url ?>">
						</a>
					</div>
					<h5 class="text-left">
					<?php foreach ($make as $key => $value){?>
						<?php if(1 <= strpos($value['pic_tag'],' ') && $value['pic_tag'] != "") {?>
							<?php
							$tag  = explode (" ", $tags);
							if(count($tag) > 0) {
								$st_tag = $tag[0];
							}
							if(count($tag) > 1) {
								$nd_tag = $tag[1];
							}
							if(count($tag) > 2) {
								$rd_tag = $tag[2];
							}
							if(count($tag) > 3) {
								$th_tag = $tag[3];
							}
							if(count($tag) > 4) {
								$fth_tag = $tag[4];
							}
							$arrytags    = explode(" ",$value['pic_tag']);
							$i = count($tag);			//图片标签	1到多个
							$j = count($arrytags);		//复数标签	2到多个

							?>
							<?php foreach ($arrytags as $key => $value2){?>
	

		<?php if($i == 2) {?>
			<?php if($j == 2) {?>
			<?php if($arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag) {?><!-- 复数  -->
			<?php if($value2 != $st_tag && $value2 != $nd_tag && $value['ID'] != $id) {?><!-- 单数  -->
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
			<?php } ?>	
			<?php if($j == 3) {?>
			<?php if($arrytags[2] == $st_tag || $arrytags[2] == $nd_tag || $arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag) {?>
			<?php if($value2 != $st_tag && $value2 != $nd_tag && $value['ID'] != $id) {?>
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
			<?php } ?>	
			<?php if($j == 4) {?>
			<?php if($arrytags[3] == $st_tag || $arrytags[3] == $nd_tag || $arrytags[2] == $st_tag || $arrytags[2] == $nd_tag || $arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag) {?><!-- 复数  -->
			<?php if($value2 != $st_tag && $value2 != $nd_tag && $value['ID'] != $id) {?><!-- 单数  -->
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
			<?php } ?>	
			<?php if($j == 5) {?>
			<?php if($arrytags[4] == $st_tag || $arrytags[4] == $nd_tag ||$arrytags[3] == $st_tag || $arrytags[3] == $nd_tag || $arrytags[2] == $st_tag || $arrytags[2] == $nd_tag || $arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag) {?><!-- 复数  -->
			<?php if($value2 != $st_tag && $value2 != $nd_tag && $value['ID'] != $id) {?><!-- 单数  -->
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
			<?php } ?>	
		<?php } ?>	
		<?php if($i == 3) {?>
			<?php if($j == 2) {?>
			<?php if($arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[1] == $rd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag || $arrytags[0] == $rd_tag) {?>
			<?php if($value2 != $rd_tag && $value2 != $nd_tag && $value2 != $st_tag && $value['ID'] != $id) {?>
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
			<?php } ?>	
			<?php if($j == 3) {?>
			<?php if($arrytags[2] == $st_tag || $arrytags[2] == $nd_tag || $arrytags[2] == $rd_tag || $arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[1] == $rd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag || $arrytags[0] == $rd_tag) {?>
			<?php if($value2 != $rd_tag && $value2 != $nd_tag && $value2 != $st_tag && $value['ID'] != $id) {?>
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
			<?php } ?>	
			<?php if($j == 4) {?>
			<?php if($arrytags[3] == $st_tag || $arrytags[3] == $nd_tag || $arrytags[3] == $rd_tag || $arrytags[2] == $st_tag || $arrytags[2] == $nd_tag || $arrytags[2] == $rd_tag || $arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[1] == $rd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag || $arrytags[0] == $rd_tag) {?>
			<?php if($value2 != $rd_tag && $value2 != $nd_tag && $value2 != $st_tag && $value['ID'] != $id) {?>
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
			<?php } ?>	
			<?php if($j == 5) {?>
			<?php if($arrytags[4] == $st_tag || $arrytags[4] == $nd_tag || $arrytags[4] == $rd_tag || $arrytags[3] == $st_tag || $arrytags[3] == $nd_tag || $arrytags[3] == $rd_tag || $arrytags[2] == $st_tag || $arrytags[2] == $nd_tag || $arrytags[2] == $rd_tag || $arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[1] == $rd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag || $arrytags[0] == $rd_tag) {?>
			<?php if($value2 != $rd_tag && $value2 != $nd_tag && $value2 != $st_tag && $value['ID'] != $id) {?>
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
			<?php } ?>	
		<?php } ?>	
		<?php if($i > 3 && 1 <= strpos($value['pic_tag'],' ')) {?>
			<?php if($arrytags[1] == $st_tag || $arrytags[1] == $nd_tag || $arrytags[0] == $st_tag || $arrytags[0] == $nd_tag) {?>
			<?php if($value2 != $st_tag && $value2 != $nd_tag && $value['ID'] != $id) {?><!-- 单数  -->
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
			<?php } ?>	
			<?php } ?>	
		<?php }else {?>	
			<?php if($arrytags[1] == $tags || $arrytags[0] == $tags) {?>
			<?php if($value2 != $tags && $value['ID'] != $id) {?>
				<a title="推荐相似标签"href="<?php echo base_url('tag/'.$value2) ?>">
					<label class="label label-info">
						<?php echo '&'.$value2 ?>
					</label>
				</a>
		<?php } ?>	
		<?php } ?>
		<?php } ?>
				<?php } ?>
		<!--
				<b><?php echo '^'.$value['pic_tag'] ?></b>
		-->
				<?php } ?>
				<?php } ?>
		
					</h5>
					<label style="color: #ff5f83;" class="icon-list-alt">标签：</label>
					<h5 class="text-left">
						<?php
							$tag  = explode (" ", $tags);
							if(count($tag) > 0) {
								$fir_tag = $tag[0];
							}
							if(count($tag) > 1) {
								$sec_tag = $tag[1];
							} else {
								$sec_tag = $fir_tag;
							}

							foreach ($tag as $value) {
						?>
						<a style="padding: 4px 2px" href="<?php echo base_url('tag/'.$value) ?>" class="border btn-sm">
							<span style="font-size: 90%" class="label label-info"><?php echo $value ?></span>
						</a>
					<?php } ?>
					</h5>
					<h5 class="text-right">
						<a title="分类" href="<?php echo base_url('catalogue/'.$catanothername) ?>"><?php echo $catname ?></a>
					</h5>
					<h5 class="text-right">
						<a title="用户" href="<?php echo base_url('user/index/'.$user) ?>"><?php echo $user ?></a>
					</h5>
					<h5 title="上传日期" class="text-right" style="color: gray;"><?php echo $date ?></h5>
				</div>
				<div class="maincontent">
<!--用户判断star --><?php if( $this->session->userdata('online')) { ?>	
					<textarea type='text' class="form-control border" rows="5" id="text" onfocus="focustextarea()" onblur="onblurtextarea()">你想说的话</textarea>
					<input style="display:none;" id="isrep" value="0"></input>
					<input style="display:none;" id="toname" value="0"></input>
					<label id="a1" style="display:none">@</label><label id="toname2"></label>
					<input style="display:none;" id="msg_id" value="0"></input>
					 <script type="text/javascript">
						//area项获得焦点的时候：
						function focustextarea(){
							var obj = document.getElementById("text");
								obj.innerHTML = "";

						}
						//area项失去焦点的时候：
						function onblurtextarea(){
							var obj = document.getElementById("text");
								//alert(obj.value);
								if(obj.value=="")
								{obj.innerHTML="请留言!	";}


						}

					</script>
					<div class="alert alert-danger border hide" id="alert" style="margin-top:10px;" role="alert">警告</div>
					<div class="alert alert-success border hide" id="success" style="margin-top:10px;" role="alert">成功</div>
					<div class="text-right" style="margin-top:10px;">
						<button id="xuanxiang2" class="btn btn-primary border" onClick="javascript:SendMessage('<?php echo $uuid ?>')">发布</button>
						<button id="xuanxiang1" style="display:none" class="btn btn-primary border" onClick="javascript:SendMessage2('<?php echo $uuid ?>')">回复</button>
					</div>
<!--用户判断end --><?php } ?>


				</div>

				<div class="maincontent" id="message">
					<?php if (!$this->message_model->pic_count($uuid)) { ?>
						<p class="text-left" id="nullmessage" style="color: #ff5f83;">暂无评论</p>
					<?php } ?>
					<?php
						$query = $this->message_model->pic_message($uuid);
						foreach ($query as $value) {
					?>
					<?php if($value['msg_status']==0){?>
						<div>
							<p class="text-left">
								<?php
									$pic = 'upload/user/' . $this->user_model->picture($value['msg_user']) . '_3.jpg';
									$repcount = $this->message_model->rep_count($value['ID']);
									if (file_exists($pic)) {
										$pic_u = base_url('upload/user/' . $this->user_model->picture($value['msg_user']) . '_3.jpg');
									} else {
										$pic_u = base_url('upload/user/default_3.jpg');
									}
								?>
								<img class="img-circle" src="<?php echo $pic_u ?>">
								<strong><?php echo $value['msg_user'] ?></strong>
							</p>
							<blockquote style="margin-bottom:10px">
								<p class="text-left"><?php echo urldecode($value['msg_text']) ?></p>
							</blockquote>
							<div style="margin-left:50px"></div>
							<p class="text-right" style="margin-bottom:0px;margin-right:10px;">
								<?php if($repcount<10){?>
								<a style="cursor: pointer;" onClick="javascritp:reply('<?php echo $value['msg_user'] ?>','<?php echo $value['ID']?>')">回复&nbsp;</a>
								<?php }?><strong style="color: #ff6262;"><i><label class="fa-bell"><label>(<?php echo $repcount ?>)</i></strong>
								<?php if($repcount>0){?><a id="chakan" style="cursor: pointer;" onClick="javascritp:watchreply('<?php echo $value['ID'] ?>')">&nbsp;展开</a><a id="shouqi" style="cursor: pointer" class="hide" onClick="javascritp:closereply('<?php echo $value['ID'] ?>')">&nbsp;close</a> 

								<?php }?>
							</p>
							<p class="text-right" style="color: gray;"><?php echo $value['msg_datetime'] ?></p>
							<div id="<?php echo $value['ID']?>" style="margin-left:50px"></div>
							<hr>
						</div>											
						<?php } ?>
					<?php } ?>
				</div>

			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="info">
					<ul>
						<li>
							<a type="button" style="position: fixed; top: 25%; right: 5px;font-size: 30px;min-width:70px;height:8%;" class="btn btn-default1 btn-circle" onClick="focus(#mepic)" href="#"><i class="icon-picture"></i></a>
							<a type="button" style="position: fixed; top: 15%; right: 5px;font-size: 30px;min-width:70px;height:8%;" class="btn btn-default1 btn-circle" onClick="window.close()" href="#"><i class="icon-off"></i></a>
	
						<?php if ($pres) { ?>
							<a type="button" style="position: fixed; bottom: 5px; left: 5px;font-size: 55px;min-width:48px;height:90%;" class="btn btn-default1 btn-circle" href="<?php echo base_url('view') . '/' . $pres ?>"><i class="icon-chevron-left"></i></a><?php echo nbs(4) ?>
						<?php } ?>
						<?php if ($next <= $this->pic_model->max_id()) { ?>
							<a type="button" style="position: fixed; bottom: 5px; right: 5px;font-size: 55px;min-width:70px;height:65%;" class="btn btn-default1 btn-circle" href="<?php echo base_url('view') . '/' . $next ?>"><i class="icon-chevron-right"></i></a>
						<?php } ?>
						</li>
						<li>
							<?php if( $this->session->userdata('online')) { ?>
						<!--用户判断 -->
				
							<a style="cursor: pointer;" onClick="Love('<?php echo $uuid ?>')"><i class="icon-heart"></i><span id="collect"> <?php if($is_love) { echo "Cancel"; } else { echo ""; } ?> <?php echo $collect ?></span></a><?php echo nbs(4) ?>
						    <?php } ?>
							<a href="<?php echo base_url('xixi/downImage/' . $uuid) ?>" onClick="Down()"><i class="icon-cloud-download"></i> <span id="download"><?php echo $share ?></span></a><?php echo nbs(4) ?> 
							<?php if( $this->session->userdata('online')) { ?>
						<!--用户判断 -->
								
							<a style="cursor: pointer;" onClick="Like('<?php echo $uuid ?>')"><i class="icon-thumbs-up"></i><span id="like"> <?php if($is_like) { echo "Cancel"; } else { echo ""; } ?> <?php echo $like ?></span></a><?php echo nbs(4) ?>
						    <?php } ?>

						</li>
						<?php if( $this->session->userdata('online')) { ?>
						<!--用户判断 -->
						<li>
							<div class="row">
								<div class="col-xs-4">
									
									<a type="button" class="btn btn-primary border btn-sm" onClick="javascript:AddAlbum()">收藏到自己的专辑</a>
								</div>
								<div class="col-xs-8">
									
									<select class="form-control input-sm">
										<?php
											$album = $this->album_model->myalbum($username);

											foreach ($album as $value) {
												$picount = $this->album_model->picturenum($value['ID']);	
										?>
								  		
										<option style="color: #ff5f83;background-color: #f8f8f8;" value="<?php echo $value['ID'] ?>">
											<?php echo $value['album_name']; ?> (<?php echo $picount ?>)
										</option>
								  		<?php } ?>
									</select>
								</div>
							</div>
							<div class="alert alert-danger border hide" id="albumwarring" style="margin-top:10px;color: #ff5f83" role="alert">已经存在</div>
							<div class="alert alert-success border hide" id="albumsuccessss" style="margin-top:10px;color: #ff5f83" role="alert">收录成功</div>
						</li>

						<?php } ?>
						<li><button class="btn btn-primary btn-sm border" data-toggle="modal" data-target="#addtagModal">
						  为你喜欢的图片添加自己的标签
						</button></li>
						<li><b style="color: #ff5f83;">相似推荐</b></li>

						<li>
							<div class="row maincontent" >
								<div class="col-xs-6">
									<?php
									$images = $this->pic_model->alltag($fir_tag);
									foreach ($images as $img) {
											$thumb    = explode(".",$img['pic_url']);
											$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
											$imageurl  = base_url($thumbpic);


									?>
									<a title="<?php echo $img['ID'].'-'.$fir_tag?>" href="<?php echo base_url('view') . '/' . $img['ID'] ?>">
										<img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>">
									</a>
									<?php } ?>
								</div>
								<div class="col-xs-6">
									<?php
									$images = $this->pic_model->alltag($sec_tag);
									foreach ($images as $img) {
											$thumb    = explode(".",$img['pic_url']);
											$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
											$imageurl  = base_url($thumbpic);
									?>
									<a title="<?php echo $img['ID'].'-'.$sec_tag?>" href="<?php echo base_url('view') . '/' . $img['ID'] ?>">
										<img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>">
									</a>
									<?php } ?>
								</div>
							</div>
						</li>
						
						<div><label><b style="color: #ff5f83;">随机推荐</b></label></div>
						<li>
							<div class="auto-fixed" style="background: #EEEEEE" >
							<a type="button" onClick="reload();focus(#suiji)" style="width: 216px;font-weight:bold;line_hight:24px" href="#" class="btn btn-default1 btn-circle"><label style="hight:auto;font-size:24px" class="icon-refresh"></label></a>							
							<script src="<?php echo base_url('dist/js/jQuery.js') ?>"></script>


								<div class="funnyNewsTicker fnt-radius fnt-shadow fnt-easing" id="funnyNewsTicker3">
									<ul>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php }?>
											<div tabindex="1" id="dinwei" style="color: #ff5f83;border:1px solid #EEEEEE"> </div>
											</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
										<li>
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
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags[0]) ?>">
											<em align="center" style="color: #ff5f83">
												<?php echo $thumbtags[0]?>
											</em>
											</a>
											<?php if(substr_count($hot['pic_tag'],$str)){for($i=1;$i<=substr_count($hot['pic_tag'],$str);$i++) { ?>
											<a title="标签名" href="<?php echo base_url('tag/' . $thumbtags1[$i]) ?>">
											<em align="center" style="color: #ff5f83"> <?php echo $thumbtags1[$i]?></em></a>												
											<?php }} ?>
											<a title="<?php echo $hot['pic_tag']?><?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>"></a>
											<?php } ?>
										</div>
										</li>
									</ul>
								</div>

							<script>
								$(document).ready(function(){	
									$("#funnyNewsTicker3").funnyNewsTicker({
									width:"70%",itemheight:250,infobarvisible:false,pagenavi:false,timer:1500,itembgcolor:"#EEEEEE",bordercolor:"#EEEEEE"});	
								});	
							</script>
							<style>
								.funnyNewsTicker{ -webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none;}
							</style>
							</div>
						</li>
						<li><b style="color: #ff5f83;">今日热门推荐</b></li>
						<li>
						<style>
							em{font-size:4px;}
						</style>
							<div class="row maincontent" >
								<div class="col-xs-6">
									<?php
									$hots = $this->pic_model->todayhot();
									foreach ($hots as $hot) {
											$thumb    = explode(".",$hot['pic_url']);
											$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
											$imageurl  = base_url($thumbpic);
									?>
							<a title="<?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>">
										<img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>">
									</a>
									<?php } ?>
								</div>
								<div class="col-xs-6">
									<?php
									$hots = $this->pic_model->todayhot2();
									foreach ($hots as $hot) {
											$thumb    = explode(".",$hot['pic_url']);
											$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
											$imageurl  = base_url($thumbpic);
									?>
									<a title="<?php echo $hot['ID']?>" href="<?php echo base_url('view') . '/' . $hot['ID'] ?>">
										<img style="width: 120px;margin-top:5px;" src="<?php echo $imageurl ?>">
									</a>
									<?php } ?>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="addtagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:200px;">
	  <div class="modal-dialog">
	    <div class="modal-content border">
	      <div class="modal-header">
	        <h4 class="modal-title" id="myModalLabel"><strong style="color: #ff5f83;">添加标签</strong></h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-horizontal">
    	        <div class="form-group">
    	        	<label class="col-sm-2 control-label" style="color: #ff5f83;">标 签</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border" id="tag" value="<?php foreach ($tag as $value) { echo $value . ','; } ?>" autofocus="true" placeholder="使用回车键入标签" data-role="tagsinput">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                    <?php
                        $query = $this->tags_model->tags();
                        foreach ($query as $value) {
                    ?>
                        <label class='label label-info border' style="cursor: pointer;" onClick="javascritp:ClickTag('<?php echo $value['tag_name'] ?>')"><?php echo $value['tag_name'] ?></label>
                    <?php } ?>
                    </div>
                </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default border" data-dismiss="modal">关闭</button>
	        <button type="button" class="btn btn-primary border" onClick="EditTag()">保存</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<style>
	.fixed { position: fixed; width:40%; top:50px; z-index: 100; }
</style>
<script src="<?php echo base_url('dist/js/fixed.js') ?>"></script>
<script src="<?php echo base_url('dist/js/bootstrap-tagsinput.min.js') ?>"></script>
<script>
    $('#tag').tagsinput({
      maxTags   : 6,
      maxChars  : 32,
      trimValue : true
    });
    function ClickTag (argument)
    {
        $('#tag').tagsinput('add', argument);
    }

    function EditTag () {
    	var pic       = '<?php echo $id; ?>';
    	var tags      = $('#tag').val();
    	var server    = Home + "xixi/edittag/" + pic + "/" + tags;
		$.ajax({
		   	type : "POST",
		   	url  : server,
		   	success: function(recvice){
		   		if (recvice == "0") {
		   			$('#addtagModal').modal('hide');
		   			 location.reload();
		   		}


		   }
		})
    }
	function Down () {
		var download = $('#download').html();
		$('#download').html(parseInt(download) + 1);
	}
	function AddAlbum () {
		var text      = $("select option:selected").text();
		var string    = text.substring(text.indexOf("(") + 1,text.length - 1);
		var newstr    = parseInt(string) + 1;
		var newName   = text.substring(0,text.indexOf(" "));
		var newText   = newName + " (" + newstr + ")";
		var album     = $("select option:selected").val();
		var pic       = '<?php echo $id; ?>';
		var server    = Home + "album/add/" + album + "/" + pic;
		$.ajax({
		   	type : "POST",
		   	url  : server,
		   	success: function(recvice){
		   		if (recvice == "1") {
		   			$('#albumwarring').removeClass('hide');
					$('#albumwarring').addClass('show');
					setTimeout(function () {
						$('#albumwarring').removeClass('show');
						$('#albumwarring').addClass('hide');
					}, 3000);
		   		};
		   		if (recvice == "0") {
		   			$("select option:selected").html(newText);
		   			$('#albumsuccessss').removeClass('hide');
					$('#albumsuccessss').addClass('show');
					setTimeout(function () {
						$('#albumsuccessss').removeClass('show');
						$('#albumsuccessss').addClass('hide');
					}, 3000);
		   		};
		   }
		})
	}
	function watchreply (num){
		var url   = Home + "message/repmsg/";
		var surl = url + num;
		$.get(surl,function(data){
				$.each(data, function(index, obj) {		
				var m_div=$('<div>')
				$('#'+obj.thisid).prepend(m_div);

				var p_user = $('<p>');
				p_user.addClass("text-left");
				m_div.append(p_user); 

				var user_img = $('<img />');
				user_img.addClass("img-circle");

				var userImg = new Image();
				userImg.src = obj.rep_upicture;
				p_user.append(user_img);

				p_user.append(" ");

				var strong = $('<strong style="margin-bottom:0px">');
				strong.html(obj.rep_username);
				p_user.append(strong); 


				var block = $('<blockquote style="margin-bottom:0px">');
				m_div.append(block);

				var loushu =$('<label>');
				loushu.html(obj.loushu);
				block.append(loushu);

				var p_text = $('<p>');
				p_text.addClass("text-left");
				p_text.html(obj.rep_text);
				block.append(p_text);

				var p_data = $('<p style="margin-bottom:0px">');
				p_data.addClass("text-right");
				p_data.html(obj.rep_datetime);
				m_div.append(p_data);

				//m_div.append("<hr/>");

				$('#text').val("");
				$('#nullmessage').addClass('hide');
				$('#chakan').addClass('hide');
				$('#shouqi').addClass('show');

				})
			},'json');
	}

	function closereply (num){
		$('#' + num).addClass('hide');

			$('#shouqi').removeClass('show');
			$('#shouqi').addClass('hide');
			//$('#chakan').removeClass('hide');
			//$('#chakan').addClass('show');
			//$('#chakan').add


		

	}
	function init(){
		setTimeout(function () {
			//alert("$('#text').focus();");
			$('#dinwei').focus();
		},28555);
		
	}
	window.onload=init;

	function reply (username,msg_id) {
		$('#text').focus();
		//var str = "@" + username + " ";
		//$('#text').val(str);
		$('#text').focus();
		$('#isrep').val(1);
		$('#toname').val(username);
		$('#toname2').html(username);
		$('#msg_id').val(msg_id);
		$('#xuanxiang1').css('display','block');
		$('#a1').css('display','block');
		$('#xuanxiang2').css('display','none');
		//$('#meitusql').append('<textarea id=\'text2\' type=\'text\'>请留下你的回复</textarea><button class="btn btn-primary border" onClick="javascript:SendMessage2(\'<?php echo $uuid ?>\')">回复</button>');

	}
	function SendMessage (view) {
		var text  = $('#text').val();
		$('#alert').removeClass('show');
		$('#alert').addClass('hide');
		if (text.length < 6) {
			$('#alert').html("留言内容不得少于六个字符。");
			$('#alert').removeClass('hide');
			$('#alert').addClass('show');
			setTimeout(function () {
				$('#alert').removeClass('show');
				$('#alert').addClass('hide');
			}, 3000);
			return;
		}

		var dataStr  = '<?php echo date("Y-m-d H:i:s"); ?>';
		var username = '<?php echo $username; ?>';
		var userpic  = '<?php echo $userpic; ?>';

		var server = Home + "message/addmessage/" + view + "/" + text + "/" + username;
		$.ajax({
		   	type : "POST",
		   	url  : server,
		   	success: function(recvice){
		    	$('#success').html("留言发布成功。");
				$('#success').removeClass('hide');
				$('#success').addClass('show');

				var m_div = $('<div>')
				$('#message').prepend(m_div);

				var p_user = $('<p>');
				p_user.addClass("text-left");
				m_div.append(p_user); 


				var user_img = $('<img />');
				user_img.addClass("img-circle");

				var userImg = new Image();
				userImg.onload = function() {
					user_img.attr('src', this.src);
					//alert(this.src);
				}
				userImg.src = userpic;
				p_user.append(user_img);

				p_user.append(" ");

				var strong = $('<strong>');
				strong.html(username);
				p_user.append(strong); 

				var block = $('<blockquote>');
				m_div.append(block);

				var p_text = $('<p>');
				p_text.addClass("text-left");
				p_text.html(text);
				block.append(p_text);

				var p_data = $('<p>');
				p_data.addClass("text-right");
				p_data.html(dataStr);
				m_div.append(p_data);

				m_div.append("<hr/>");

				$('#text').val("");
				$('#nullmessage').addClass('hide');
		   }
		})
		setTimeout(function () {
			$('#success').removeClass('show');
			$('#success').addClass('hide');
		}, 3000);
	}
	function SendMessage2 (view) {
		var text  = $('#text').val();
		$('#alert').removeClass('show');
		$('#alert').addClass('hide');
		if (text.length < 6) {
			$('#alert').html("留言内容不得少于六个字符。");
			$('#alert').removeClass('hide');
			$('#alert').addClass('show');
			setTimeout(function () {
				$('#alert').removeClass('show');
				$('#alert').addClass('hide');
			}, 3000);
			return;
		}

		var dataStr  = '<?php echo date("Y-m-d H:i:s"); ?>';
		var username = '<?php echo $username; ?>';
		var userpic  = '<?php echo $userpic; ?>';
		var toname   = $('#toname').val();
		var msgid   = $('#msg_id').val();
		var msg_status = $('#isrep').val();


		var server = Home + "message/addmessage2/" + view + "/" + text + "/" + username + "/" + toname + "/" + msgid + "/" + msg_status;
		$.ajax({
		   	type : "POST",
		   	url  : server,
		   	success: function(recvice){
		    	$('#success').html("留言发布成功。");
				$('#success').removeClass('hide');
				$('#success').addClass('show');

				var m_div = $('<div>')
				$('#message').prepend(m_div);

				var p_user = $('<p>');
				p_user.addClass("text-left");
				m_div.append(p_user); 


				var user_img = $('<img />');
				user_img.addClass("img-circle");

				var userImg = new Image();
				userImg.onload = function() {
					user_img.attr('src', this.src);
				}
				userImg.src = userpic;
				p_user.append(user_img);

				p_user.append(" ");

				var strong = $('<strong>');
				strong.html(username);
				p_user.append(strong); 

				var block = $('<blockquote>');
				m_div.append(block);

				var p_text = $('<p>');
				p_text.addClass("text-left");
				p_text.html(text);
				block.append(p_text);

				var p_data = $('<p>');
				p_data.addClass("text-right");
				p_data.html(dataStr);
				m_div.append(p_data);

				m_div.append("<hr/>");

				$('#text').val("");
				$('#nullmessage').addClass('hide');
		   }
		})
		setTimeout(function () {
			$('#success').removeClass('show');
			$('#success').addClass('hide');
		}, 3000);

		$('#xuanxiang2').css('display','block');
		$('#xuanxiang1').css('display','none');

	
	}
	function Like (uuid) {
		$.get("<?php echo base_url('xixi/like') . '/' ?>" + uuid,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
				if (obj.is_like) {
					$('#like').html("Cancel" + obj.like);
				} else {
					$('#like').html("" + obj.like);
				}
			});
		});
	}
	function Love (uuid) {
		$.get("<?php echo base_url('xixi/love') . '/' ?>" + uuid,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
					if (obj.is_love) {
						$('#collect').html("Cancel" + obj.love);
					} else {
						$('#collect').html("" + obj.love);
					}
			});
			
		});
		$(document).ready(function() {
			$(document).bind('keydown', function(event) {
				switch(event.keyCode) {
					case 37:
						if ($('#Btnprse').length > 0) {
							window.location.href = $('#Btnprse').attr("href");
						}
						break;
					case 39:
						if ($('#Btnnext').length > 0) {
							window.location.href = $('#Btnnext').attr("href");
						}
						break;
					default:
						break;
				}
			});
		});
	}
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
<!--  离线有点卡
<script>
	window._bd_share_config = {
		image : [{
			"tag" : "xixi_picture",
			viewType : 'list',
			viewPos : 'top',
			viewColor : 'black',
			viewSize : '16',
			viewList : ['qzone','tsina','huaban','tqq','renren']
		}]
	}
</script>
<script>
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
	window.onload=function(){
		imagepicmsg();
		}
	function imagepicmsg () {
		//document.getElementById(mepic).titlename="book_show";
}
</script>

-->