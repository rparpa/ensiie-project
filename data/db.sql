------------------------------------------------------------
--        Script Postgre
------------------------------------------------------------

------------------------------------------------------------
-- Table: Category
------------------------------------------------------------
CREATE TABLE public.Category(
	NAME   VARCHAR (20) NOT NULL  ,
	CONSTRAINT Category_PK PRIMARY KEY (NAME)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE public.User(
	USERNAME        VARCHAR (30) NOT NULL ,
	EMAIL           VARCHAR (100) NOT NULL ,
	PASSWD          VARCHAR (60) NOT NULL ,
	CREATION_DATE   DATE  NOT NULL ,
	VALIDATE        BOOL  NOT NULL,
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
CREATE TABLE public.Article(
	ID_PAGE             SERIAL NOT NULL ,
	TITLE               VARCHAR (50) NOT NULL ,
	CREATION_DATE       DATE  NOT NULL ,
	MODIFICATION_DATE   DATE  NOT NULL ,
	VALIDATED           BOOL  NOT NULL ,
	SYNOPSIS            VARCHAR (200) NOT NULL ,
	ID_ADMIN            INT   ,
	CAT0                VARCHAR (20)  ,
	CAT1                VARCHAR (20)  ,
	CONSTRAINT Page_PK PRIMARY KEY (ID_PAGE)

	,CONSTRAINT Page_Admin_FK FOREIGN KEY (ID_ADMIN) REFERENCES public.Admin(ID_ADMIN)
	,CONSTRAINT Page_Category0_FK FOREIGN KEY (CAT0) REFERENCES public.Category(NAME)
	,CONSTRAINT Page_Category1_FK FOREIGN KEY (CAT1) REFERENCES public.Category(NAME)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Section
------------------------------------------------------------
CREATE TABLE public.Section(
	ID_SECTION   SERIAL NOT NULL ,
	TITLE        VARCHAR (100) NOT NULL ,
	CONTENT      VARCHAR (2000)  NOT NULL ,
	ID_PAGE      INT  NOT NULL  ,
	CONSTRAINT Section_PK PRIMARY KEY (ID_SECTION)

	,CONSTRAINT Section_Page_FK FOREIGN KEY (ID_PAGE) REFERENCES public.Page(ID_PAGE)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Maintains
------------------------------------------------------------
CREATE TABLE public.Maintains(
	ID_PAGE    INT  NOT NULL ,
	USERNAME   VARCHAR (30) NOT NULL  ,
	CONSTRAINT Maintains_PK PRIMARY KEY (ID_PAGE,USERNAME)

	,CONSTRAINT Maintains_Page_FK FOREIGN KEY (ID_PAGE) REFERENCES public.Page(ID_PAGE)
	,CONSTRAINT Maintains_User0_FK FOREIGN KEY (USERNAME) REFERENCES public.User(USERNAME)
)WITHOUT OIDS;

------------------------------------------------------------
-- Insert
------------------------------------------------------------
INSERT INTO Category (name) VALUES ('');
INSERT INTO Category (name) VALUES ('Aucune');
INSERT INTO Category (name) VALUES ('Sport');
INSERT INTO Category (name) VALUES ('Physique');
INSERT INTO Category (name) VALUES ('Chimie');
INSERT INTO Category (name) VALUES ('Financier');
INSERT INTO Category (name) VALUES ('Juridique');
INSERT INTO Category (name) VALUES ('Musique');
INSERT INTO Category (name) VALUES ('Cinéma');
INSERT INTO Category (name) VALUES ('Rock');
INSERT INTO Category (name) VALUES ('Jeux');
INSERT INTO Category (name) VALUES ('Mythologie');

-- INSERT INTO public.User (USERNAME, EMAIL, PASSWD, CREATION_DATE, VALIDATE) VALUES ('demo', 'demo@test.fr', '123', '2000-10-10', TRUE);

-- demo : demo123
INSERT INTO public.User (USERNAME, EMAIL, PASSWD, CREATION_DATE, VALIDATE) VALUES ('demo', 'demo@demo.fr', '$2y$10$f17IfAAYhMiiTs30xgshkOqgZffYCsiHGszAsvzXQewEFBBhUTDJa', '2000-10-10', TRUE);

-- admin : admin123
INSERT INTO public.User (USERNAME, EMAIL, PASSWD, CREATION_DATE, VALIDATE) VALUES ('admin', 'admin@admin.fr', '$2y$10$dVTgDzaYXor87JGkmSS70eo/vGgRConuG4Uf5.A0Pt9Gi/.t.2tVe', '2000-09-10', TRUE);
INSERT INTO public.Admin (ID_ADMIN, USERNAME) VALUES (1, 'admin');

-- INSERT INTO ADMIN VALUES ('admin');

INSERT INTO public.Article (TITLE, CREATION_DATE, MODIFICATION_DATE, VALIDATED, SYNOPSIS, CAT0, CAT1) VALUES('TEST ARTICLE', '2000-10-10', '2000-10-10', FALSE, 'Ceci est la page de test !', 'Sport', 'Musique');
-- INSERT INTO public.Article (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Soleil', '../vue/pages/soleil.php', 'Mikael Ferreira', '2021-01-29', 'TRUE', 'Le Soleil est l étoile du Système solaire. Dans la classification astronomique, c est une étoile de type naine jaune d une masse d environ 1,989 1 × 1030 kg, composée d hydrogène (75 % de la masse ou 92 % du volume) et d hélium (25 % de la masse ou 8 % du volume)', NULL, 4, 1);
-- INSERT INTO public.Article (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Papa Jhonny', '../vue/pages/papa_jhonny.php', 'Ton plus grand fan', '2021-01-29', 'FALSE', 'Johnny Hallyday, nom de scène de Jean-Philippe Smet, né le 15 juin 1943 dans le 9e arrondissement de Paris et mort le 5 décembre 2017 à Marnes-la-Coquette (Hauts-de-Seine), est un chanteur, compositeur et acteur français.', NULL, 10, 1);
-- INSERT INTO public.Article (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Hadès', '../vue/pages/hadès.php', 'Zagreus', '2021-01-29', 'FALSE', 'Hades est un jeu vidéo roguelike action-RPG développé et publié par Supergiant Games, sorti le 17 septembre 2020 sur Microsoft Windows et Nintendo Switch.', NULL, 11, 12);