const EntrepriseEntity = require('../../src/Model/Entity/Entreprise');
module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    getProfil(id) {
        return this.httpClient.fetch('/profilentreprise', {}).then(rows => {
            return rows.map(row => {
                let Entreprise = new EntrepriseEntity();
                Entreprise.adresseMail = row.adresseMail;
                Entreprise.telephone = row.telephone;
                Entreprise.nom = row.nom;
                Entreprise.motDePasse = row.motDePasse;
                Entreprise.adresseSiege = row.adresseSiege;
                Entreprise.logo = row.logo;
                return Entreprise;
            });
        });
    }

    editProfilEmail(id,email) {
        return this.httpClient.fetch('/profilentreprise/editemail', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:"id="+id+ "&email=" + email 

        }).then(rows => {
            return rows.map(row => {
                let Entreprise = new EntrepriseEntity();
                Entreprise.adresseMail = row.adresseMail;
                Entreprise.telephone = row.telephone;
                Entreprise.nom = row.nom;
                Entreprise.motDePasse = row.motDePasse;
                Entreprise.adresseSiege = row.adresseSiege;
                Entreprise.logo = row.logo;
                return Entreprise
            });
        });
    }

    editProfilTelephone(id,telephone) {
        return this.httpClient.fetch('/profilentreprise/edittelephone', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&telephone=" + telephone

        }).then(rows => {
            return rows.map(row => {
            let Entreprise = new EntrepriseEntity();
                Entreprise.adresseMail = row.adresseMail;
                Entreprise.telephone = row.telephone;
                Entreprise.nom = row.nom;
                Entreprise.motDePasse = row.motDePasse;
                Entreprise.adresseSiege = row.adresseSiege;
                Entreprise.logo = row.logo;
            return Entreprise
            });
        });
    }

    editProfilMdp(id,mdp) {
        return this.httpClient.fetch('/profilentreprise/editmdp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&mdp=" + mdp

        }).then(rows => {
            return rows.map(row => {
            let Entreprise = new EntrepriseEntity();
                Entreprise.adresseMail = row.adresseMail;
                Entreprise.telephone = row.telephone;
                Entreprise.nom = row.nom;
                Entreprise.motDePasse = row.motDePasse;
                Entreprise.adresseSiege = row.adresseSiege;
                Entreprise.logo = row.logo; 
                return Entreprise
            });
        });
    }

    editProfilNomSiege(id,nom) {
        return this.httpClient.fetch('/profilentreprise/editnom', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&nom=" + nom

        }).then(rows => {
            return rows.map(row => {
            let Entreprise = new EntrepriseEntity();
                Entreprise.adresseMail = row.adresseMail;
                Entreprise.telephone = row.telephone;
                Entreprise.nom = row.nom;
                Entreprise.motDePasse = row.motDePasse;
                Entreprise.adresseSiege = row.adresseSiege;
                Entreprise.logo = row.logo;
                return Entreprise
            });
        });
    }

    editProfilAdresseSiege(id,adresse) {
        return this.httpClient.fetch('/profilentreprise/editadresse', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&adresse=" + adresse

        }).then(rows => {
            return rows.map(row => {
            let Entreprise = new EntrepriseEntity();
                Entreprise.adresseMail = row.adresseMail;
                Entreprise.telephone = row.telephone;
                Entreprise.nom = row.nom;
                Entreprise.motDePasse = row.motDePasse;
                Entreprise.adresseSiege = row.adresseSiege;
                Entreprise.logo = row.logo;
                return Entreprise
            });
        });
    }

    editProfilLogo(id,logo) {
        return this.httpClient.fetch('/profilentreprise/editlogo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+id+ "&logo=" + logo

        }).then(rows => {
            return rows.map(row => {
            let Entreprise = new EntrepriseEntity();
                Entreprise.adresseMail = row.adresseMail;
                Entreprise.telephone = row.telephone;
                Entreprise.nom = row.nom;
                Entreprise.motDePasse = row.motDePasse;
                Entreprise.adresseSiege = row.adresseSiege;
                Entreprise.logo = row.logo;
                return Entreprise
            });
        });
    }
}