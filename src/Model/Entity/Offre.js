module.exports = class {
    constructor() {
    }

    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get identreprise() {
        return this._identreprise;
    }

    set identreprise(value) {
        this._identreprise = value;
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

    get typecontrat() {
        return this._typecontrat;
    }
    
    set typecontrat(value) {
        this._typecontrat = value;
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

    get titre() {
        return this._titre;
    }

    set titre(value) {
        this._titre = value;
    }

    get dateparution() {
        return this._dateparution;
    }

    set dateparution(value) {
        this._dateparution = value;
    }

    toJson() {
        return {
            id: this.id,
            identreprise: this.identreprise,
            description: this.description,
            document: this.document,
            typecontrat: this.typecontrat,
            adresse: this.adresse,
            latitude: this.latitude,
            longitude: this.longitude,
            salaire: this.salaire,
            titre: this.titre,
            dateparution: this.dateparution
        }
    }
};
