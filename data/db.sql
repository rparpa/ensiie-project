CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL,
    lastname VARCHAR NOT NULL,
    email VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    birthday date,
    role int NOT NULL
);

INSERT INTO "user"(firstname, lastname, email, password, birthday, role) VALUES ('John', 'Doe', 'johndoe@ba.com', 'aaa', '1967-11-22',0);
INSERT INTO "user"(firstname, lastname, email, password, birthday, role) VALUES ('Yvette', 'Angel', 'yvangel@ba.com', 'bbb', '1932-01-24',0);
INSERT INTO "user"(firstname, lastname, email, password, birthday, role) VALUES ('Amelia', 'Waters', 'amwater@ho.com', 'ccc', '1981-12-01',1);


CREATE TABLE "marque" (
	id_marque SERIAL PRIMARY KEY,
	nom_marque VARCHAR NOT NULL
);

CREATE TABLE "modele" (
	id_modele SERIAL PRIMARY KEY,
	id_marque int NOT NULL,
	nom_modele VARCHAR NOT NULL,
	lien_img VARCHAR,
	FOREIGN KEY (id_marque) REFERENCES marque (id_marque)
);

CREATE TABLE "puissance" (
	id_puissance SERIAL,
	id_marque int,
	puissance_fisc int NOT NULL,
	puissance_ch int NOT NULL,
	FOREIGN KEY (id_marque) REFERENCES marque (id_marque),
	PRIMARY KEY (id_marque,id_puissance)
);

CREATE TABLE "finition" (
	id_finition SERIAL,
	id_marque int,
	nom_finition VARCHAR NOT NULL,
	liste_options VARCHAR,
	FOREIGN KEY (id_marque) REFERENCES marque (id_marque),
	PRIMARY KEY (id_marque,id_finition)
);

CREATE TABLE "voiture" (
	id_voiture SERIAL PRIMARY KEY,
	immat VARCHAR NOT NULL,
	date_immat date NOT NULL,
	prix int NOT NULL,
	id_marque int NOT NULL,
	id_modele int NOT NULL,
	id_puissance int NOT NULL,
	id_finition int NOT NULL,
	FOREIGN KEY (id_modele) REFERENCES modele (id_modele),
	FOREIGN KEY (id_puissance,id_marque) REFERENCES puissance (id_puissance,id_marque),
	FOREIGN KEY (id_marque,id_finition) REFERENCES finition (id_marque,id_finition)
);

CREATE TABLE "location" (
	id_location SERIAL PRIMARY KEY,
	id_voiture int NOT NULL,
	id_user int NOT NULL,
	date_debut date NOT NULL,
	date_fin date NOT NULL,
	prix int NOT NULL,
	km_max int,
	FOREIGN KEY (id_user) REFERENCES "user" (id),
	FOREIGN KEY (id_voiture) REFERENCES voiture (id_voiture)
);

INSERT INTO "marque"(id_marque,nom_marque) VALUES (0,'BMW');
INSERT INTO "marque"(id_marque,nom_marque) VALUES (1,'Volvo');
INSERT INTO "marque"(id_marque,nom_marque) VALUES (2,'Renault');
INSERT INTO "marque"(id_marque,nom_marque) VALUES (3,'Peugeot');

INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (1,0,'S60');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (1,1,'V60');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (1,2,'V70');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (1,3,'S40');
INSERT INTO "modele"(id_marque,id_modele,nom_modele, lien_img) VALUES (1,4,'V40','https://sf2.viepratique.fr/wp-content/uploads/sites/9/2017/06/volvo-v40.jpg');

INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (0,5,'Serie 1');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (0,6,'Serie 2');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (0,7,'Serie 3');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (0,8,'Serie 4');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (0,9,'Serie 5');

INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,10,'Clio 4');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,11,'Clio 5');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,12,'Megane');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,13,'Espace');

INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (3,14,'208');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,15,'308');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,16,'2008');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,17,'3008');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,18,'5008');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,19,'508');
INSERT INTO "modele"(id_marque,id_modele,nom_modele) VALUES (2,20,'508SW');

INSERT INTO "puissance"(id_puissance,id_marque,puissance_fisc,puissance_ch) VALUES (0,1,6,120);
INSERT INTO "puissance"(id_puissance,id_marque,puissance_fisc,puissance_ch) VALUES (1,1,9,150);
INSERT INTO "puissance"(id_puissance,id_marque,puissance_fisc,puissance_ch) VALUES (2,1,10,190);

INSERT INTO "finition"(id_finition,id_marque,nom_finition) VALUES (0,1,'KINETIC');
INSERT INTO "finition"(id_finition,id_marque,nom_finition) VALUES (1,1,'MOMENTUM');
INSERT INTO "finition"(id_finition,id_marque,nom_finition) VALUES (2,1,'SUMMUM');
INSERT INTO "finition"(id_finition,id_marque,nom_finition) VALUES (3,1,'XENIUM');

INSERT INTO "voiture"(immat,date_immat,id_marque,id_modele,id_puissance,id_finition,prix) VALUES ('FE-504-ZZ','01-05-2019',1,0,2,3,270);
INSERT INTO "voiture"(immat,date_immat,id_marque,id_modele,id_puissance,id_finition,prix) VALUES ('FK-824-BS','09-02-2019',1,4,0,3,400);
