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
/******/ 	return __webpack_require__(__webpack_require__.s = "./public/Script/profil.js");
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

/***/ "./public/Api/ParticulierApi.js":
/*!**************************************!*\
  !*** ./public/Api/ParticulierApi.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("const ParticulierEntity = __webpack_require__(/*! ../../src/Model/Entity/Particulier */ \"./src/Model/Entity/Particulier.js\");\nmodule.exports = class  {\n    constructor(httpClient) {\n        this.httpClient = httpClient;\n    }\n\n    getProfil(id) {\n        return this.httpClient.fetch('/profil', {}).then(rows => {\n            return rows.map(row => {\n                let Particulier = new ParticulierEntity();\n                Particulier.adresseMail = row.adresseMail;\n                Particulier.telephone = row.telephone;\n                Particulier.cv = row.cv;\n                Particulier.motDePasse = row.motDePasse;\n                return Particulier;\n            });\n        });\n    }\n\n    editProfilEmail(email) {\n        return this.httpClient.fetch('/profil/editemail', {\n            method: 'POST',\n            headers: {\n                'Content-Type': 'application/x-www-form-urlencoded'\n            },\n            body: \"email=\" + email\n\n        }).then(rows => {\n            return rows.map(row => {\n                let Particulier = new ParticulierEntity();\n                Particulier.adresseMail = row.adresseMail;\n                Particulier.telephone = row.telephone;\n                Particulier.cv = row.cv;\n                Particulier.motDePasse = row.motDePasse;\n                return Particulier\n            });\n        });\n    }\n\n    editProfilTelephone(telephone) {\n        return this.httpClient.fetch('/profil/edittelephone', {\n            method: 'POST',\n            headers: {\n                'Content-Type': 'application/x-www-form-urlencoded'\n            },\n            body: \"telephone=\" + telephone\n\n        }).then(rows => {\n            return rows.map(row => {\n            let Particulier = new ParticulierEntity();\n            Particulier.adresseMail = row.adresseMail;\n            Particulier.telephone = row.telephone;\n            Particulier.cv = row.cv;\n            Particulier.motDePasse = row.motDePasse;\n            return Particulier\n            });\n        });\n    }\n\n    editProfilMdp(mdp) {\n        return this.httpClient.fetch('/profil/editmdp', {\n            method: 'POST',\n            headers: {\n                'Content-Type': 'application/x-www-form-urlencoded'\n            },\n            body: \"mdp=\" + mdp\n\n        }).then(rows => {\n            return rows.map(row => {\n            let Particulier = new ParticulierEntity();\n                Particulier.adresseMail = row.adresseMail;\n                Particulier.telephone = row.telephone;\n                Particulier.cv = row.cv;\n                Particulier.motDePasse = row.motDePasse;\n                return Particulier\n            });\n        });\n    }\n\n    editProfilCV(cv) {\n        return this.httpClient.fetch('/profil/editcv', {\n            method: 'POST',\n            headers: {\n                'Content-Type': 'application/x-www-form-urlencoded'\n            },\n            body: \"cv=\" + cv\n\n        }).then(rows => {\n            return rows.map(row => {\n            let Particulier = new ParticulierEntity();\n                Particulier.adresseMail = row.adresseMail;\n                Particulier.telephone = row.telephone;\n                Particulier.cv = row.cv;\n                Particulier.motDePasse = row.motDePasse;\n                return Particulier\n            });\n        });\n    }\n}\n\n//# sourceURL=webpack:///./public/Api/ParticulierApi.js?");

/***/ }),

/***/ "./public/Script/HttpClient.js":
/*!*************************************!*\
  !*** ./public/Script/HttpClient.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = class  {\n    constructor(url) {\n        this.url = url;\n    }\n\n    fetch (path, options) {\n        return fetch(this.url + path, options).then(response => response.json());\n    }\n    \n};\n\n//# sourceURL=webpack:///./public/Script/HttpClient.js?");

/***/ }),

/***/ "./public/Script/profil.js":
/*!*********************************!*\
  !*** ./public/Script/profil.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// Détection du support\nif(localStorage.getItem('id') == \"1\" || localStorage.getItem('id') == \"2\") {\n    document.getElementById(\"navbarDropdown\").style.display = \"block\";\n}\nif(localStorage.getItem('id') == \"1\") {\n    document.getElementById(\"contribution\").style.display = \"none\";\n    document.getElementById(\"MonCV\").style.display = \"none\";\n}\nelse if (localStorage.getItem('id') == \"2\") {\n    document.getElementById(\"offres\").style.display = \"none\";\n    document.getElementById(\"AdrSiege\").style.display = \"none\";\n}\n\n$(\"input[type=file]\").change(function (e){$(this).next('.custom-file-label').text(e.target.files[0].name);})\n\nconst appConfig = __webpack_require__(/*! ../../app.config */ \"./app.config.js\");\nconst ParticulierService = __webpack_require__(/*! ../Api/ParticulierApi */ \"./public/Api/ParticulierApi.js\");\nconst HttpClient = __webpack_require__(/*! ./HttpClient */ \"./public/Script/HttpClient.js\");\n\n\nconst Particulier = __webpack_require__(/*! ../../src/Model/Entity/Particulier */ \"./src/Model/Entity/Particulier.js\");\n\nconst httpClient = new HttpClient(appConfig.apiUrl);\n\nconst particulierService = new ParticulierService(httpClient);\n\nparticulierService.getProfil(localStorage.getItem('id')).then(particuliers => {\n    particuliers.forEach((particulier) => {\n    document.getElementById('telephone').innerHTML = particulier.telephone;\n    document.getElementById('email').innerHTML = particulier.adresseMail;\n    document.getElementById('mdp').innerHTML = particulier.motDePasse;\n    document.getElementById('nomfichier').innerHTML = particulier.cv;\n    })\n});\n\n//Edit on click\n$('#EmailModal').on('show.bs.modal', function (event) {\n    \n    var modal = $(this)\n\n    document.getElementById('btn-edit-email').onclick = function(){  \n\n        var error = \"false\"\n        \n        if(document.getElementById('exampleInputEmail').value === '') {\n            alert('Impossible de modifier l email sans nom')\n            error = \"true\"\n    \n        }\n        if (document.getElementById('exampleInputEmail2').value === '') {\n            alert('Impossible de modifier l email sans nom')\n            error = \"true\"\n        }\n        if (document.getElementById('exampleInputEmail2').value != document.getElementById('exampleInputEmail').value) {\n            alert('Les deux valeurs saisies sont differentes')\n            error = \"true\"\n        }\n        if (error === \"false\") {\n            \n            particulierService.editProfilEmail(localStorage.getItem('id')).then(particuliers => {\n                particuliers.forEach((particulier) => {\n                    document.getElementById('telephone').innerHTML = particulier.telephone;\n                    document.getElementById('email').innerHTML = particulier.adresseMail;\n                    document.getElementById('mdp').innerHTML = particulier.motDePasse;\n                    document.getElementById('nomfichier').innerHTML = particulier.cv;\n                })\n            });\n            $('#EmailModal').hide();\n            $('.modal-backdrop').hide();\n        }\n\n    }\n \n})\n\n//Edit on click\n$('#MdpModal').on('show.bs.modal', function (event) {\n    \n    var modal = $(this)\n\n    document.getElementById('btn-edit-mdp').onclick = function(){  \n\n        var error = \"false\"\n        \n        if(document.getElementById('exampleInputMdp').value === '') {\n            alert('Impossible de modifier le mdp')\n            error = \"true\"\n    \n        }\n        if (document.getElementById('exampleInputMdp2').value === '') {\n            alert('Impossible de modifier le mdp')\n            error = \"true\"\n        }\n        if (document.getElementById('exampleInputMdp2').value != document.getElementById('exampleInputMdp').value) {\n            alert('Les deux valeurs saisies sont differentes')\n            error = \"true\"\n        }\n        if (error === \"false\") {\n            \n            particulierService.editProfilMdp(localStorage.getItem('id')).then(particuliers => {\n                particuliers.forEach((particulier) => {\n                    document.getElementById('telephone').innerHTML = particulier.telephone;\n                    document.getElementById('email').innerHTML = particulier.adresseMail;\n                    document.getElementById('mdp').innerHTML = particulier.motDePasse;\n                    document.getElementById('nomfichier').innerHTML = particulier.cv;\n                })\n            });\n            $('#MdpModal').hide();\n            $('.modal-backdrop').hide();\n        }\n\n    }\n \n})\n\n//Edit on click\n$('#TelephoneModal').on('show.bs.modal', function (event) {\n    \n    var modal = $(this)\n\n    document.getElementById('btn-edit-telephone').onclick = function(){  \n\n        var error = \"false\"\n        \n        if(document.getElementById('exampleInputTelephone').value === '') {\n            alert('Impossible de modifier le numero de telephone')\n            error = \"true\"\n    \n        }\n        if (document.getElementById('exampleInputTelephone2').value === '') {\n            alert('Impossible de modifier le numero de telephone')\n            error = \"true\"\n        }\n\n        if (document.getElementById('exampleInputTelephone2').value !== document.getElementById('exampleInputTelephone').value) {\n            alert('Les deux valeurs saisies sont differentes')\n            error = \"true\"\n        }\n\n        if (error === \"false\") {\n            \n            particulierService.editProfilTelephone(localStorage.getItem('id')).then(particuliers => {\n                particuliers.forEach((particulier) => {\n                    document.getElementById('telephone').innerHTML = particulier.telephone;\n                    document.getElementById('email').innerHTML = particulier.adresseMail;\n                    document.getElementById('mdp').innerHTML = particulier.motDePasse;\n                    document.getElementById('nomfichier').innerHTML = particulier.cv;\n                })\n            });\n            $('#TelephoneModal').hide();\n            $('.modal-backdrop').hide();\n        }\n\n    }\n \n})\n\n\ndocument.getElementById('btn-edit-cv').onclick = function(){  \n\n    var error = \"false\"\n    \n    if(document.getElementById('nomfichier').value === '') {\n        alert('Impossible d upload le fichier')\n        error = \"true\"\n\n    }\n\n    if (error === \"false\") {\n        \n        particulierService.editProfilCV(localStorage.getItem('id')).then(particuliers => {\n            particuliers.forEach((particulier) => {\n                document.getElementById('telephone').innerHTML = particulier.telephone;\n                document.getElementById('email').innerHTML = particulier.adresseMail;\n                document.getElementById('mdp').innerHTML = particulier.motDePasse;\n                document.getElementById('nomfichier').innerHTML = particulier.cv;\n            })\n        });\n\n    }\n\n}\n \n\n\n//# sourceURL=webpack:///./public/Script/profil.js?");

/***/ }),

/***/ "./src/Model/Entity/Particulier.js":
/*!*****************************************!*\
  !*** ./src/Model/Entity/Particulier.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = class {\n    constructor() {\n    }\n\n    get id() {\n        return this._id;\n    }\n\n    set id(value) {\n        this._id = value;\n    }\n\n    get adresseMail() {\n        return this._adresseMail;\n    }\n\n    set adresseMail(value) {\n        this._adresseMail = value;\n    }\n\n    get motDePasse() {\n        return this._motDePasse;\n    }\n\n    set motDePasse(value) {\n        this._motDePasse = value;\n    }\n\n    get cv() {\n        return this._cv;\n    }\n\n    set cv(value) {\n        this._cv = value;\n    }\n\n    get telephone() {\n        return this._telephone;\n    }\n\n    set telephone(value) {\n        this._telephone = value;\n    }\n\n    get nom() {\n        return this._nom;\n    }\n    \n    set nom(value) {\n        this._nom = value;\n    }\n\n    get prenom() {\n        return this._prenom;\n    }\n\n    set prenom(value) {\n        this._prenom = value;\n    }\n\n    toJson() {\n        return {\n            id: this.id,\n            adresseMail: this.adresseMail,\n            motDePasse: this.motDePasse,\n            telephone: this.telephone,\n            cv: this.cv,\n            nom: this.nom,\n            prenom: this.prenom\n        }\n    }\n};\n\n\n//# sourceURL=webpack:///./src/Model/Entity/Particulier.js?");

/***/ })

/******/ });