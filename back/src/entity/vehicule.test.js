const Vehicule = require('./Vehicule');

describe('Vehicule to Json', function () {

    test('Test toJson', () => {
        let vehicule = new Vehicule();
        vehicule.id = "1" ;
        vehicule.userId = "007"
        vehicule.parkingSpotId = "1507"

        expect(vehicule.toJson()).toMatchObject({
            id: "1",
            userId: "007",
            parkingSpotId: "1507",
        })
    });

});