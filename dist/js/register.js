;(function($){
    var form = $('#register');
    var oGetCode = $('#btn-code');
    var reValidate = $('#validate-dailog'),
        reTxt = reValidate.find('.txt'),
        reCode = reValidate.find('.coder'),
        reBtn = reValidate.find('.btn'),
        reClose = reValidate.find('i');

    var times = 60, timer = null;
    function setTimes(_this, def_txt){
        if( times<=0 ){
            clearInterval(timer);
            _this.removeClass('enbled').removeData('code').text(def_txt);
        }else{
            _this.text(times+'s后再次获取');
        }
        times--;
    }

    oGetCode.on('click', function(){
        var _this = $(this),
            def_txt = _this.text();
        var data = { };
        var country = $('#country-sel'), tel = $('#number');
        data[ tel.attr('name') ] = tel.val();
        data[ country.attr('name') ] = country.val();

        // if( _this.data('code') ){ return false; }
        // if( !_this.data('code') ){
        //  _this.data('code', 1);
        // }
        if ( _this.hasClass('enbled') ) { return false; }

        clearInterval(timer);
        _this.addClass('enbled');

        ajax(_this.attr('href'), data, function(res){
            if( res.code == 1 ){ //code == 1
                if ( res.data.isSend == 1 ) {
                    reValidate.show();
                    var src = reCode.attr('src');
                    reCode.attr('src', src);
                    
                }else{
                    _this.addClass('enbled');
                    setTimes(_this, def_txt);
                    timer = setInterval(function(){
                        setTimes(_this, def_txt);
                    }, 1000);
                    alert(res.msg);
                }
            }else{ //code == 0
                clearInterval(timer);
                alert(res.msg);
                _this.removeClass('enbled').removeData('code').text(def_txt);
            }
        });
        return false;
    });

    form.formx({
        err : '.ele-bd',
        blured : function(obj){
            var _parent = obj.parents('.ele-bd');
            if ( !_parent.hasClass('err') ) {
                _parent.addClass('success');
            }else{
                _parent.removeClass('success');
            }
        },
        saved : function(res){
            if ( res.code == 1 ) {
                alert( res.msg );
                location.href = res.data.href;
            }else{
                alert( res.msg );
            }
        }
    });

    //reValidate
    reCode.on('click', function(){
        var src = $(this).attr('src');
        $(this).attr('src', src);
    });
    reClose.on('click', function(){
        reValidate.hide();
        oGetCode.removeClass('enbled');
    })
    reBtn.on('click', function(){
        var country = $('#country-sel'), tel = $('#number');
        var redata = {code : reTxt.val()};
        var def_txt = oGetCode.text();
        var url = $(this).attr('href');

        redata[ tel.attr('name') ] = tel.val();
        redata[ country.attr('name') ] = country.val();
        ajax(url, redata, function(recode){
            if ( recode.code == 1 ) {
                reValidate.hide();
                reTxt.val('');
                oGetCode.addClass('enbled');
                setTimes(oGetCode, def_txt);
                timer = setInterval(function(){
                    setTimes(oGetCode, def_txt);
                }, 1000);
            }else{
                oGetCode.removeClass('enbled').removeData('code').text(def_txt);
                alert(recode.msg);
            }
        });
        return false;
    });

    //url, data, successFn
    function ajax(url, data, success){
        $.ajax({
            async: false,
            type:'post',
            dataType: 'json',
            data: data,
            url:url,
            success:function(e){
                success && success(e);
            }
        });
    };

})(jQuery);
