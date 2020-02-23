var https = require("https");

class OpenDataParis{
    constructor(){
        this.base = "https://opendata.paris.fr/api/records/1.0/search/?dataset=stationnement-voie-publique-emplacements&rows=10&facet=regpri&facet=regpar&facet=typsta&facet=arrond";
    }

    getAllParkingSpots(urlOptions, onOpenDataApiReturn){
        let url = this.base

        for(var optionName in urlOptions){
            //console.log(optionName)
            var optionValue = urlOptions[optionName];
            url += "&" + optionName + "=" + optionValue;
        }

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

    getAllParkingSpotsVoitures(urlOptions,onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=PAYANT+MIXTE" ;

        for(var optionName in urlOptions){
            //console.log(optionName)
            var optionValue = urlOptions[optionName];
            url += "&" + optionName + "=" + optionValue;
        }

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

    getAllParkingSpotsMotos(urlOptions, onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=2+ROUES&refine.regpar=Motos";

        for(var optionName in urlOptions){
            //console.log(optionName)
            var optionValue = urlOptions[optionName];
            url += "&" + optionName + "=" + optionValue;
        }

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

    //TODO bug Velos if options
    getAllParkingSpotsVelos(urlOptions, onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=2+ROUES&refine.regpar=V%C3%A9los ";

        for(var optionName in urlOptions){
            var optionValue = urlOptions[optionName];
            url += "&" + optionName + "=" + optionValue;
        }

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

    getAllParkingSpotsGratuit(urlOptions, onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=GRATUIT ";

        for(var optionName in urlOptions){
            //console.log(optionName)
            var optionValue = urlOptions[optionName];
            url += "&" + optionName + "=" + optionValue;
        }

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

    getAllParkingSpotsLivraison(urlOptions, onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=LIVRAISON";

        for(var optionName in urlOptions){
            //console.log(optionName)
            var optionValue = urlOptions[optionName];
            url += "&" + optionName + "=" + optionValue;
        }

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

    getAllParkingSpotsAutocar(urlOptions, onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=AUTOCAR ";

        for(var optionName in urlOptions){
            //console.log(optionName)
            var optionValue = urlOptions[optionName];
            url += "&" + optionName + "=" + optionValue;
        }

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

    getAllParkingSpotsElectrique(urlOptions, onOpenDataApiReturn){
        let url = this.base + "&refine.regpri=ELECTRIQUE ";

        for(var optionName in urlOptions){
            //console.log(optionName)
            var optionValue = urlOptions[optionName];
            url += "&" + optionName + "=" + optionValue;
        }

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
