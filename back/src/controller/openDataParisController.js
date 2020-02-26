var express = require('express');
var router = express.Router();
var openDataRepository = require('../repository/openDataParisRepository');
var ParkingSpot = require('../entity/ParkingSpot');

/* ### FONCTIONS ### */

function fromJsonToObject(dataFromOpenDataParisRepo){
    const parkingSpotObjectList = [];

    for (var indice = 0; indice < dataFromOpenDataParisRepo.records.length; indice++) {
        var objectParkingSpot = new ParkingSpot(
            parkingSpotId = dataFromOpenDataParisRepo.records[indice].recordid,
            statut = null,
            vehiculeId = null,
            numVoie = dataFromOpenDataParisRepo.records[indice].fields.numvoie,
            typeVoie = dataFromOpenDataParisRepo.records[indice].fields.typevoie,
            nomVoie = dataFromOpenDataParisRepo.records[indice].fields.nomvoie,
            arrond = dataFromOpenDataParisRepo.records[indice].fields.arrond,
            typeSta = dataFromOpenDataParisRepo.records[indice].fields.typesta,
            typeMob = dataFromOpenDataParisRepo.records[indice].fields.typemob,
            tarif = dataFromOpenDataParisRepo.records[indice].fields.tar,
            latitude = dataFromOpenDataParisRepo.records[indice].geometry.coordinates[0],
            longitude = dataFromOpenDataParisRepo.records[indice].geometry.coordinates[1]
        );

        parkingSpotObjectList.push(objectParkingSpot) ;
    }

    return parkingSpotObjectList;
}

/* ### ROUTAGE ### */

router.get('/getAllParkingSpots', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){

        allParkingSpotObjectList = fromJsonToObject(dataFromOpenDataParisRepo);

        //console.log(parkingSpotObjectList)
        console.log(allParkingSpotObjectList.length)

        res.json(allParkingSpotObjectList);

    }

    var urlOptions = req.query;
    repository.getAllParkingSpots(urlOptions, onDataFromOpenDataParisRepo);

});

router.get('/getAllParkingSpotsVoitures', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){

        voituresParkingSpotObjectList = fromJsonToObject(dataFromOpenDataParisRepo);

        res.json(voituresParkingSpotObjectList);

        //console.log(parkingSpotObjectList)
        console.log(voituresParkingSpotObjectList.length)

    };

    var urlOptions = req.query;
    repository.getAllParkingSpotsVoitures(urlOptions, onDataFromOpenDataParisRepo);

});

router.get('/getAllParkingSpotsMotos', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){

        motosParkingSpotObjectList = fromJsonToObject(dataFromOpenDataParisRepo);

        res.json(motosParkingSpotObjectList);

        //console.log(parkingSpotObjectList)
        console.log(motosParkingSpotObjectList.length)

    };

    var urlOptions = req.query;
    repository.getAllParkingSpotsMotos(urlOptions, onDataFromOpenDataParisRepo);
});



router.get('/getAllParkingSpotsVelos', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){

        velosParkingSpotObjectList = fromJsonToObject(dataFromOpenDataParisRepo);

        res.json(velosParkingSpotObjectList);

        //console.log(parkingSpotObjectList)
        console.log(velosParkingSpotObjectList.length)

    };

    var urlOptions = req.query;
    repository.getAllParkingSpotsVelos(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsGratuit', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){

        gratuitParkingSpotObjectList = fromJsonToObject(dataFromOpenDataParisRepo);

        res.json(gratuitParkingSpotObjectList);

        //console.log(parkingSpotObjectList)
        console.log(gratuitParkingSpotObjectList.length)

    };

    var urlOptions = req.query;
    repository.getAllParkingSpotsGratuit(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsLivraison', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){

        livraisonParkingSpotObjectList = fromJsonToObject(dataFromOpenDataParisRepo);

        res.json(livraisonParkingSpotObjectList);

        //console.log(parkingSpotObjectList)
        console.log(livraisonParkingSpotObjectList.length)

    };

    var urlOptions = req.query;
    repository.getAllParkingSpotsLivraison(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsAutocar', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){

        autocarParkingSpotObjectList = fromJsonToObject(dataFromOpenDataParisRepo);

        res.json(autocarParkingSpotObjectList);

        //console.log(parkingSpotObjectList)
        console.log(autocarParkingSpotObjectList.length)

    };

    var urlOptions = req.query;
    repository.getAllParkingSpotsAutocar(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsElectrique', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){

        electriqueParkingSpotObjectList = fromJsonToObject(dataFromOpenDataParisRepo);


        res.json(electriqueParkingSpotObjectList);

        //console.log(parkingSpotObjectList)
        console.log(electriqueParkingSpotObjectList.length)

    };

    var urlOptions = req.query;
    repository.getAllParkingSpotsElectrique(urlOptions, onDataFromOpenDataParisRepo);
});


module.exports = router;
