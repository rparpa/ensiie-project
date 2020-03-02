module.exports = class {
    constructor() {
    }

    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get adresseMail() {
        return this._adresseMail;
    }

    set adresseMail(value) {
        this._adresseMail = value;
    }

    get motDePasse() {
        return this._motDePasse;
    }

    set motDePasse(value) {
        this._motDePasse = value;
    }

    get cv() {
        return this._cv;
    }

    set cv(value) {
        this._cv = value;
    }

    get telephone() {
        return this._telephone;
    }

    set telephone(value) {
        this._telephone = value;
    }

    get nom() {
        return this._nom;
    }
    
    set nom(value) {
        this._nom = value;
    }

    get prenom() {
        return this._prenom;
    }

    set prenom(value) {
        this._prenom = value;
    }

    toJson() {
        return {
            id: this.id,
            adresseMail: this.adresseMail,
            motDePasse: this.motDePasse,
            telephone: this.telephone,
            cv: this.cv,
            nom: this.nom,
            prenom: this.prenom
        }
    }
};
