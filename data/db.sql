DROP TABLE IF EXISTS "offre" CASCADE;
DROP TABLE IF EXISTS "candidat" CASCADE;
DROP TABLE IF EXISTS "administrateur" CASCADE;
DROP TABLE IF EXISTS "entreprise" CASCADE;
DROP TABLE IF EXISTS "particulier" CASCADE;

CREATE TABLE "administrateur" (
    id SERIAL PRIMARY KEY ,
    identifiant VARCHAR NOT NULL ,
    motdepasse VARCHAR NOT NULL
);

CREATE TABLE "entreprise" (
    id SERIAL PRIMARY KEY ,
    nom VARCHAR NOT NULL ,
    adressemail VARCHAR NOT NULL ,
    adressesiege VARCHAR NOT NULL ,
    motdepasse VARCHAR NOT NULL ,
    logo VARCHAR NOT NULL ,
    isvalid BOOLEAN NOT NULL,
    telephone VARCHAR NOT NULL
);

CREATE TABLE "particulier" (
    id SERIAL PRIMARY KEY ,
    adressemail VARCHAR NOT NULL ,
    motdepasse VARCHAR NOT NULL ,
    cv VARCHAR NOT NULL ,
    nom VARCHAR NOT NULL ,
    prenom VARCHAR NOT NULL,
    telephone VARCHAR NOT NULL
);

CREATE TABLE "offre" (
    id SERIAL PRIMARY KEY ,
    identreprise INTEGER REFERENCES entreprise(id) ,
    description VARCHAR NOT NULL ,
    document VARCHAR NOT NULL ,
    typecontrat VARCHAR NOT NULL ,
    adresse VARCHAR NOT NULL ,
    latitude NUMERIC NOT NULL ,
    longitude NUMERIC NOT NULL ,
    salaire NUMERIC NOT NULL ,
    titre VARCHAR NOT NULL ,
    dateparution NUMERIC NOT NULL
);

CREATE TABLE "candidat" (
    idoffre INTEGER REFERENCES offre(id) ,
    idparticulier INTEGER REFERENCES particulier(id) ,
    PRIMARY KEY (idoffre, idparticulier)
);

INSERT INTO particulier(adressemail, motdepasse, cv, nom, prenom, telephone) VALUES('test@gmail.com', 'f4f263e439cf40925e6a412387a9472a6773c2580212a4fb50d224d3a817de17', 'nomCV.pdf', 'LENOM', 'LEPRENOM', '0600000000');
INSERT INTO entreprise(nom, adressemail, adressesiege, motdepasse, logo, isvalid, telephone) VALUES('ENSIIE CORPO', 'ensiie@ensiie.fr', 'rue ensiie', 'f4f263e439cf40925e6a412387a9472a6773c2580212a4fb50d224d3a817de17', 'nomLogo.png', FALSE, '0700000000');
INSERT INTO offre(identreprise, description, document, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution) VALUES(1, 'Mission incroyable', 'document.pdf', 'CDI', 'rue ensiie', 90, 90, 50000, 'Poste incroyable', 0);
INSERT INTO offre(id, identreprise, description, document, typecontrat, adresse, latitude, longitude, salaire, titre, dateparution) VALUES(3, 1, 'Mission tranquille', 'document.pdf', 'CDD', 'rue ensiie', 90, 90, 50000, 'Poste tranquille', 0);
INSERT INTO candidat(idoffre, idparticulier) VALUES(1, 1);
INSERT INTO administrateur(identifiant, motdepasse) VALUES('admin', 'admin');