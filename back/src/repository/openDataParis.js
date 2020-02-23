var https = require("https");

class OpenDataParis{
    constructor(){
        this.base = "https://opendata.paris.fr/api/records/1.0/search/?dataset=stationnement-voie-publique-emplacements&rows=10&facet=regpri&facet=regpar&facet=typsta&facet=arrond";
    }

    getAllParkingSpots(onOpenDataApiReturn){
        let url = this.base;

        https.get(url, (res) => {
            let data = "";
            res.on('data', (d) => {
                data += d;
            });
            res.on('end', () => {
                onOpenDataApiReturn(JSON.parse(data));
            });
        }).on('error', (e) => {
            console.error(e);
        });
    }

    getAllParkingSpotsCars(onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=PAYANT+MIXTE";

        https.get(url, (res) => {
            let data = "";
            res.on('data', (d) => {
                data += d;
            });
            res.on('end', () => {
                onOpenDataApiReturn(JSON.parse(data));
            });
        }).on('error', (e) => {
            console.error(e);
        });
    }

    getAllParkingSpotsMotos(onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=2+ROUES&refine.regpar=Motos";

        https.get(url, (res) => {
            let data = "";
            res.on('data', (d) => {
                data += d;
            });
            res.on('end', () => {
                onOpenDataApiReturn(JSON.parse(data));
            });
        }).on('error', (e) => {
            console.error(e);
        });
    }

    getAllParkingSpotsVelos(onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=2+ROUES&refine.regpar=V%C3%A9los ";

        https.get(url, (res) => {
            let data = "";
            res.on('data', (d) => {
                data += d;
            });
            res.on('end', () => {
                onOpenDataApiReturn(JSON.parse(data));
            });
        }).on('error', (e) => {
            console.error(e);
        });
    }

    getAllParkingSpotsGratuit(onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=GRATUIT ";

        https.get(url, (res) => {
            let data = "";
            res.on('data', (d) => {
                data += d;
            });
            res.on('end', () => {
                onOpenDataApiReturn(JSON.parse(data));
            });
        }).on('error', (e) => {
            console.error(e);
        });
    }


}//end constructor






module.exports = OpenDataParis;
