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


CREATE TABLE "notification_swap"
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

CREATE OR REPLACE FUNCTION numberSwapIncr()
    RETURNS trigger AS
$$
BEGIN
    UPDATE tc_category
    SET ca_number_swap = ca_number_swap + 1
    WHERE ca_id IN (SELECT id_category
                    FROM tc_item_category
                    WHERE id_item = new.id_item);
END;
$$
    LANGUAGE 'plpgsql';

CREATE TRIGGER incrementCaNumberSwap
    AFTER INSERT
    ON tc_swap_item
EXECUTE PROCEDURE numberSwapIncr();


CREATE FUNCTION create_notification() RETURNS trigger
    LANGUAGE plpgsql
AS
$$
BEGIN
    INSERT INTO notification_swap(no_user_mail, no_swap_id) VALUES (new.ts_us_mail_to, new.ts_id)
END;
$$;

CREATE TRIGGER tr_notification_creation
    AFTER INSERT
    ON tc_swap
    FOR EACH ROW
EXECUTE PROCEDURE create_notification();

/**
  INSERTION dans la base de données d'informations pour ne pas avoir une application vide
 */
 /*
  Création des utilisateurs
  */
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('ange@gmail.com', 'Angela', 'Ziegler', 'Ange', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d067db9096.09601097.png', 13311, '10 rue du soin', 'Geneve', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('ana@gmail.com', 'Ana', 'Amari', 'Ana', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d0d34b5ad3.20237330.png', 32133, '10 rue du sniper', 'Le Caire', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('genji@gmail.com', 'Genji', 'Shimura', 'Genji', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d12710a936.62575814.png', 13121, '10 rue du shuriken', 'Hanamura', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('soldat76@gmail.com', 'Jack', 'Morrison', 'Soldat76', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d163500e95.93281885.png', 14412, '10 rue de la roquette', 'Hollywood', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('hanzo@gmail.com', 'Hanzo', 'Shimura', 'Hanzo', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d1bf100647.37166608.png', 94483, '10 rue de l''arc', 'Hanamura', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('pharah@gmail.com', 'Pharah', 'Amari', 'Pharah', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d24a998e17.54910404.png', 98484, '10 rue du lance roquette', 'Anubis', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('tracer@gmail.com', 'Len', 'Oxton', 'Tracer', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d2cf9f5a14.71925005.png', 13313, '10 rue du chronomètre', 'King''s Row', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('mccree@gmail.com', 'Jessy', 'Mccree', 'Mccree', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d3059776f4.88732080.png', 39494, '10 rue du renommage', 'Route 66', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('fatale@gmail.com', 'Anne', 'Delacroix', 'Fatale', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d33bd70587.26294600.png', 39391, '10 rue du sniper', 'Annecy', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('brigitte@gmail.com', 'Brigitte', 'Lindholm', 'Brigitte', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d3c234e204.37903741.png', 13393, '10 rue du stun ', 'Stockholm', false, false);
INSERT INTO tc_user (us_mail, us_firstname, us_lastname, us_pseudo, us_password, us_picture, us_zipcode, us_street, us_city, us_is_super_user, us_is_banned) VALUES ('orisa@gmail.com', 'Efi', 'Oldadele', 'Orisa', 'eeb7aaa5565aa8ef732ec9a2999cd72258b2df354fbaf735b9cdf36169cd0e8484c667e42c31bc0d932995723b88a3dc', '6272d4021e2563.47987067.png', 34313, '10 rue du javelot', 'Numbani', false, false);

/*
 Ajout des catégories
 */
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (1, 'DVD', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (2, 'EDUCATION', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (3, 'GOODIES', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (4, 'MANGA', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (5, 'BD', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (6, 'ARME', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (7, 'JEUX VIDEO', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (8, 'INFORMATIQUE', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (9, 'ELECTROMENAGER', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (10, 'CARTE A JOUER', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (11, 'VOITURE', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (12, 'NEUF', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (13, 'OCCASION', 0);
INSERT INTO tc_category (ca_id, ca_name, ca_number_swap) VALUES (14, 'BIJOU', 0);
