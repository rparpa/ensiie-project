module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    logIn(adresseMail, motDePasse) {
        return this.httpClient.fetch('/logIn', {}).then(rows => {
            return rows.map(row => {
                localStorage.setItem('id',row.isParticulier);
                localStorage.setItem('idPersonne',row.id);
            });
        });
    }

    signUp(nom, prenom, adresseMail, motDePasse) {
        return this.httpClient.fetch('/signUp', {}).then(rows => {
            return rows.map(row => {
                localStorage.setItem('id',row.isParticulier);
                localStorage.setItem('idPersonne',row.id);
            });
        });
    }

}