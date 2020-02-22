const mbHelper = require('../conf/mountbank-helper');
const settings = require('../conf/settings');

function addService() {
    const response = [
        {
            id: 1,
            vehiculeId: 2,
            numvoie: 12,
            typeVoie: "Rue",
            nomVoie: "lorem ipsum",
            arond: 10,
            status: "status",
            coord: {
                lat:2.456765,
                long:34.576765
            }
        },
        {
            id: 1,
            vehiculeId: 4,
            numvoie: 10,
            typeVoie: "Rue",
            nomVoie: "lorem ipsum",
            arond: 10,
            status: "status",
            coord: {
                lat:2.556765,
                long:33.576765
            }
        },
        {
            id: 1,
            vehiculeId: 5,
            numvoie: 34,
            typeVoie: "Rue",
            nomVoie: "lorem ipsum",
            arond: 9,
            status: "status",
            coord: {
                lat:2.256765,
                long:34.876765
            }
        },
        {
            id: 1,
            vehiculeId: 9,
            numvoie: 1,
            typeVoie: "Rue",
            nomVoie: "lorem ipsum",
            arond: 3,
            status: "status",
            coord: {
                lat:2.156765,
                long:34.176765
            }
        },
        {
            id: 1,
            vehiculeId: 45,
            numvoie: 12,
            typeVoie: "Rue",
            nomVoie: "lorem ipsum",
            arond: 10,
            status: "status",
            coord: {
                lat:2.956765,
                long:34.2276765
            }
        },
        {
            id: 1,
            vehiculeId: 98,
            numvoie: 12,
            typeVoie: "Avenue",
            nomVoie: "lorem ipsum",
            arond: 1,
            status: "status",
            coord: {
                lat:2.856765,
                long:34.976765
            }
        },
        {
            id: 1,
            vehiculeId: 78,
            numvoie: 12,
            typeVoie: "Rue",
            nomVoie: "lorem ipsum",
            arond: 10,
            status: "status",
            coord: {
                lat:2.336765,
                long:34.8876765
            }
        }
    ];

    const stubs = [
        {
            predicates: [ {
                equals: {
                    method: "GET",
                    "path": "/"
                }
            }],
            responses: [
                {
                    is: {
                        statusCode: 200,
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(response)
                    }
                }
            ]
        }
    ];

    const imposter = {
        port: settings.parkingPort,
        protocol: 'http',
        stubs: stubs
    };

    return mbHelper.postImposter(imposter);
}

module.exports = { addService };