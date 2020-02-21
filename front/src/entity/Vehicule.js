module.exports = class {
    constructor(id, userId, parkingSpotId) {
        this._id = id;
        this._userId= userId;
        this._parkingSpotId = parkingSpotId;
    }


    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get userId() {
        return this._userId;
    }

    set userId(value) {
        this._userId = value;
    }

    get parkingSpotId() {
        return this._parkingSpotId;
    }

    set parkingSpotId(value) {
        this._parkingSpotId = value;
    }

    toJson() {
        return {
            id: this.id,
            userId: this._userId,
            parkingSpotId: this._parkingSpotId
        }
    };

};//end class

