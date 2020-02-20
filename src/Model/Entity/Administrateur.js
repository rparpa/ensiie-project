module.exports = class {
    constructor() {
    }

    get identifiant() {
        return this._identifiant;
    }

    set identifiant(value) {
        this._identifiant = value;
    }

    get motDePasse() {
        return this._motDePasse;
    }

    set motDePasse(value) {
        this._motDePasse = value;
    }

    toJson() {
        return {
            identifiant: this.identifiant,
            motDePasse: this.motDePasse
        }
    }
};
