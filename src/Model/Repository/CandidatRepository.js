const insert = "INSERT INTO candidat(idoffree, idparticulier, datedemande) VALUES($1, $2, $3) RETURNING *";

module.exports = class {
    static create(Candidat){
        if (!Candidat) {
            throw 'Candidat object is undefined';
        }

        if (!Candidat.idoffre || !Candidat.idparticulier || !Candidat.datedemande) {
            throw 'Candidat object is missing information';
        }

        if (Object.prototype.toString.call(Candidat.datedemande) !== "[object Date]") {
            throw 'Invalid date in candidat object';
        }

        let result;
        let values = [Candidat.idoffre, Candidat.idparticulier, Candidat.datedemande];

        ClientSession.getSession().query(insert, values, (err, res) => {
            if(err) {
                throw 'Error in the database'
            }
            else {
                result =  res.rows[0];
            }
        });

        return result;
    }

    // getAllByOffre(idOffre) {
    //     if(Object.prototype.toString.call(start_date) !== "[object Date]" || Object.prototype.toString.call(end_date) !== "[object Date]" || start_date =="Invalid Date" || end_date == "Invalid Date") {
    //         throw 'Invalid date in argument';
    //     }
    //     let candidats = this.db
    //                         .get('candidats')
    //                         .value();

    //     if (candidats != null) {
    //         let candidatsFiltered = [];
    //         let len = candidats.length

    //         for(let i = 0 ; i < len ; ++i) {
    //             if(candidats[i].idOffre == idOffre)  {
    //                 candidatsFiltered.push(candidats[i]);
    //             }
    //         }

    //         return candidatsFiltered;
    //     }

    //     return candidats;
    // }
    // getAllByParticulier(idParticulier){
    //     if(Object.prototype.toString.call(start_date) !== "[object Date]" || Object.prototype.toString.call(end_date) !== "[object Date]" || start_date =="Invalid Date" || end_date == "Invalid Date") {
    //         throw 'Invalid date in argument';
    //     }
    //     let candidats = this.db
    //                         .get('candidats')
    //                         .value();

    //     if (candidats != null) {
    //         let candidatsFiltered = [];
    //         let len = candidats.length

    //         for(let i = 0 ; i < len ; ++i) {
    //             if(candidats[i].idParticulier == idParticulier)  {
    //                 candidatsFiltered.push(candidats[i]);
    //             }
    //         }

    //         return candidatsFiltered;
    //     }

    //     return candidats;
    

    // }
};