var express = require('express');
var router = express.Router();
var openDataRepository = require('../repository/openDataParis');
var ParkingSpot = require('../entity/ParkingSpot');


router.get('/getAllParkingSpots', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);

        parkingSpotObjectList = [] ;

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

        console.log(parkingSpotObjectList)
        console.log(parkingSpotObjectList.length)

    }

    var urlOptions = req.query;
    repository.getAllParkingSpots(urlOptions, onDataFromOpenDataParisRepo);

});

router.get('/getAllParkingSpotsVoitures', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    var urlOptions = req.query;
    repository.getAllParkingSpotsVoitures(urlOptions, onDataFromOpenDataParisRepo);

});

router.get('/getAllParkingSpotsMotos', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    var urlOptions = req.query;
    repository.getAllParkingSpotsMotos(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsVelos', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    var urlOptions = req.query;
    repository.getAllParkingSpotsVelos(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsGratuit', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    var urlOptions = req.query;
    repository.getAllParkingSpotsGratuit(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsLivraison', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    var urlOptions = req.query;
    repository.getAllParkingSpotsLivraison(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsAutocar', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    var urlOptions = req.query;
    repository.getAllParkingSpotsAutocar(urlOptions, onDataFromOpenDataParisRepo);
});

router.get('/getAllParkingSpotsElectrique', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    var urlOptions = req.query;
    repository.getAllParkingSpotsElectrique(urlOptions, onDataFromOpenDataParisRepo);
});


module.exports = router;
