const ClientSession = require('../Factory/ClientSession');

const begin = "BEGIN";
const commit = "COMMIT";
const rollback = "ROLLBACK";

const login = "SELECT id FROM administrateur WHERE identifiant = $1 AND motdepasse = $2";

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