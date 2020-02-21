module.exports = class {
    constructor(id, numVoie, typeVoie, nomVoie, arrond, status) {
        this._id = id;
        this._numvoie = numVoie ;
        this._typeVoie = typeVoie ;
        this._nomVoie = nomVoie ;
        this._arond = arrond ;
        this._status = status ;
        this._numVoie = numVoie;
        this._arrond = arrond;
    }


    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get numVoie() {
        return this._numVoie;
    }

    set numVoie(value) {
        this._numVoie = value;
    }

    get typeVoie() {
        return this._typeVoie;
    }

    set typeVoie(value) {
        this._typeVoie = value;
    }

    get nomVoie() {
        return this._nomVoie;
    }

    set nomVoie(value) {
        this._nomVoie = value;
    }

    get arrond() {
        return this._arrond;
    }

    set arrond(value) {
        this._arrond = value;
    }

    get status() {
        return this._status;
    }

    set status(value) {
        this._status = value;
    }
    
    toJson() {
        return {
            id: this.id,
            numVoie: this._numVoie,
            typeVoie: this._typeVoie,
            nomVoie: this._nomVoie,
            arrond: this._arrond,
            status: this._status
        }
    };
};