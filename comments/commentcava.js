$(function() {

	/*
	* Use a relative or a full path if you prefer
	* a full path will work better if you do some url rewriting
	*/
	var gurl = "/comments/commentcava.php";

	$.ajax({

	url: gurl,
	data: {
		a: 'g',
		url: document.URL
	},
	type: "GET",
	dataType : "json",

	success: function( json ) {

		for (var i=0; i<json.length; i++) {
			if (i == 0) {
				$('#comments').html('<div class="comment" style="display:none"><span class="comment_user">'+ json[i].author + '</span><div class="comment_message">'+ json[i].message + '</div></div>');
			}
			else {
				$('#comments').append('<div class="comment" style="display:none"><span class="comment_user">'+ json[i].author + '</span><div class="comment_message">'+ json[i].message + '</div></div>');	
			}
		}
		if (json.length == 0) {
			$('#comments').html('<div class="comment" style="font-size:200%;line-height:0.5;">~</div>');
		}
	},

	error: function( xhr, status ) {
		$('#comments').html('<div class="comment">Erreur au chargement des commentaires</div>');
	},

	complete: function( xhr, status ) {
		$('#comments').append('<a id="comment_addcomment" class="comment_addcomment" style="display:none" href="javascript:toggle(\'comment_form\');toggle(\'comment_addcomment\')">Réagir à ce billet</a><form method="post" action="' + gurl + '?a=p" id="comment_form" class="comment_form" style="display:none"><input type="hidden" value="' + document.URL + '" name="url"><div class="comment_inputuser">nouveau commentaire de <input type="text" value="" placeholder="votre pseudonyme" size="20" name="name"></div><div class="comment_inputmessage"><textarea placeholder="Votre commentaire…" value="" name="comment" cols="32" rows="2"></textarea><small style="color:#666;">le formatage de votre texte se fait en HTML.</small></div><div class="comment_recaptcha"><input type="text" placeholder="Copiez le code" name="captcha"><a title="Recharger l\'image" href="javascript:reloadCaptcha()"><img id="captcha" alt="Copiez le code" src="' + gurl + '?a=c"></a><br><small style="color:#666;">les lettres du code sont en majuscule.</small></div><div class="comment_submit"><input type="submit" value="Envoyer" name="submit"></div></form>')
		
		$(".comment").each(function(i) {
			$(this).delay(200*i).fadeIn();
		});

		$(".comment_addcomment").each(function(i) {
			$(this).delay(1000*i).fadeIn();
		});
	}

	});
});

function toggle(theobj) {
	var obj = document.getElementById(theobj);

	if (obj.style.display == 'none') {
		obj.style.display = 'block';
	}
	else {
		obj.style.display = 'none';
	}
}

function reloadCaptcha() {
	var obj = document.getElementById('captcha');
	obj.src = gurl + '?a=c&rand=' + Math.random();
}
