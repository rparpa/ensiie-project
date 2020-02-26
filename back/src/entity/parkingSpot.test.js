const ParkingSpot = require('./ParkingSpot');

describe('Parking spot to Json', function () {

    test('Test toJson', () => {
        let parkingSpot = new ParkingSpot();
        parkingSpot.parkingSpotId = "129837",
        parkingSpot.statut = 0,
        parkingSpot.vehiculeId = "20207654",
        parkingSpot.numVoie = 9,
        parkingSpot.typeVoie = "Rue du",
        parkingSpot.nomVoie = "Père Brottier",
        parkingSpot.arrond = 16,
        parkingSpot.typeSta = "Bataille",
        parkingSpot.typeMob = "Sans",
        parkingSpot.tarif = 4.50,
        parkingSpot.latitude = 48.8584427838,
        parkingSpot.longitude =	2.38349883123

        expect(parkingSpot.toJson()).toMatchObject({
            parkingSpotId : "129837",
            statut : 0,
            vehiculeId : "20207654",
            numVoie : 9,
            typeVoie : "Rue du",
            nomVoie : "Père Brottier",
            arrond : 16,
            typeSta : "Bataille",
            typeMob : "Sans",
            tarif : 4.50,
            latitude : 48.8584427838,
            longitude :	2.38349883123
        })
    });

});