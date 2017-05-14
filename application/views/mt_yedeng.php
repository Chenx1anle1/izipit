    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        /*.container {
            max-width: 50rem;
            margin-left: 1rem;
            margin-right: auto;
            margin-bottom: 50px;
            margin-top: 50px;
        }*/
        .article {
            max-width: 50rem;
            margin-left: 1rem;
            margin-right: auto;
            margin-bottom: 50px;
            margin-top: 50px;
        }
        h1 {
            font-size: 54px;
            margin: 30px 0 10px;
        }

        .btn-submit {
            /*color: #F7B5C4;*/
            width:848px;
            text-align: center;
            padding: 1px 12px;
            font-size: 10px;
            min-width: 62px;
        }

        .now {
            color: #fff;
            background-color: #F7B5C4;
            border-color: #F8C1CE;
        }
        hr {
            display: block;
            width: 7rem;
            height: 1px;
            margin: 2.5rem 0;
            background-color: #eee;
            border: 0;
        }
        .ol-li{ display:inline}
        .key_box{display:none;}
        p {
            font-size: 18px;
        }
    </style>

<link rel="stylesheet" href="<?php echo base_url('dist/css/yedeng/main.css') ?>">

<!-- 分页 -->
<div style="overflow: hidden;margin-top: 50px;">
    <ul>
        <?php
            $total_page = ceil($total%10);
            $uid = 0;
            if ($uid_key) {
                $uid = $this->session->userdata('id');
            }
            $total_page = $total_page<8?8:$total_page;
        ?>
        <?php for ($i=0; $i<=$total_page; $i++) { ?>
            <?php if (2<$i && $i!=$offset/10 && $i<$total_page) { ?>
                <li style="list-style:none;float:left;">·</li>
            <?php } else { ?>
                <li style="list-style:none;float:left;">
                <a<?php if ($i*10 == $offset) :?> class="now btn btn-primary"<?php endif; ?> style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.(10*$i) ?><?php echo $uid ? '&uid='.$uid : '' ?>"><?php echo '第'.($i+1).'页' ?></a>
                </li>
            <?php } ?>
        <?php } ?>
        <?php if (($offset-10)>-10) { ?>
            <li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset-10) ?><?php echo $uid ? '&uid='.$uid : '' ?>"><?php echo '上一页' ?></a></li>
        <?php } ?>
        <?php if (($offset)<$total_page*10) { ?>
            <li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset+10) ?><?php echo $uid ? '&uid='.$uid : '' ?>"><?php echo '下一页' ?></a></li>
        <?php } ?>
        <?php if (!$uid_key) { ?>
            <li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page=0&uid='.$this->session->userdata('id') ?>"><?php echo '我的' ?></a></li>
        <?php } ?>
        <?php if ($uid_key) { ?>
            <li style="list-style:none;float:left;"><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page=0' ?>"><?php echo '退出收藏' ?></a></li>
        <?php } ?>

    </ul>
</div>

<!-- 图文区块 -->
<div style="overflow: hidden;">
<div class="helpcenterWild">
    <div class="new100content">
        <div class="helpcenter clearfloat">
            <div class="helpcenter_Cleft">
                <img src="<?php echo base_url('dist/img/yedeng/help_left.png') ?>">
                <span></span>
            </div>
            <div class="helpcenter_Cright">
                <img src="<?php echo base_url('dist/img/yedeng/help_right.png') ?>">
                <span></span>
            </div>
            <!-- 左侧 -->
            <div class="helpcenter_left">
                <!-- <h2>电台节目：财经夜读</h2> -->
                <div id="content_1" class="helpcenter_leftIn mCustomScrollbar _mCS_1">
                    <!-- 左侧列表 -->
                    
                    <!-- <ul> -->
                    <ul style="display:none">
                        <li><a class="helpcenter_leftInOn">article</a></li>
                    </ul>
                    
                    <!-- 左侧列表end -->

                    <div id="player" class="aplayer"></div>


                </div>
            </div>
            <!-- 右侧 -->
            <div class="helpcenter_right">
                <!-- 帮助中心右侧 -->
                <div class="helpcenter_rightIn">
                    <!--帮助中心1号信息-->
                    <div class="helpcenter_rightInIn displayblock">
                        <!-- 图文1 -->
                        <div class="helpcenter_rightIns helpcenter_rightInsOn">
                            <div class="helpcenter_rightInL">
                            <div id="loader">
                                <i class="icon-spinner icon-spin icon-5x" style="color: #ff5f83"></i>
                            </div>
                            </div>
                        </div>
                        <!-- 图文2 -->
                        <div class="helpcenter_rightIns">
                            <div class="helpcenter_rightInL">
                                <h2><span>帮助中心1</span><span class="helpcenter_span1">2</span><span>/</span><span>3</span></h2>
                                <div class="m">
                                    <textarea class="txt txt-editor" id="content" name="content"></textarea>
                                    <input type="submit" value="提 交" id="784533" class="btn-submit">
                                </div>
                            </div>
                        </div>
                        <!-- 图文3 -->
                        <div class="helpcenter_rightIns">
                            <div class="helpcenter_rightInL">
                                <h2><span>帮助中心1</span><span class="helpcenter_span1">3</span><span>/</span><span>3</span></h2>
                                <p>帮助中心帮助中心帮助中心帮助中心帮助中心帮助中心帮助中心帮助中心</p>
                            </div>
                            <div class="helpcenter_rightInR">
                                <img src="<?php echo base_url('dist/img/yedeng/help.jpg') ?>">
                            </div>
                         </div>
                    </div>
                    <!--over-->
                </div>
            </div>
        </div>
    </div>
    <!-- pagenation -->
    <div class="helpcenter_bottom">
        <a class="helpcenter_bBL"><</a>
        <a class="helpcenter_bB helpcenter_bBon">1</a>
        <a class="helpcenter_bB">2</a>
        <a class="helpcenter_bB">3</a>
        <a class="helpcenter_bBR">></a>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('resources/kindeditor/kindeditor-all-min.js') ?>"></script>
<script src="<?php echo base_url('resources/ajax_upload/ajax.upload.js') ?>" /></script>
<script type="text/javascript" src="<?php echo base_url('dist/js/yedeng/main.js') ?>"></script>
<script type="text/javascript">
function UpLoadFile(objKindEditor, btnId, btnVal, upload_url) {
    var K = objKindEditor;
    var uploadbutton = K.uploadbutton({
        button : K('#'+btnId)[0],
        fieldName : 'upload_file',
        url : upload_url,
        afterUpload : function(data) {
            if (data.error === 0) {
                var url = K.formatUrl(data.url, 'absolute');
                alert(data.file_name+'1');
            } else {
                K('#'+btnVal).val(data.file_name);
            }
        },
        afterError : function(str) {
            alert('自定义错误信息: ' + str);
        }
    });
    uploadbutton.fileBox.change(function(e) {
        uploadbutton.submit();
    });
}
</script>
<script>
// KindEditor.ready(function (K){
// // }
var editor;
function KindEditor_ready(K){
    var options =
    {
        width : '848px',
        height : '200px',
        allowFileManager : true,
        uploadJson : '<?php echo base_url('common/editor_upload'); ?>',
        fileManagerJson : '<?php echo base_url('common/editor_manager'); ?>'
    };
 
    $('.txt-editor').each(function(i, ele){
         editor = KindEditor.create($(ele), options);
    });

    var k_area = $(".ke-container");
    var k_doc = $(".ke-edit-iframe").contents().find('body');
    k_doc.each(function(i, ele){
        $(ele).on('keyup', function(e){
            if (e.keyCode == 86) {
                getNetImg(k_area, k_doc);
            };
        });
    });
    function getNetImg(k_area, k_doc){
        var imgs = k_doc.find('img');
        var upload_layer = $('<div class="upload_layer">').css({position:'absolute', left:0, top:0, width:'100%', height:'100%', background:'#fff url(/static/site/2015v1/img/load.gif) no-repeat center',opacity:.5, textAlign:'center'});
        var num = 0;
        var len = 0;

        if (!imgs.length) { return; };
        k_area.css('position','relative').append(upload_layer);
        imgs.each(function(i, ele){
            var src = $(ele).attr('src'), re = /^\/uploads/;
            if (!re.test(src)) {
                len++;
                $.getJSON('/resources/ueditor/php/controller.php?callback=?', {action:'catchimage',source:src}, function(res){
                    num++;
                    if ( res.state == 'SUCCESS' ) {
                        imgs.eq(i).attr({'src': res.list[0].url,'data-ke-src': res.list[0].url});
                        if (num == len) {
                            k_area.css('position','static').find('.upload_layer').remove();
                        };
                    };
                });
            };
        });
    }
    // UpLoadFile(K, 'imgButton', 'img', '<?php echo base_url('page_article/img_upload') ?>');
};
// });
function load_article(id){
    $(".helpcenter_rightIn").empty();
    $(".helpcenter_rightIn").append('<div id="loader"><i class="icon-spinner icon-spin icon-5x" style="color: #ff5f83"></i></div>');
    $('#loader').show();


    // 做改变当用户查看自己收藏时只显示自己的历史图文
    var href = window.location.search;
    // 获取当前链接中的uid 并传递给图文接口
    var uid = '';
    if (href) {
        if (href.lastIndexOf('&')>0) {
                var length = href.lastIndexOf('&');
                uid = href.substring(length+5, href.length);
                uid = '/'+uid;
        }
    }


    var url   = Home + "yedeng/load_article/";
    var surl = url + id + '/' + uid;
        $.getJSON(surl, function(json) {
            $(".helpcenter_rightIn").empty();
            $(".helpcenter_rightIn").append(json.html);
            $(".helpcenter_bottom").empty();
            $('.helpcenter_bottom').append(json.bottom);
            $("#id_"+id).addClass("displayblock");
            KindEditor_ready();
        });
        setTimeout(function() {
                    $('#loader').hide();
        },1000);
}
function add(id){
    editor.sync();
    // var html = editor.html();
    var title = $('.music_title').val();
    var cont = $('.txt-editor').val();
    var status = false;
    if (title == '' || cont == '') {
        alert('标题和内容均不能为空');
    } else {
        status = true;
    }
    var fields = {"title":title,"txt":cont};
    var url   = Home + "yedeng/add_article/" + id;
    if (status) {
        $.ajax({
            url:url,
            type:"POST",
            data:fields,
            dataType:'JSON',
            success:function(json){
                if (json.status) {
                    load_article(id);
                } else {
                    alert(json.msg);
                }
            },
            error:function(){
            }
        });
    }
}
</script>
<script src="<?php echo base_url('dist/js/player/APlayer.min.js') ?>"></script>
<script>
    var url   = Home + "yedeng/listinfo/";
    var page = 0;
    var href = window.location.search;
    var page = 0;
    var uid = '';
    if (href) {
        if (href.lastIndexOf('&')>0) {
                var length = href.lastIndexOf('&');
                uid = href.substring(length+5, href.length);
                uid = '/'+uid;
                page = href.substring(href.lastIndexOf('page=')+5, length);
        } else {
            page = href.substring(href.lastIndexOf('=')+1, href.length);
        }
    }

    function list () {
        var surl = url + page +  uid;
        $.getJSON(surl, function(json) {
            if ($.isEmptyObject(json)) {
                return;
            };
            if (page) {
                $('.aplayer').empty();

            }
            if (json.album.length != 0) {
                var ap5 = new APlayer({
                    element: document.getElementById('player'),
                    narrow: false,
                    autoplay: false,
                    showlrc: 3,
                    mutex: true,
                    theme: '#ad7a86',
                    mode: 'order',
                    listmaxheight: '360px',
                    music: json.album
                });
                var id = $('.aplayer-list-light input').val();
                // alert('heree');
                load_article(id);
                $(".aplayer-controller").append('<i id="love" onclick="love()" class="icon-heart-empty"></i>');
                ap5.on('play', function(){
                    if(document.getElementById('love')!=undefined) {
                    } else {
                        $(".aplayer-controller").append('<i id="love" onclick="love()" class="icon-heart-empty"></i>');
                    }
                });
            } else {$("#player").append('<p><p>暂未收录</p><a style="padding: 1px 12px;font-size: 10px;min-width: 62px;" class="btn btn-primary" href="<?php echo site_url().'yedeng'.'?page='.($offset-5) ?>"><?php echo '上一页' ?></a></p></p>');}
            $.each(json.list, function(i, item) {
                if (!json.user_id) {
                }
            });
        });
    }

    list();
    function love(){
        var mid = $(".aplayer-list-light input").val();
        $.getJSON("<?php echo base_url('yedeng/love') . '/' ?>" + mid, function(json){
            //收藏图标处理
            if ($.isEmptyObject(json)) {
                return;
            };
            if (json.is_login) {
                if (json.is_love) {
                    if ($(".aplayer-list-light>i").length != 0) {
                        $(".aplayer-list-light i").remove();
                    } else {
                        $(".aplayer-list-light").append('<i style="float:left" id="heart" class="icon-heart"></i>');
                    }
                }                       
            }
        });
    }
</script>