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
    ts_us_mail_to    TEXT    NOT NULL REFERENCES tc_user (us_mail) ON DELETE CASCADE
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


CREATE TABLE "notification"
(
    no_id            SERIAL PRIMARY KEY,
    no_content       TEXT NOT NULL,
    no_creation_date DATE NOT NULL
);

INSERT INTO tc_category(ca_name)
VALUES ('LITTERATURE'),
       ('FOURNITURE SCOLAIRE'),
       ('DVD'),
       ('GOODIES');

INSERT INTO tc_user
VALUES ('toto',
        'toto',
        'toto',
        'toto',
        'toto',
        'toto',
        12,
        'toto',
        'toto',
        false,
        false);

INSERT INTO tc_user
VALUES ('titi',
        'titi',
        'titi',
        'titi',
        'titi',
        'titi',
        12,
        'titi',
        'titi',
        false,
        false)