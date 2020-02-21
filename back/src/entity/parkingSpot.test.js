const ParkingSpot = require('./ParkingSpot');

describe('Parking spot to Json', function () {

    test('Test toJson', () => {
        let parkingSpot = new ParkingSpot();
        parkingSpot.id = "1" ;
        parkingSpot.numVoie = 9 ;
        parkingSpot.typeVoie = "Rue du" ;
        parkingSpot.nomVoie = "Père Brottier" ;
        parkingSpot.arrond = 16 ;
        parkingSpot.status = "available" ;

        expect(parkingSpot.toJson()).toMatchObject({
            id: "1",
            numVoie: 9,
            typeVoie: "Rue du",
            nomVoie: "Père Brottier",
            arrond: 16,
            status: "available"
        })
    });

});