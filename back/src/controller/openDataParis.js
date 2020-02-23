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


}); // end router

module.exports = router;
