var cssSwitcher = {

	COOKIE_PREFIX: "cssSwitcher_",
	CLASS_FILTER: ".fontSize",
	
	switchCSS : function(clsName, title, saveToCookie){
		this._changeCSS(clsName, "title", title);
		if(saveToCookie){
			this._setCookie(this.COOKIE_PREFIX + clsName, title, 30 * 86400);
		}
	},

	switchDefaultCSS : function(clsName, saveToCookie){
		this._changeCSS(clsName, 'rel', 'stylesheet');
		if(saveToCookie){
			this._removeCookie(this.COOKIE_PREFIX + clsName);
		}
	},

	restoreAll : function(){
		var cookies = this._getCookies();
		for(var name in cookies){
			if(name.indexOf(this.COOKIE_PREFIX) == 0){
				var cName = name.substr(this.COOKIE_PREFIX.length);
				this.switchCSS(cName, cookies[name], false);
			}
		}
	},
	
	restore : function(clsName){
		var cookies = this._getCookies();
		for(var name in cookies){
			if(name == this.COOKIE_PREFIX + clsName){
				this.switchCSS(clsName, cookies[name], false);
				return;
			}
		}
		this.switchDefaultCSS(clsName);
	},

	getCurrentCSSTitle : function(clsName) {
		var nlLink = $("link").filter(this.CLASS_FILTER);
		for(var i=0; i<nlLink.length; i++){
			var elemLink = nlLink.get(i);
			if (! elemLink.disabled) {
				return elemLink.getAttribute("title");
			}
		}
		return null;
	},
	
	_changeCSS : function( clsName, targetAttr, checkAttr ){
		var nlLink = $("link").filter(this.CLASS_FILTER);
		for(var i=0; i<nlLink.length; i++){
			var elemLink = nlLink.get(i);
			elemLink.disabled = true;
			if(elemLink.getAttribute(targetAttr) == checkAttr){
				elemLink.disabled = false;
			}
		}
	},
	
	_getCookie : function(cookieName){
		var result = null;
		for (var i = 0; i < document.cookie.split('; ').length; i++){
			var crumb = document.cookie.split('; ')[i].split('=');
			if (crumb[0] == cookieName && crumb[1] != null)
			{
				result = crumb[1];
				break;
			}
		}
	
		if((navigator.userAgent.toLowerCase().indexOf("opera") != -1) && result != null){
			result = result.replace(/%22/g, '"');
		}
		return result;
	},
	
	_getCookies : function(){
		var isOpera = (navigator.userAgent.toLowerCase().indexOf("opera") != -1);
		
		var results = new Object();
		var cookies = document.cookie.split('; ');
		for (var i = 0; i < cookies.length; i++){
			var crumb = cookies[i].split('=');
			var name = crumb[0];
			if(isOpera){
				results[name] = crumb[1].replace(/%22/g, '"');
			}
			else{
				results[name] = crumb[1];
			}
		}
		return results;
	},
	
	_setCookie : function(cookieName, cookieValue, sec){
		if(navigator.userAgent.toLowerCase().indexOf("opera") != -1){
			cookieValue = cookieValue.replace(/"/g, "%22");
		}
		var date = new Date();
		var expires = '';
		if(sec != null){
			date.setTime(date.getTime() + (sec * 1000));
			expires = '; expires=' + date.toGMTString();
		}
		document.cookie = cookieName + '=' + cookieValue + expires + '; path=/';
	},
	
	_removeCookie : function(cookieName){
		document.cookie = cookieName + '=;expires=Thu, 01-Jan-1970 00:00:01 GMT; path=/';
	}
};

cssSwitcher.restoreAll();
