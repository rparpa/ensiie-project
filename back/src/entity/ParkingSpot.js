module.exports = class {
    constructor(parkingSpotId, statut, vehiculeId, numVoie, typeVoie, nomVoie, arrond, typeSta, typeMob, tarif, latitude, longitude) {

        this._parkingSpotId = parkingSpotId;
        this._statut = statut ;
        this._vehiculeId = vehiculeId ;
        this._numVoie = numVoie ;
        this._typeVoie = typeVoie ;
        this._nomVoie = nomVoie ;
        this._arrond = arrond ;
        this._typeSta = typeSta ;
        this._typeMob = typeMob ;
        this._tarif = tarif ;
        this._latitude = latitude ;
        this._longitude = longitude;

    }


    get parkingSpotId() {
        return this._parkingSpotId;
    }

    set parkingSpotId(value) {
        this._parkingSpotId = value;
    }

    get statut() {
        return this._statut;
    }

    set statut(value) {
        this._statut = value;
    }

    get vehiculeId() {
        return this._vehiculeId;
    }

    set vehiculeId(value) {
        this._vehiculeId = value;
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

    get typeSta() {
        return this._typeSta;
    }

    set typeSta(value) {
        this._typeSta = value;
    }

    get typeMob() {
        return this._typeMob;
    }

    set typeMob(value) {
        this._typeMob = value;
    }

    get tarif() {
        return this._tarif;
    }

    set tarif(value) {
        this._tarif = value;
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

    toJson() {
        return {
        parkingSpotId: this.parkingSpotId,
        statut: this.statut ,
        vehiculeId: this.vehiculeId ,
        numVoie: this.numVoie,
        typeVoie: this.typeVoie ,
        nomVoie: this.nomVoie ,
        arrond: this.arrond ,
        typeSta: this.typeSta ,
        typeMob: this.typeMob ,
        tarif: this.tarif ,
        latitude: this.latitude ,
        longitude: this.longitude
        }
    };


};

