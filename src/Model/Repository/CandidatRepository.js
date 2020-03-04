const ClientSession = require('../Factory/ClientSession');

const begin = "BEGIN";
const commit = "COMMIT";
const rollback = "ROLLBACK";

const checkCandidature = "SELECT idoffre FROM candidat WHERE idoffre = $1 AND idparticulier = $2";

const insert = "INSERT INTO candidat(idoffre, idparticulier) VALUES($1, $2) RETURNING *";

const selectAllCandidatByOffre = "SELECT p.id, adressemail, cv, nom, prenom, telephone FROM candidat c, particulier p WHERE c.idparticulier = p.id AND c.idoffre = $1";
const selectAllOffreByCandidat = "SELECT o.id, o.identreprise, e.nom, e.adressemail, e.adressesiege, e.logo, e.telephone, description, document, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution FROM candidat c, offre o, entreprise e WHERE c.idoffre = o.id AND o.identreprise = e.id AND c.idparticulier = $1";

module.exports = class {
    static async create(Candidat){
        if (!Candidat) {
            throw 'Candidat object is undefined';
        }

        if (!Candidat.idoffre || !Candidat.idparticulier) {
            throw 'Candidat object is missing information';
        }

        let result;
        let values = [Candidat.idoffre, Candidat.idparticulier];

        var client = ClientSession.getSession();

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(checkCandidature, [Candidat.idoffre, Candidat.idparticulier]);

            if(result.rows.length > 0) {
                throw 'Candidature already done';
            }

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

    static async getAllCandidatByOffre(idoffre) {
        var result;
        var client = ClientSession.getSession();
        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(selectAllCandidatByOffre, [idoffre])
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

    static async getAllOffreByCandidat(idparticulier) {
        var result;
        var client = ClientSession.getSession();
        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(selectAllOffreByCandidat, [idparticulier])
            .catch(err => {throw 'Error in database'});

            let length = result.rows.length;

            for(let i = 0 ; i < length ; ++i) {
                result.rows[i] = {
                    "id": result.rows[i].id,
                    "identreprise": {
                        "id": result.rows[i].identreprise,
                        "nom": result.rows[i].nom,
                        "adressemail": result.rows[i].adressemail,
                        "adressesiege": result.rows[i].adressesiege,
                        "logo": result.rows[i].logo,
                        "telephone": result.rows[i].telephone
                    },
                    "description": result.rows[i].description,
                    "document": result.rows[i].document,
                    "typecontrat": result.rows[i].typecontrat,
                    "adresse": result.rows[i].adresse,
                    "latitude": result.rows[i].latitude,
                    "longitude": result.rows[i].longitude,
                    "salaire": result.rows[i].salaire,
                    "titre": result.rows[i].titre,
                    "dateparution": result.rows[i].dateparution
                }
            }

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows;
    }
};