$(document).ready(function() {

	$('#form_connexion').submit(function() {
		var email = $("#email").val();
		var password = $("#password").val();
		if(email=='' || password=='') {
			alert("Remplissez les champs vides.");
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
			alert("Remplissez les champs vides.");
			return false;
		}
	});

	$('#form_reset').submit(function() {
		var email = $("#email").val();
		if(email=='') {
			alert("Remplissez les champs vides.");
			return false;
		}
	});

	$('#car-img').on('click', function() {
		
	});
});
