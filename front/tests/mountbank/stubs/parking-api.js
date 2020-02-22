const mbHelper = require('../conf/mountbank-helper');
const settings = require('../conf/settings');
const simpleQuery = require("./ressources/parking-query");
const bigQuery = require("./ressources/parking-bigQuery");

function addService() {
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
                            "Access-Control-Allow-Origin": "*",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(simpleQuery.response)
                    }
                }
            ]
        },
        {
            predicates: [ {
                equals: {
                    method: "GET",
                    "path": "/bigQuery"
                }
            }],
            responses: [
                {
                    is: {
                        statusCode: 200,
                        headers: {
                            "Access-Control-Allow-Origin": "*",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(bigQuery.response)
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