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

module.exports = router;
