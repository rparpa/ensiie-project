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
VALUES ('JD', 'John', 'Doe', 'j.d@hl.com', 'JD', '1967-11-22');

INSERT INTO organization(name, creationdate)
VALUES ('Ile Mysterieuse', '2019-12-20');

INSERT INTO project
VALUES(1, 'NewProject', 1, '2020-02-20');

INSERT INTO project
VALUES(2, 'NewProject2', 1, '2020-02-20');

INSERT INTO message( iduser, source, message, creationdate, idsource)
VALUES (1, 'organization', 'Le premier message.', '2020-02-16', 1);

INSERT INTO info(source, idsource, idcreator, title, content, creationdate)
VALUES ('organization',1,1,'Les dauphins','sont nos amis','2020-02-17');

INSERT INTO meeting(source, idsource, name, place, creationdate, description)
VALUES ('organization', 1, 'Coucou cest nous', 'chez ta maman', '2020-02-17', 'Un peu de mousse ?');

INSERT INTO userorganization
VALUES(1, 1,'Big Boss','2000-04-01');

INSERT INTO userproject
VALUES(1, 1, 'Larbin', '2020-02-20');

INSERT INTO userproject
VALUES(1, 2, 'Scripteur', '2020-02-20');

