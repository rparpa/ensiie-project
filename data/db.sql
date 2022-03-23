CREATE TABLE "tc_user" (

    us_mail VARCHAR PRIMARY KEY ,
    us_firstname VARCHAR NOT NULL ,
    us_lastname VARCHAR NOT NULL ,
    us_pseudo VARCHAR NOT NULL ,
    us_password VARCHAR NOT NULL ,
    us_picture VARCHAR NOT NULL ,
    us_zipcode INT NOT NULL ,
    us_street VARCHAR NOT NULL ,
    us_city VARCHAR NOT NULL ,
    us_is_super_user BOOLEAN NOT NULL ,
    us_is_banned BOOLEAN NOT NULL
);

CREATE TABLE "tc_wish" (
    wi_id SERIAL PRIMARY KEY ,
    wi_mail VARCHAR REFERENCES tc_user (us_mail) NOT NULL,
    wi_label VARCHAR NOT NULL
);

CREATE TABLE "tc_category" (
    ca_id SERIAL PRIMARY KEY ,
    ca_name VARCHAR NOT NULL ,
    ca_number_swap INT DEFAULT 0 NOT NULL
);

CREATE TABLE "tc_object" (
    ob_id SERIAL PRIMARY KEY ,
    ob_proprietary VARCHAR NOT NULL REFERENCES tc_user (us_mail) ,
    ob_picture VARCHAR NOT NULL ,
    ob_description VARCHAR NOT NULL ,
    ob_creation_date DATE NOT NULL ,
    ob_is_swapable BOOLEAN NOT NULL
);

CREATE TABLE "tc_troc" (
    tr_id SERIAL PRIMARY KEY ,
    tr_creation_date DATE NOT NULL ,
    tr_end_date DATE NOT NULL ,
    tr_is_done BOOLEAN NOT NULL
);

CREATE TABLE "tc_object_category" (
    id_object INT NOT NULL REFERENCES tc_object (ob_id),
    id_category INT NOT NULL REFERENCES tc_category (ca_id),
    PRIMARY KEY (id_object, id_category)
);

CREATE TABLE "tc_object_troc" (
    id_object INT NOT NULL REFERENCES tc_object (ob_id),
    id_troc INT NOT NULL REFERENCES tc_troc (tr_id),
    PRIMARY KEY (id_object, id_troc)
);



CREATE TABLE "notification" (
    no_id SERIAL PRIMARY KEY,
    no_content VARCHAR NOT NULL ,
    no_creation_date DATE NOT NULL
);