var https = require("https");

class OpenDataParis{
    constructor(){
        this.base = "https://opendata.paris.fr/api/records/1.0/search/?dataset=stationnement-voie-publique-emplacements&rows=10000&facet=regpri&facet=regpar&facet=typsta&facet=arrond";
    }

    getAllParkingSpots(){

        let url = this.base;

        https.get(url, (res) => {
            let data = "";
            res.on('data', (d) => {
                data += d;
            });
            res.on('end', () => {
                console.log(JSON.parse(data));
            });
        }).on('error', (e) => {
            console.error(e);
        });
    }
}


module.exports = OpenDataParis;


let test = new OpenDataParis() ;

test.getAllParkingSpots()