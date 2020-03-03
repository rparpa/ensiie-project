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
/******/ 	return __webpack_require__(__webpack_require__.s = "./public/Script/admin.js");
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

/***/ "./public/Api/AdminApi.js":
/*!********************************!*\
  !*** ./public/Api/AdminApi.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("const OffreEntity = __webpack_require__(/*! ../../src/Model/Entity/Offre */ \"./src/Model/Entity/Offre.js\");\nconst EntrepriseEntity = __webpack_require__(/*! ../../src/Model/Entity/Entreprise */ \"./src/Model/Entity/Entreprise.js\");\n\nmodule.exports = class  {\n    constructor(httpClient) {\n        this.httpClient = httpClient;\n    }\n\n    getInscriptionEntrepriseAttente(){\n        return this.httpClient.fetch('/getInscriptionEntrepriseAttente', {}).then(rows => {\n            return rows.map(row => {\n                let Entreprise = new EntrepriseEntity();\n                Entreprise.adresseMail = row.adresseMail;\n                Entreprise.telephone = row.telephone;\n                Entreprise.nom = row.nom;\n                Entreprise.motDePasse = row.motDePasse;\n                Entreprise.adresseSiege = row.adresseSiege;\n                Entreprise.logo = row.logo;\n                return Entreprise;\n            });\n        });\n    }\n\n    getOffreEntrepriseAttente(){\n        return this.httpClient.fetch('/getOffreEntrepriseAttente', {}).then(rows => {\n            return rows.map(row => {\n                let Offre = new OffreEntity();\n                Offre.id = row.id;\n                Offre.titre = row.titre;\n                Offre.description = row.description;\n                Offre.document = row.document;\n                Offre.typeContrat = row.typeContrat;\n                Offre.adresse = row.adresse;\n                Offre.salaire = row.salaire;\n                Offre.dateParution = row.dateParution;\n                return Offre;\n            });\n        });\n    }\n\n    validerInscriptionEntreprise(idEntreprise) {\n\n        return this.httpClient.fetch('/validerInscriptionEntreprise', {}).then(rows => {\n            return rows.map(row => {\n                alert(row.message)\n            });\n        });\n    }\n\n    refuserInscriptionEntreprise(idEntreprise) {\n\n        return this.httpClient.fetch('/refuserInscriptionEntreprise', {}).then(rows => {\n            return rows.map(row => {\n                alert(row.message)\n            });\n        });\n    }\n\n    //ValiderOffreEntreprise : prend id de l'offre. Renvoie si c'est bon ou non\n    validerOffreEntreprise(idOffre){\n        return this.httpClient.fetch('/validerOffreEntreprise', {}).then(rows => {\n            return rows.map(row => {\n                alert(row.message)\n            });\n        });\n    }\n\n    refuserOffreEntreprise(idOffre){\n        return this.httpClient.fetch('/refuserOffreEntreprise', {}).then(rows => {\n            return rows.map(row => {\n                alert(row.message)\n            });\n        });\n    }\n    \n}\n\n//# sourceURL=webpack:///./public/Api/AdminApi.js?");

/***/ }),

/***/ "./public/Script/HttpClient.js":
/*!*************************************!*\
  !*** ./public/Script/HttpClient.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = class  {\n    constructor(url) {\n        this.url = url;\n    }\n\n    fetch (path, options) {\n        return fetch(this.url + path, options).then(response => response.json());\n    }\n    \n};\n\n//# sourceURL=webpack:///./public/Script/HttpClient.js?");

/***/ }),

/***/ "./public/Script/admin.js":
/*!********************************!*\
  !*** ./public/Script/admin.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("const appConfig = __webpack_require__(/*! ../../app.config */ \"./app.config.js\");\nconst AdminService = __webpack_require__(/*! ../Api/AdminApi */ \"./public/Api/AdminApi.js\");\nconst HttpClient = __webpack_require__(/*! ./HttpClient */ \"./public/Script/HttpClient.js\");\n\nconst httpClient = new HttpClient(appConfig.apiUrl);\n\n//const Offre = require('../../src/Model/Entity/Offre');\n\nconst adminService = new AdminService(httpClient);\n\nadminService.getInscriptionEntrepriseAttente().then(entreprises => {\n    let html =''\n    entreprises.forEach((entreprise) => {\n        \n        html += EntrepriseHtml(entreprise.id,entreprise.nom, entreprise.adresseMail, entreprise.telephone, entreprise.adresseSiege, entreprise.logo);\n    });\n \n    document.getElementById('inscription-entreprise').innerHTML = html;\n});\n\nadminService.getOffreEntrepriseAttente().then(offres => {\n    let html =''\n    offres.forEach((offre) => {\n        \n        html += OffreHtml(offre.id,offre.titre,offre.description,offre.document,offre.typeContrat,offre.adresse, offre.salaire,offre.dateParution);\n    });\n \n    document.getElementById('offre-entreprise').innerHTML = html;\n});\n\nOffreHtml = function(id,titre, description, document, typeContrat, adresse, salaire, dateParution) {\n    let html =  '<div class=\"border border-primary rounded\">' +\n    '<div class=\"m-3 pb-3\">' +\n    '<h3 class=\"modal-title\">' + titre + '</h3>' +\n    '<div class=\"badge badge-primary text-wrap\" style=\"width: 6rem;\">' + typeContrat + '</div>' +\n    '<div class=\"m-3 badge badge-primary text-wrap\" style=\"width: 6rem;\">' + salaire + '</div>' +\n    '<div class=\"badge badge-primary text-wrap\" style=\"width: 6rem;\">' + dateParution + '</div> <br> ' +\n    '<p class=\"text-sm-left\">' + description + '</p>' +\n    '<p class=\"font-weight-light text-sm-left\"> Adresse : ' + adresse + '</p>' +\n    '<p class=\"font-weight-light text-sm-left\"> Document : ' + document + '</p>' +\n    '<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#validerModal\" data-idOffre='+ id + '> Valider </button>' +\n    '<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#refuserModal\" data-idOffre='+ id + '> Refuser </button>' +\n    '</div>' +\n    '</div> <br>'\n\n    return html\n};\n\nEntrepriseHtml = function(id,nom, adresseMail, telephone, adresseSiege, logo) {\n    let html =  '<div class=\"border border-primary rounded\">' +\n    '<div class=\"m-3 pb-3\">' +\n    '<h3 class=\"modal-title\">' + nom + '</h3>' +\n    '<p class=\"font-weight-light text-sm-left\"> Email : ' + adresseMail + '</p>' +\n    '<p class=\"font-weight-light text-sm-left\"> Telephone : ' + telephone + '</p>' +\n    '<p class=\"font-weight-light text-sm-left\"> Adresse du siege : ' + adresseSiege + '</p>' +\n    '<p class=\"font-weight-light text-sm-left\"> Logo (.png) : ' + logo + '</p>' +\n    '<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#validerEModal\" data-idEntreprise='+ id + '> Valider </button>' +\n    '<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#refuserEModal\" data-idEntreprise='+ id + '> Refuser </button>' +\n    '</div>' +\n    '</div> <br>'\n\n    return html\n};\n\n\n$('#validerModal').on('show.bs.modal', function (event) {\n    \n\n    var idOffre = $(event.relatedTarget).attr('data-idOffre')\n\n    document.getElementById('btnValider').onclick = async function() {\n\n\n        adminService.validerOffreEntreprise(idOffre).then( x => {\n            x.forEach((y) => {\n                if(y===\"ok\"){\n                    alert(\"Offre valide\")\n                }\n            });\n    \n        });\n\n        await sleep(1000);\n        location.reload(); \n    }\n \n})\n\n$('#validerEModal').on('show.bs.modal', function (event) {\n    \n\n    var idEntreprise = $(event.relatedTarget).attr('data-idEntreprise')\n\n    document.getElementById('btnEntrepriseValider').onclick = async function() {\n\n\n        adminService.validerOffreEntreprise(idEntreprise).then( x => {\n            x.forEach((y) => {\n                if(y===\"ok\"){\n                    alert(\"Entreprise valide\")\n                }\n            });\n    \n        });\n\n        await sleep(1000);\n        location.reload(); \n    }\n \n})\n\n$('#refuserModal').on('show.bs.modal', function (event) {\n    \n\n    var idOffre = $(event.relatedTarget).attr('data-idOffre')\n\n    document.getElementById('btnRefuser').onclick = async function() {\n\n\n        adminService.refuserOffreEntreprise(idOffre).then( x => {\n            x.forEach((y) => {\n                if(y===\"ok\"){\n                    alert(\"Offre refuse\")\n                }\n            });\n    \n        });\n\n        await sleep(1000);\n        location.reload(); \n    }\n \n})\n\n$('#refuserEModal').on('show.bs.modal', function (event) {\n    \n\n    var idEntreprise = $(event.relatedTarget).attr('data-idEntreprise')\n\n    document.getElementById('btnEntrepriseRefuser').onclick = async function() {\n\n\n        adminService.validerOffreEntreprise(idEntreprise).then( x => {\n            x.forEach((y) => {\n                if(y===\"ok\"){\n                    alert(\"Entreprise refuse\")\n                }\n            });\n    \n        });\n\n        await sleep(1000);\n        location.reload(); \n    }\n \n})\n\n//# sourceURL=webpack:///./public/Script/admin.js?");

/***/ }),

/***/ "./src/Model/Entity/Entreprise.js":
/*!****************************************!*\
  !*** ./src/Model/Entity/Entreprise.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = class {\n    constructor() {\n    }\n\n    get id() {\n        return this._id;\n    }\n\n    set id(value) {\n        this._id = value;\n    }\n\n    get nom() {\n        return this._nom;\n    }\n\n    set nom(value) {\n        this._nom = value;\n    }\n\n    get adresseMail() {\n        return this._adresseMail;\n    }\n\n    set adresseMail(value) {\n        this._adresseMail = value;\n    }\n\n    get adresseSiege() {\n        return this._adresseSiege;\n    }\n\n    set adresseSiege(value) {\n        this._adresseSiege = value;\n    }\n\n    get motDePasse() {\n        return this._motDePasse;\n    }\n    \n    set motDePasse(value) {\n        this._motDePasse = value;\n    }\n\n    get logo() {\n        return this._logo;\n    }\n\n    set logo(value) {\n        this._logo = value;\n    }\n\n    get isValid() {\n        return this._isValid;\n    }\n\n    set isValid(value) {\n        this._isValid = value;\n    }\n\n    set telephone(value) {\n        this._telephone = value;\n    }\n\n    get telephone() {\n        return this._telephone;\n    }\n\n    toJson() {\n        return {\n            id: this.id,\n            nom: this.nom,\n            adresseMail: this.adresseMail,\n            adresseSiege: this.adresseSiege,\n            motDePasse: this.motDePasse,\n            logo: this.logo,\n            telephone: this.telephone,\n            isValid: this.isValid\n        }\n    }\n};\n\n\n//# sourceURL=webpack:///./src/Model/Entity/Entreprise.js?");

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