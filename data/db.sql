-- Create schemas

-- Create tables
CREATE TABLE IF NOT EXISTS info
(
    id SERIAL,
    source TEXT NOT NULL,
    idsource INTEGER NOT NULL,
    idcreator INTEGER NOT NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    creationdate TIMESTAMP NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS task
(
    id SERIAL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    creationdate TIMESTAMP NOT NULL,
    state TEXT NOT NULL,
    idcreator INTEGER NOT NULL,
    idassignee INTEGER NOT NULL,
    idproject INTEGER NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS message
(
    id SERIAL,
    iduser INTEGER NOT NULL,
    source TEXT NOT NULL,
    message TEXT NOT NULL,
    creationdate TIMESTAMP NOT NULL,
    idsource INTEGER NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS project
(
    id SERIAL,
    name TEXT NOT NULL,
    idorganization INTEGER NOT NULL,
    creationdate TIMESTAMP NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS meeting
(
    id SERIAL,
    source TEXT NOT NULL,
    idsource INTEGER NOT NULL,
    name TEXT NOT NULL,
    place TEXT NOT NULL,
    creationdate TIMESTAMP NOT NULL,
    description TEXT NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS organization
(
    id SERIAL,
    name TEXT NOT NULL,
    creationdate TEXT NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS "user"
(
    id SERIAL,
    username TEXT NOT NULL,
    surname TEXT NOT NULL,
    name TEXT NOT NULL,
    mail TEXT NOT NULL,
    password TEXT NOT NULL,
    creationdate TIMESTAMP NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS usermeeting
(
    iduser INTEGER NOT NULL,
    idmeeting INTEGER NOT NULL,
    role TEXT NOT NULL,
    date TIMESTAMP NOT NULL,
    PRIMARY KEY(iduser, idmeeting)
);

CREATE TABLE IF NOT EXISTS userorganization
(
    idorganization INTEGER NOT NULL,
    iduser INTEGER NOT NULL,
    role TEXT,
    date TIMESTAMP NOT NULL,
    PRIMARY KEY(idorganization, iduser)
);

CREATE TABLE IF NOT EXISTS userproject
(
    iduser INTEGER NOT NULL,
    idproject INTEGER NOT NULL,
    role TEXT NOT NULL,
    date TIMESTAMP NOT NULL,
    PRIMARY KEY(iduser, idproject)
);


-- Create FKs
ALTER TABLE info
    ADD    FOREIGN KEY (idcreator)
    REFERENCES "user"(id)
    MATCH SIMPLE
;

ALTER TABLE task
    ADD    FOREIGN KEY (idcreator)
    REFERENCES "user"(id)
    MATCH SIMPLE
;

ALTER TABLE task
    ADD    FOREIGN KEY (idassignee)
    REFERENCES "user"(id)
    MATCH SIMPLE
;

ALTER TABLE message
    ADD    FOREIGN KEY (iduser)
    REFERENCES "user"(id)
    MATCH SIMPLE
;

ALTER TABLE project
    ADD    FOREIGN KEY (idorganization)
    REFERENCES organization(id)
    MATCH SIMPLE
;

ALTER TABLE usermeeting
    ADD    FOREIGN KEY (iduser)
    REFERENCES "user"(id)
    MATCH SIMPLE
;

ALTER TABLE usermeeting
    ADD    FOREIGN KEY (idmeeting)
    REFERENCES meeting(id)
    MATCH SIMPLE
;

ALTER TABLE userorganization
    ADD    FOREIGN KEY (idorganization)
    REFERENCES organization(id)
    MATCH SIMPLE
;

ALTER TABLE userorganization
    ADD    FOREIGN KEY (iduser)
    REFERENCES "user"(id)
    MATCH SIMPLE
;

ALTER TABLE userproject
    ADD    FOREIGN KEY (iduser)
    REFERENCES "user"(id)
    MATCH SIMPLE
;

ALTER TABLE userproject
    ADD    FOREIGN KEY (idproject)
    REFERENCES project(id)
    MATCH SIMPLE
;

ALTER TABLE task
    ADD    FOREIGN KEY (idproject)
    REFERENCES project(id)
    MATCH SIMPLE
;


-- Create Indexes


INSERT INTO "user"(username, surname, name, mail, password, creationdate )
VALUES ('JD', 'John', 'Doe', 'j.d@hl.com', '$2y$10$xLe4r1.aD5SY2nVfErx4BeI.BKrdXn.AYFvr2hqNqKa3QivJRMpQu', '1967-11-22');

INSERT INTO "user"(username, surname, name, mail, password, creationdate )
VALUES ('GAT', 'Oli', 'Gat', 'oli@gat.fr', '$2y$10$OFNUtx4KmC4nigEgTCObXeIwp/HMzH9uvwZyeiy9cP8dPLWdv5.Ou', '1967-11-22');

INSERT INTO "user"(username, surname, name, mail, password, creationdate )
VALUES ('Erl', 'Danel', 'Pierre', 'erl@erl.erl', '$2y$10$7phoabKhqhxdn/dMx9hepeaUTPxJtYSammg9romPhpJCzzyOcid8.', '1987-11-22');

INSERT INTO "user"(username, surname, name, mail, password, creationdate )
VALUES ('admin', 'admin', 'admin', 'admin@admin.admin', '$2y$10$I.QC4gSwJTzTDtweWKW1ae8DLpG7tPJlOryztXdD9fhYZl9opKd02', '1789-07-14');

INSERT INTO organization(name, creationdate)
VALUES ('Ile Mysterieuse', '2019-12-20');

INSERT INTO organization(name, creationdate)
VALUES ('Voyage au centre de la Terre', '1864-11-25');

INSERT INTO organization(name, creationdate)
VALUES ('Le conseil des 4', '2019-12-23');

INSERT INTO project
VALUES(3, 'Devenir le meilleur dresseur', 2, '2020-02-20');

INSERT INTO project
VALUES(1, 'Projet 1', 1, '2020-02-20');

INSERT INTO project
VALUES(2, 'Notre projeeet', 1, '2020-02-20');

INSERT INTO project
VALUES(4, 'Nettoyer les toilettes', 1, '2020-02-20');

INSERT INTO message( iduser, source, message, creationdate, idsource)
VALUES (1, 'organization', 'Le premier message.', '2020-02-16', 1);

INSERT INTO message( iduser, source, message, creationdate, idsource)
VALUES (1, 'organization', 'Un autre message', '2020-02-16', 2);

INSERT INTO info(source, idsource, idcreator, title, content, creationdate)
VALUES ('organization',1,1,'Les dauphins','sont nos amis','2020-02-17');

INSERT INTO info(source, idsource, idcreator, title, content, creationdate)
VALUES ('organization',1,1,'Les pingouins','ont trahi la horde','2020-02-19');

INSERT INTO meeting(source, idsource, name, place, creationdate, description)
VALUES ('project', 1, 'Coucou cest nous', 'chez ta maman', '2020-02-17', 'Un peu de mousse ?');

INSERT INTO meeting(source, idsource, name, place, creationdate, description)
VALUES ('project', 4, 'Choisir un responsable', 'Local poubelle', '2020-02-17', 'Qui veut des gants');

INSERT INTO task(title, content, creationdate, state, idcreator, idassignee, idproject)
VALUES('Nettoyage', 'Avec des gants et une brosse à dents', '2020-03-04', 'En cours', 1, 1, 4);

INSERT INTO userorganization
VALUES(1, 1,'Big Boss','2000-04-01');

INSERT INTO userorganization
VALUES(2, 3,'Big Boss','2000-04-01');

INSERT INTO userproject
VALUES(1, 1, 'Larbin', '2020-02-20');

INSERT INTO userproject
VALUES(1, 2, 'Larbin', '2020-02-20');

INSERT INTO userproject
VALUES(3, 3, 'Chef', '2020-02-20');

ALTER TABLE "user" ADD isadmin BOOLEAN NOT NULL DEFAULT FALSE;

UPDATE "user" SET isadmin = TRUE WHERE name = 'admin';

