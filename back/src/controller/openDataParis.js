var express = require('express');
var router = express.Router();
var openDataRepository = require('../repository/openDataParis');
var ParkingSpot = require('../entity/ParkingSpot');


router.get('/getAllParkingSpots', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    repository.getAllParkingSpots(onDataFromOpenDataParisRepo);

});

router.get('/getAllParkingSpotsCars', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    repository.getAllParkingSpotsCars(function (dataFromOpenDataParisRepo){
                res.json(dataFromOpenDataParisRepo);
    });
});

router.get('/getAllParkingSpotsMotos', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    repository.getAllParkingSpotsMotos(function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    });
});

router.get('/getAllParkingSpotsVelos', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    repository.getAllParkingSpotsVelos(function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    });
});

router.get('/getAllParkingSpotsGratuit', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    repository.getAllParkingSpotsGratuit(function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    });
});

router.get('/getAllParkingSpotsLivraison', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    repository.getAllParkingSpotsLivraison(function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    });
});

router.get('/getAllParkingSpotsAutocar', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    repository.getAllParkingSpotsAutocar(function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    });
});

router.get('/getAllParkingSpotsElectrique', function(req, res, next) {
    let repository = new openDataRepository();

    var onDataFromOpenDataParisRepo = function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    }

    repository.getAllParkingSpotsElectrique(function (dataFromOpenDataParisRepo){
        res.json(dataFromOpenDataParisRepo);
    });
});


module.exports = router;
