const ParticulierRepository = require('./ParticulierRepository');
const Particulier = require('../Entity/Particulier');

// jest.mock('pg');

// import {Client} from 'pg';

describe("Create tests", () => {
    // test('teeest', async() => {
    //     Client.mockReturnValue(new Error("coucouuuuu"));

    //     let particulier = { 
    //         id:'1' ,
    //         nom: 'nom',
    //         prenom: 'prenom',
    //         motdepasse: 'mdp',
    //         cv: 'cv',
    //         adressemail:'adresse'
    //     }

    //     try {
    //         await ParticulierRepository.create(particulier);
    //     }
    //     catch(e) {
    //         expect(e).toEqual('Particulier object is undefined');
    //     }
    // });

    test('Throw Particulier object undefined exception', async () => {
        try {
            await ParticulierRepository.create();
        }
        catch(e) {
            expect(e).toEqual('Particulier object is undefined');
        }
    });

    test('Throw Particulier object is missing information (telephone case) exception', async () => {
        let Part = new Particulier();
        Part.id = "1";
        Part.adressemail = "adresse@mail.com";
        Part.nom = 'nom';
        Part.prenom = 'prenom';
        Part.motdepasse = 'mdp';
        Part.cv =  'cv';
        // Part.telephone = '0000000'

        try {
            await ParticulierRepository.create(Part);
        }
        catch(e) {
            expect(e).toEqual('Particulier object is missing information');
        }
    });

    test('Throw Particulier object is missing information (adressemail case) exception', async () => {
        let Part = new Particulier();
        Part.id = "1";
        // Part.adressemail = "adresse@mail.com";
        Part.nom = 'nom';
        Part.prenom = 'prenom';
        Part.motdepasse = 'mdp';
        Part.cv =  'cv';
        Part.telephone = '0000000'

        try {
            await ParticulierRepository.create(Part);
        }
        catch(e) {
            expect(e).toEqual('Particulier object is missing information');
        }
    });

    test('Throw Particulier object is missing information (nom case) exception', async () => {
        let Part = new Particulier();
        // Part.id = "1";
        Part.adressemail = "adresse@mail.com";
        // Part.nom = 'nom';
        Part.prenom = 'prenom';
        Part.motdepasse = 'mdp';
        Part.cv =  'cv';
        Part.telephone = '0000000'

        try {
            await ParticulierRepository.create(Part);
        }
        catch(e) {
            expect(e).toEqual('Particulier object is missing information');
        }
    });
});

describe ("Update tests", () => {


});

describe("Get by Id tests", () => {
    test('should not get a particulier with no id', async () => {
        try {
            await ParticulierRepository.getById();
        }
        catch(e) {
            expect(e).toEqual('No id specified')
        }
    });
});

describe("Delete by Id tests", () => {
    test('should not delete a particulier with no id', async () => {
        try {
            await ParticulierRepository.deleteById();
        }
        catch(e) {
            expect(e).toEqual('No id specified')
        }
    });
});