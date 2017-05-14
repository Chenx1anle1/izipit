//jQuery upload
(function($){var noop=function(){return true};var frameCount=0;$.uploadDefault={url:'',fileName:'Filedata',dataType:'json',params:{},onSend:noop,onSubmit:noop,onComplate:noop};$.upload=function(options){var opts=$.extend(jQuery.uploadDefault,options);if(opts.url==''){return}var canSend=opts.onSend();if(!canSend){return}var frameName='upload_frame_'+(frameCount++);var iframe=$('<iframe style="width:0; height:0;overflow:hidden;" />').attr('name',frameName);var form=$('<form method="post" style="display:none;" enctype="multipart/form-data" />').attr('name','form_'+frameName);form.attr("target",frameName).attr('action',opts.url);var formHtml='<input type="file" name="'+opts.fileName+'" onchange="$.onChooseFile(this)">';for(key in opts.params){formHtml+='<input type="hidden" name="'+key+'" value="'+opts.params[key]+'">'}form.append(formHtml);iframe.appendTo("body");form.appendTo("body");form.submit(opts.onSubmit);iframe.load(function(){var contents=$(this).contents().get(0);var data=$(contents).find('body').text();if('json'==opts.dataType){data=$.parseJSON(data)}opts.onComplate(data);setTimeout(function(){iframe.remove();form.remove()},5000)});var fileInput=$('input[type=file][name='+opts.fileName+']',form);fileInput.click();$.onChooseFile=function(fileInputDOM){var form=$(fileInputDOM).parent();form.submit()}}})(jQuery);

//input 初始化
$('input.ajax_upload').each(function(){
    var dataimg = $(this).val();
    var datafor = $(this).attr('name');
    var datatip = $(this).data('tip');
    var thumb = $(this).data('thumb');
    var path = '/uploads/';
    var npath = $(this).data('path');
    $(this).wrap('<a class="vbt_ajax_upload" href="javascript:;" data-img="'+dataimg+'" data-for="'+datafor+'" data-thumb="'+thumb+'"></a>');
    $(this).after(datatip+'<span>点击上传图片</span>');
    if (npath){
        path = path + npath;
    }else{
        path = path + 'image';
    }
    if (thumb){
        $(this).after('<img src="'+path+'/'+thumb+'" width="100%">');
    } else if (dataimg){
        $(this).after('<img src="'+path+'/'+dataimg+'" width="100%">');
    }
});

//绑定上传事件
$('a.vbt_ajax_upload').on('click', function(e){
    var _this = $(this);
    $.upload({
        url: $('#vbt_ajax_upload_url').val()+'?fileinput='+_this.data('for'),
        fileName: 'Filedata',
        dataType: 'json',
        onComplate: function(data) {
            //console.log(data);
            _this.find('img').remove();
            _this.find('input').val(data.file_name);
            _this.prepend('<img src="'+data.img_src+'" width="100%" />');
        }
    });
    return false;
});