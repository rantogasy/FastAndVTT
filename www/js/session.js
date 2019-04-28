	function setCookie(cname, cvalue, exs) {
		var d = new Date();
		d.setTime(d.getTime() + (exs * 60 * 1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	  function tokenize(max){

    const characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890".split("");
    
    let to_return = "";
    
    for ( let i = 0; i < max; i++ ){

      const random = (Math.random() * (characters.length - 1)).toFixed(0);

      to_return = to_return + characters[random];

    }
    
    return to_return;
  }


