module.exports = class {
    constructor() {
    }

    get idOffre() {
        return this._idOffre;
    }

    set idOffre(value) {
        this._idOffre = value;
    }

    get idParticulier() {
        return this._idParticulier;
    }

    set idParticulier(value) {
        this._idParticulier = value;
    }

    toJson() {
        return {
            idOffre: this.idOffre,
            idParticulier: this.idParticulier
        }
    }
};
