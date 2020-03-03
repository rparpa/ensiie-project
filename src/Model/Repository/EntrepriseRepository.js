const ClientSession = require('../Factory/ClientSession');

const begin = "BEGIN";
const commit = "COMMIT";
const rollback = "ROLLBACK";

const login = "SELECT id FROM entreprise WHERE adressemail = $1 AND motdepasse = $2";

const insert = "INSERT INTO entreprise(nom, adressemail, adressesiege, motdepasse, logo, isvalid, telephone) VALUES($1, $2, $3, $4, $5, $6, $7) RETURNING nom, adressemail, adressesiege, logo, telephone";
const selectAllValidated = "SELECT id, nom, adressemail, adressesiege, logo, isvalid, telephone FROM entreprise WHERE isvalid = TRUE";
const selectAllNoValidated = "SELECT id, nom, adressemail, adressesiege, logo, isvalid, telephone FROM entreprise WHERE isvalid = FALSE";
const updateNom = "UPDATE entreprise SET nom = $1 WHERE id = $2 RETURNING nom, adressemail, adressesiege, logo, telephone, isvalid";
const updateAdressemail = "UPDATE entreprise SET adressemail = $1 WHERE id = $2 RETURNING nom, adressemail, adressesiege, logo, telephone, isvalid";
const updateAdressesiege = "UPDATE entreprise SET adressesiege = $1 WHERE id = $2 RETURNING nom, adressemail, adressesiege, logo, telephone, isvalid";
const updateMotdepasse = "UPDATE entreprise SET motdepasse = $1 WHERE id = $2 RETURNING nom, adressemail, adressesiege, logo, telephone, isvalid";
const updateLogo = "UPDATE entreprise SET logo = $1 WHERE id = $2 RETURNING nom, adressemail, adressesiege, logo, telephone, isvalid";
const updateIsvalid = "UPDATE entreprise SET isvalid = $1 WHERE id = $2 RETURNING nom, adressemail, adressesiege, logo, telephone, isvalid";
const updateTelephone = "UPDATE entreprise SET telephone = $1 WHERE id = $2 RETURNING nom, adressemail, adressesiege, logo, telephone, isvalid";
const deleteOne = "DELETE FROM entreprise WHERE id = $1 RETURNING nom, adressemail, adressesiege, motdepasse, logo, isvalid, telephone";

module.exports = class {
    static async login({identifiant, mdp}) {
        if(!identifiant || !mdp) {
            throw 'Missing Information'
        }

        let result;

        var client = ClientSession.getSession();
        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(login, [identifiant, mdp])
            .catch(err => {throw 'Error in database'});

            if(result.rows.length > 0){
                result = true;
            }
            else result = false

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result;
    }

    static async create(Entreprise) {
        if (!Entreprise) {
            throw 'Entreprise object is undefined';
        }

        if (!Entreprise.nom || !Entreprise.motdepasse || !Entreprise.logo || !Entreprise.adressesiege ||!Entreprise.adressemail || !Entreprise.telephone) {
            throw 'Entreprise object is missing information';
        }
        let result;
        let values = [Entreprise.nom, Entreprise.adressemail, Entreprise.adressesiege, Entreprise.motdepasse, Entreprise.logo, false, Entreprise.telephone];

        var client = ClientSession.getSession();

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(insert, values)
            .catch(e => {throw 'Error in the database'}); 
            
            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }
    
    static async getAllValidated() {
        var result;
        var client = ClientSession.getSession();
        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(selectAllValidated)
            .catch(err => {throw 'Error in database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows;
    }

    static async getAllNoValidated() {
        var result;
        var client = ClientSession.getSession();
        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(selectAllNoValidated)
            .catch(err => {throw 'Error in database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows;
    }

    static async updateNom(id, nom) {
        if(!id){
            throw 'no id specified';
        }
        if(!nom){
            throw 'no name specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateNom, [nom, id])
            .catch(e => {throw 'Error in the database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }

    static async updateAdressemail(id, adressemail) {
        if(!id){
            throw 'no id specified';
        }
        if(!adressemail){
            throw 'no adressemail specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateAdressemail, [adressemail, id])
            .catch(e => {throw 'Error in the database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }

    static async updateAdressesiege(id, adressesiege) {
        if(!id){
            throw 'no id specified';
        }
        if(!adressesiege){
            throw 'no adressesiege specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateAdressesiege, [adressesiege, id])
            .catch(e => {throw 'Error in the database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }

    static async updateMotdepasse(id, motdepasse) {
        if(!id){
            throw 'no id specified';
        }
        if(!motdepasse){
            throw 'no motdepasse specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateMotdepasse, [motdepasse, id])
            .catch(e => {throw 'Error in the database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }

    static async updateLogo(id, logo) {
        if(!id){
            throw 'no id specified';
        }
        if(!logo){
            throw 'no logo specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateLogo, [logo, id])
            .catch(e => {throw 'Error in the database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }

    static async updateIsvalid(id, isvalid) {
        if(!id){
            throw 'no id specified';
        }
        if(!isvalid){
            throw 'no isvalid specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateIsvalid, [isvalid, id])
            .catch(e => {throw 'Error in the database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }

    static async updateTelephone(id, telephone) {
        if(!id){
            throw 'no id specified';
        }
        if(!telephone){
            throw 'no telephone specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateTelephone, [telephone, id])
            .catch(e => {throw 'Error in the database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }

    static async deleteById(id) {
        if(!id){
            throw 'No id specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(deleteOne, [id])
            .catch(e => {throw 'Error in the database'});

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }
};