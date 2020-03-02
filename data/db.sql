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
    titre VARCHAR NOT NULL
);

CREATE TABLE "candidat" (
    idoffre INTEGER REFERENCES offre(id) ,
    idparticulier INTEGER REFERENCES particulier(id) ,
    datedemande TIMESTAMP NOT NULL ,
    PRIMARY KEY (idoffre, idparticulier)
);