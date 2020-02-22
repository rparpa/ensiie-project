const https = require('https');

https.get('https://opendata.paris.fr/api/records/1.0/search/?dataset=stationnement-voie-publique-emplacements&facet=regpri&facet=regpar&facet=typsta&facet=arrond', (resp) => {

    let data = '';

   resp.on('data', (chunk) => {
        data += chunk;
    });

    resp.on('end', () => {
        console.log(JSON.parse(data));

    });

}).on("error", (err) => {
    console.log("Error: " + err.message);
});

