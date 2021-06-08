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
	SYNOPSIS            VARCHAR (500) NOT NULL ,
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
	CONTENT      VARCHAR  NOT NULL ,
	ID_PAGE      INT  NOT NULL  ,
	CONSTRAINT Section_PK PRIMARY KEY (ID_SECTION)

	,CONSTRAINT Section_Page_FK FOREIGN KEY (ID_PAGE) REFERENCES public.Article(ID_PAGE)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Maintains
------------------------------------------------------------
CREATE TABLE public.Maintains(
	ID_PAGE    INT  NOT NULL ,
	USERNAME   VARCHAR (30) NOT NULL  ,
	CONSTRAINT Maintains_PK PRIMARY KEY (ID_PAGE,USERNAME)

	,CONSTRAINT Maintains_Page_FK FOREIGN KEY (ID_PAGE) REFERENCES public.Article(ID_PAGE)
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
INSERT INTO public.User (USERNAME, EMAIL, PASSWD, CREATION_DATE, VALIDATE) VALUES ('demo', 'demo@demo.fr', '$2y$10$f17IfAAYhMiiTs30xgshkOqgZffYCsiHGszAsvzXQewEFBBhUTDJa', '2000-10-10', FALSE);

-- admin : admin123
INSERT INTO public.User (USERNAME, EMAIL, PASSWD, CREATION_DATE, VALIDATE) VALUES ('admin', 'admin@admin.fr', '$2y$10$dVTgDzaYXor87JGkmSS70eo/vGgRConuG4Uf5.A0Pt9Gi/.t.2tVe', '2000-09-10', TRUE);
INSERT INTO public.Admin (ID_ADMIN, USERNAME) VALUES (1, 'admin');

-- INSERT INTO ADMIN VALUES ('admin');

-- INSERT INTO ARTICLE
INSERT INTO public.Article (TITLE, CREATION_DATE, MODIFICATION_DATE, VALIDATED, SYNOPSIS, CAT0, CAT1) VALUES('TEST ARTICLE', '2000-10-10', '2000-10-10', FALSE, 'Ceci est la page de test !', 'Sport', 'Musique');
INSERT INTO public.Article (TITLE, CREATION_DATE, MODIFICATION_DATE, VALIDATED, SYNOPSIS, CAT0, CAT1) VALUES('TEST ARTICLE 2', '2000-10-11', '2000-10-12', TRUE, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy. ', 'Aucune', 'Musique');

-- INSERT INTO SECTION
INSERT INTO public.Section (TITLE, CONTENT, ID_PAGE) VALUES('Section Test 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam est eget semper euismod. Pellentesque at enim ac quam vestibulum sagittis. Quisque ullamcorper elit id justo sollicitudin, ut porttitor lectus viverra. Donec vitae risus accumsan, blandit lacus vitae, pulvinar sem. Phasellus porttitor quam eu massa lacinia condimentum. Cras faucibus magna sit amet purus malesuada, eu tincidunt quam varius. Pellentesque eu turpis ante. Quisque accumsan eros augue, in pellentesque nibh egestas a.Aenean facilisis non velit sit amet efficitur. Pellentesque luctus facilisis turpis sit amet feugiat. Quisque maximus auctor varius. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus facilisis orci nec scelerisque convallis. Mauris consectetur malesuada augue, at consequat lorem luctus at. Duis vitae turpis vel felis fermentum sodales. Cras eu felis lectus. Ut eleifend laoreet magna ac suscipit. Nunc rhoncus diam non justo dapibus, eget dignissim mi blandit. Donec cursus metus sed erat mollis sodales. Proin pellentesque, ex et varius iaculis, elit felis malesuada eros, volutpat aliquam nibh elit nec risus.Nullam vestibulum risus a nisl sodales, sed lobortis lacus consectetur. Curabitur lacinia quis felis eu fringilla. Pellentesque sed quam sodales, bibendum ex ac, sagittis odio. Vestibulum gravida lectus et sem viverra blandit. Nullam finibus lobortis odio, vel varius erat iaculis in. Nullam mattis sapien sed ornare interdum. Quisque pharetra blandit urna, sit amet pretium magna sollicitudin at. Nunc fringilla arcu vitae lectus fringilla iaculis. In eleifend ligula vehicula fermentum ornare. Donec mauris leo, scelerisque vitae diam ut, porta convallis diam. Phasellus efficitur nisl sit amet convallis vehicula.Fusce vel orci in lorem posuere pellentesque. Aliquam et purus nec est porta finibus. Fusce condimentum massa a ante hendrerit, vel elementum arcu pellentesque. Proin luctus vehicula mollis. Donec porta sem a malesuada tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam tristique tellus vel dolor egestas bibendum. Proin eu dapibus massa. Duis aliquam ex nec interdum dapibus. Nunc sed felis nec ligula efficitur sollicitudin ac sit amet odio. Praesent ornare posuere neque nec vehicula. Duis magna sem, accumsan ut tempus commodo, commodo non nisi. Cras nibh nibh, commodo aliquet elit ac, finibus porta magna.Etiam dignissim, lacus a imperdiet eleifend, ligula nibh vehicula leo, ac hendrerit diam velit id sapien. Duis augue dui, efficitur vitae sapien in, posuere scelerisque nibh. Pellentesque tristique blandit sem ac interdum. Ut gravida condimentum tortor, id congue ipsum pellentesque sed. Phasellus vulputate sem et eros hendrerit imperdiet. Nunc mauris ipsum, egestas id lacinia id, dapibus et tellus. Nullam at bibendum erat, in fermentum enim. Morbi euismod pharetra neque eu facilisis. Nullam commodo, ex eu sagittis elementum, mi urna consectetur orci, vitae tempus mauris risus non velit. Morbi laoreet ex sapien, ac efficitur diam sollicitudin at. Aliquam eu massa in sem hendrerit consectetur quis nec eros. Sed maximus facilisis nulla, ac cursus metus auctor ac. Maecenas lacus nibh, dictum id augue vel, sodales vestibulum erat.', 1);
INSERT INTO public.Section (TITLE, CONTENT, ID_PAGE) VALUES('Section Test 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam est eget semper euismod. Pellentesque at enim ac quam vestibulum sagittis. Quisque ullamcorper elit id justo sollicitudin, ut porttitor lectus viverra. Donec vitae risus accumsan, blandit lacus vitae, pulvinar sem. Phasellus porttitor quam eu massa lacinia condimentum. Cras faucibus magna sit amet purus malesuada, eu tincidunt quam varius. Pellentesque eu turpis ante. Quisque accumsan eros augue, in pellentesque nibh egestas a.Aenean facilisis non velit sit amet efficitur. Pellentesque luctus facilisis turpis sit amet feugiat. Quisque maximus auctor varius. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus facilisis orci nec scelerisque convallis. Mauris consectetur malesuada augue, at consequat lorem luctus at. Duis vitae turpis vel felis fermentum sodales. Cras eu felis lectus. Ut eleifend laoreet magna ac suscipit. Nunc rhoncus diam non justo dapibus, eget dignissim mi blandit. Donec cursus metus sed erat mollis sodales. Proin pellentesque, ex et varius iaculis, elit felis malesuada eros, volutpat aliquam nibh elit nec risus.Nullam vestibulum risus a nisl sodales, sed lobortis lacus consectetur. Curabitur lacinia quis felis eu fringilla. Pellentesque sed quam sodales, bibendum ex ac, sagittis odio. Vestibulum gravida lectus et sem viverra blandit. Nullam finibus lobortis odio, vel varius erat iaculis in. Nullam mattis sapien sed ornare interdum. Quisque pharetra blandit urna, sit amet pretium magna sollicitudin at. Nunc fringilla arcu vitae lectus fringilla iaculis. In eleifend ligula vehicula fermentum ornare. Donec mauris leo, scelerisque vitae diam ut, porta convallis diam. Phasellus efficitur nisl sit amet convallis vehicula.Fusce vel orci in lorem posuere pellentesque. Aliquam et purus nec est porta finibus. Fusce condimentum massa a ante hendrerit, vel elementum arcu pellentesque. Proin luctus vehicula mollis. Donec porta sem a malesuada tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam tristique tellus vel dolor egestas bibendum. Proin eu dapibus massa. Duis aliquam ex nec interdum dapibus. Nunc sed felis nec ligula efficitur sollicitudin ac sit amet odio. Praesent ornare posuere neque nec vehicula. Duis magna sem, accumsan ut tempus commodo, commodo non nisi. Cras nibh nibh, commodo aliquet elit ac, finibus porta magna.Etiam dignissim, lacus a imperdiet eleifend, ligula nibh vehicula leo, ac hendrerit diam velit id sapien. Duis augue dui, efficitur vitae sapien in, posuere scelerisque nibh. Pellentesque tristique blandit sem ac interdum. Ut gravida condimentum tortor, id congue ipsum pellentesque sed. Phasellus vulputate sem et eros hendrerit imperdiet. Nunc mauris ipsum, egestas id lacinia id, dapibus et tellus. Nullam at bibendum erat, in fermentum enim. Morbi euismod pharetra neque eu facilisis. Nullam commodo, ex eu sagittis elementum, mi urna consectetur orci, vitae tempus mauris risus non velit. Morbi laoreet ex sapien, ac efficitur diam sollicitudin at. Aliquam eu massa in sem hendrerit consectetur quis nec eros. Sed maximus facilisis nulla, ac cursus metus auctor ac. Maecenas lacus nibh, dictum id augue vel, sodales vestibulum erat.', 1);
INSERT INTO public.Section (TITLE, CONTENT, ID_PAGE) VALUES('Section Test 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam est eget semper euismod. Pellentesque at enim ac quam vestibulum sagittis. Quisque ullamcorper elit id justo sollicitudin, ut porttitor lectus viverra. Donec vitae risus accumsan, blandit lacus vitae, pulvinar sem. Phasellus porttitor quam eu massa lacinia condimentum. Cras faucibus magna sit amet purus malesuada, eu tincidunt quam varius. Pellentesque eu turpis ante. Quisque accumsan eros augue, in pellentesque nibh egestas a.Aenean facilisis non velit sit amet efficitur. Pellentesque luctus facilisis turpis sit amet feugiat. Quisque maximus auctor varius. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus facilisis orci nec scelerisque convallis. Mauris consectetur malesuada augue, at consequat lorem luctus at. Duis vitae turpis vel felis fermentum sodales. Cras eu felis lectus. Ut eleifend laoreet magna ac suscipit. Nunc rhoncus diam non justo dapibus, eget dignissim mi blandit. Donec cursus metus sed erat mollis sodales. Proin pellentesque, ex et varius iaculis, elit felis malesuada eros, volutpat aliquam nibh elit nec risus.Nullam vestibulum risus a nisl sodales, sed lobortis lacus consectetur. Curabitur lacinia quis felis eu fringilla. Pellentesque sed quam sodales, bibendum ex ac, sagittis odio. Vestibulum gravida lectus et sem viverra blandit. Nullam finibus lobortis odio, vel varius erat iaculis in. Nullam mattis sapien sed ornare interdum. Quisque pharetra blandit urna, sit amet pretium magna sollicitudin at. Nunc fringilla arcu vitae lectus fringilla iaculis. In eleifend ligula vehicula fermentum ornare. Donec mauris leo, scelerisque vitae diam ut, porta convallis diam. Phasellus efficitur nisl sit amet convallis vehicula.Fusce vel orci in lorem posuere pellentesque. Aliquam et purus nec est porta finibus. Fusce condimentum massa a ante hendrerit, vel elementum arcu pellentesque. Proin luctus vehicula mollis. Donec porta sem a malesuada tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam tristique tellus vel dolor egestas bibendum. Proin eu dapibus massa. Duis aliquam ex nec interdum dapibus. Nunc sed felis nec ligula efficitur sollicitudin ac sit amet odio. Praesent ornare posuere neque nec vehicula. Duis magna sem, accumsan ut tempus commodo, commodo non nisi. Cras nibh nibh, commodo aliquet elit ac, finibus porta magna.Etiam dignissim, lacus a imperdiet eleifend, ligula nibh vehicula leo, ac hendrerit diam velit id sapien. Duis augue dui, efficitur vitae sapien in, posuere scelerisque nibh. Pellentesque tristique blandit sem ac interdum. Ut gravida condimentum tortor, id congue ipsum pellentesque sed. Phasellus vulputate sem et eros hendrerit imperdiet. Nunc mauris ipsum, egestas id lacinia id, dapibus et tellus. Nullam at bibendum erat, in fermentum enim. Morbi euismod pharetra neque eu facilisis. Nullam commodo, ex eu sagittis elementum, mi urna consectetur orci, vitae tempus mauris risus non velit. Morbi laoreet ex sapien, ac efficitur diam sollicitudin at. Aliquam eu massa in sem hendrerit consectetur quis nec eros. Sed maximus facilisis nulla, ac cursus metus auctor ac. Maecenas lacus nibh, dictum id augue vel, sodales vestibulum erat.', 1);
INSERT INTO public.Section (TITLE, CONTENT, ID_PAGE) VALUES('Section Test 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam est eget semper euismod. Pellentesque at enim ac quam vestibulum sagittis. Quisque ullamcorper elit id justo sollicitudin, ut porttitor lectus viverra. Donec vitae risus accumsan, blandit lacus vitae, pulvinar sem. Phasellus porttitor quam eu massa lacinia condimentum. Cras faucibus magna sit amet purus malesuada, eu tincidunt quam varius. Pellentesque eu turpis ante. Quisque accumsan eros augue, in pellentesque nibh egestas a.Aenean facilisis non velit sit amet efficitur. Pellentesque luctus facilisis turpis sit amet feugiat. Quisque maximus auctor varius. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus facilisis orci nec scelerisque convallis. Mauris consectetur malesuada augue, at consequat lorem luctus at. Duis vitae turpis vel felis fermentum sodales. Cras eu felis lectus. Ut eleifend laoreet magna ac suscipit. Nunc rhoncus diam non justo dapibus, eget dignissim mi blandit. Donec cursus metus sed erat mollis sodales. Proin pellentesque, ex et varius iaculis, elit felis malesuada eros, volutpat aliquam nibh elit nec risus.Nullam vestibulum risus a nisl sodales, sed lobortis lacus consectetur. Curabitur lacinia quis felis eu fringilla. Pellentesque sed quam sodales, bibendum ex ac, sagittis odio. Vestibulum gravida lectus et sem viverra blandit. Nullam finibus lobortis odio, vel varius erat iaculis in. Nullam mattis sapien sed ornare interdum. Quisque pharetra blandit urna, sit amet pretium magna sollicitudin at. Nunc fringilla arcu vitae lectus fringilla iaculis. In eleifend ligula vehicula fermentum ornare. Donec mauris leo, scelerisque vitae diam ut, porta convallis diam. Phasellus efficitur nisl sit amet convallis vehicula.Fusce vel orci in lorem posuere pellentesque. Aliquam et purus nec est porta finibus. Fusce condimentum massa a ante hendrerit, vel elementum arcu pellentesque. Proin luctus vehicula mollis. Donec porta sem a malesuada tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam tristique tellus vel dolor egestas bibendum. Proin eu dapibus massa. Duis aliquam ex nec interdum dapibus. Nunc sed felis nec ligula efficitur sollicitudin ac sit amet odio. Praesent ornare posuere neque nec vehicula. Duis magna sem, accumsan ut tempus commodo, commodo non nisi. Cras nibh nibh, commodo aliquet elit ac, finibus porta magna.Etiam dignissim, lacus a imperdiet eleifend, ligula nibh vehicula leo, ac hendrerit diam velit id sapien. Duis augue dui, efficitur vitae sapien in, posuere scelerisque nibh. Pellentesque tristique blandit sem ac interdum. Ut gravida condimentum tortor, id congue ipsum pellentesque sed. Phasellus vulputate sem et eros hendrerit imperdiet. Nunc mauris ipsum, egestas id lacinia id, dapibus et tellus. Nullam at bibendum erat, in fermentum enim. Morbi euismod pharetra neque eu facilisis. Nullam commodo, ex eu sagittis elementum, mi urna consectetur orci, vitae tempus mauris risus non velit. Morbi laoreet ex sapien, ac efficitur diam sollicitudin at. Aliquam eu massa in sem hendrerit consectetur quis nec eros. Sed maximus facilisis nulla, ac cursus metus auctor ac. Maecenas lacus nibh, dictum id augue vel, sodales vestibulum erat.', 1);
INSERT INTO public.Section (TITLE, CONTENT, ID_PAGE) VALUES('Section Test 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam est eget semper euismod. Pellentesque at enim ac quam vestibulum sagittis. Quisque ullamcorper elit id justo sollicitudin, ut porttitor lectus viverra. Donec vitae risus accumsan, blandit lacus vitae, pulvinar sem. Phasellus porttitor quam eu massa lacinia condimentum. Cras faucibus magna sit amet purus malesuada, eu tincidunt quam varius. Pellentesque eu turpis ante. Quisque accumsan eros augue, in pellentesque nibh egestas a.Aenean facilisis non velit sit amet efficitur. Pellentesque luctus facilisis turpis sit amet feugiat. Quisque maximus auctor varius. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus facilisis orci nec scelerisque convallis. Mauris consectetur malesuada augue, at consequat lorem luctus at. Duis vitae turpis vel felis fermentum sodales. Cras eu felis lectus. Ut eleifend laoreet magna ac suscipit. Nunc rhoncus diam non justo dapibus, eget dignissim mi blandit. Donec cursus metus sed erat mollis sodales. Proin pellentesque, ex et varius iaculis, elit felis malesuada eros, volutpat aliquam nibh elit nec risus.Nullam vestibulum risus a nisl sodales, sed lobortis lacus consectetur. Curabitur lacinia quis felis eu fringilla. Pellentesque sed quam sodales, bibendum ex ac, sagittis odio. Vestibulum gravida lectus et sem viverra blandit. Nullam finibus lobortis odio, vel varius erat iaculis in. Nullam mattis sapien sed ornare interdum. Quisque pharetra blandit urna, sit amet pretium magna sollicitudin at. Nunc fringilla arcu vitae lectus fringilla iaculis. In eleifend ligula vehicula fermentum ornare. Donec mauris leo, scelerisque vitae diam ut, porta convallis diam. Phasellus efficitur nisl sit amet convallis vehicula.Fusce vel orci in lorem posuere pellentesque. Aliquam et purus nec est porta finibus. Fusce condimentum massa a ante hendrerit, vel elementum arcu pellentesque. Proin luctus vehicula mollis. Donec porta sem a malesuada tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam tristique tellus vel dolor egestas bibendum. Proin eu dapibus massa. Duis aliquam ex nec interdum dapibus. Nunc sed felis nec ligula efficitur sollicitudin ac sit amet odio. Praesent ornare posuere neque nec vehicula. Duis magna sem, accumsan ut tempus commodo, commodo non nisi. Cras nibh nibh, commodo aliquet elit ac, finibus porta magna.Etiam dignissim, lacus a imperdiet eleifend, ligula nibh vehicula leo, ac hendrerit diam velit id sapien. Duis augue dui, efficitur vitae sapien in, posuere scelerisque nibh. Pellentesque tristique blandit sem ac interdum. Ut gravida condimentum tortor, id congue ipsum pellentesque sed. Phasellus vulputate sem et eros hendrerit imperdiet. Nunc mauris ipsum, egestas id lacinia id, dapibus et tellus. Nullam at bibendum erat, in fermentum enim. Morbi euismod pharetra neque eu facilisis. Nullam commodo, ex eu sagittis elementum, mi urna consectetur orci, vitae tempus mauris risus non velit. Morbi laoreet ex sapien, ac efficitur diam sollicitudin at. Aliquam eu massa in sem hendrerit consectetur quis nec eros. Sed maximus facilisis nulla, ac cursus metus auctor ac. Maecenas lacus nibh, dictum id augue vel, sodales vestibulum erat.', 1);


-- INSERT INTO public.Article (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Soleil', '../vue/pages/soleil.php', 'Mikael Ferreira', '2021-01-29', 'TRUE', 'Le Soleil est l étoile du Système solaire. Dans la classification astronomique, c est une étoile de type naine jaune d une masse d environ 1,989 1 × 1030 kg, composée d hydrogène (75 % de la masse ou 92 % du volume) et d hélium (25 % de la masse ou 8 % du volume)', NULL, 4, 1);
-- INSERT INTO public.Article (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Papa Jhonny', '../vue/pages/papa_jhonny.php', 'Ton plus grand fan', '2021-01-29', 'FALSE', 'Johnny Hallyday, nom de scène de Jean-Philippe Smet, né le 15 juin 1943 dans le 9e arrondissement de Paris et mort le 5 décembre 2017 à Marnes-la-Coquette (Hauts-de-Seine), est un chanteur, compositeur et acteur français.', NULL, 10, 1);
-- INSERT INTO public.Article (title, url, author, date, validated, synopsis, id_admin, id_cat1, id_cat2) VALUES('Hadès', '../vue/pages/hadès.php', 'Zagreus', '2021-01-29', 'FALSE', 'Hades est un jeu vidéo roguelike action-RPG développé et publié par Supergiant Games, sorti le 17 septembre 2020 sur Microsoft Windows et Nintendo Switch.', NULL, 11, 12);