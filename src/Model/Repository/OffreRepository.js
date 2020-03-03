const ClientSession = require('../Factory/ClientSession');

const begin = "BEGIN";
const commit = "COMMIT";
const rollback = "ROLLBACK";

const insert = "INSERT INTO offre(identreprise, description, document, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution) VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9, $10) RETURNING description, document, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution";
const selectAllByIdentreprise = "SELECT id, description, document, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution FROM offre WHERE identreprise = $1";

const updateDateparution = "UPDATE offre SET dateparution = $1 WHERE id = $2 RETURNING id, identreprise, description, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution";
const updateDescription = "UPDATE offre SET description = $1 WHERE id = $2 RETURNING id, identreprise, description, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution";
const updateDocument = "UPDATE offre SET document = $1 WHERE id = $2 RETURNING id, identreprise, description, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution";
const updateTypecontrat = "UPDATE offre SET typecontrat = $1 WHERE id = $2 RETURNING id, identreprise, description, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution";
const updateAdresse = "UPDATE offre SET adresse = $1 WHERE id = $2 RETURNING id, identreprise, description, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution";
const updateSalaire = "UPDATE offre SET salaire = $1 WHERE id = $2 RETURNING id, identreprise, description, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution";
const updateTitre = "UPDATE offre SET titre = $1 WHERE id = $2 RETURNING id, identreprise, description, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution";

const deleteOne = "DELETE FROM offre WHERE id = $1 RETURNING id, identreprise, description, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution"

module.exports = class {
    static async create(Offre) {
        if (!Offre) {
            throw 'Offre object is undefined';
        }

        if (!Offre.identreprise || !Offre.description || !Offre.document || !Offre.typecontrat ||!Offre.adresse || !Offre.latitude || !Offre.longitude ||!Offre.salaire ||!Offre.titre || !Offre.dateparution) {
            throw 'Offre object is missing information';
        }

        let result;
        let values = [Offre.identreprise, Offre.description, Offre.document, Offre.typecontrat, Offre.adresse, Offre.latitude, Offre.longitude, Offre.salaire, Offre.titre, Offre.dateparution];

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
       
    static async getAllByIdentreprise(identreprise) {
        if(!identreprise){
            throw 'no company specified';
        }

        var result;
        var client = ClientSession.getSession();
        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(selectAllByIdentreprise, [identreprise])
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

    static async getAllByArgs(titre, adresse, typecontrat, salaire, dateparution) {
        var request = "SELECT offre.id, offre.identreprise, entreprise.nom, entreprise.adressemail, entreprise.adressesiege, entreprise.logo, entreprise.telephone, description, document, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution FROM offre, entreprise WHERE offre.identreprise = entreprise.id";
        
        if(titre != null && titre != "''") {
            request += " AND titre ~ '" + titre + "'";
        }
        if(adresse != null && adresse != "''") {
            // if(!isWhere) {
            //     request += " WHERE";
            //     isWhere = true;
            // }
            // else {
            //     request += " AND"
            // }


        }
        if(typecontrat != null && typecontrat != "''") {
            request += " AND typecontrat = '" + typecontrat + "'";
        }
        if(salaire != null && salaire != "''") {
            request += " AND salaire >= " + salaire;
        }
        if(dateparution != null && dateparution != "''") {
            request += " AND dateparution >= '" + dateparution + "'";
        }

        var result;
        var client = ClientSession.getSession();
        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(request)
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

    static async updateDateparution(id, dateparution) {
        if(!id){
            throw 'no id specified';
        }
        if(!dateparution){
            throw 'no dateparution specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateDateparution, [dateparution, id])
            .catch(e => {throw 'Error in the database'});

            result.dateparution = new Date(dateparution).getTime();

            await client.query(commit)
            .catch(err => {throw 'Error in transaction'});
        }
        catch(e) {
            await client.query(rollback);
            throw e;
        }

        return result.rows[0];
    }
    
    static async updateDescription(id, description) {
        if(!id){
            throw 'no id specified';
        }
        if(!description){
            throw 'no description specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateDescription, [description, id])
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

    static async updateDocument(id, document) {
        if(!id){
            throw 'no id specified';
        }
        if(!document){
            throw 'no document specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateDocument, [document, id])
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

    static async updateTypecontrat(id, typecontrat) {
        if(!id){
            throw 'no id specified';
        }
        if(!typecontrat){
            throw 'no typecontrat specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateTypecontrat, [typecontrat, id])
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

    static async updateAdresse(id, adresse) {
        if(!id){
            throw 'no id specified';
        }
        if(!adresse){
            throw 'no adresse specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateAdresse, [adresse, id])
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

    static async updateSalaire(id, salaire) {
        if(!id){
            throw 'no id specified';
        }
        if(!salaire){
            throw 'no salaire specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateSalaire, [salaire, id])
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

    static async updateTitre(id, titre) {
        if(!id){
            throw 'no id specified';
        }
        if(!titre){
            throw 'no titre specified';
        }

        var client = ClientSession.getSession();
        var result;

        try {
            await client.query(begin)
            .catch(err => {throw 'Error in transaction'});

            result = await client.query(updateTitre, [titre, id])
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