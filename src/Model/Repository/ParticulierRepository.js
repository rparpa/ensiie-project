const ClientSession = require('../Factory/ClientSession');

const begin = "BEGIN";
const commit = "COMMIT";
const rollback = "ROLLBACK";

const login = "SELECT id FROM particulier WHERE adressemail = $1 AND motdepasse = $2";


const insert = "INSERT INTO particulier(adressemail, motdepasse, cv, nom, prenom, telephone) VALUES($1, $2, $3, $4, $5, $6) RETURNING adressemail, cv, nom, prenom, telephone";
const selectAll = "SELECT id , adressemail, cv, nom, prenom, telephone FROM particulier";
const selectById = "SELECT adressemail, cv, nom, prenom, telephone FROM particulier WHERE id = $1";

const updateNom = "UPDATE particulier SET nom = $1 WHERE id = $2 RETURNING adressemail, cv, nom, prenom, telephone";
const updatePrenom = "UPDATE particulier SET prenom = $1 WHERE id = $2 RETURNING adressemail, cv, nom, prenom, telephone";
const updateAdressemail = "UPDATE particulier SET adressemail = $1 WHERE id = $2 RETURNING adressemail, cv, nom, prenom, telephone";
const updateCv = "UPDATE particulier SET cv = $1 WHERE id = $2 RETURNING adressemail, cv, nom, prenom, telephone";
const updateMotdepasse = "UPDATE particulier SET motdepasse = $1 WHERE id = $2 RETURNING adressemail, cv, nom, prenom, telephone";
const updateTelephone = "UPDATE particulier SET telephone = $1 WHERE id = $2 RETURNING adressemail, cv, nom, prenom, telephone";

const deleteOne = "DELETE FROM particulier WHERE id = $1 RETURNING ";

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

    static async updateNom(id, nom) {
        if(!id) {
            throw 'No id specified';
        }
        if(!nom) {
            throw 'No name specified';
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

    static async updatePrenom(id, prenom) {
        if(!id) {
            throw 'No id specified';
        }
        if(!prenom) {
            throw 'No firstname specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updatePrenom, [prenom, id])
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
    
    static async updateMotdepasse(id, motdepasse){
        if(!id) {
            throw 'No id specified';
        }
        if(!motdepasse) {
            throw 'No motdepasse specified';
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

    static async updateCv(id, cv) {
        if(!id) {
            throw 'No id specified';
        }
        if(!cv) {
            throw 'No cv specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateCv, [cv, id])
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
        if(!id) {
            throw 'No id specified';
        }
        if(!adressemail) {
            throw 'No adressemail specified';
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
    
    static async updateTelephone(id, telephone) {
        if(!id) {
            throw 'No id specified';
        }
        if(!telephone) {
            throw 'No telephone specified';
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