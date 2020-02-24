DROP TABLE  "user";
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR,
    lastname VARCHAR,
    birthday date,
    pseudo VARCHAR,
    mail VARCHAR,
    password VARCHAR
);

INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password) VALUES ('Marwan', 'GUERNOUG', '1997-12-18', 'Kart', 'marwan.guernoug@ensiie.fr', '1234');
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password) VALUES ('Mike', 'MALECOT', '1995-08-06', 'Adolf', 'mike.malecot@ensiie.fr', '1234');
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password) VALUES ('Nicolas', 'CHARLON', '1996-11-09', 'Kozak', 'nicolas.charlon@ensiie.fr', '1234');
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password) VALUES ('Rayan', 'BELMADANI', '1996-10-18', 'Greenns', 'rayan.belmadani@ensiie.fr', '1234');