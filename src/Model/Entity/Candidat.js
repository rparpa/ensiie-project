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

    get date() {
        return this._date
    }
    set date(value){
        this._date = value;
    }
    toJson() {
        return {
            idOffre: this.idOffre,
            idParticulier: this.idParticulier,
            date:this.date // peut etre faire en sorte que la date soit la date du jour

        }
    }
};
