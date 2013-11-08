var url_home = "http://eventosdeportivos.sportyguest.es/";

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
			url: url_home + 'yii/facebookUser/ajax',
			data: data,
			success:function(data){
				console.log(data);
			},
			error: function(data) { // if error occured
				alert("Error occured.please try again");
				console.log(data);
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
			url: url_home + 'yii/facebookFriends/ajax',
			data: friends,
			success:function(data){
				console.log(data); 
			},
			error: function(data) { // if error occured
				alert("Error occured.please try again");
				console.log(data);
			},
			dataType:'json'
		});
	});	
}

function meGustariaParticiparFB(evento_id) {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			uid = response.authResponse.userID;
			saveFBData(uid);
			meGustariaParticipar(evento_id, uid);
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					uid = response.authResponse.userID;
					saveFBData(uid);
					meGustariaParticipar(evento_id, uid);
				} else {
					alert("No podemos realizar esta acción sin Facebook ;(");
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'publish_actions, email, user_friends'});
		}
	});
}

function meGustariaParticipar(evento_id, uid) {
	var data = {
			'EventoMeGustariaParticipar[facebook_id]': uid,
			'EventoMeGustariaParticipar[evento_id]': evento_id
		};
	// The rating is created in the database and then the rating is post to facebook
	$.ajax({
		type: 'POST',
		url: url_home + 'yii/eventoMeGustariaParticipar/ajax',
		data: data,
		success:function(data){
			console.log(data);
			if (data.code == "success") {
				FB.api(
					'me/sportyguest_eventos:would_like_to_assist',
					'post',
					{
						sport_event: url_home + 'yii/evento/view/id/' + evento_id
					},
					function(response) {
						changeImgMeGustaria();
						console.log(response);
					}
				);
			}
		},
		error: function(data) { // if error occured
			alert("Error occured.please try again");
			console.log(data);
		},
		dataType:'json'
	});
}

function participarFB(evento_id) {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			uid = response.authResponse.userID;
			saveFBData(uid);
			participar(evento_id, uid);
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					uid = response.authResponse.userID;
					saveFBData(uid);
					participar(evento_id,  uid);
				} else {
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'publish_actions, email, user_friends'});
		}
	});
}

function participar(evento_id, uid) {
	// TODO: Manage years
	FB.api(
		'me/sportyguest_eventos:participate',
		'post',
		{
			'sport_event': url_home + 'yii/evento/view/id/' + evento_id,
			'years': ["2000"]
		},
		function(response) {
			console.log(response);
			console.log(response.id);
			// Create a new participation
			var data = {
				'EventoParticipacion[evento_id]': evento_id, 
				'EventoParticipacion[facebook_id]': uid, 
				'EventoParticipacion[facebook_participacion_id]': response.id, 
				'EventoParticipacion[year]': "2000"
			};
			$.ajax({
				type: 'POST',
				url: url_home + 'yii/eventoParticipacion/ajax',
				data: data,
				success:function(data){
					changeImgParticipado();
				},
				error: function(data) { // if error occured
					alert("Error occured.please try again");
					console.log(data);
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
			saveFBData(uid);
			valorar(evento_id, uid);
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					uid = response.authResponse.userID;
					saveFBData(uid);
					valorar(evento_id, uid);
				} else {
					alert("No podemos realizar la valoración sin Facebook ;(");
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
		url: url_home + 'yii/eventoValoracion/ajax',
		data: data,
		success:function(data){
			console.log(data);
			if (data.code == "success") {
				var rating_url = url_home + 'yii/eventoValoracion/view/id/' + data.id;
				FB.api(
					'me/sportyguest_eventos:rating',
					'post',
					{
						'rating': rating_url,
						'sport_event': url_home + 'yii/evento/view/id/' + evento_id
					},
					function(response) {
						console.log(response);
					}
				);
			}
		},
		error: function(data) { // if error occured
			alert("Error occured.please try again");
			console.log(data);
		},
		dataType:'json'
	});
}

function like(evento_id, uid) {
	var data = {
		'EventoMeGusta[evento_id]': evento_id, 
		'EventoMeGusta[facebook_id]': uid
	};
	// The rating is created in the database and then the rating is post to facebook
	$.ajax({
		type: 'POST',
		url: url_home + 'yii/eventoMeGusta/ajax',
		data: data,
		success:function(data){
			console.log(data);
		},
		error: function(data) {
			console.log(data);
		},
		dataType:'json'
	});
}

function asistireFB(evento_id) {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			uid = response.authResponse.userID;
			saveFBData(uid);
			asistire(evento_id, uid);
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					uid = response.authResponse.userID;
					saveFBData(uid);
					asistire(evento_id, uid);
				} else {
					alert("No podemos realizar la valoración sin Facebook ;(");
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'email, user_friends'});
		}
	});
}

function asistire(evento_id, uid) {
	var data = {
		'EventoAsistire[evento_id]': evento_id,
		'EventoAsistire[facebook_id]': uid
	}
	$.ajax({
		type: 'POST',
		url: url_home + 'yii/eventoAsistire/ajax',
		data: data,
		success: function(data) {
			changeImgAsistire();
			console.log(data);
		},
		error: function(data) {
			console.log(data);
		},
		dataType:'json'
	});
}

function checkMeGustaria(evento_id) {
	FB.api(
		'me/sportyguest_eventos:would_like_to_assist',
		'get',
		{},
		function(response) {
			console.log(response);
			for (var i = 0; response && response.data && i < response.data.length; i++) {
				if (response.data[i].data.sport_event.url == url_home + "yii/evento/view/id/" + evento_id) {
					changeImgMeGustaria();
				}
			}
		}
	);
}

function checkParticipado(evento_id) {
	FB.api(
		'me/sportyguest_eventos:participate',
		'get',
		{},
		function(response) {
			console.log(response);
			for (var i = 0; response && response.data && i < response.data.length; i++) {
				if (response.data[i].data.sport_event.url == url_home + "yii/evento/view/id/" + evento_id) {
					changeImgParticipado();
				}
			}
		}
	);
}

function changeImgMeGustaria() {
	jQuery("#img_megustaria").attr("src", "images/heart_on.png");
}
function changeImgParticipado() {
	jQuery("#img_participado").attr("src", "images/medal_on.png");
}
function changeImgAsistire() {
	jQuery("#img_asistire").attr("src", "images/tick_on.png");
}