CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR,
    lastname VARCHAR,
    birthday date,
    pseudo VARCHAR,
    mail VARCHAR
);

INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail) VALUES ('Marwan', 'GUERNOUG', '1997-12-18', 'Kart', 'marwan.guernoug@ensiie.fr');
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail) VALUES ('Mike', 'MALECOT', '1995-08-06', 'Adolf', 'mike.malecot@ensiie.fr');
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail) VALUES ('Nicolas', 'CHARLON', '1996-11-09', 'Kozak', 'nicolas.charlon@ensiie.fr');
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail) VALUES ('Rayan', 'BELMADANI', '1996-10-18', 'Greenns', 'rayan.belmadani@ensiie.fr');