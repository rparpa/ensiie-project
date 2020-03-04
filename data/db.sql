CREATE TABLE "user"(
    id SERIAL PRIMARY KEY ,
    login VARCHAR UNIQUE NOT NULL ,
    mdp VARCHAR NOT NULL
);

CREATE TABLE "favorie"(
    id_user  VARCHAR NOT NULL,
    id_pokemon INTEGER,
    PRIMARY KEY(id_user,id_pokemon)
);

INSERT INTO "user"(login,  mdp) VALUES ('john.doe','test');
INSERT INTO "user"(login,  mdp) VALUES ('yvette.angel','test');
INSERT INTO "user"(login,  mdp) VALUES ('amelia.waters','test');
INSERT INTO "user"(login,  mdp) VALUES ('manuel.holloway','test');
INSERT INTO "user"(login,  mdp) VALUES ('alonzo.erickson','test');
INSERT INTO "user"(login,  mdp) VALUES ('otis.roberson','test');
INSERT INTO "user"(login,  mdp) VALUES ('jaime.king','test');


create table "pokemon"(
    abilities  VARCHAR (255) ,
    against_bug NUMERIC,
    against_dark NUMERIC,
    against_dragon NUMERIC,
    against_electric NUMERIC,
    against_fairy NUMERIC,
    against_fight NUMERIC,
    against_fire NUMERIC,
    against_flying NUMERIC,
    against_ghost NUMERIC,
    against_grass NUMERIC,
    against_ground NUMERIC,
    against_ice NUMERIC,
    against_normal NUMERIC,
    against_poison NUMERIC,
    against_psychic NUMERIC,
    against_rock NUMERIC,
    against_steel NUMERIC,
    against_water NUMERIC,
    attack INTEGER,
    base_egg_steps NUMERIC,
    base_happiness NUMERIC,
    base_total NUMERIC,
    capture_rate NUMERIC,
    classfication VARCHAR (255),
    defense INTEGER,
    experience_growth NUMERIC,
    height_m NUMERIC,
    hp NUMERIC,
    japanese_name VARCHAR (255),
    english_name VARCHAR (255),
    french_name VARCHAR (255),
    percentage_male NUMERIC,
    pokedex_number INTEGER PRIMARY KEY,
    sp_attack INTEGER,
    sp_defense INTEGER,
    speed INTEGER,
    type1 VARCHAR (255),
    type2 VARCHAR (255),
    weight_kg NUMERIC,
    generation INTEGER,
    is_legendary INTEGER
);

COPY "pokemon"(abilities ,    against_bug,    against_dark,    against_dragon,    against_electric,    against_fairy,    against_fight,    against_fire,    against_flying,    against_ghost,    against_grass,    against_ground,    against_ice,    against_normal,    against_poison,    against_psychic,    against_rock,    against_steel,    against_water,    attack,    base_egg_steps,    base_happiness,    base_total,    capture_rate,    classfication,    defense,    experience_growth,    height_m,    hp,    japanese_name,    english_name,    french_name,    percentage_male,    pokedex_number,    sp_attack,    sp_defense,    speed,    type1,    type2,    weight_kg,    generation,    is_legendary
)
FROM '/var/www/html/data/pokemon.csv' DELIMITER ';' CSV HEADER ENCODING 'windows-1251';

/*
admin NUMERIC DEFAULT 0

INSERT INTO "user"(login, firstname, lastname, mdp,admin) VALUES ('mehdi.tahri','Mehdi', 'Tahri','test',1);

CREATE TABLE "favorie" (
    id_user INTEGER PRIMARY KEY ,
    id_pokemon INTEGER PRIMARY KEY
);
*/
