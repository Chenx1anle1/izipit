<?php if (strpos($_SERVER['REQUEST_URI'], 'yedeng') === false) { ?>
<?php if( !$this->session->userdata('online') ) { ?>
		<div class="bottom_box">
		    <div class="bottom" style="margin-leftt:440px;">
				<label><center>欢迎访问ZipIt</center></label>
		        <a class="register" href="<?php echo site_url().'register' ?>" target="_blank"><a type="button" class="btn btn-success btn-circle navbar-btn" href="<?php echo site_url().'register' ?>">注 册</a></a>
		        <a class="ask" href="<?php echo site_url().'login' ?>" target="_blank"><a type="button" style="margin-leftt:440px;" class="btn btn-success btn-circle navbar-btn" href="<?php echo site_url().'login' ?>">登 录</a></a>
		    </div>
		    <div class="close" style="left:92%;"><b style="color: #585858;">×</b></div>  
		</div>
	<script type="text/javascript">
		$(function(){
			
			setTimeout(function(){
			$(".bottom_box").slideDown("slow");
			},2000);

			$(".close").click(function(){
				$(".bottom_box").hide();	
				$(".mini").show(200);	
			})
			$(".mini").click(function(){
				$(this).hide();	
				$(".bottom_box").show();	
			})
		});
	</script>
<?php } ?>
<?php } ?>
<?php if (strlen($_SERVER['REQUEST_URI'])>1 && strpos($_SERVER['REQUEST_URI'], '_mypic') === false && strpos($_SERVER['REQUEST_URI'], 'album') === false) { ?>
<?php if (strpos($_SERVER['REQUEST_URI'], 'search') === false) { ?>
<?php if (strpos($_SERVER['REQUEST_URI'], 'popular') === false && strpos($_SERVER['REQUEST_URI'], 'user') === false) { ?>
<?php if (strpos($_SERVER['REQUEST_URI'], 'catalogue') === false && strpos($_SERVER['REQUEST_URI'], 'tag') === false) { ?>
<footer id="colophon" role="contentinfo" itemscope="">
        <div class="footer-image"></div>
        <div class="container">
            <p>© 2017 <a href="http://www.izipit.top/">不去说·个人·图片博客</a>.
                辽ICP备17002568号-1. by Chenxl. </p>
        </div>
</footer>
<?php } ?>
<?php } ?>
<?php } ?>
<?php } ?>
<div style="text-align:center;clear:both">
	<style>
		.bottom_box{ 
			position:fixed; 
			left:0; 
			bottom:0; 
			z-index:10000000; 
			width:100%; 
			display:none; 
			background:#d4d4d4; 
			filter:alpha(opacity=80); -moz-opacity:.8; opacity:.8;}
		* html .bottom_box{
			position:absolute; left:expression(eval(document.documentElement.scrollLeft+document.documentElement.clientWidth-this.offsetWidth)-(parseInt(this.currentStyle.marginLeft,10)||0)-(parseInt(this.currentStyle.marginRight,10)||0)); top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0)))}
		.bottom{ 
			width:100%; 
			height: auto;			
			margin-top:0px;
 
			color:#000000; 
			line-height:75px; 
			padding:0 0; 
			position:relative;}
		.bottom label{width:60%;font-size:25px;}
		.bottom a{ width:12.5%;}


		.close{ 
			position:absolute; 
			right:60px; 
			top:0px; 
			width:48px; 
			height:48px; 
			font-size:80px;
		}
	</style>
	<script src="<?php echo base_url('dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('dist/js/sample.js') ?>"></script>
    <script src="<?php echo base_url('dist/js/lightbox.min.js') ?>"></script>
  </body>
</html>