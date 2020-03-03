$(document).ready(function() {

	$('#form_connexion').submit(function() {
		var email = $("#email").val();
		var password = $("#password").val();
		if(email=='' || password=='') {
			alert("Merci de remplir tous les champs.");
			return false;
		}
	});

	$('#form_inscription').submit(function() {
		var name = $("#name").val();
		var firstname = $("#firstname").val();
		var email = $("#email").val();
		var birthday = $("#birthday").val();
		var password = $("#password").val();
		var password_confirm = $("#password_confirm").val();
		if(name=='' || firstname=='' || email=='' || birthday=='' || password=='' || password_confirm=='') {
			alert("Merci de remplir tous les champs.");
			return false;
		}
	});

	$('#form_reset').submit(function() {
		var email = $("#email").val();
		if(email=='') {
			alert("Merci de renseigner l'addresse email.");
			return false;
		}
	});

	$('#form_location').submit(function() {
		var debut = $("#debut").val();
		var fin = $("#fin").val();
		var km_max = $("#km_max").val();
		if(debut=='' || fin =='' || km_max =='') {
			alert("Merci de remplir tous les champs.");
			return false;
		}
	});

	$('#form_ajout').submit(function() {
		var nom_modele = $("#nom_modele").val();
		var marque = $("#marque").val();
		var lien_img = $("#lien_img").val();
		var puissance_fisc = $("#puissance_fisc").val();
		var puissance_ch = $("#puissance_ch").val();
		var nom_finition = $("#nom_finition").val();
		var immat = $("#immat").val();
		var date_immat = $("#date_immat").val();
		var prix = $("#prix").val();
		if(nom_modele=='' || marque='' || lien_img='' || puissance_fisc='' || puissance_ch='' || nom_finition='' || immat='' || date_immat='' || prix='') {
			alert("Merci de remplir tous les champs.");
			return false;
		}
	});

	$('#form_modif').submit(function() {
		alert("aaa");
	});
});
