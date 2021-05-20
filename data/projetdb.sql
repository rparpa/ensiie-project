------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Ingredient
------------------------------------------------------------
CREATE TABLE public.Ingredient(
	id    SERIAL NOT NULL ,
	nom   VARCHAR (64) NOT NULL  ,
	unite CHAR (5) NOT NULL ,
	CONSTRAINT Ingredient_PK PRIMARY KEY (id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE public.Utilisateur(
	identifiant   VARCHAR (64) NOT NULL ,
	mdp           VARCHAR (2000)  NOT NULL ,
	statut        INT  NOT NULL  ,
	CONSTRAINT User_PK PRIMARY KEY (identifiant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Stocker
------------------------------------------------------------
CREATE TABLE public.Stocker(
	identifiant_utilisateur   VARCHAR (64) NOT NULL ,
    id_ingredient      INT  NOT NULL ,
	quantite           FLOAT   ,
	date_stock         DATE   ,
	CONSTRAINT Stocker_PK PRIMARY KEY (identifiant_Utilisateur,id_ingredient)

	,CONSTRAINT Stocker_User_FK FOREIGN KEY (identifiant_utilisateur) REFERENCES public.Utilisateur(identifiant)
	,CONSTRAINT Stocker_Ingredient0_FK FOREIGN KEY (id_ingredient) REFERENCES public.Ingredient(id)
)WITHOUT OIDS;

INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('John', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '0');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Yvette', '374396e03a2c57e5c2b5273eab82f571085413f0994d5cb01ce8ad24e61ba3da', '0');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Amelia', '9c39ddbe80796991c38b3d381b9b95ca5277de62b0b211b3274ab03b9b386172', '1');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Manuel', '4804f6f27df0b734ca5c3b844b991a65fab05d6379e2711fc588eba4fa9f3a22', '0');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Alonzo', '005d980a72c3dc26d85181c343657a945fc36618493fb902833e1e248aa7de9f', '1');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Otis', '77e335c81d3d7248d36cb1303c207c992f3a473eeca1f365f0c3b1998c703449', '0');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Jaime', 'cc9a26f55d5b600d7a85124a13a5f4b32481c7dca8950209328c7bcd9ab03e67', '0');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Vicky', '2490aafc94e832a6c63194ea1db6f38aff6c94a1fa281686a368c2fa7cb62488', '0');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Silvia', 'a64a14377f3263b785732d1e5e43e237fa9032d3086e978dde4b4214e057519c', '0');
INSERT INTO "public".Utilisateur(identifiant, mdp, statut) VALUES ('Brendan', '65924bf5809308bb84bf5a928a0019efcac1234fdee88d432fd6b12455f50c7f', '1');
INSERT INTO "public".utilisateur(identifiant, mdp, statut) VALUES ('Jackie', '1a12fef0345f3405a7da66b684bf2d862e770d679496cc2b002d556174044875', '0');
INSERT INTO "public".utilisateur(identifiant, mdp, statut) VALUES ('Delores', '27dab652931b8d7d13d95d1f0dbc3bfb7fcc9b861b6e70c3f5bbc75a20b71268', '0');

INSERT INTO public.Ingredient (id, nom, unite) VALUES ('0', 'Poireau', 'u');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('1', 'Ciboulette', 'g');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('2', 'Steak de soja', 'u');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('3', 'Bavette de boeuf', 'g');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('4', 'Pavé de saumon', 'g');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('5', 'Poivron rouge', 'u');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('6', 'Oeuf', 'u');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('7', 'Tagliatelle', 'g');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('8', 'Sel', 'g');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('9', 'Poivre', 'g');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('10', 'Courgette', 'u');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('11', 'Lait', 'L');
INSERT INTO public.Ingredient (id, nom, unite) VALUES ('12', 'Lait de soja', 'L');

INSERT INTO public.Stocker (identifiant_utilisateur, id_ingredient, quantite, date_stock) VALUES ('John', '2', '5.0', '2021-05-29');
INSERT INTO public.Stocker (identifiant_utilisateur, id_ingredient, quantite, date_stock) VALUES ('John', '0', '2.0', '2021-05-20');
INSERT INTO public.Stocker (identifiant_utilisateur, id_ingredient, quantite, date_stock) VALUES ('John', '7', '1000.0', '2022-12-31');
INSERT INTO public.Stocker (identifiant_utilisateur, id_ingredient, quantite, date_stock) VALUES ('Silvia', '6', '14.0', '2021-05-15');
INSERT INTO public.Stocker (identifiant_utilisateur, id_ingredient, quantite, date_stock) VALUES ('Silvia', '4', '1.2', '2021-05-25');
INSERT INTO public.Stocker (identifiant_utilisateur, id_ingredient, quantite, date_stock) VALUES ('Brendan', '5', '2.0', '2021-06-01');