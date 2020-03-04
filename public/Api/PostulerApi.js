module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    postuler(idPersonne, idOffre) {
        
        return this.httpClient.fetch('/postuler', {}).then(rows => {
            return rows.map(row => {
                return(row.isValidated)
            });
        });
    }

}