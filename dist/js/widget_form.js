;(function($){
    $.fn.getForm = function(type){
        var _this = $(this),
            aTxt = ['input', 'select', 'textarea'],
            _children = _this.find(aTxt.join(',')),
            _res = {},
            str = '';
        function json2str(json){
            var res = ''
            for( str in json ){
                res += '&'+str+'='+json[str];
            }
            return res.substring(1);
        };
        
        _children.each(function(i, ele){
            if( $(ele).attr('name') ){
                _res[ $(ele).attr('name') ] = $(ele).val();
            }
        });
        if( type == 'str' ){
            _res = json2str(_res);
        }
        return _res;
    };
})(jQuery);
/**
 * @name form validate widget
 * @auth sole
 * @time 2015年8月3日
 * @verson 1.0
 * @use $('#form').formx();
*/
/**
* html elements config options
* required          是否验证
* pattern           验证规则，正则表达式
* data-group        验证组，双向验证，常用地方：密码验证
* data-url          远程验证地址
* data-callback     远程验证失败返回的错误信息，如果未定义，则取回服务器返回的信息
* data-msg          验证失败后的提示信息
*/
/**
* formx config options
* errClass      string  为空时候的提示 和 错误提示的 class
* errElem       string  错误添加的元素，默认父级，如果指定了元素，那么默认查找parents('errElem');
* regexped      fn      正则验证完成后执行的回调函数，返回参数：当前验证对象
* urled         fn      远程验证完成后指向的回调函数，返回参数：当前验证对象，服务器返回的结果
* eleClick      fn      元素点击事件，返回参数：当前元素对象
* docClick      fn      document点击事件，返回参数：当前点击元素对象
* saved         fn      保存成功之后要的回调函数，返回参数：服务器数据
* mouseover     fn      在表单上移动的时候执行的函数，返回参数：当前表单所有数据，json格式
* keyup         fn      键盘抬起后执行
* saveBefore    fn      在提交之前要处理数据的函数
*/
;(function($){

    var noop = function(res){ return true; };

    //default options
    var def = {
        errClass : 'err',
        errElem : '',
        blured : noop, 
        eleClick : noop,
        docClick : noop,
        regexped : noop, 
        mouseover : noop, 
        keyup : noop,
        urled : noop,
        saved : noop,
        debug : false,
        saveBefore : noop
    };
    
    $.fn.formx = function(o){
        var opt = $.fn.extend({}, def, o);

        return this.each(function(){

            var oForm = $(this),
                oRequired = oForm.find('input[required], textarea[required]'),
                oTxt = oForm.find('input, textarea'),
                oBtnSave = oForm.find('input[type="submit"]');

            function setSaveBtn(){
                var arr = [];
                var iErr = oForm.find('.'+opt.errClass).length;
                data = oForm.getForm();
                oRequired.each(function(i, ele){
                    if( $.trim(data[ $(ele).attr('name') ]) ){
                        arr.push( $(ele).attr('name') );
                    }
                });

                (oRequired.length==arr.length && !iErr) ? oBtnSave.removeAttr('disabled') : oBtnSave.attr('disabled', 'disabled');
            }

            oRequired.live('blur change', function(){
                var _this = $(this),
                    _datas = _this.data(),
                    _name = _this.attr('name'),
                    _parent = _this.parent(),
                    _re = $.trim( _this.attr('pattern') ),
                    _group = _this.data('group'),
                    _url = _this.data('url'),
                    _msg = _this.data('msg'),
                    _callback = _this.data('callback'),
                    _val = $.trim( _this.val() ),
                    nextEle = _this.next();

                //errElem
                _parent = opt.errElem ? _this.parents(opt.errElem) : _parent;

                function v_empty(){
                    _parent[ (!_val ? 'add' : 'remove') + 'Class' ](opt.errClass);
                    return !_val ? false : true;
                }

                function v_pattern(){
                    
                    var flag = false;
                    var reg = new RegExp(_re);
                    _parent[ (!reg.test(_val) ? 'add' : 'remove') + 'Class' ](opt.errClass);
                    if( !reg.test(_val) ){
                        if (_msg) {
                            flag = false;
                            !nextEle.hasClass('formx-err')?_this.after('<p class="formx-err">'+_msg+'</p>'):'';
                        };
                    }else{
                        flag = true;
                        nextEle.hasClass('formx-err')?nextEle.remove():'';
                        opt.regexped( _this );
                    }

                    return flag;
                    
                }

                function v_url(){
                    var data = {};
                    var flag = false;
                    data[_name] = _val;
                    $.ajax({
                        async: false,
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        url:_url,
                        success:function(res){
                            _parent[ (!res.code ? 'add' : 'remove') + 'Class' ](opt.errClass);
                            if( res.code == 1 ){
                                flag = true;
                                _parent.removeClass(opt.errClass);
                                nextEle.hasClass('formx-err')?nextEle.remove():'';
                            }else{
                                flag = false;
                                _parent.addClass(opt.errClass);
                                !nextEle.hasClass('formx-err')?_this.after('<p class="formx-err">'+(_callback?_callback:res.msg)+'</p>'):'';
                            }
                            opt.urled(_this, res);
                        }
                    });

                    return flag;
                    
                }

                function v_group(){

                    var oGroup = oForm.find('input[data-group="'+_group+'"]');
                    var arr = [];
                    var flag = false;
                    oGroup.each(function(i, ele){
                        if( !$.trim($(ele).val()) ){ arr.push(i); }
                    });

                    if( !arr.length ){
                        if( oGroup.eq(0).val() !== oGroup.eq(1).val() ){
                            flag = false;
                            _parent.addClass(opt.errClass);
                            if (_msg) {
                                !nextEle.hasClass('formx-err')?_this.after('<p class="formx-err">'+_msg+'</p>'):'';
                            };
                        }else{
                            flag = true;
                            nextEle.hasClass('formx-err')?nextEle.remove():'';
                            _parent.removeClass(opt.errClass);
                        }
                    }

                    return flag;

                }
      
                //is empty
                if ( v_empty() ){
                    //pattern
                    if ( _re && v_pattern() ) {
                        //ajax
                        if (_url) {v_url(); }
                        //group
                        if (_group) {v_group();}
                    }
                    if ( !_re ) {
                        //ajax
                        if (_url) {v_url(); }
                        //group
                        if (_group) {v_group();}
                    }
                }
                
                setSaveBtn();

                //callback
                opt.blured( _this );

            }).live('click', function(e){
                var _this = $(this);
                //errElem
                _parent = opt.errElem ? _this.parents(opt.errElem) : _this.parent();

                if( _this.attr('type') == 'checkbox' ){
                    _this.val( _this.attr('checked')?'on':'' );
                    _parent[ (!_this.val() ? 'add' : 'remove') + 'Class' ](opt.errClass);
                }

                e.stopPropagation();
            });

            oTxt.live('click', function(e){
                var _this = $(this);
                opt.eleClick( _this );
                e.stopPropagation();
            }).live('keyup', function(){
                var _this = $(this);
                opt.keyup( _this );
            });

            $(document).on('click', function(e){
                opt.docClick( $(e.target) );
            });

            oForm.on('mousemove', function(){
                setSaveBtn();

                opt.mouseover( data );
            }).on('submit', function(){
                var url = oForm.attr('action'),
                    method = oForm.attr('method'),
                    data = oForm.getForm();

                opt.saveBefore && opt.saveBefore(data);


                if (opt.debug) { window.console && console.log(url, method, data) };

                if( !oBtnSave.attr('disabled') ){
                    $.ajax({
                        async: false,
                        type:method,
                        dataType: 'json',
                        data: data,
                        url:url,
                        success:function(res){
                            opt.saved(res);
                        }
                    });
                }
                return false;
            });
            
        });

    }
    
})(jQuery);