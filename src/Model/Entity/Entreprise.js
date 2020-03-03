module.exports = class {
    constructor() {
    }

    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get nom() {
        return this._nom;
    }

    set nom(value) {
        this._nom = value;
    }

    get adresseMail() {
        return this._adresseMail;
    }

    set adresseMail(value) {
        this._adresseMail = value;
    }

    get adresseSiege() {
        return this._adresseSiege;
    }

    set adresseSiege(value) {
        this._adresseSiege = value;
    }

    get motDePasse() {
        return this._motDePasse;
    }
    
    set motDePasse(value) {
        this._motDePasse = value;
    }

    get logo() {
        return this._logo;
    }

    set logo(value) {
        this._logo = value;
    }

    get isValid() {
        return this._isValid;
    }

    set isValid(value) {
        this._isValid = value;
    }

    get telephone() {
        return this._telephone;
    }

    set telephone(value) {
        this._telephone = value;
    }

    toJson() {
        return {
            id: this.id,
            nom: this.nom,
            adresseMail: this.adresseMail,
            adresseSiege: this.adresseSiege,
            motDePasse: this.motDePasse,
            logo: this.logo,
            isValid: this.isValid,
            telephone: this.telephone
        }
    }
};
