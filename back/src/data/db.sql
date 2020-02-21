CREATE TABLE "User" (
	"id" serial NOT NULL,
	"username" varchar(50) NOT NULL UNIQUE,
	"password" char(64) NOT NULL,
	"email" varchar(254) NOT NULL UNIQUE,
	"address_id" serial,
	CONSTRAINT "User_pk" PRIMARY KEY ("id")
);

CREATE TABLE "Vehicule" (
	"id" serial NOT NULL,
	"owner_id" serial NOT NULL,
	"name" varchar(50) NOT NULL,
	"type" int NOT NULL,
	CONSTRAINT "Vehicule_pk" PRIMARY KEY ("id")
);

CREATE TABLE "ParkingSpot" (
	"id" serial NOT NULL,
	"latitude" numeric NOT NULL,
	"longitude" numeric NOT NULL,
	"emplacement_id" serial NOT NULL,
	"pricing" DECIMAL(4,2) NOT NULL,
	"type" int NOT NULL,
	CONSTRAINT "ParkingSpot_pk" PRIMARY KEY ("id")
);

CREATE TABLE "Address" (
	"id" serial NOT NULL,
	"city" varchar(100) NOT NULL,
	"street_name" varchar(255),
	"street_number" int,
	"type" int,
	CONSTRAINT "Address_pk" PRIMARY KEY ("id")
);

ALTER TABLE "User" ADD CONSTRAINT "User_fk0" FOREIGN KEY ("address_id") REFERENCES "Address"("id");
ALTER TABLE "Vehicule" ADD CONSTRAINT "Vehicule_fk0" FOREIGN KEY ("owner_id") REFERENCES "User"("id");
ALTER TABLE "ParkingSpot" ADD CONSTRAINT "ParkingSpot_fk0" FOREIGN KEY ("emplacement_id") REFERENCES "Address"("id");

INSERT INTO "Address"(city, street_name, street_number, type) 
    VALUES ('paris', 'chaussée d''antin', 8, 1);
INSERT INTO "Address"(city, street_name, street_number, type) 
    VALUES ('paris', 'mogador', 20, 1);

INSERT INTO "User"(username, password, email, address_id) VALUES ('JohnDoe', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'johndoe@gmail.com', 1);
INSERT INTO "User"(username, password, email, address_id) VALUES ('JaneDoe', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'janedoe@gmail.com', 2);