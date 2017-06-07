<div id="body" class="container top">
    <div class="row layout">
        <div class="col-xs-1 col-sm-10">
            <div class="maincontent" style="background-color: #F8F8F8;min-height: 450px">
                <h4 class="text-center"><strong style="color: #ff5f83;"><?php echo $article['title'] ?></strong></h4>
                <div class="text-center">
                    <p><?php echo $article['txt'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-xs-1 col-sm-2">
            <a href="<?php echo $href ?>" style="float:left;padding: 0px 0px;">
                <img src="<?php echo $userpic ?>" class="img-circle" style="height: 35px">
                <?php if($username != $this->session->userdata('username')) { ?>
                    <label>
                        <?php echo '&nbsp&nbsp&nbsp&nbsp'.$username ?>&nbsp&nbsp&nbsp
                    </label>
                <?php }else{ ?>
                    <label>&nbsp&nbsp&nbspit's me!</label>
                <?php } ?>
                    <hr>
                    <label><?php echo $uptime.'  ' ?> 留下</label>
            </a>
        </div>
    </div>
</div>