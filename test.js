const CandidatRepository = require('./src/Model/Repository/CandidatRepository');

async function test() {
    let res = await CandidatRepository.getAllOffreByCandidat(1);

    console.log(res);
}

test();