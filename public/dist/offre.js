/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./public/Script/offre.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./app.config.js":
/*!***********************!*\
  !*** ./app.config.js ***!
  \***********************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = {\n    apiUrl : \"http://0.0.0.0:8090\"\n};\n\n//# sourceURL=webpack:///./app.config.js?");

/***/ }),

/***/ "./public/Api/OffreApi.js":
/*!********************************!*\
  !*** ./public/Api/OffreApi.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("const OffreEntity = __webpack_require__(/*! ../../src/Model/Entity/Offre */ \"./src/Model/Entity/Offre.js\");\nmodule.exports = class  {\n    constructor(httpClient) {\n        this.httpClient = httpClient;\n    }\n\n    getOffres(titre, localisation, typeContrat, salaire, dateParution) {\n\n        var d = new Date();\n        if(dateParution==='Tout') {\n            d.setFullYear(d.getFullYear() - 20);\n        }\n        else if (dateParution==='< 1 mois') {\n            d.setMonth(d.getMonth() - 1);\n        }\n        else if (dateParution==='< 2 semaines') {\n            d.setDate(d.getDate() - 14);\n        }\n        else if (dateParution==='< 1 semaine') {\n            d.setDate(d.getDate() - 7);\n        }\n        //alert(d.getDate() + \"-\" + d.getMonth() + \"-\" + d.getFullYear())\n        //alert(d.getTime())\n        return this.httpClient.fetch('/getOffres', {}).then(rows => {\n            return rows.map(row => {\n                let Offre = new OffreEntity();\n                Offre.id = row.id;\n                Offre.titre = row.titre;\n                Offre.description = row.description;\n                Offre.document = row.document;\n                Offre.typeContrat = row.typeContrat;\n                Offre.adresse = row.adresse;\n                Offre.salaire = row.salaire;\n                Offre.dateParution = row.dateParution;\n                return Offre;\n            });\n        });\n    }\n\n    createOffre(idSociete, titre, description, typeContrat, salaire, dateParution, adresse, document) {\n        return this.httpClient.fetch('/createOffre', {}).then(rows => {\n            return rows.map(row => {\n                return(row.isSaved)\n            });\n        });\n    }\n    \n    modifyOffre(idOffre, titre, description, typeContrat, salaire, dateParution, adresse, document) {\n        return this.httpClient.fetch('/modifyOffre', {}).then(rows => {\n            return rows.map(row => {\n                return(row.isSaved)\n            });\n        });\n    }\n\n    getCompanyOffre(idSociete) {\n        return this.httpClient.fetch('/getCompanyOffres', {}).then(rows => {\n            return rows.map(row => {\n                let Offre = new OffreEntity();\n                Offre.id = row.id;\n                Offre.titre = row.titre;\n                Offre.description = row.description;\n                Offre.document = row.document;\n                Offre.typeContrat = row.typeContrat;\n                Offre.adresse = row.adresse;\n                Offre.salaire = row.salaire;\n                Offre.dateParution = row.dateParution;\n                return Offre;\n            });\n        });\n    }\n\n}\n\n//# sourceURL=webpack:///./public/Api/OffreApi.js?");

/***/ }),

/***/ "./public/Script/HttpClient.js":
/*!*************************************!*\
  !*** ./public/Script/HttpClient.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = class  {\n    constructor(url) {\n        this.url = url;\n    }\n\n    fetch (path, options) {\n        return fetch(this.url + path, options).then(response => response.json());\n    }\n    \n};\n\n//# sourceURL=webpack:///./public/Script/HttpClient.js?");

/***/ }),

/***/ "./public/Script/offre.js":
/*!********************************!*\
  !*** ./public/Script/offre.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("const appConfig = __webpack_require__(/*! ../../app.config */ \"./app.config.js\");\nconst OffreService = __webpack_require__(/*! ../Api/OffreApi */ \"./public/Api/OffreApi.js\");\nconst HttpClient = __webpack_require__(/*! ./HttpClient */ \"./public/Script/HttpClient.js\");\n\nconst httpClient = new HttpClient(appConfig.apiUrl);\n\nconst offreService = new OffreService(httpClient);\n\n// Détection du support\nif(localStorage.getItem('id') == \"1\" || localStorage.getItem('id') == \"2\") {\n    document.getElementById(\"navbarDropdown\").style.display = \"block\";\n}\nif(localStorage.getItem('id') == \"1\") {\n    document.getElementById(\"contribution\").style.display = \"none\";\n}\nelse if (localStorage.getItem('id') == \"2\") {\n    document.getElementById(\"offres\").style.display = \"none\";\n    document.getElementById(\"AdrSiege\").style.display = \"none\";\n}\n\nwindow.onload = function() {\n    \n    offreService.getCompanyOffre(localStorage.getItem('idPersonne')).then(offres => {\n        let html =''\n        offres.forEach((offre) => {\n            html += OffreHtml(offre.id,offre.titre,offre.description,offre.document,offre.typeContrat,offre.adresse, offre.salaire,offre.dateParution);\n        });\n\n        document.getElementById('mesOffres').innerHTML = '<h3 class=\"modal-title\">Mes offres</h3><br>'\n            \n        document.getElementById('mesOffres').innerHTML += html;\n    });\n};\n\ndocument.getElementById('btnCreer').onclick = async function() {\n\n    var error = \"false\"\n    var titre = document.getElementById('inputTitre').value\n    var description = document.getElementById('inputDescription').value\n    var typeContrat = document.getElementById('inputContrat').value\n    var salaire = document.getElementById('inputSalaire').value\n    var dateParution = document.getElementById('inputDateParution').value\n    var adresse = document.getElementById('inputAdresseSiege').value\n    var doc = document.getElementById('exampleFormControlFile1').files[1]\n\n    //alert (titre + description + typeContrat + salaire + dateParution + adresse)\n\n    if (titre==='' || description==='' || typeContrat==='' || salaire==='' || dateParution==='' || adresse===''){\n        alert('Veuillez remplir tous les champs')\n    }\n    else {\n        offreService.createOffre(localStorage.getItem('idPersonne'),titre,description,typeContrat,salaire,dateParution,adresse,doc).then( x => {\n            x.forEach((y) => {\n                if(y===\"yes\"){\n                    alert(\"Votre offre a bien été prise en compte, elle sera traité sous peu\")\n                }\n                else {\n                    (\"Something went wrong\")\n                }\n            });\n    \n        });\n        \n        document.getElementById(\"formNewOffre\").reset();\n        await sleep(1000);\n        location.reload(); \n    }\n}\n\n$('#modifierModal').on('show.bs.modal', function (event) {\n    \n\n    var idOffre = $(event.relatedTarget).attr('data-idOffre')\n    var idTitre = $(event.relatedTarget).attr('data-idTitre')\n    var idDescription = $(event.relatedTarget).attr('data-idDescription')\n    var idTypeContrat = $(event.relatedTarget).attr('data-idTypeContrat')\n    var idSalaire = $(event.relatedTarget).attr('data-idSalaire')\n    var idDateParution = $(event.relatedTarget).attr('data-idDateParution')\n    var idAdresse = $(event.relatedTarget).attr('data-idAdresse')\n\n    document.getElementById('inputTitre').value = idTitre\n    document.getElementById('inputDescription').value = idDescription\n    document.getElementById('inputContrat').value = idTypeContrat\n    document.getElementById('inputSalaire').value = idSalaire\n    //document.getElementById('inputDateParution').value = idDateParution\n    document.getElementById('inputAdresseSiege').value = idAdresse\n    //manque le document\n\n    //On sélectionne le type de contrat déjà renseigné\n    var selectElement = document.getElementById('inputContrat');\n    var selectOptions = selectElement.options;\n    \n    for (var opt, j = 0; opt = selectOptions[j]; j++){\n        if (opt.value == idTypeContrat) {\n            selectElement.selectedIndex = j;\n            break;\n        }\n    }\n\n    document.getElementById('btnModifier').onclick = async function() {\n        \n        var titre = document.getElementById('inputTitre').value\n        var description = document.getElementById('inputDescription').value\n        var typeContrat = document.getElementById('inputContrat').value\n        var salaire = document.getElementById('inputSalaire').value\n        var dateParution = document.getElementById('inputDateParution').value\n        var adresse = document.getElementById('inputAdresseSiege').value\n        var doc = document.getElementById('exampleFormControlFile1').files[1]\n\n        if (titre==='' || description==='' || typeContrat==='' || salaire==='' || dateParution==='' || adresse===''){\n            alert('Veuillez remplir tous les champs')\n        }\n        else {\n            offreService.modifyOffre(idOffre,titre,description,typeContrat,salaire,dateParution,adresse,doc).then( x => {\n                x.forEach((y) => {\n                    if(y===\"yes\"){\n                        alert(\"Votre offre a bien été modifiée\")\n                    }\n                    else {\n                        (\"Something went wrong\")\n                    }\n                });\n        \n            });\n            \n            await sleep(1000);\n            location.reload(); \n        }\n    }\n\n\n \n})\n\nfunction sleep(ms) {\n    return new Promise(resolve => setTimeout(resolve, ms));\n} \n\nOffreHtml = function(id,titre, description, document, typeContrat, adresse, salaire, dateParution) {\n    let html =  '<div class=\"border border-primary rounded\">' +\n    '<div class=\"m-3 pb-3\">' +\n    '<h3 class=\"modal-title\">' + titre + '</h3>' +\n    '<div class=\"badge badge-primary text-wrap\" style=\"width: 6rem;\">' + typeContrat + '</div>' +\n    '<div class=\"m-3 badge badge-primary text-wrap\" style=\"width: 6rem;\">' + salaire + '</div>' +\n    '<div class=\"badge badge-primary text-wrap\" style=\"width: 6rem;\">' + dateParution + '</div> <br> ' +\n    '<p class=\"text-sm-left\">' + description + '</p>' +\n    '<p class=\"font-weight-light text-sm-left\"> Adresse : ' + adresse + '</p>' +\n    '<p class=\"font-weight-light text-sm-left\"> Document : ' + document + '</p>' +\n    '<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#modifierModal\" data-idOffre='+ id + ' data-idTitre=\"'+ titre + '\" data-idDescription=\"'+ description + '\" data-idTypeContrat=\"'+ typeContrat + '\" data-idSalaire='+ salaire + ' data-idDateParution=\"'+ dateParution + '\" data-idAdresse=\"'+ adresse + '\"> Modifier </button>' +\n    '</div>' +\n    '</div> <br>'\n\n    return html\n};\n\n//# sourceURL=webpack:///./public/Script/offre.js?");

/***/ }),

/***/ "./src/Model/Entity/Offre.js":
/*!***********************************!*\
  !*** ./src/Model/Entity/Offre.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = class {\n    constructor() {\n    }\n\n    get id() {\n        return this._id;\n    }\n\n    set id(value) {\n        this._id = value;\n    }\n\n    get idEntreprise() {\n        return this._idEntreprise;\n    }\n\n    set idEntreprise(value) {\n        this._idEntreprise = value;\n    }\n\n    get description() {\n        return this._description;\n    }\n\n    set description(value) {\n        this._description = value;\n    }\n\n    get document() {\n        return this._document;\n    }\n\n    set document(value) {\n        this._document = value;\n    }\n\n    get typeContrat() {\n        return this._typeContrat;\n    }\n    \n    set typeContrat(value) {\n        this._typeContrat = value;\n    }\n\n    get adresse() {\n        return this._adresse;\n    }\n\n    set adresse(value) {\n        this._adresse = value;\n    }\n\n    get latitude() {\n        return this._latitude;\n    }\n\n    set latitude(value) {\n        this._latitude = value;\n    }\n\n    get longitude() {\n        return this._longitude;\n    }\n\n    set longitude(value) {\n        this._longitude = value;\n    }\n\n    get salaire() {\n        return this._salaire;\n    }\n\n    set salaire(value) {\n        this._salaire = value;\n    }\n\n    get isValid() {\n        return this._isValid;\n    }\n\n    set isValid(value) {\n        this._isValid = value;\n    }\n\n    toJson() {\n        return {\n            id: this.id,\n            idEntreprise: this.idEntreprise,\n            description: this.description,\n            document: this.document,\n            typeContrat: this.typeContrat,\n            adresse: this.adresse,\n            latitude: this.latitude,\n            longitude: this.longitude,\n            salaire: this.salaire,\n            isValid: this.isValid\n        }\n    }\n};\n\n\n//# sourceURL=webpack:///./src/Model/Entity/Offre.js?");

/***/ })

/******/ });