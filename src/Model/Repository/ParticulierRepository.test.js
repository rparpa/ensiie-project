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

    test('Throw Particulier object is missing information (id Offre case) exception', async () => {
        let Part = new Particulier();
        Part.id = "1"
        Part.adressemail = "adresse@mail.com"

        try {
            await ParticulierRepository.create(Part);
        }
        catch(e) {
            expect(e).toEqual('Particulier object is missing information');
        }
    });
});

describe ("Update tests", () => {

    test('should not update a particulier with no id', async () => {
        let particulier = { 
            // id:'1' ,
            nom: 'nom',
            prenom: 'prenom',
            motdepasse: 'mdp',
            cv: 'cv',
            adressemail:'adresse'
        }

        try {
            await ParticulierRepository.updateOne(particulier)
        }
        catch(e) {
            expect(e).toEqual('no id specified');
        }            
    });

    test('should not update a particulier with no mail', async () => {
        let particulier = { 
            id:'1' ,
            nom: 'nom',
            prenom: 'prenom',
            motdepasse: 'mdp',
            cv: 'cv'
        }
        
        try {
            await ParticulierRepository.updateOne(particulier)
        }
        catch(e) {
            expect(e).toEqual('no email specified');
        }            
    });

    test('should not update a particulier with no password', async () => {
        let particulier = { 
                id:'1' ,
                nom: 'nom',
                prenom: 'prenom',
                cv: 'cv',
                adressemail: 'adresse'
        }
        
        try {
            await ParticulierRepository.updateOne(particulier)
        }
        catch(e) {
            expect(e).toEqual('no password specified');
        }
    });
    
    test('should not update a particulier with no cv', async () => {
        let particulier = { 
            id:'1' ,
            nom: 'nom',
            prenom: 'prenom',
            motdepasse: 'mdp',
            adressemail: 'adresse'
        }

        try {
            await ParticulierRepository.updateOne(particulier)
        }
        catch(e) {
            expect(e).toEqual('no cv specified');
        }            
    });

    test('should not update a particulier with no name', async () => {
        let particulier = { 
            id:'1' ,
            // nom: 'nom',
            prenom: 'prenom',
            motdepasse: 'mdp',
            cv: 'cv',
            adressemail:'adresse'
        }

        try {
            await ParticulierRepository.updateOne(particulier)
        }
        catch(e) {
            expect(e).toEqual('no name specified');
        }             
    });

    test('should not update a particulier with no firstname', async () => {
        let particulier = { 
            id:'1' ,
            nom: 'nom',
            // prenom: 'prenom',
            motdepasse: 'mdp',
            cv: 'cv',
            adressemail:'adresse'
        }

        try {
            await ParticulierRepository.updateOne(particulier)
        }
        catch(e) {
            expect(e).toEqual('no firstname specified');
        } 
    });
});
