module.exports = class {
    constructor(id, firstName, lastName, numVoie, typeVoie, nomVoie, arrond) {
        this._id = id;
        this._firstName = firstName;
        this._lastName = lastName;
        this._numVoie = numVoie;
        this._typeVoie = typeVoie;
        this._arrond = arrond;
    }

    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get firstName() {
        return this._firstName;
    }

    set firstName(value) {
        this._firstName = value;
    }

    get lastName() {
        return this._lastName;
    }

    set lastName(value) {
        this._lastName = value;
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

    toJson() {
        return {
            id: this.id,
            firstName: this._firstName,
            lastName: this._lastName,
            numVoie: this._numVoie,
            typeVoie: this._typeVoie,
            nomVoie: this._nomVoie,
            arrond: this._arrond
        }
    };

}; //end class barcket