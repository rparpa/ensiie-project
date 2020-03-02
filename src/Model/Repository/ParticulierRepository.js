const ClientSession = require('../Factory/ClientSession');

const begin = "BEGIN";
const commit = "COMMIT";
const rollback = "ROLLBACK";

const insert = "INSERT INTO particulier(adressemail, motdepasse, cv, nom, prenom, telephone) VALUES($1, $2, $3, $4, $5, $6) RETURNING adressemail, cv, nom, prenom, telephone";
const selectAll = "SELECT adressemail, cv, nom, prenom, telephone FROM particulier";
const selectById = "SELECT adressemail, cv, nom, prenom, telephone FROM particulier WHERE id = $1";
const updateOne = "UPDATE particulier SET adressemail = $1, motdepasse = $2, cv = $3, nom = $4, prenom = $5, telephone = $6 WHERE id = $7 RETURNING adressemail, motdepasse, cv, nom, prenom, telephone";
const deleteOne = "DELETE FROM particulier WHERE id = $1 RETURNING adressemail, motdepasse, cv, nom, prenom, telephone";

module.exports = class {
    static async create(Particulier) {
        if (!Particulier) {
            throw 'Particulier object is undefined';
        }

        if (!Particulier.nom || !Particulier.prenom || !Particulier.motdepasse || !Particulier.cv || !Particulier.adressemail || !Particulier.telephone) {
            throw 'Particulier object is missing information';
        }

        let values = [Particulier.adressemail, Particulier.motdepasse, Particulier.cv, Particulier.nom, Particulier.prenom, Particulier.telephone];
        
        var result;
        
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

    static async getAll() {
        var result;
        var client = ClientSession.getSession();
        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(selectAll)
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

    static async getById(id) {
        if(!id) {
            throw 'No id specified';
        }

        var result;
        var client = ClientSession.getSession();

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(selectById, [id])
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
    
    static async updateOne({id, nom, prenom, motdepasse,cv,adressemail,telephone}) {
        if(!id){
            throw 'no id specified';
        }
        if(!nom){
            throw 'no name specified';
        }
        if(!prenom){
            throw 'no firstname specified';
        }
        if(!motdepasse){
            throw 'no password specified';
        }
        if (!cv){
            throw 'no cv specified';
        }
        if(!adressemail){
            throw 'no email specified';
        }
        if(!telephone){
            throw 'no telephone specified';
        }

        var values = [adressemail, motdepasse, cv, nom, prenom, telephone, id];
        
        var result;
        var client = ClientSession.getSession();

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateOne, values)
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