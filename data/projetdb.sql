------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Ingredient
------------------------------------------------------------
CREATE TABLE public.Ingredient(
	Id    SERIAL NOT NULL ,
	nom   VARCHAR (64) NOT NULL  ,
	CONSTRAINT Ingredient_PK PRIMARY KEY (Id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE public.User(
	identifiant   VARCHAR (64) NOT NULL ,
	mdp           VARCHAR (2000)  NOT NULL  ,
	CONSTRAINT User_PK PRIMARY KEY (identifiant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Stocker
------------------------------------------------------------
CREATE TABLE public.Stocker(
	identifiant_User   VARCHAR (64) NOT NULL ,
	Id                 INT  NOT NULL ,
	quantite           INT   ,
	date_stock         DATE   ,
	Id_ingredient      INT  NOT NULL ,
	identifiant        VARCHAR (64) NOT NULL  ,
	CONSTRAINT Stocker_PK PRIMARY KEY (identifiant_User,Id)

	,CONSTRAINT Stocker_User_FK FOREIGN KEY (identifiant_User) REFERENCES public.User(identifiant)
	,CONSTRAINT Stocker_Ingredient0_FK FOREIGN KEY (Id) REFERENCES public.Ingredient(Id)
)WITHOUT OIDS;



