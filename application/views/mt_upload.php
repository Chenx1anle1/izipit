    <style>
    body{
        background-color: #e0e0e0;
    }
    </style>
    <div class="container top">
            <div id="uploader" class="wu-example">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <p style="color:#ff5f83">或将照片拖到这里，单次最多可选100张</p>
                    </div>
                </div>

                <div class="viewInfo" style="display:none;">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="color: #ff5f83">专 辑</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="album">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <?php
                                    $username = $this->session->userdata('Username');
                                    $album = $this->album_model->myalbum($username);

                                    foreach ($album as $value) {
                                ?>
                                <span class="btn btn-primary border btn-sm" style="cursor: pointer;" onClick="Clickalbum('<?php echo $value['album_name'] ?>')"><?php echo $value['album_name'] ?></span>
                                <?php } ?>
                                	<span class="btn btn-primary border btn-sm" onClick="creatday()">
		
										〓today
		
		
									</span>
                            </div>
							<script>
							function creatday(){
								var now= new Date();
								var year=now.getFullYear();
								var month=now.getMonth();
								var date=now.getDate();
								document.getElementById("album").value=year-2000 + "-" + month + "-" + date;
							  }
							</script>
						</div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="color: #ff5f83">分 类</label>
                            <div class="col-sm-8">
                                <?php
                                $query = $this->catalogue_model->cat_all();
                                foreach ($query as $value) {
                                ?>
                                <label class="radio-inline" style="color: #ff5f83">
								<span class='label label-info border'>
									<input type="radio" name="type" checked value="<?php echo $value['cat_another_name'] ?>"> 
										<?php echo $value['cat_name'] ?>
									</input>
                                </label>
								</span>
                                <?php } ?>
                            </div>
                         </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="color: #ff5f83">标 题</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="title" autofocus="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label" style="color: #ff5f83">描 述</label>
                            <div class="col-sm-8">
                                <textarea class="form-control border" rows="5" id="info"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="color: #ff5f83">标 签</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="tag" placeholder="使用回车键入标签" data-role="tagsinput">
                            </div>
                        </div>   
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                            <?php
                                $query = $this->tags_model->tags();
                                foreach ($query as $value) {
                            ?>
                                <span class='label label-default border' style="cursor: pointer;" onClick="ClickTag('<? echo $value['tag_name'] ?>')"><? echo $value['tag_name'] ?></span>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="statusBar" style="display:none;">
                        <div class="progress">
                            <span class="text" style="color: #ff5f83">0%</span>
                            <span class="percentage" style="color: #ff5f83"></span>
                        </div>
                        <div class="info"></div>
                        <div class="btns">
                            <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
    <script>
        var imageNum  = "<?php echo $this->system_model->get_imageNum() ?>";
        var imageSize = "<?php echo $this->system_model->get_imageSize() ?>";
    </script>
    <script src="<?php echo base_url('dist/js/webuploader.min.js') ?>"></script>
    <script src="<?php echo base_url('dist/js/upload.js') ?>"></script>
    <script>
    function Clickalbum (argument) 
    {
        $('#album').val(argument);
    }

    function ClickTag (argument) 
    {
        $('#tag').tagsinput('add', argument);
    }
    </script>
    <script src="<?php echo base_url('dist/js/bootstrap-tagsinput.min.js') ?>"></script>
    <script>
    $('#tag').tagsinput({
      maxTags   : 6,
      maxChars  : 32,
      trimValue : true
    });
    </script>