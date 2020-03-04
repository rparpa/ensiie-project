const ParticulierEntity = require('../../src/Model/Entity/Particulier');
module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    getProfil(id) {
        return this.httpClient.fetch('/profil', {}).then(rows => {
            return rows.map(row => {
                let Particulier = new ParticulierEntity();
                Particulier.nom = row.nom;
                Particulier.prenom = row.prenom;
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                Particulier.adresseDomicile = row.adresseDomicile;
                return Particulier;
            });
        });
    }

    editProfilNom(id,nom) {
        return this.httpClient.fetch('/profil/editnom', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&nom=" + nom

        }).then(rows => {
            return rows.map(row => {
                let Particulier = new ParticulierEntity();
                Particulier.nom = row.nom;
                Particulier.prenom = row.prenom;
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                Particulier.adresseDomicile = row.adresseDomicile;
                return Particulier
            });
        });
    }

    editProfilPrenom(id,prenom) {
        return this.httpClient.fetch('/profil/editprenom', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&prenom=" + prenom

        }).then(rows => {
            return rows.map(row => {
                let Particulier = new ParticulierEntity();
                Particulier.nom = row.nom;
                Particulier.prenom = row.prenom;
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                Particulier.adresseDomicile = row.adresseDomicile;
                return Particulier
            });
        });
    }
    
    editProfilEmail(id,email) {
        return this.httpClient.fetch('/profil/editemail', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&email=" + email

        }).then(rows => {
            return rows.map(row => {
                let Particulier = new ParticulierEntity();
                Particulier.nom = row.nom;
                Particulier.prenom = row.prenom;
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                Particulier.adresseDomicile = row.adresseDomicile;
                return Particulier
            });
        });
    }

    editProfilAdresseDomi(id,adresseDomi) {
        return this.httpClient.fetch('/profil/editadresse', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&adresseDomi=" + adresseDomi

        }).then(rows => {
            return rows.map(row => {
                let Particulier = new ParticulierEntity();
                Particulier.nom = row.nom;
                Particulier.prenom = row.prenom;
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                Particulier.adresseDomicile = row.adresseDomicile;
                return Particulier
            });
        });
    }

    editProfilTelephone(id,telephone) {
        return this.httpClient.fetch('/profil/edittelephone', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&telephone=" + telephone

        }).then(rows => {
            return rows.map(row => {
            let Particulier = new ParticulierEntity();
            Particulier.nom = row.nom;
                Particulier.prenom = row.prenom;
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.cv = row.cv;
                Particulier.motDePasse = row.motDePasse;
                Particulier.adresseDomicile = row.adresseDomicile;
            return Particulier
            });
        });
    }

    editProfilMdp(id,mdp) {
        return this.httpClient.fetch('/profil/editmdp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&mdp=" + mdp

        }).then(rows => {
            return rows.map(row => {
            let Particulier = new ParticulierEntity();
            Particulier.nom = row.nom;
            Particulier.prenom = row.prenom;
            Particulier.adresseMail = row.adresseMail;
            Particulier.telephone = row.telephone;
            Particulier.cv = row.cv;
            Particulier.motDePasse = row.motDePasse;
            Particulier.adresseDomicile = row.adresseDomicile;
                return Particulier
            });
        });
    }

    editProfilCV(id,cv) {
        return this.httpClient.fetch('/profil/editcv', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&cv=" + cv

        }).then(rows => {
            return rows.map(row => {
            let Particulier = new ParticulierEntity();
            Particulier.nom = row.nom;
            Particulier.prenom = row.prenom;
            Particulier.adresseMail = row.adresseMail;
            Particulier.telephone = row.telephone;
            Particulier.cv = row.cv;
            Particulier.motDePasse = row.motDePasse;
            Particulier.adresseDomicile = row.adresseDomicile;
                return Particulier
            });
        });
    }
}