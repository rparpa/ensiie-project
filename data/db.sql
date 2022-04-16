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

CREATE TABLE "tc_troc"
(
    tr_id            SERIAL PRIMARY KEY,
    tr_creation_date DATE    NOT NULL,
    tr_end_date      DATE    NOT NULL,
    tr_is_done       BOOLEAN NOT NULL
);

CREATE TABLE "tc_item_category"
(
    id_item     INT NOT NULL REFERENCES tc_item (it_id),
    id_category INT NOT NULL REFERENCES tc_category (ca_id),
    PRIMARY KEY (id_item, id_category)
);

CREATE TABLE "tc_item_troc"
(
    id_item INT NOT NULL REFERENCES tc_item (it_id),
    id_troc INT NOT NULL REFERENCES tc_troc (tr_id),
    PRIMARY KEY (id_item, id_troc)
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