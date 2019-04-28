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

		$(function() {

		if(getCookie("lastname") != "" && getCookie("lastname") != null && getCookie("firstname") != "" && getCookie("firstname") != null && getCookie("id") != "" && getCookie("id") != null && getCookie("token") != "" && getCookie("token") != null){

			let o = {
				"id": getCookie("id"),
				"token": getCookie("token")
			}

			$.ajax( {
				url: "http://dwarves.iut-fbleau.fr/~ralijaon/fichiersPT/api.php",
				method: "post",
				data: $.param(o),
				dataType: "text",
				success: function(response) {
					if(response != "success"){
						document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
						document.location.href = 'index.html';
					}

				}
			});

		} else {
			document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
			document.location.href = 'index.html';
		}

	});