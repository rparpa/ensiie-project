$(document).ready(function() {
	$("#voiture").change(function() {
		searchCar();
	  });

	fetchCarInfo();

	fetchAndSetupMarques();

	$("#sendRq").click(function() {
		// TODO form check

		$.ajax({
			url:"index.php?api=search",
			type:"POST",
			data: {
				id_modele: id_modele,
				id_marque: id_marque,
				id_finition: id_finition,
				id_puissance: id_puissance,
				date_debut: $('input[name="datedeb"]').val(),
				date_fin: $('input[name="datefin"]').val(),
				budget: $('input[name="budget"]').val(),
			},
			dataType:"json",
			success: function(data){
				console.log("res " + JSON.stringify(data["content"]));
				//data["content"].forEach
				if(data["content"].length > 0)
					$("#columnsCars").html("OUE");
			}
		});
	});

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
		if(nom_modele=='' || marque=='' || lien_img=='' || puissance_fisc=='' || puissance_ch=='' || nom_finition=='' || immat=='' || date_immat=='' || prix=='') {
			alert("Merci de remplir tous les champs.");
			return false;
		}
	});

	$('#form_modif').submit(function() {
		var nom_modele = $("#nom_modele").val();
		var marque = $("#marque").val();
		var lien_img = $("#lien_img").val();
		var puissance_fisc = $("#puissance_fisc").val();
		var puissance_ch = $("#puissance_ch").val();
		var nom_finition = $("#nom_finition").val();
		var immat = $("#immat").val();
		var date_immat = $("#date_immat").val();
		var prix = $("#prix").val();
		if(nom_modele=='' || marque=='' || lien_img=='' || puissance_fisc=='' || puissance_ch=='' || nom_finition=='' || immat=='' || date_immat=='' || prix=='') {
			alert("Merci de remplir tous les champs.");
			return false;
		}
	});
});

/*function searchCar() {
	$.ajax({
		url:"index.php?api=fetch",
		type:"POST",
		data: {
			string: $("#voiture").val()
		},
		dataType:"json",
		success: function(data){
			if(data["status"]!="-1") {
				$("#sendRq").html(JSON.stringify(data));
				finalList = [];

				if(data['marque']) {
					if(data['marque'].length > 1) {
						data['marque'].forEach(marque => finalList.push(marque));
					} else {
						finalList.push(data["marque"][0]);
						if(data['modele']) {
							if(data['modele'].length > 1)
								data['modele'].forEach(modele => finalList.push({"id_marque":finalList[0]['id_marque'], "nom_marque":finalList[0]['nom_marque'],modele}));
							else {
								finalList[0]['id_modele'] = data['modele'][0]['id_modele'];
								finalList[0]['nom_modele'] = data['modele'][0]['nom_modele'];
								if(data['finition']) {
									if(data['finition'].length > 1)
										data['finition'].forEach(finition => ({"id_marque":finalList[0]['id_marque'], "nom_marque":finalList[0]['nom_marque'],
																			"id_modele":finalList[0]['id_modele'], "nom_modele": finalList[0]['nom_modele'],finition}));
									else {
										finalList[0][0].push(data['finition'][0]['id_finition']);
										finalList[0][0].push(data['finition'][0]['nom_finition']);
										if(data['puissance'])
											data['puissance'].forEach(puissance => ({"id_marque":finalList[0]['id_marque'], "nom_marque":finalList[0]['nom_marque'],
											"id_modele":finalList[0]['id_modele'], "nom_modele": finalList[0]['nom_modele'],
											"id_finition":finalList[0]['id_finition'], "nom_finition": finalList[0]['nom_finition'],puissance}));
									}
								}
							}
						}
					}
				}

				console.log(JSON.stringify(finalList));

			} else {
				alert("ERREUR");
			}
		}
	  });
	  }*/
	  var contenu = "";
	  var marques = "";
	  var models = "";
	  var finitions = "";
	  var puissances = "";
	  var id_marque = "";
	  var id_modele = "";
	  var id_finition = "";
	  var id_puissance = "";

	function fetchCarInfo() {
		$.ajax({
			url:"index.php?api=fetch",
			type:"POST",
			data: {
				string: ""
			},
			dataType:"json",
			success: function(data){
				Object.size = function(obj) {
					var size = 0, key;
					for (key in obj) {
						if (obj.hasOwnProperty(key)) size++;
					}
					return size;
				};
				if(data["status"]!="-1") {
					contenu = data["content"];
				}
			}
		});
	}

	function fetchAndSetupMarques() {
		$.ajax({
			url:"index.php?api=fetchBrands",
			type:"POST",
			data: {
				string: ""
			},
			dataType:"json",
			success: function(data){
				if(data["status"]!="-1") {
					marques = data["content"];

					$('#marqueForm').autocomplete({
						dataSource: marques,
						textProperty:'nom',
						valueProperty:'id',
						allowCustomValue: true
					});
					$('#marqueForm').click(function(){
						id_marque = $(this).next().find('li.selected').attr('data-value');
						$('input[name=id_marque]').val(id_marque); 
						fetchAndSetupModels();
						fetchAndSetupFinitions();
						fetchAndSetupPuissances();
					});
				}
			}
		});
	}

	function fetchAndSetupModels() {
		$.ajax({
			url:"index.php?api=fetchModels",
			type:"POST",
			data: {
				id_marque: id_marque
			},
			dataType:"json",
			success: function(data){
				if(data["status"]!="-1") {
					models = data["content"];

					$('#modeleForm').autocomplete({
						dataSource: models,
						textProperty:'nom',
						valueProperty:'id',
						allowCustomValue: true
					});
					$('#modeleForm').click(function(){
						id_modele = $(this).next().find('li.selected').attr('data-value');
						$('input[name=id_modele]').val(id_modele); 
					});
				}
			}
		});
	}

	function fetchAndSetupFinitions() {
		$.ajax({
			url:"index.php?api=fetchFinitions",
			type:"POST",
			data: {
				id_marque: id_marque
			},
			dataType:"json",
			success: function(data){
				if(data["status"]!="-1") {
					finitions = data["content"];

					$('#finitionForm').autocomplete({
						dataSource: finitions,
						textProperty:'nom',
						valueProperty:'id',
						allowCustomValue: true
					});
					$('#finitionForm').click(function(){
						id_finition = $(this).next().find('li.selected').attr('data-value');
						$('input[name=id_finition]').val(id_finition); 
					});
				}
			}
		});

		
	}

	function fetchAndSetupPuissances() {
		$.ajax({
			url:"index.php?api=fetchPuissances",
			type:"POST",
			data: {
				id_marque: id_marque
			},
			dataType:"json",
			success: function(data){
				if(data["status"]!="-1") {
					puissances = data["content"];

				$('#puissanceForm').autocomplete({
					dataSource: puissances,
					textProperty:'nom',
					valueProperty:'id',
					allowCustomValue: true
				});
				$('#puissanceForm').click(function(){
					id_puissance = $(this).next().find('li.selected').attr('data-value');
					$('input[name=id_puissance]').val(id_puissance); 
				});
				}
			}
		});
	}


	function searchCar() {
		sc = [];
		leng = $("#voiture").val().split(" ").length;

		contenu.forEach(variation => {
			if(leng > 2 && Object.size(variation) == 8) {
				sc.push({nom:variation['nom_marque'] + " " + variation['nom_modele'] + " " + variation['nom_finition'] + " " + variation['puissance_ch'],
								id:variation['id_marque'] + " " + variation['id_modele'] + " " + variation['id_finition'] + " " + variation['id_puissance']});
			} else if (leng >= 2 && Object.size(variation) == 6) {
				sc.push({nom:variation['nom_marque'] + " " + variation['nom_modele'] + " " + variation['nom_finition'],
								id:variation['id_marque'] + " " + variation['id_modele'] + " " + variation['id_finition']})
			} else if (leng == 2 && Object.size(variation) == 4) {
				sc.push({nom:variation['nom_marque'] + " " + variation['nom_modele'],
								id:variation['id_marque'] + " " + variation['id_modele']})
			} else if (leng == 1 && Object.size(variation) == 2) {
				sc.push({nom:variation['nom_marque'],
								id:variation['id_marque']})
			}
		});
		console.log(sc);				
		$('#voiture').autocomplete({
			dataSource: sc,
			textProperty:'nom',
			valueProperty:'id',
			allowCustomValue: true
		});
		$('#voiture').click(function(){
			args = $(this).next().find('li.selected').attr('data-value');
			if(args.length > 0) id_marque = args[0]; else id_marque = "";
			if(args.length > 1) id_modele = args[1]; else id_modele = "";
			if(args.length > 2) id_finition = args[2]; else id_finition = "";
			if(args.length > 3) id_puissance = args[3]; else id_puissance = "";
		});
	}
