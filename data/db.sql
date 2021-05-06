------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------

------------------------------------------------------------
-- Table: Categorie
------------------------------------------------------------
CREATE TABLE public.Categorie(
	NAME   VARCHAR (20) NOT NULL  ,
	CONSTRAINT Categorie_PK PRIMARY KEY (NAME)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE public.User(
	USERNAME        VARCHAR (30) NOT NULL ,
	EMAIL           VARCHAR (100) NOT NULL ,
	PASSWORD        VARCHAR (50) NOT NULL ,
	CREATION_DATE   DATE  NOT NULL ,
	VALIDATE        BOOL  NOT NULL  ,
	CONSTRAINT User_PK PRIMARY KEY (USERNAME)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Admin
------------------------------------------------------------
CREATE TABLE public.Admin(
	ID_ADMIN   SERIAL NOT NULL ,
	USERNAME   VARCHAR (30) NOT NULL  ,
	CONSTRAINT Admin_PK PRIMARY KEY (ID_ADMIN)

	,CONSTRAINT Admin_User_FK FOREIGN KEY (USERNAME) REFERENCES public.User(USERNAME)
	,CONSTRAINT Admin_User_AK UNIQUE (USERNAME)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Page
------------------------------------------------------------
CREATE TABLE public.Page(
	ID_PAGE             SERIAL NOT NULL ,
	TITLE               VARCHAR (50) NOT NULL ,
	URL                 VARCHAR (50) NOT NULL ,
	CREATION_DATE       DATE  NOT NULL ,
	MODIFICATION_DATE   DATE  NOT NULL ,
	VALIDATED           BOOL  NOT NULL ,
	SYNOPSIS            VARCHAR (200) NOT NULL ,
	ID_ADMIN            INT   ,
	NAME                VARCHAR (20)  ,
	NAME_Categorie      VARCHAR (20)   ,
	CONSTRAINT Page_PK PRIMARY KEY (ID_PAGE)

	,CONSTRAINT Page_Admin_FK FOREIGN KEY (ID_ADMIN) REFERENCES public.Admin(ID_ADMIN)
	,CONSTRAINT Page_Categorie0_FK FOREIGN KEY (NAME) REFERENCES public.Categorie(NAME)
	,CONSTRAINT Page_Categorie1_FK FOREIGN KEY (NAME_Categorie) REFERENCES public.Categorie(NAME)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Maintient
------------------------------------------------------------
CREATE TABLE public.Maintient(
	ID_PAGE    INT  NOT NULL ,
	USERNAME   VARCHAR (30) NOT NULL  ,
	CONSTRAINT Maintient_PK PRIMARY KEY (ID_PAGE,USERNAME)

	,CONSTRAINT Maintient_Page_FK FOREIGN KEY (ID_PAGE) REFERENCES public.Page(ID_PAGE)
	,CONSTRAINT Maintient_User0_FK FOREIGN KEY (USERNAME) REFERENCES public.User(USERNAME)
)WITHOUT OIDS;

------------------------------------------------------------
-- Insert
------------------------------------------------------------
INSERT INTO Categorie (name) VALUES ('');
INSERT INTO Categorie (name) VALUES ('Aucune');
INSERT INTO Categorie (name) VALUES ('Sport');
INSERT INTO Categorie (name) VALUES ('Physique');
INSERT INTO Categorie (name) VALUES ('Chimie');
INSERT INTO Categorie (name) VALUES ('Financier');
INSERT INTO Categorie (name) VALUES ('Juridique');
INSERT INTO Categorie (name) VALUES ('Musique');
INSERT INTO Categorie (name) VALUES ('Cinéma');
INSERT INTO Categorie (name) VALUES ('Rock');
INSERT INTO Categorie (name) VALUES ('Jeux');
INSERT INTO Categorie (name) VALUES ('Mythologie');

-- INSERT INTO ADMIN VALUES ('admin');

-- INSERT INTO Page (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('TEST', '../vue/pages/test.php', 'Jeremie Henrion', '2021-01-29', 'FALSE', 'Ceci est la page de test !', NULL,  3, 4);
-- INSERT INTO Page (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Soleil', '../vue/pages/soleil.php', 'Mikael Ferreira', '2021-01-29', 'TRUE', 'Le Soleil est l étoile du Système solaire. Dans la classification astronomique, c est une étoile de type naine jaune d une masse d environ 1,989 1 × 1030 kg, composée d hydrogène (75 % de la masse ou 92 % du volume) et d hélium (25 % de la masse ou 8 % du volume)', NULL, 4, 1);
-- INSERT INTO Page (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Papa Jhonny', '../vue/pages/papa_jhonny.php', 'Ton plus grand fan', '2021-01-29', 'FALSE', 'Johnny Hallyday, nom de scène de Jean-Philippe Smet, né le 15 juin 1943 dans le 9e arrondissement de Paris et mort le 5 décembre 2017 à Marnes-la-Coquette (Hauts-de-Seine), est un chanteur, compositeur et acteur français.', NULL, 10, 1);
-- INSERT INTO Page (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Hadès', '../vue/pages/hadès.php', 'Zagreus', '2021-01-29', 'FALSE', 'Hades est un jeu vidéo roguelike action-RPG développé et publié par Supergiant Games, sorti le 17 septembre 2020 sur Microsoft Windows et Nintendo Switch.', NULL, 11, 12);