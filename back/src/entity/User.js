module.exports = class {
    constructor(username, encryptedPassword, email, vehiculeId, addressId, role) {
        this._username = username;
        this._encryptedPassword = encryptedPassword;
        this._email = email;
        this._vehiculeId = vehiculeId;
        this._addressId = addressId;
        this._role = role;
    }

    get username() {
        return this._username;
    }

    set username(value) {
        this._username = value;
    }

    get encryptedPassword() {
        return this._encryptedPassword;
    }

    set encryptedPassword(value) {
        this._encryptedPassword = encryptedPassword;
    }

    get email() {
        return this._email;
    }

    set email(value) {
        this._email = value;
    }

    get vehiculeId() {
        return this._vehiculeId;
    }

    set vehiculeId(value) {
        this._vehiculeId = value;
    }

    get addressId() {
        return this._addressId;
    }

    set addressId(value) {
        this._addressId = addressId;
    }


    get role() {
        return this._role;
    }

    set role(value) {
        this._role = value;
    }

    toJson() {
        return {
            username: this._username,
            encryptedPassword: this._encryptedPassword,
            email: this._email,
            vehiculeId: this._vehiculeId,
            addressId: this._addressId,
            role: this._role
        }
    };

}; //end class barcket