const fetch = require("node-fetch");
module.export = class {
    constructor() {
    }

    async getAdrrByCoords(latitude,longitude) { // fonction async necessite async contexte lors de l'appel
        if(!latitude || !longitude){
            throw 'Parameter missing'
        }
        if(isNaN(latitude) || isNaN(longitude)){
            throw 'Parameters must be numbers';
        }
        var url = "https://nominatim.openstreetmap.org/reverse?format=json&"
        var encodedURL = url + "lat=" + latitude + "&lon=" + longitude;
        try {
        const response = await fetch(encodedURL);
        const json = await response.json();
        // console.log(json);
        // const res = JSON.parse(json);
        
        return json.display_name;
        
        } catch (error){
        console.log(error);
        }
        }

        
        ComputeDistance(lat1,lat2,lon1,lon2){ // Formule de Haversine pour la distance à vol d'oiseau
        // On travaille avec des radians donc tout nos angles sont convertis en radians en multipliant par pi / 180 
       if(!lat1 ||!lat2 || !lon1||!lon2){
           throw 'Parameter missing';
       }
       if(isNaN(lat1) ||isNaN(lat2) || isNaN(lon1)|| isNaN(lon2)){
        throw 'Parameter must be number';
    }
        var R = 6371; // km
        var dLat = (lat2-lat1)*Math.PI / 180;
        var dLon = (lon2-lon1)*Math.PI / 180; 
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) + 
                Math.cos(lat1*Math.PI / 180) * Math.cos(lat2*Math.PI / 180) *
                Math.sin(dLon/2) * Math.sin(dLon/2); 
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        var d = R * c;
    
        return d;
    }
}