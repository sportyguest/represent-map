var uid;
jQuery(document).ready(function() {
	jQuery("#participado").click(function() {
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				uid = response.authResponse.userID;
				saveFBData(uid);
				var accessToken = response.authResponse.accessToken;
				participarFB(window.location, uid);
			} else {
				FB.login(function(response) {
					if (response.authResponse) {
						uid = response.authResponse.userID;
						saveFBData(uid);
						FB.api('/me', function(response) {
							participarFB(window.location,  uid);
						});
					} else {
						console.log('User cancelled login or did not fully authorize.');
					}
				}, {scope: 'publish_actions, email, user_friends'});
			}
		});
	});
	jQuery("#like").click(function() {
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				uid = response.authResponse.userID;
				var accessToken = response.authResponse.accessToken;
				likeFB(window.location);
			} else {
				FB.login(function(response) {
					if (response.authResponse) {
						FB.api('/me', function(response) {
							likeFB(window.location)
						});
					} else {
						console.log('User cancelled login or did not fully authorize.');
					}
				}, {scope: 'publish_actions, email, user_friends'});
			}
		});
	});
	jQuery("#valorar").click(function() {
		
	});
});
function saveFBData(uid) {
	saveFBUserData();
	saveFBFriends(uid);
}

function saveFBUserData() {
	FB.api("/me?fields=email,name,gender,first_name,last_name,username,link", function(response) {
		var data = {
			'FacebookUser[facebook_id]': response.id,
			'FacebookUser[name]': response.name,
			'FacebookUser[first_name]': response.first_name,
			'FacebookUser[last_name]': response.last_name,
			'FacebookUser[link]': response.link,
			'FacebookUser[username]': response.username,
			'FacebookUser[gender]': response.gender,
			'FacebookUser[email]': response.email
		};
		$.ajax({
			type: 'POST',
			url: 'http://eventosdeportivos.sportyguest.es/yii/facebookUser/ajax',
			data: data,
			success:function(data){
				alert(data); 
			},
			error: function(data) { // if error occured
				alert("Error occured.please try again");
				alert(data);
			},
			dataType:'json'
		});
	});
}

function saveFBFriends(uid) {
	FB.api("/me/friends", function(response) {
		response.uid = uid;
		var friends = response;
		$.ajax({
			type: 'POST',
			url: 'http://eventosdeportivos.sportyguest.es/yii/facebookFriends/ajax',
			data: friends,
			success:function(data){
				alert(data); 
			},
			error: function(data) { // if error occured
				alert("Error occured.please try again");
				alert(data);
			},
			dataType:'json'
		});
	});	
}

function participarFB(url, uid) {
	id = $("#Evento_id").val();
	FB.api(
		'me/sportyguest_eventos:participate',
		'post',
		{
			'sport_event': url,
			'years': ["2000"]
		},
		function(response) {
			console.log(response);
			console.log(response.id);
			// Create a new participation
			var data = {
							evento_id: id, 
							facebook_id: uid, 
							facebook_participacion_id: response.id, 
							year: "2000"
						};
			$.ajax({
				type: 'POST',
				url: 'http://eventosdeportivos.sportyguest.es/yii/eventoParticipacion/ajax',
				data: data,
				success:function(data){
					alert(data); 
				},
				error: function(data) { // if error occured
					alert("Error occured.please try again");
					alert(data);
				},
				dataType:'html'
			});
		}
	);
}

function valorarFB(evento_id) {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			valorar(evento_id, uid);
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					uid = response.authResponse.userID;
					FB.api('/me', function(response) {
						valorar(evento_id, uid);
					});
				} else {
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'publish_actions, email, user_friends'});
		}
	});
}

function valorar(evento_id, uid) {
	var rating = jQuery("#val_general").rateit('value');
	var rating_org = jQuery("#val_organizacion").rateit('value');
	var rating_diff = jQuery("#val_dificultad").rateit('value');
	var rating_route = jQuery("#val_atractivo").rateit('value');
	var rating_price = jQuery("#val_precio").rateit('value');
	var rating_extra = jQuery("#val_actcomplementarias").rateit('value');
	var data = {
					'EventoValoracion[evento_id]': evento_id, 
					'EventoValoracion[facebook_id]': uid, 
					'EventoValoracion[valoracion]': rating,
					'EventoValoracion[valoracion_organizacion]': rating_org,
					'EventoValoracion[valoracion_dificultad]': rating_diff,
					'EventoValoracion[valoracion_recorrido]': rating_route,
					'EventoValoracion[valoracion_precio]': rating_price,
					'EventoValoracion[valoracion_actividad_complementaria]': rating_extra
				};
	// The rating is created in the database and then the rating is post to facebook
	$.ajax({
		type: 'POST',
		url: 'http://eventosdeportivos.sportyguest.es/yii/eventoValoracion/ajax',
		data: data,
		success:function(data){
			alert(data);
			if (data.code == "success") {
				var rating_url = 'http://eventosdeportivos.sportyguest.es/yii/eventoValoracion/view/id/' + data.id;
				FB.api(
					'me/sportyguest_eventos:rating',
					'post',
					{
						'rating': rating_url,
						'sport_event': 'http://eventosdeportivos.sportyguest.es/yii/evento/view/id/' + evento_id
					},
					function(response) {
						console.log(response);
					}
				);
			}
		},
		error: function(data) { // if error occured
			alert("Error occured.please try again");
			alert(data);
		},
		dataType:'json'
	});
}
function likeFB(url) {
	FB.api(
		'me/og.likes',
		'post',
		{
			object: url
		},
		function(response) {
			console.log(response);
		}
	);
}