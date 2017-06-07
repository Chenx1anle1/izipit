<!-- page-nav -->
<div class="layout page-nav hide">
    <a href="">首页</a> / 用户注册
</div>

<!-- register -->
<div class="register">
    <div class="layout">
        <div class="fl txts">
            <div class="fl">
                <h2>非常完美客户端</h2>
                <p>国内最大、最靠谱的赴韩整形平台</p>
            </div>
            <div class="fr">
                <img src="<?php echo base_url(); ?>static/common/img/code_wx.jpg">
                <p>扫描下载 <br>即刻变美</p>
            </div>
        </div>
        <div class="box fr">
            <!-- 注册成功后，从哪里来，再跳转回去 -->
            <!--
                返回的数据格式：
                成功
                    {
                        code : 1,
                        msg : '注册成功！',
                        data : {
                            href : ''
                        }
                    }
                失败：
                    {
                        code : 0,
                        msg : '验证码错误',
                        data : {}
                    }
             -->
            <form action="<?php echo site_url('/register/go/'); ?>" method="post" id="register">
                <div class="form-ele">
                    <div class="ele-bd">
                        <select name="pcode" id="country-sel" class="txt">
                            <option value="86">中国</option>
                            <option value="82">韩国</option>
                            <option value="852">香港</option>
                            <option value="853">澳门</option>
                            <option value="886">台湾省</option>
                            <option value="1">美国</option>
                            <option value="44">英国</option>
                            <option value="31">荷兰</option>
                            <option value="39">意大利</option>
                            <option value="380">乌克兰</option>
                            <option value="358">芬兰</option>
                        </select>
                        <label for="country-sel"><i>&#xe623;</i></label>
                        <p class="no"><i>&#xe61d;</i> 请选择所在国家</p>
                        <p class="yes"><i>&#xe640;</i> 选择正确</p>
                    </div>
                </div>
                <div class="form-ele">
                    <div class="ele-bd">
                        <input type="text" name="phone" id="number" class="txt" maxlength="11" pattern="^\d{11}$" placeholder="手机号" required <?php echo site_url('/register/check_register'); ?>/>
                        <label for="number"><i>&#xe653;</i></label>
                        <p class="no"><i>&#xe61d;</i> 手机号码格式错误</p>
                        <p class="yes"><i>&#xe640;</i> 输入正确</p>
                    </div>
                </div>
                <div class="form-ele">
                    <div class="ele-bd">
                        <input type="password" name="setpassword" id="pass" class="txt" maxlength="18" pattern="^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,18}$" placeholder="密码" required />
                        <label for="pass"><i>&#xe619;</i></label>
                        <p class="no"><i>&#xe61d;</i> 请输入密码</p>
                        <p class="yes"><i>&#xe640;</i> 输入正确</p>
                    </div>
                </div>
                <div class="form-ele">
                    <div class="ele-bd code">
                        <input type="text" name="test" class="txt" id="code" maxlength="6" pattern="^\d{6}$" placeholder="验证码" required />
                        <label for="code"><i>&#xe61b;</i></label>
                                               
                        <a href="<?php echo site_url('/register/get_vcode'); ?>" class="btn-code fr" id="btn-code">获取验证码</a>
                        <p class="no"><i>&#xe61d;</i> 验证码格式错误</p>
                        <p class="yes"><i>&#xe640;</i> 验证码格式正确</p>
                    </div>
                </div>
                <div class="form-ele">
                    <div class="ele-bd agreement">
                        <label for="agreement">
                            <input type="checkbox" name="agreement" id="agreement" class="txt" checked="checked" required />
                            <!-- 连接到帮助中心的对应地址 -->
                            遵守非常完美<a href="<?php echo site_url('help/show/339');?>">用户协议</a>和<a href="<?php echo site_url('help/show/409');?>">隐私政策</a>
                        </label>
                        <a href="<?php echo site_url('forget');?>" class="fr">忘记密码?</a>
                    </div>
                </div>
                <div class="form-ele">
                    <div class="ele-bd">
                        <input type="submit" name="submit" value="注 册" class="btn" />
                    </div>
                </div>
                <div class="form-ele">
                    <div class="ele-bd tip">
                        已有账号？<a href="<?php echo site_url('/login'); ?>">点击登录</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- validate-dailog -->
<div class="validate-dailog" id="validate-dailog">
    <div class="code-area">
            <i>&#xe61d;</i>
        <p>请输入验证码</p>
        <p>
            <input type="text" id="re-code" class="txt"><img src="<?php echo site_url('/register/captcha/show');?>" class="coder">
        </p>
        <p><a href="<?php echo site_url('/register/get_vcode'); ?>" class="btn">提 交</a></p>
    </div>
</div>
<?php $this->load->view('site/footer'); ?>
<script src="<?php echo base_url(); ?>dist/js/widget_form.js"></script>
<script src="<?php echo base_url(); ?>dist/js/js/register.js"></script>

</body>
</html>
