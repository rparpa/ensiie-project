/*
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);

INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');
*/


CREATE TABLE Utilisateur(
    id_user SERIAL NOT NULL PRIMARY KEY,
    nom VARCHAR(200),
    prenom VARCHAR(200),
    pseudo VARCHAR(200),
    password TEXT,
    email TEXT,
    telephone VARCHAR(20),
    promo VARCHAR(20),
    droit_publication BOOLEAN NOT NULL,
    nb_signal_user INTEGER,
    admin BOOLEAN NOT NULL
);

CREATE TABLE Etat(
    id_etat SERIAL NOT NULL PRIMARY KEY,
    etat VARCHAR(200)
);

CREATE TABLE Annonce (
    id_annonce SERIAL NOT NULL PRIMARY KEY,
    id_user INTEGER NOT NULL,
    id_etat INTEGER NOT NULL,
    titre VARCHAR(1024),
    description TEXT,
    prix DECIMAL(4, 2),
    vendu BOOLEAN NOT NULL,
    nb_signal INTEGER,
    date_publication TIMESTAMP,
    CONSTRAINT fk1_user_annonce FOREIGN KEY(id_user) REFERENCES Utilisateur(id_user),
    CONSTRAINT fk2_etat_annonce FOREIGN KEY(id_etat) REFERENCES Etat(id_etat)
);

CREATE TABLE Categorie (
    id_categorie SERIAL NOT NULL PRIMARY KEY,
    categorie VARCHAR(200)
);

CREATE TABLE Categorie_annonce (
    id_annonce INTEGER NOT NULL,
    id_categorie INTEGER NOT NULL,
    CONSTRAINT pk_categorie_annonce PRIMARY KEY(id_annonce,id_categorie),
    CONSTRAINT fk1_categorie_annonce FOREIGN KEY(id_annonce) REFERENCES Annonce(id_annonce),
    CONSTRAINT fk2_categorie_annonce FOREIGN KEY(id_categorie) REFERENCES Categorie(id_categorie)
);

CREATE TABLE Image (
    id_image SERIAL NOT NULL PRIMARY KEY,
    id_annonce INTEGER NOT NULL,
    url TEXT,
    CONSTRAINT fk_annonce_image FOREIGN KEY (id_annonce) REFERENCES Annonce(id_annonce)
);