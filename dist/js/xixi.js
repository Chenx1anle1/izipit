$(function() {
	var oContainer = $('#picture');
	var iCells = 0;
	var imageWidth = 220;
	var iWidth = 244;
	var iSpace = 20;
	var iOuterWidth = iWidth + iSpace;
	var arrT   = [];
	var arrL   = [];
	var iPage  = 1;
	var iBtn   = true;
	var iColor = "";
	var pUrl   = GetImageURL + "/";
	var sUrl   = "";
	var maxH   = 0;

	function fRandomBy(under, over){
	    switch(arguments.length){
	        case 1: return parseInt(Math.random()*under+1);
	        case 2: return parseInt(Math.random()*(over-under+1) + under);
	        default: return 0;
	    }
	}
    
	function setCell() {
		var widthstr = $(".container").css("width");
		if (widthstr) {
			var width    = widthstr.substring(0, widthstr.length -2);
			iCells = Math.floor(width / iOuterWidth);
		} else {
			iCells = Math.floor($(window).innerWidth() / iOuterWidth);
		}
		if (iCells < 1) {
			iCells = 1;
		}
		oContainer.css('width', iCells * iOuterWidth - iSpace);
	}

	setCell();
	
	for (var i=0; i<iCells; i++) {
		arrT[i] = 0;
		arrL[i] = iOuterWidth * i;
	}

	function getData() {
		if (!iBtn) {
			return ;
		}
		iBtn = false;
		sUrl = pUrl + iPage;
		iPage++;
		$.getJSON(sUrl, function(jData) {
			if ($.isEmptyObject(jData)) {
				return;
			};
			$('#loader').show();
			$.each(jData, function(index, obj) {

				var viewUrl = Home + 'view/' + obj.viewid;
				var userUrl = Home + '/' + obj.user;
				
				var objuser =obj.user;
				if(obj.me == obj.user){objuser=' is me !';}//判断用户是否为登录用户 是则 is me！ 在数组里添加了'me' =>$this->user, 

//--------------------------------------------------------------加了class
				var oDiv = $('<div>');

				var iHeight   = obj.height * (imageWidth / obj.width) + 45;
				var _index = getMin();
				oDiv.css({
					left	:	arrL[_index],
					top		:	arrT[_index]
				});
				arrT[_index] += iHeight + iSpace;
				oDiv.css({
					width   : iWidth,
					height  : iHeight
				});
				oDiv.css("position","absolute");
				oContainer.append(oDiv);		
/////////////////////			
				var labela = $('<label>')
				labela.css("opacity",0)
				oDiv.append(labela);

				var aa = $('<a>');
				aa.attr('href',Home+'user/picture/'+obj.user)
				aa.html("<a>" + objuser + "</a>");	
				aa.css("margin-left",0);
				labela.append(aa);
/////////////////////			

				var aa2 = $('<a>');
				aa2.attr('href',Home+'user/picture/'+obj.user)
				aa2.html("<a>" + obj.time + "</a>");	
				//aa2.css("float",'right');
				aa2.css("margin-left",20);
				aa2.css("font-size",4);
				//aa2.css("font-color",'gray');


				labela.append(aa2);
/////////////////////

				var section = $('<section>');
				section.addClass("post-featured-image");
				oDiv.append(section);
				var imageUrl = obj.pic;

/////////////////////
				var viewAs = $('<a>');
				viewAs.attr('href', viewUrl);
				viewAs.attr('target', "_black");
				viewAs.attr('title', obj.name + "-收藏量-" + obj.love);

				viewAs.addClass("thumbnail");
				section.append(viewAs);
/////////////////////

				var oImg = $('<img />');

				oImg.css("width","100%");

				var objImg = new Image();
				objImg.onload = function() {
					oImg.attr('src', this.src);
				}
				objImg.src = obj.url;
				viewAs.append(oImg);


				viewAs.addClass("thumbnail");
				section.append(viewAs);
	
				viewAs.addClass("thumbnail");
				section.append(viewAs);


				var boxAs = $('<a>');

				boxAs.attr('type', "button");

				boxAs.addClass("btn btn-default btn-circle");

				boxAs.css("opacity",0);

				boxAs.css("margin-top",-iHeight);

				boxAs.css("margin-left",40);

				boxAs.attr('href', imageUrl);

				boxAs.attr('data-lightbox', "picture");

				boxAs.attr('data-title', obj.text);

				oDiv.append(boxAs);

				var boxIcon = $('<i>');

				boxIcon.addClass('icon-search');

				boxAs.append(boxIcon);



				var likeButton = $('<button>');

				likeButton.attr("id","likeButton"+obj.id);

				likeButton.addClass("btn btn-circle");

				if (obj.is_like) {
					likeButton.addClass("btn-info");
				} else{
					likeButton.addClass("btn-default");
				}

				likeButton.css("opacity",0);

				likeButton.css("margin-top",-iHeight);

				likeButton.css("margin-left",37);

				var likeStr = "Like('" + obj.id + "','" + obj.url + "')";

				likeButton.attr("onClick",likeStr);
				likeButton.attr("mouseover","set('" + obj.id  + "')");

				oDiv.append(likeButton);

				var likeIcon = $('<i>');

				likeIcon.addClass('icon-thumbs-up');

				likeButton.append(likeIcon);



				var collectButton = $('<button>');

				collectButton.attr("id","collectButton"+obj.id);

				collectButton.addClass("btn btn-circle");

				if (obj.is_love) {
					collectButton.addClass("btn-info");
				} else{
					collectButton.addClass("btn-default");
				}

				collectButton.css("opacity",0);

				collectButton.css("margin-top",-iHeight);

				collectButton.css("margin-left",37);

				var collectStr = "Love('" + obj.id + "')";

				collectButton.attr("onClick",collectStr);

				oDiv.append(collectButton);

				var collectIcon = $('<i>');

				collectIcon.addClass('icon-heart-empty');

				collectButton.append(collectIcon);


				oDiv.bind('mouseenter', function() {
  					collectButton.css('opacity','0.9');
  					likeButton.css('opacity','0.9');
  					boxAs.css('opacity','0.9');
					labela.css('opacity','0.9');

				});

				oDiv.bind('mouseleave', function() {
  					collectButton.css('opacity','0');
  					likeButton.css('opacity','0');
  					boxAs.css('opacity','0');
					labela.css('opacity','0');

				});

				setTimeout(function() {
					$('#loader').hide();
				},1000)
				iBtn = true;
			})
		});
	}

	getData();

	function getMin() {
		var v = arrT[0];
		var _index = 0;
		
		for (var i=1; i<arrT.length; i++) {
			if (arrT[i] < v) {
				v = arrT[i];
				_index = i;
			}
		}
		return _index;
	}
	
	$(window).on('scroll', function() {
		if (maxH <= $(window).scrollTop()) {
			maxH = $(window).scrollTop();
		}

		var _index =getMin();
		var iH = $(window).scrollTop() + $(window).innerHeight();
		if (arrT[_index] + 50 < iH) {
			getData();
		}
	})
	
	$(window).on('resize', function() {
		var iLen = iCells;
		setCell();
		if (iLen == iCells) {
			return ;
		}
		arrT = [];
		arrL = [];
		for (var i=0; i<iCells; i++) {
			arrT[i] = 0;
			arrL[i] = iOuterWidth * i;
		}
		oContainer.find('div').each(function() {
			
			var _index = getMin();

			$(this).animate({
				left	:	arrL[_index],
				top		:	arrT[_index]
			}, 1000);
			arrT[_index] += $(this).height() + 12;
			
		});
	})
})
