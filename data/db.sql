/**
  Création du schéma de la base de données
 */
CREATE TABLE "tc_user"
(

    us_mail          TEXT PRIMARY KEY,
    us_firstname     TEXT    NOT NULL,
    us_lastname      TEXT    NOT NULL,
    us_pseudo        TEXT    NOT NULL,
    us_password      TEXT    NOT NULL,
    us_picture       TEXT    NOT NULL,
    us_zipcode       INT     NOT NULL,
    us_street        TEXT    NOT NULL,
    us_city          TEXT    NOT NULL,
    us_is_super_user BOOLEAN NOT NULL,
    us_is_banned     BOOLEAN NOT NULL
);

CREATE TABLE "tc_wish"
(
    wi_id    SERIAL PRIMARY KEY,
    wi_mail  TEXT REFERENCES tc_user (us_mail) NOT NULL,
    wi_label TEXT                              NOT NULL
);

CREATE TABLE "tc_category"
(
    ca_id          SERIAL PRIMARY KEY,
    ca_name        TEXT          NOT NULL,
    ca_number_swap INT DEFAULT 0 NOT NULL
);

CREATE TABLE "tc_item"
(
    it_id            SERIAL PRIMARY KEY,
    it_name          VARCHAR(50) NOT NULL,
    it_proprietary   TEXT        NOT NULL REFERENCES tc_user (us_mail),
    it_picture       TEXT        NOT NULL,
    it_description   TEXT        NOT NULL,
    it_creation_date DATE        NOT NULL DEFAULT CURRENT_DATE,
    it_is_swappable  BOOLEAN     NOT NULL DEFAULT TRUE
);

CREATE TABLE "tc_swap_status"
(
    tss_id   NUMERIC PRIMARY KEY,
    tss_name TEXT
);

INSERT INTO "tc_swap_status"
VALUES (0, 'EN ATTENTE'),
       (1, 'VALIDE'),
       (2, 'REFUSE');

CREATE TABLE "tc_swap"
(
    ts_id            SERIAL PRIMARY KEY,
    ts_creation_date DATE    NOT NULL                                    DEFAULT CURRENT_DATE,
    ts_end_date      DATE,
    ts_is_done       BOOLEAN NOT NULL                                    DEFAULT FALSE,
    ts_tss_id        NUMERIC NOT NULL REFERENCES tc_swap_status (tss_id) DEFAULT 0,
    ts_us_mail_from  TEXT    NOT NULL REFERENCES tc_user (us_mail) ON DELETE CASCADE,
    ts_us_mail_to    TEXT    NOT NULL REFERENCES tc_user (us_mail) ON DELETE CASCADE CHECK ( ts_us_mail_from != ts_us_mail_to )
);

CREATE TABLE "tc_item_category"
(
    id_item     INT NOT NULL REFERENCES tc_item (it_id) ON DELETE CASCADE,
    id_category INT NOT NULL REFERENCES tc_category (ca_id) ON DELETE CASCADE,
    PRIMARY KEY (id_item, id_category)
);

CREATE TABLE "tc_swap_item"
(
    id_item INT NOT NULL REFERENCES tc_item (it_id),
    id_swap INT NOT NULL REFERENCES tc_swap (ts_id),
    PRIMARY KEY (id_item, id_swap)
);


CREATE TABLE "tc_notification_swap"
(
    no_id            SERIAL PRIMARY KEY,
    no_user_mail     TEXT REFERENCES tc_user (us_mail) NOT NULL,
    no_swap_id       INT                               NOT NULL REFERENCES tc_swap (ts_id),
    no_creation_date DATE DEFAULT CURRENT_DATE         NOT NULL
);

CREATE FUNCTION close_swap_of_item() RETURNS trigger
    LANGUAGE plpgsql
AS
$$
DECLARE
BEGIN
    IF (new.it_is_swappable = FALSE AND old.it_is_swappable = TRUE) THEN
        UPDATE tc_swap
        SET ts_tss_id=2,
            ts_end_date=CURRENT_DATE,
            ts_is_done= true
        WHERE ts_id IN (select id_swap from tc_swap_item WHERE id_item = new.it_id)
          and ts_tss_id = 0;
    end IF;
    RETURN new;
END;
$$;

CREATE TRIGGER tr_close_swaps
    AFTER UPDATE
    ON tc_item
    FOR EACH ROW
EXECUTE PROCEDURE close_swap_of_item();

CREATE FUNCTION update_status_swap() RETURNS trigger
    LANGUAGE plpgsql
AS
$$
DECLARE
    cur_items_in_swap CURSOR (id_s INTEGER)
        FOR SELECT id_item as id_item
            FROM tc_swap_item
            WHERE id_swap = id_s;
    rec_items_id RECORD;
BEGIN
    /* Si le troc est terminé alors on met les bons champs associés, si le troc est validé alors notre objet devient non trocable, cela aura pour conséquence de fermer tous les trocs
       associés à cet objet
     */
    IF new.ts_tss_id = 1 OR new.ts_tss_id = 2 THEN
        new.ts_is_done = TRUE;
        new.ts_end_date = CURRENT_DATE;
        IF new.ts_tss_id = 1 THEN
            OPEN cur_items_in_swap(new.ts_id);
            LOOP
                FETCH cur_items_in_swap INTO rec_items_id;
                EXIT WHEN NOT found;
                UPDATE tc_item SET it_is_swappable= FALSE where it_id = rec_items_id.id_item;

            END LOOP;
            new.ts_tss_id = 1;
        END IF;
    END IF;

    RETURN new;
END;
$$;

CREATE TRIGGER tr_swap_status_changed
    AFTER UPDATE
    ON tc_swap
    FOR EACH ROW
EXECUTE PROCEDURE update_status_swap();

CREATE VIEW CALENDAR_LAST_SEVEN_DAYS AS
SELECT (current_date - (n || 'days')::INTERVAL)::DATE date
FROM generate_series(0, 6) n
ORDER BY date;

CREATE TABLE "tc_token"
(
    tr_token TEXT NOT NULL,
    id_user  TEXT NOT NULL REFERENCES tc_user (us_mail),
    PRIMARY KEY (id_user, tr_token)
);

/*
 Ce trigger ne fonctionne pas bien pour l'instant
 */

CREATE OR REPLACE FUNCTION numberSwapIncr()
    RETURNS trigger
    LANGUAGE plpgsql AS
$$
BEGIN
    UPDATE tc_category
    SET ca_number_swap = ca_number_swap + 1
    WHERE ca_id IN (SELECT tc_item_category.id_category
                    FROM tc_item_category
                    WHERE tc_item_category.id_item = new.id_item);
    RETURN new;
END;
$$;

CREATE TRIGGER incrementCaNumberSwap
    AFTER INSERT
    ON tc_swap_item
    FOR EACH ROW
EXECUTE PROCEDURE numberSwapIncr();



/**
  INSERTION dans la base de données d'informations pour ne pas avoir une application vide
 */
/*
 Création des utilisateurs
 */
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('ange@gmail.com', 'Angela', 'Ziegler', 'Ange',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d067db9096.09601097.png', 13311, '10 rue du soin', 'Geneve', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('ana@gmail.com', 'Ana', 'Amari', 'Ana',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d0d34b5ad3.20237330.png', 32133, '10 rue du sniper', 'Le Caire', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('genji@gmail.com', 'Genji', 'Shimura', 'Genji',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d12710a936.62575814.png', 13121, '10 rue du shuriken', 'Hanamura', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('soldat76@gmail.com', 'Jack', 'Morrison', 'Soldat76',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d163500e95.93281885.png', 14412, '10 rue de la roquette', 'Hollywood', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('hanzo@gmail.com', 'Hanzo', 'Shimura', 'Hanzo',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d1bf100647.37166608.png', 94483, '10 rue de l''arc', 'Hanamura', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('pharah@gmail.com', 'Pharah', 'Amari', 'Pharah',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d24a998e17.54910404.png', 98484, '10 rue du lance roquette', 'Anubis', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('tracer@gmail.com', 'Len', 'Oxton', 'Tracer',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d2cf9f5a14.71925005.png', 13313, '10 rue du chronomètre', 'King''s Row', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('mccree@gmail.com', 'Jessy', 'Mccree', 'Mccree',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d3059776f4.88732080.png', 39494, '10 rue du renommage', 'Route 66', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('fatale@gmail.com', 'Anne', 'Delacroix', 'Fatale',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d33bd70587.26294600.png', 39391, '10 rue du sniper', 'Annecy', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('brigitte@gmail.com', 'Brigitte', 'Lindholm', 'Brigitte',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d3c234e204.37903741.png', 13393, '10 rue du stun ', 'Stockholm', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street,
                     us_city, us_is_super_user, us_is_banned)
VALUES ('orisa@gmail.com', 'Efi', 'Oldadele', 'Orisa',
        'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc',
        '6272d4021e2563.47987067.png', 34313, '10 rue du javelot', 'Numbani', false, false);

/*
 Ajout des catégories
 */
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (1, 'DVD', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (2, 'EDUCATION', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (3, 'GOODIES', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (4, 'MANGA', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (5, 'BD', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (6, 'ARME', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (7, 'JEUX VIDEO', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (8, 'INFORMATIQUE', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (9, 'ELECTROMENAGER', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (10, 'CARTE A JOUER', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (11, 'VOITURE', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (12, 'NEUF', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (13, 'OCCASION', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (14, 'BIJOU', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (15, 'LITTERATURE', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap)
VALUES (16, 'VETEMENTS', 0);

INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (28, 'Pelotte de laine', 'pharah@gmail.com', '6272e92eee0858.91940061.png',
        'Lot de 20 pelottes de laine pour tricoter', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (29, 'Boucles d''oreille (or 24 carat)', 'pharah@gmail.com', '6272e96e0eddf6.01394079.jpg',
        'Boucles d''oreille en or 24 carat. Venant du manège à bijoux de leclerc.', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (10, 'Mini frigo', 'ana@gmail.com', '6272db180a8957.96986900.png',
        'Mini frigo pouvant contenir jusqu''à 20 boissons.', '2022-05-01', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (5, 'Figurine de Genji', 'ange@gmail.com', '6272d8ea82c8e1.41037375.jpg', 'Figurine du ninja d''Overwatch',
        '2022-05-02', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (1, 'Les misérables', 'ange@gmail.com', '6272d7362247d7.47502701.jpeg',
        'Livre les misérables de Victor Hugo qui est excellent. Très bon état', '2022-05-01', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (26, 'Gilet par balles', 'pharah@gmail.com', '6272e8dd758dd6.02175747.jpg', 'Gilet volé à un policier',
        '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (2, 'La médecine pour les nuls', 'ange@gmail.com', '6272d799bcb725.12874741.jpg',
        'Livre qui est très utile pour ceux voulant faire des études de médecine.', '2022-05-03', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (9, 'Sniper', 'ana@gmail.com', '6272dad0f162b6.04252598.png',
        'Le sniper que j''utilise pour la chasse. Les cartouches sont non comprises', '2022-05-02', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (3, 'Masques chirurgicaux', 'ange@gmail.com', '6272d87c1bb964.09115469.jpg',
        'Boîte de 20 masques chirurgicaux non utilisés', '2022-04-14', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (23, 'Lot de 3 arcs ', 'hanzo@gmail.com', '6272e720a4e924.27868293.jpg',
        'Arcs pour débutant, très utile pour commencer. Flèches non incluses.', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (31, 'Moto Kawazaki (10000km)', 'tracer@gmail.com', '6272eb01606802.52718822.jpg',
        'Moto kawazaki, 70 chevaux ayant quelques kilomètres. ', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (32, 'Figurine Tracer Overwatch', 'tracer@gmail.com', '6272eb2f8abd91.56255700.jpg',
        'Figurine de tracer dans Overwatch', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (6, 'Stylo 4 couleurs', 'ana@gmail.com', '6272da2046b379.21490180.jpg',
        'Stylo 4 couleurs, le bleu ne fonctionne plus', '2022-05-02', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (8, 'Lampe de chevet', 'ana@gmail.com', '6272daaa878d45.74795887.jpg', 'Mon ancienne lampe de chevet',
        '2022-05-01', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (4, 'Boucles d''oreille', 'ange@gmail.com', '6272d8a4e8edd0.97437281.jpg', 'Bijou de chez DIOR jamais porté',
        '2022-05-01', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (12, 'Collection shurikens', 'genji@gmail.com', '6272e18be575c8.96297683.jpg',
        'Ma collection de shurikens utilisés', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (14, 'Katana Zoro One Piece', 'genji@gmail.com', '6272e1ddd655b2.93944340.jpg', 'Katana de Zoro dans One Piece',
        '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (15, 'Tome 1 Naruto', 'genji@gmail.com', '6272e22c062ba9.06872855.jpg', 'Premier tome de Naruto neuf',
        '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (11, 'Crayon papier', 'genji@gmail.com', '6272e16c04eef7.35360795.png', 'Crayon neuf', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (7, 'Dvd Iron Man', 'ana@gmail.com', '6272da953aa7b4.94711463.jpg', 'Dvd du premier film Iron Man sous blister',
        '2022-05-01', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (16, 'Famas', 'soldat76@gmail.com', '6272e4c0b79689.09773725.jpg', 'Arme de guerre', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (17, 'Il faut sauver le soldat Ryan (DVD)', 'soldat76@gmail.com', '6272e4e92b3206.61510848.jpg',
        'Dvd du film culte il faut sauver le soldat Ryan', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (19, 'Lunettes gaming', 'soldat76@gmail.com', '6272e53eda78a3.89664267.jpg',
        'Lunette anti-lumière bleue, idéale pour le gaming.', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (20, 'Barbecue', 'soldat76@gmail.com', '6272e583edfd50.21417657.jpg',
        'Mon barbecue TEFAL tout neuf. Les aliments ne sont pas pris en compte dans le troc.', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (13, 'AirPod 2', 'genji@gmail.com', '6272e1a654d897.20671541.jpg', 'Airpod d''occasion', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (21, 'Manteau d''hiver', 'hanzo@gmail.com', '6272e6e37984d3.08752633.png',
        'Manteau long jamais porté idéal pour l''hiver. ', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (22, 'Flèches pour arc', 'hanzo@gmail.com', '6272e6f9ec44e4.76513197.jpg', '50 flèches neuves', '2022-05-04',
        true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (24, 'DVD saison 7 Arrow', 'hanzo@gmail.com', '6272e743e01d14.12028708.jpg',
        'DVD blu-ray de la dernière saison de Arrow', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (25, 'Kimono Karaté', 'hanzo@gmail.com', '6272e77db96ce7.23197074.jpg',
        'Kimono de taille M pour les karatékas, ceinture non incluse.', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (18, 'Chemise bleue', 'soldat76@gmail.com', '6272e510495b42.15256182.jpg',
        'Chemise utilisée mais idéale pour les rendez vous important', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (27, 'Lance roquettes', 'pharah@gmail.com', '6272e9072eaca6.21071745.jpg',
        'Arme factice utilisé pour des parties d''airsoft. La roquette contient de l''eau.', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (33, 'Chaussures Nike grises neuves', 'tracer@gmail.com', '6272eb4f046784.40347191.png',
        'Pointure 43 jamais porté.', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (35, 'Nerf Tracer Overwatch', 'tracer@gmail.com', '6272eb9e37c6b4.93019833.png',
        'Réplique Nerf de l''arme de tracer dans Overwatch? Flechettes incluses (8)', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (30, 'Faux jetpack', 'pharah@gmail.com', '6272e98e6bb9d4.81458356.jpg', 'Faux jetpack pour se déguiser. ',
        '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (36, 'ETB Pokemon Cartes Scellés', 'mccree@gmail.com', '6272ed27721861.58279686.jpg',
        'Contient 10 boosters. Des cartes rares dedans j''en suis sur', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (37, 'Ordinateur portable', 'mccree@gmail.com', '6272ed4ea149f2.00721392.jpg', '16Go de ram, RTX3080 etc...',
        '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (39, 'Revolver factice', 'mccree@gmail.com', '6272ed9a7632e6.07056367.jpg',
        'Parfait pour faire peur à des gens en jouant à la roulette russe.', '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (40, 'Playstation 5', 'mccree@gmail.com', '6272edbe7fe6c0.49850738.jpg', 'Playstation 5 scellé neuve',
        '2022-05-04', true);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (38, 'Tome 1 One Piece', 'mccree@gmail.com', '6272ed76ebad69.25276471.jpg',
        'Edition 2000 française avec Luffy=Corentin', '2022-05-04', false);
INSERT INTO tc_item (it_id, it_name, it_proprietary, it_picture, it_description, it_creation_date, it_is_swappable)
VALUES (34, 'Apple Watch series 2', 'tracer@gmail.com', '6272eb753e61c0.70241046.jpg',
        'Apple Watch jamais utilisé car j''ai pas d''iPhone pour l''utiliser.', '2022-05-04', false);


INSERT INTO tc_item_category (id_item, id_category)
VALUES (1, 15);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (1, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (2, 2);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (2, 15);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (2, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (3, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (4, 14);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (4, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (5, 3);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (6, 2);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (7, 5);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (7, 1);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (7, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (8, 9);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (8, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (9, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (9, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (10, 9);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (11, 2);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (11, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (12, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (12, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (13, 8);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (13, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (14, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (14, 4);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (14, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (15, 15);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (15, 4);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (15, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (16, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (16, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (17, 1);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (17, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (18, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (18, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (19, 7);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (19, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (20, 9);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (21, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (21, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (22, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (22, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (23, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (24, 1);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (25, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (25, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (26, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (26, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (26, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (27, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (27, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (28, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (29, 14);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (30, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (31, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (31, 11);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (32, 7);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (32, 3);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (32, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (33, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (33, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (34, 14);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (34, 8);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (34, 16);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (35, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (35, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (36, 10);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (36, 12);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (37, 8);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (37, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (38, 15);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (38, 4);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (38, 13);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (39, 6);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (40, 9);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (40, 7);
INSERT INTO tc_item_category (id_item, id_category)
VALUES (40, 12);


INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (6, '2022-05-03', '2022-05-03', true, 1, 'ana@gmail.com', 'ange@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (7, '2022-05-03', '2022-05-03', true, 2, 'ana@gmail.com', 'ange@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (9, '2022-05-04', '2022-05-04', true, 1, 'genji@gmail.com', 'ana@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (8, '2022-05-04', '2022-05-04', true, 2, 'genji@gmail.com', 'ana@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (10, '2022-05-04', '2022-05-04', true, 1, 'soldat76@gmail.com', 'genji@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (11, '2022-05-04', '2022-05-04', true, 1, 'hanzo@gmail.com', 'soldat76@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (12, '2022-05-04', '2022-05-04', true, 1, 'pharah@gmail.com', 'hanzo@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (13, '2022-05-04', '2022-05-04', true, 1, 'tracer@gmail.com', 'pharah@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (14, '2022-05-04', '2022-05-04', true, 1, 'mccree@gmail.com', 'tracer@gmail.com');
INSERT INTO tc_swap (ts_id, ts_creation_date, ts_end_date, ts_is_done, ts_tss_id, ts_us_mail_from, ts_us_mail_to)
VALUES (15, '2022-05-04', '2022-05-04', true, 2, 'mccree@gmail.com', 'tracer@gmail.com');

INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (6, 6);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (8, 6);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (4, 6);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (7, 7);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (9, 7);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (3, 7);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (15, 8);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (7, 8);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (11, 9);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (7, 9);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (19, 10);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (20, 10);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (13, 10);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (25, 11);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (18, 11);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (26, 12);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (23, 12);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (35, 13);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (30, 13);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (38, 14);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (34, 14);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (36, 15);
INSERT INTO tc_swap_item (id_item, id_swap)
VALUES (34, 15);
