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
    nb_signal INTEGER DEFAULT 0,
    date_publication TIMESTAMP not null DEFAULT CURRENT_DATE,
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
INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('4', '5', 'Lave vaisselle encastrable hotpoint ariston', 'Vends lave-vaisselle encastrable Hotpoint ariston LSB 7M121 14 couverts standard dimensions largeur 59.5 cm hauteur 82 cm profondeur 57 cm. Nous le vendons suite à un déménagement (lave vaisselle en double)', '120', 0, '2019-02-04 11:55:28');
INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('4', '6', 'Vélo VTT femme neuf', 'Vélo VTT femme neuf. Achèter en juillet 2019. Prix d achat 310Euro(s). Je le revends 250Euro(s). Garantie 2 ans. Facture à l appui. Je vends également des anti-vols (3 au total)', '850', 0, '2018-03-30 09:12:49');
INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('1', '4', 'Ordinateur Acer Aspire reconditionné', 'Vente ordinateur reconditionné en parfait état de marche. PC n°23 : Acer Aspire, Processeur: AMD Athlon X2 64, Carte intégrée, Mémoire RAM:, 3 Go DDR3, Stockage:, 500 Go HDD, Système d’exploitation: Emmabuntüs, Prix: 110€, Livraison possible en main propre, État : Reconditionné par le vendeur.', '240', 0, '2015-06-25 23:38:26');
INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('2', '3', 'Imprimante HP ENVY Photo 6232 Neuve', 'Je vends une imprimante HP ENVY Photo 6232 Neuve (carton non ouvert - Seul le code barre a été découpé). * Imprime, scanne, copie. * Imp. rapide (Noir, 13ppm). * Idéal document : 2 cartouches - Wi-Fi airPrint, Wi-Fi ePrint. * Haute qualité (4800x1200ppp) - A4. * Impression gratuite possible jusqu''à 15 pages/mois (instant ink). Facture - Garantie', '120', 0, '2012-05-12 05:01:02');
INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('4', '4', 'Iphone SE 64 GO débloqué', 'iphone SE TBE 64 GO LIBRES TTS OERATEURS - entierement fonctionnel , y compris l''identification digitale ( ID ), MAJ IOS 13.3.1 installée , réenitialisé et remis a zero pour un nouvel utilisateur, des mini chocs d''usage sur les cotes , ecran d''origine et tres propre, capacité batterie 90 %', '253', 0, '2017-09-28 01:23:55');
INSERT INTO Annonce (id_user, id_etat, titre, description, prix, nb_signal, date_publication) VALUES ('3', '2', 'Samsung GT-C3590', 'Téléphone Samsung GT-C3590 avec tout son équipement, Peu utilisé, Livraison à négocier Blois et alentours', '150', 0, '2000-11-08 15:51:00');

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

INSERT INTO Image (id_annonce, url) VALUES ('1', 'img1.jpeg');
INSERT INTO Image (id_annonce, url) VALUES ('2', 'img2.jpeg');
INSERT INTO Image (id_annonce, url) VALUES ('3', 'img3.jpeg');
INSERT INTO Image (id_annonce, url) VALUES ('4', 'img4.jpeg');
INSERT INTO Image (id_annonce, url) VALUES ('5', 'img5.jpeg');
INSERT INTO Image (id_annonce, url) VALUES ('6', 'img6.jpeg');
INSERT INTO Image (id_annonce, url) VALUES ('7', 'img7.jpeg');
INSERT INTO Image (id_annonce, url) VALUES ('8', 'img8.jpeg');
INSERT INTO Image (id_annonce, url) VALUES ('9', 'img9.jpeg');
