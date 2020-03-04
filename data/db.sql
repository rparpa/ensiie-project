DROP TABLE  "user";
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR,
    lastname VARCHAR,
    birthday date,
    pseudo VARCHAR,
    mail VARCHAR,
    password VARCHAR,
    isvalidator BOOLEAN
);

INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password, isvalidator) VALUES ('Marwan', 'GUERNOUG', '1997-12-18', 'Kart', 'marwan.guernoug@ensiie.fr', '3a103a4e57', true);
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password, isvalidator) VALUES ('Mike', 'MALECOT', '1995-08-06', 'Adolf', 'mike.malecot@ensiie.fr', '3a103a4e57', true);
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password, isvalidator) VALUES ('Nicolas', 'CHARLON', '1996-11-09', 'Kozak', 'nicolas.charlon@ensiie.fr', '3a103a4e57', true);
INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password, isvalidator) VALUES ('Rayan', 'BELMADANI', '1996-10-18', 'Greenns', 'rayan.belmadani@ensiie.fr', '3a103a4e57', true);

DROP TABLE  "ingredient";
CREATE TABLE "ingredient" (
    id SERIAL PRIMARY KEY,
    label VARCHAR,
    available BOOLEAN,
    price REAL,
    image_link VARCHAR
);

INSERT INTO "ingredient" (label, available, price, image_link)
VALUES ('Salade', true, 0.2, '/images/lettuce.png');
INSERT INTO "ingredient" (label, available, price, image_link)
VALUES ('Tomate', true, 0.5, '/images/tomato.png');
INSERT INTO "ingredient" (label, available, price, image_link)
VALUES ('Oignon', true, 0.3, '/images/onion.png');
INSERT INTO "ingredient" (label, available, price, image_link)
VALUES ('Egg', true, 0.9, '/images/egg.png');
INSERT INTO "ingredient" (label, available, price, image_link)
VALUES ('Tuna', true, 0.3, '/images/tuna.png');
INSERT INTO "ingredient" (label, available, price, image_link)
VALUES ('Mozzarella', true, 1.2, '/images/mozzarella.png');
INSERT INTO "ingredient" (label, available, price, image_link)
VALUES ('Hummus', true, 1.0, '/images/hummus.png');

DROP TABLE  "sandwich";
CREATE TABLE "sandwich" (
    id SERIAL PRIMARY KEY,
    label VARCHAR
);

INSERT INTO "sandwich" (label)
VALUES ('Le kozak gourmand');
INSERT INTO "sandwich" (label)
VALUES ('Le marwoille');

DROP TABLE  "sandwich_ingredient";
CREATE TABLE "sandwich_ingredient" (
    sandwich_id BIGINT,
    ingredient_id BIGINT
);

INSERT INTO "sandwich_ingredient" (sandwich_id, ingredient_id)
VALUES (1, 1);
INSERT INTO "sandwich_ingredient" (sandwich_id, ingredient_id)
VALUES (1, 2);
INSERT INTO "sandwich_ingredient" (sandwich_id, ingredient_id)
VALUES (1, 3);

DROP TABLE  "order";
CREATE TABLE "order" (
    id SERIAL PRIMARY KEY,
    order_date DATE,
    approval BOOLEAN,
    client_id BIGINT,
    validator_id BIGINT
);

INSERT INTO "order" (order_date, approval, client_id, validator_id)
VALUES ('2020-02-01', true, 1, 2);
INSERT INTO "order" (order_date, approval, client_id, validator_id)
VALUES ('2020-02-01', false, 1, 3);

DROP TABLE  "order_sandwich";
CREATE TABLE "order_sandwich" (
    order_id BIGINT,
    sandwich_id BIGINT
);

INSERT INTO "order_sandwich" (order_id, sandwich_id)
VALUES (1, 1);
INSERT INTO "order_sandwich" (order_id, sandwich_id)
VALUES (2, 2);

DROP TABLE  "invoice";
CREATE TABLE "invoice" (
    id SERIAL PRIMARY KEY,
    order_id BIGINT,
    order_date date,
    order_number BIGINT,
    client_name VARCHAR,
    validator_name VARCHAR,
    order_detail VARCHAR,
    total_price REAL
);

INSERT INTO "invoice" (order_id, order_date, order_number, client_name, validator_name, order_detail, total_price)
VALUES (1, '2020-02-01', 1, 'Jeanne', 'Marwan', 'test', 36.4);
INSERT INTO "invoice" (order_id, order_date, order_number, client_name, validator_name, order_detail, total_price)
VALUES (2, '2020-02-01', 2, 'Simon', 'Marwan', 'test2', 16.4);