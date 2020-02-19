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
    droit_publication BOOLEAN NOT NULL DEFAULT true,
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
    prix DECIMAL,
    vendu BOOLEAN NOT NULL DEFAULT false,
    nb_signal INTEGER,
    date_publication TIMESTAMP,
    CONSTRAINT fk1_user_annonce FOREIGN KEY(id_user) REFERENCES Utilisateur(id_user) ON DELETE CASCADE,
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
    CONSTRAINT fk_annonce_image FOREIGN KEY (id_annonce) REFERENCES Annonce(id_annonce) ON DELETE CASCADE
);

INSERT INTO Utilisateur (nom, prenom, pseudo, password, email, telephone, promo, droit_publication, nb_signal_user, admin) VALUES ('Admin', 'Mehdi', 'Admin_pseudo', 'root', 'admin@test.fr', '0600000000', '2A', 'true', 0, 'true');
INSERT INTO Utilisateur (nom, prenom, pseudo, password, email, telephone, promo, droit_publication, nb_signal_user, admin) VALUES ('Mehdi', 'Abd', 'DrMehdi', 'root', 'mehdi@test.fr', '0600000000', '2A', 'true', 0, 'false');
INSERT INTO Utilisateur (nom, prenom, pseudo, password, email, telephone, promo, droit_publication, nb_signal_user, admin) VALUES ('Frescinel', 'Bart', 'fbart', 'root', 'fbart@test.fr', '0600000000', '2A', 'true', 0, 'false');
INSERT INTO Utilisateur (nom, prenom, pseudo, password, email, telephone, promo, droit_publication, nb_signal_user, admin) VALUES ('Redwan', 'b6', 'redwan', 'root', 'redwan@test.fr', '0600000000', '2A', 'true', 0, 'false');

INSERT INTO Etat(etat) VALUES ('Occasion');
INSERT INTO Etat(etat) VALUES ('Etat correct');
INSERT INTO Etat(etat) VALUES ('Bon état');
INSERT INTO Etat(etat) VALUES ('Très bon état');
INSERT INTO Etat(etat) VALUES ('Comme neuf');
INSERT INTO Etat(etat) VALUES ('Neuf');

INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('2', '1', 'Pc en très bon état à vendre!', 'PC Gamer /AMD FX 8320 /Radeon FX 570 4Go/ 16Go DDR3 / SSD 240 Go, DD 1To/Windows 10 pro.', '1100.55', 0, '2020-02-20 03:14:07');
INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('2', '2', 'Tel à vendre', 'Je Vends mon iPhone 7 32 go gold avec sa boîte. Aucun problème aucun beug aucune fissure, rien, parfait état je le vend pour acheter un nouveau téléphone. Pas d’échange.Petite négociation avec bonjour svp et au revoir sinon pas de réponse! Personnes mal intentionné s’abstenir. ', '800', 0, '2020-02-02 04:40:55');
INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('3', '1', 'Machine à coudre', 'Vend machine à coudre Electrolux 4600. Avec sa boite de ustensiles. Je fait pas d’envoie. Payement espece uniquement', '222', 0, '2019-05-05 22:22:22');

INSERT INTO Categorie(categorie) VALUES ('Informatique');
INSERT INTO Categorie(categorie) VALUES ('Multimédia');
INSERT INTO Categorie(categorie) VALUES ('Loisirs');
INSERT INTO Categorie(categorie) VALUES ('Vêtements');
INSERT INTO Categorie(categorie) VALUES ('BDE');
INSERT INTO Categorie(categorie) VALUES ('Dièse');
INSERT INTO Categorie(categorie) VALUES ('Offre stage');
INSERT INTO Categorie(categorie) VALUES ('Electroménager');
INSERT INTO Categorie(categorie) VALUES ('Meuble');
INSERT INTO Categorie(categorie) VALUES ('Évènement');
INSERT INTO Categorie(categorie) VALUES ('Billeterie');
INSERT INTO Categorie(categorie) VALUES ('Cours particuliers');
