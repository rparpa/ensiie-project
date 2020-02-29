const mb = require('mountebank');
const settings = require('./conf/settings');
const parkingApi = require('./stubs/parking-api');

const mbServerInstance = mb.create({
        port: settings.port,
        pidfile:  './logs/mb.pid',
        logfile: './logs/mb.log',
        protofile: '../protofile.json',
        ipWhitelist: ['*']
    });

mbServerInstance.then(function() {
    parkingApi.addService();
});