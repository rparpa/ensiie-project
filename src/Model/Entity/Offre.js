module.exports = class {
    constructor() {
    }

    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get idEntreprise() {
        return this._idEntreprise;
    }

    set idEntreprise(value) {
        this._idEntreprise = value;
    }

    get description() {
        return this._description;
    }

    set description(value) {
        this._description = value;
    }

    get document() {
        return this._document;
    }

    set document(value) {
        this._document = value;
    }

    get typeContrat() {
        return this._typeContrat;
    }
    
    set typeContrat(value) {
        this._typeContrat = value;
    }

    get adresse() {
        return this._adresse;
    }

    set adresse(value) {
        this._adresse = value;
    }

    get latitude() {
        return this._latitude;
    }

    set latitude(value) {
        this._latitude = value;
    }

    get longitude() {
        return this._longitude;
    }

    set longitude(value) {
        this._longitude = value;
    }

    get salaire() {
        return this._salaire;
    }

    set salaire(value) {
        this._salaire = value;
    }

    get isValid() {
        return this._isValid;
    }

    set isValid(value) {
        this._isValid = value;
    }

    toJson() {
        return {
            id: this.id,
            idEntreprise: this.idEntreprise,
            description: this.description,
            document: this.document,
            typeContrat: this.typeContrat,
            adresse: this.adresse,
            latitude: this.latitude,
            longitude: this.longitude,
            salaire: this.salaire,
            isValid: this.isValid
        }
    }
};
