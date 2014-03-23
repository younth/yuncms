var FixedBox=function(el){
		this.element=document.getElementById(el); 
		this.element2=el; 
		
		this.BoxY=getXY(this.element).y;
	}
	FixedBox.prototype={
		setCss:function(){
			var windowST=(document.compatMode && document.compatMode!="CSS1Compat")? document.body.scrollTop:document.documentElement.scrollTop||window.pageYOffset;
			if(windowST>this.BoxY){
				if (this.element2 == 'toolBackTop')
				{
					
					this.element.style.cssText="position:fixed; bottom:80px;width:150px;margin:0px auto;";
				}else{
					this.element.style.cssText="position:fixed; top:0px; width:100%;background:url(./images/nav_bg.gif) repeat-x center; margin:0px auto;";
				}
			}else{
				if (this.element2 == 'toolBackTop')
				{
					this.element.style.cssText="display:none";
				}else{
					this.element.style.cssText="";
				}
			}
		}
	};
	//添加事件
	function addEvent(elm, evType, fn, useCapture) {
		if (elm.addEventListener) {
			elm.addEventListener(evType, fn, useCapture);
		return true;
		}else if (elm.attachEvent) {
			var r = elm.attachEvent('on' + evType, fn);
			return r;
		}
		else {
			elm['on' + evType] = fn;
		}
	}
	//获取元素的XY坐标；
	function getXY(el) {
        return document.documentElement.getBoundingClientRect && (function() {//取元素坐标，如元素或其上层元素设置position relative
            var pos = el.getBoundingClientRect();
            return { x: pos.left + document.documentElement.scrollLeft, y: pos.top + document.documentElement.scrollTop };
        })() || (function() {
            var _x = 0, _y = 0;
            do {
                _x += el.offsetLeft;
                _y += el.offsetTop;
            } while (el = el.offsetParent);
            return { x: _x, y: _y };
        })();
    }
	//实例化；
	var divA=new FixedBox("divWatermark");
	var divB=new FixedBox("toolBackTop");
    	addEvent(window,"scroll",function(){
		divA.setCss();
		divB.setCss();
	 
	});