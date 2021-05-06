------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Ingredient
------------------------------------------------------------
CREATE TABLE public.Ingredient(
	id    SERIAL NOT NULL ,
	nom   VARCHAR (64) NOT NULL  ,
	CONSTRAINT Ingredient_PK PRIMARY KEY (id)
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
	quantite           INT   ,
	date_stock         DATE   ,
	id_ingredient      INT  NOT NULL ,
    identifiant_user   VARCHAR (64) NOT NULL ,
	CONSTRAINT Stocker_PK PRIMARY KEY (identifiant_user,id_ingredient)

	,CONSTRAINT Stocker_User_FK FOREIGN KEY (identifiant_user) REFERENCES public.User(identifiant)
	,CONSTRAINT Stocker_Ingredient0_FK FOREIGN KEY (id_ingredient) REFERENCES public.Ingredient(id)
)WITHOUT OIDS;



