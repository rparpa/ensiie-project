const ParticulierEntity = require('../src/Model/Entity/Particulier');
module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    getProfil(id) {
        return this.httpClient.fetch('/profil', {}).then(rows => {
            return rows.map(row => {
                let Particulier = new ParticulierEntity();
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                return Particulier;
            });
        });
    }

    editProfilEmail(email) {
        return this.httpClient.fetch('/profil/editemail', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "email=" + email

        }).then(rows => {
            return rows.map(row => {
                let Particulier = new ParticulierEntity();
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                return Particulier
            });
        });
    }

    editProfilTelephone(telephone) {
        return this.httpClient.fetch('/profil/edittelephone', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "telephone=" + telephone

        }).then(rows => {
            return rows.map(row => {
            let Particulier = new ParticulierEntity();
            Particulier.adresseMail = row.adresseMail;
            Particulier.telephone = row.telephone;
            Particulier.cv = row.cv;
            Particulier.motDePasse = row.motDePasse;
            return Particulier
            });
        });
    }

    editProfilMdp(mdp) {
        return this.httpClient.fetch('/profil/editmdp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "mdp=" + mdp

        }).then(rows => {
            return rows.map(row => {
            let Particulier = new ParticulierEntity();
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                return Particulier
            });
        });
    }

    editProfilCV(cv) {
        return this.httpClient.fetch('/profil/editcv', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "cv=" + cv

        }).then(rows => {
            return rows.map(row => {
            let Particulier = new ParticulierEntity();
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                return Particulier
            });
        });
    }
}