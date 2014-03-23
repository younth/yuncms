/*
*Jquery 表单验证和表单Ajax提交合体插件
*需要jquery1.4或者以上版本支持
*By 甘强 2011/03/17
*1.0版
*插件官方地址：http://www.skygq.com/2010/12/29/skygq-check-ajax-form-plugins/
*/
;(function($){
	$.fn.skygqCheckAjaxForm = function(settings){
		//如果选择器选择的不是form，则阻止插件继续运行
		if( !this.is("form") ) return;
		var form_id = this.selector.substring(1);
		settings = $.extend({}, $.skygqCheckAjaxForm.defaultSettings, settings || {});
		// 计算skygqCheckAjaxForm的根路径
		if (!settings.root) {
			$('script').each(function(a, tag) {
				miuScript = $(tag).get(0).src.match(/(.*)jquery\.skygqCheckAjaxform\.1\.5(\.mini)?\.js$/);
				if (miuScript !== null) settings.root = miuScript[1];
			});
		}
		//设定ajax loading的图片地址
		if (!settings.ajaxImage) settings.ajaxImage = settings.root + 'images/loading.gif';



		//装载ajax loading图片和遮罩层
		if ($("#skygqCheckAjaxFormOverlay").length == 0){
			$("body").append('<div id="skygqCheckAjaxFormOverlay" style="display:none;text-align:center;position:absolute;z-index:2000;left:0;top:0;background:black;cursor:hand"><img src="'+settings.ajaxImage+'" id="skygqCheckAjaxForm_image"></div>');
		}
		settings.ajaxImageObj = $("#skygqCheckAjaxForm_image");
		settings.overLayObj	= $("#skygqCheckAjaxFormOverlay");
		var	msg = "",
			formObj = this,
			checkRet = true,
			rule = $.skygqCheckAjaxForm.rule,
			isAll,
			tipname = function(namestr){
				namestr = namestr.replace(/(\.|\[|\])/g,'');
				return form_id + "tip_" + namestr.replace(/([a-zA-Z0-9])/g,"-$1");
			},
			//规则类型匹配检测
			typeTest = function(){
				var result = true,args = arguments;
				if(rule.hasOwnProperty(args[0])){
					var t = rule[args[0]][0], v = args[1];
					result = args.length>2 ? t.apply(arguments,[].slice.call(args,1)):($.isFunction(t) ? t(v) :t.test(v));
				}
				return result;
			},
			//错误信息提示
			showError = function(fieldObj,filedName,warnInfo){
				checkRet = false;
				var tipObj = $("#"+tipname(filedName));
				if(tipObj.length>0) tipObj.remove();
				var tipPosition = fieldObj.next().length>0 ? fieldObj.nextAll(":last"):fieldObj;
				tipPosition.after("<span class='Wrong' id='"+tipname(filedName)+"'> "+warnInfo+" </span>");
				if(settings.isAlert && isAll) msg += "\n" + warnInfo;
			},

			//正确信息提示
			showRight = function(fieldObj,filedName,SuccessInfo){
				var tipObj = $("#"+tipname(filedName));
				if(tipObj.length>0) tipObj.remove();
				var tipPosition = fieldObj.next().length>0 ? fieldObj.nextAll(":last"):fieldObj;
				if (!SuccessInfo){
					SuccessInfo = '填写正确';
				}
				tipPosition.after("<span class='Correct' id='"+tipname(filedName)+"'> "+ SuccessInfo +" </span>");
			},
			//focus时提示
			showExp = function(obj){
				var i = obj, fieldObj = $("[name='"+i.name+"']",formObj[0]);
				var tipObj = $("#"+tipname(i.name));
				if(tipObj.length>0) tipObj.remove();
				var tipPosition = fieldObj.next().length>0 ? fieldObj.nextAll(":last"):fieldObj;
				if (i.focusMsg){
					tipPosition.after("<span class='Exp' id='"+tipname(i.name)+"'>"+ i.focusMsg +"</span>");
				}
			},
			//匹配对比值的提示名
			findTo = function(objName){
				var find;
				$.each(settings.items, function(){
					if(this.name == objName && this.simple){
						find = this.simple;	return false;
					}
				});
				if(!find) find = $("[name='"+objName+"']")[0].name;
				return find;
			},
			//ajax验证
			ajax = function (obj,fv,field){
				var i = obj, fieldObj = $("[name='"+i.name+"']",formObj[0]);
				var tipObj = $("#"+tipname(i.name));
				if(tipObj.length>0) tipObj.remove();
				var tipPosition = fieldObj.next().length>0 ? fieldObj.nextAll().eq(this.length):fieldObj.eq(this.length - 1);
				tipPosition.after("<span class='Exp' id='"+tipname(i.name)+"'>检测中......</span>");
				fv = encodeURI(fv);
				$.ajax({
			        type	: obj.ajax.method || 'GET',
			        url		: obj.ajax.url,
			        data	: obj.name+"="+fv,
			        cache	: false,
			        async	: !isAll,// false使用同步方式执行AJAX，true使用异步方式执行ajax
			        success	: function(data){
						if (data == 1){
							showRight(field,obj.name,obj.ajax.success_msg);
						}
						else if(data == 0){
							showError(field ,obj.name, obj.ajax.failure_msg);
						}else{
							showError(field ,obj.name, data);
						}
			        }
				});
			},
			//单元素验证
			fieldCheck = function(item){
				var i = item, field = $("[name='"+i.name+"']",formObj[0]),filed_length = field.length;
				if(filed_length == 0) return;
				var warnMsg,
					fv = $.trim(field.val()),
					isRq = typeof i.require ==="boolean" ? i.require : true;
				if (filed_length == 1){
					if( isRq && ((field.is(":radio")|| field.is(":checkbox")) && !field.is(":checked"))){
						warnMsg =  i.message|| "请选择" + i.simple;
						showError(field ,i.name, warnMsg);
					}else if(isRq && fv == "" ){
						warnMsg =  i.message|| ( field.is("select") ? "请选择" :"请填写" ) + i.simple;
						showError(field ,i.name, warnMsg);
					}else if(fv != ""){
						if(i.min || i.max){
							var len = fv.length, min = i.min || 0, max = i.max;
							warnMsg =  i.message || (max? i.simple + "长度范围应在"+min+"~"+max+"之间":i.simple + "长度应大于"+min);
							if( (max && (len>max || len<min)) || (!max && len<min) ){
								showError(field ,i.name, warnMsg);	return;
							}
						}
						if(i.type){
							var matchVal = i.to ? $.trim($("[name='"+i.to+"']",formObj[0]).val()) :i.value;
							var matchRet = matchVal ? typeTest(i.type,fv,matchVal) :typeTest(i.type,fv);
							warnMsg = i.message|| i.simple + rule[i.type][1];
							if(matchVal && i.simple) warnMsg += (i.to ? findTo(i.to) +"的值" :i.value);
							if(!matchRet){
								showError(field ,i.name, warnMsg);return;
							}else{
								showRight(field,i.name);
							}
						}
						if (i.between){
							var from = i.between[0],to = i.between[1];
							warnMsg = i.message || i.simple + "的值必须在" + from + "和" + to + "之间";
							if (fv >= +from && fv <= +to){
								showRight(field,i.name);
							}else{
								showError(field ,i.name, warnMsg);return;
							}
						}
						if (i.ajax){
							ajax(i,fv,field);
						}else{
							showRight(field,i.name);
						}
					}
				}else{
					if (field.is("input:checkbox")){
						var checked_count = 0;
						field.each(function(){
							if (this.checked == true){
								checked_count ++;
							}
						});
						if(i.checked_limit){
							var min = i.checked_limit[0] || 1, max = i.checked_limit[1] || null;
							warnMsg = i.message || min==max?"请必须选择"+min+"项"+i.simple:(max? "请选择"+i.simple + min+"到"+max+"项目":"请至少选择" +min + "项" + i.simple);
							if( (max && (checked_count>max || checked_count<min)) || (!max && checked_count<min) ){
								showError(field ,i.name, warnMsg);	return;
							}else{
								showRight(field,i.name,'正确');
							}
						}
					}
				}
			},
			//元素组验证
			validate = function(){
				checkRet = true;
				$.each(settings.items, function(){
					isAll=true; fieldCheck(this);
				});
				if(settings.isAlert && msg != ""){
					alert(msg);	msg = "";
				}
				return checkRet;
			};
			//单元素事件绑定
			$.each(settings.items, function(){
				var field = $("[name='"+this.name+"']",formObj[0]);
				var obj = this,
				toExp = function(){showExp(obj);},
				toCheck = function(){ isAll=false; fieldCheck(obj);};
				if(field.is(":file") || field.is("select")){
					field.change(toCheck).focus(toExp);
				}else{
					field.blur(toCheck).focus(toExp);
				}
			});
			return this.each(function(){
				//提交事件绑定
				if(settings.isAjaxSubmit) {
					formObj.submit(function(){
						if (validate()){//验证通过-ajax提交数据
							if (settings.isBg){
								$.fn.skygqCheckAjaxForm.setPosition(formObj,settings);
							}
							$('input:submit',formObj).attr('disabled','disabled');
							formObj.skygqajaxSubmit(settings);
						}
						return false;
					});
				}else{//非ajax提交数据
					formObj.submit(validate);
				}
			});
	};
	$.skygqCheckAjaxForm = function(){};

	$.skygqCheckAjaxForm.defaultSettings = {
		items				: [],
		isAlert				: false,
		isAjaxSubmit		: false,
		success				: $.noop,
		isBg				: true,
		clearForm			: true,
		root				: '',
		ajaxImage			: null
	};

	$.skygqCheckAjaxForm.rule	= {
		"eng" 		: [/^[A-Za-z]+$/,"只能输入英文"],
		"chn" 		: [/^[\u0391-\uFFE5]+$/,"只能输入汉字"],
		"mail" 		: [/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/,"格式不正确"],
		"url" 		: [/^http[s]?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/,"格式不正确"],
		"currency" 	: [/^\d+(\.\d+)?$/,"数字格式有误"],
		"number" 	: [/^\d+$/,"只能为数字"],
		"int" 		: [/^[0-9]{1,30}$/,"只能为整数"],
		"double" 	: [/^[-\+]?\d+(\.\d+)?$/,"只能为带小数的数字"],
		"username" 	: [/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){3,19}$/,"用户名不合法"],
		"password" 	: [/^(\w){6,20}$/,"只能为数字和英文及下划线的组合，6-20个字符"],
		"safe" 		: [/>|<|,|\[|\]|\{|\}|\?|\/|\+|=|\||\'|\\|\"|:|;|\~|\!|\@|\#|\*|\$|\%|\^|\&|\(|\)|`/i,"不能有特殊字符"],
		"dbc" 		: [/[ａ-ｚＡ-Ｚ０-９！＠＃￥％＾＆＊（）＿＋｛｝［］｜：＂＇；．，／？＜＞｀～　]/,"不能有全角字符"],
		"qq" 		: [/[1-9][0-9]{4,}/,"格式不正确"],
		"date" 		: [/^((((1[6-9]|[2-9]\d)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((1[6-9]|[2-9]\d)\d{2})-(0?[13456789]|1[012])-(0?[1-9]|[12]\d|30))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-))$/,"格式不正确"],
		"telephone" : [/^1\d{10}$/,"格式不正确"],
		"zipcode" 	: [/^[1-9]\d{5}$/,"格式不正确"],
		"bodycard" 	: [/^((1[1-5])|(2[1-3])|(3[1-7])|(4[1-6])|(5[0-4])|(6[1-5])|71|(8[12])|91)\d{4}((19\d{2}(0[13-9]|1[012])(0[1-9]|[12]\d|30))|(19\d{2}(0[13578]|1[02])31)|(19\d{2}02(0[1-9]|1\d|2[0-8]))|(19([13579][26]|[2468][048]|0[48])0229))\d{3}(\d|X|x)?$/,"格式不正确"],
		"ip" 		: [/^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/,"IP不正确"],
		// 函数规则
		"eq"		: [function(arg1,arg2){ return arg1==arg2 ? true:false;},"必须等于"],
		"gt"		: [function(arg1,arg2){ return arg1>arg2 ? true:false;},"必须大于"],
		"gte"		: [function(arg1,arg2){ return arg1>=arg2 ? true:false;},"必须大于或等于"],
		"lt"		: [function(arg1,arg2){ return arg1<arg2 ? true:false;},"必须小于"],
		"lte"		: [function(arg1,arg2){ return arg1<=arg2 ? true:false;},"必须小于或等于"]
	};
	$.skygqCheckAjaxForm.extendRemove = function(target, props) {
		$.extend(target, props);
		for (var name in props)
			if (props[name] == null || props[name] == undefined)
				target[name] = props[name];
		return target;
	};
	$.skygqCheckAjaxForm.addRules = function(settings) {
		$.skygqCheckAjaxForm.extendRemove($.skygqCheckAjaxForm.rule, settings || {});
		return this;
	};

	$.fn.skygqCheckAjaxForm.setPosition = function(formObj,settings){
		var form_position = formObj.offset();
		settings.overLayObj.css({
			'width' : formObj.outerWidth(),
			'height': formObj.outerHeight(),
			'top'	: form_position.top,
			'left'	: form_position.left,
			'opacity':'0.5'
		}).fadeIn();
		var image_h = settings.ajaxImageObj[0].height;
		var marginTop = parseInt((formObj.outerHeight() - image_h)/2,10);
		if (settings.ajaxImage) settings.ajaxImageObj.css('marginTop',marginTop);
	};
	$.fn.skygqajaxSubmit = function(options) {
		if (!this.length) {	return this;}
		return this.each(function(){
			var $form = $(this), callbacks = [];
			var url = $.trim($form.attr('action'));
			if (url) url = (url.match(/^([^#]+)/)||[])[1];// 获取url中“#”字符前面的地址
			url = url || window.location.href || '';
			options = $.extend(true, {
				url		:  url,
				type	: $form.attr('method') || 'GET',
				dataType:'html'
			}, options);

			var q = $form.serialize();

			if(options.type.toUpperCase() == 'GET') {
				options.url += (options.url.indexOf('?') >= 0 ? '&' : '?') + q;
				options.data = null;
			}else{
				options.data = q;
			}

			if (options.clearForm) {
				callbacks.push(function() { $form.clearForm(); });
			}

			callbacks.push(function(){
				$.fn.removeBg($form);
			});

			if (options.success) {
				callbacks.push(options.success);
			}

			options.success = function(data, status, xhr) {
				var context = options.context || options;
				for (var i=0, max=callbacks.length; i < max; i++) {
					callbacks[i].apply(context, [data, status, xhr || $form, $form]);
				}
			};
		   	$.ajax(options);
		});
	};

	$.fn.removeBg = function($form){
		$('#skygqCheckAjaxFormOverlay').fadeOut();
    	$('input:submit',$form[0]).removeAttr('disabled');
	};

	$.fn.clearForm = function() {
		return this.each(function() {
			$('input,select,textarea', this).clearFields();
		});
	};

	$.fn.clearFields = function() {
		return this.each(function() {
			var t = this.type, tag = this.tagName.toLowerCase();
			if (t == 'text' || t == 'password' || tag == 'textarea') {
				this.value = '';
			}
			else if (t == 'checkbox' || t == 'radio') {
				this.checked = false;
			}
			else if (tag == 'select') {
				this.selectedIndex = -1;
			}
		});
	};
})(jQuery);