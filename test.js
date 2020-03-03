const OffreRepository = require('./src/Model/Repository/OffreRepository');

async function test() {
    let res = await OffreRepository.getAllByArgs("t", null, null, null,null);

    console.log(res);
}

test();