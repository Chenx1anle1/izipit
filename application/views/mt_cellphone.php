    <div class="container top" style="margin-bottom: 100px;">
        <div class="row">
            <div class="user-details">
                <div class="user-image">
                    <div class="row">
                        <div class="col-xs-6" style="margin-top: 50px;color: #FF5F83">
                            <h3><label class="icon-user icon-large">&nbsp&nbsp&nbsp</label>设置手机</h3>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <hr>
                <hr>
                <div class="user-info-block" style="top:85px;background-color: #F8F8F8;">
                    <hr>
                    <div style="float:right">
                        
                    </div>
                    <div class="login-form-section col-xs-12 col-sm-4" style="left: 100px;">
                        <div class="login-content  animated bounceIn">
                            <form action="http://cxlmeitu.com/login" method="post" accept-charset="utf-8" role="form">
                                <div class="textbox-wrap focused" id='div_user'>
                                    <div class="input-group">
                                        <span class="input-group-addon ">手机号</span>
                                        <input onfocus="focususer()" onblur="bluruser()" type="text" class="form-control" name="username" autocomplete="off" value="<?php echo set_value('username'); ?>" onpaste="return false" oncontextmenu="return false" required="true" maxlength="12" placeholder="用户名" autofocus="true">
                                        <span class="input-group-addon ">发送验证码</span>
                                    </div>
                                </div>
                                <div class="textbox-wrap" id='div_pwd'>
                                    <div class="input-group">
                                        <span class="input-group-addon ">验证码</span>
                                        <input onfocus="focusPswd()" onblur="blurPswd()" type="password" class="form-control" name="password" autocomplete="off" onpaste="return false" oncontextmenu="return false" placeholder="密码" required="true">
                                        <span class="input-group-addon ">验证码</span>
                                    </div>
                                </div>
                                <div class="login-form-action clearfix">
                                    <button type="submit" class="btn btn-success pull-right green-btn">提交</button>
                                </div>
                                <div class="section-title">
                                    <h3></h3>
                                    <?php echo validation_errors(); ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    //user项获得焦点的时候：
    function focususer(){
        var obj = document.getElementById("div_user");
            obj.className = "textbox-wrap focused";

    }

    //user项失去焦点的时候：
    function bluruser(){
        var obj = document.getElementById("div_user");
            obj.className = "textbox-wrap";
    }

    //密码项获得焦点的时候：
    function focusPswd(){
        var obj = document.getElementById("div_pwd");
            obj.className = "textbox-wrap focused";

    }

    //密码项失去焦点的时候：
    function blurPswd(){
        var obj = document.getElementById("div_pwd");
            obj.className = "textbox-wrap";
    }
</script>