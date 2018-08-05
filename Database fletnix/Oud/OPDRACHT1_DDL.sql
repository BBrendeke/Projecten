USE master

DROP DATABASE fletnix

CREATE DATABASE fletnix

USE fletnix


CREATE TABLE Person (
	person_id			integer				not null,
	lastname			varchar(50)			not null,
	firstname			varchar(50)			not null,
	gender				char(1)				null,
	CONSTRAINT	PK_PERSON	PRIMARY KEY	(person_id),
	CONSTRAINT ck_gender 	CHECK (gender IN ('M', 'F'))
)


CREATE TABLE Genre (
	genre_name			varchar(255)		not null,
	description			varchar(255)		null,
	CONSTRAINT	PK_GENRE	PRIMARY KEY	(genre_name)
)

CREATE TABLE Movie (
	movie_id			integer				not null,
	title				varchar(255)		not null,
	duration			integer				null,
	description			varchar(255)		null,
	publication_year	integer				null,
	cover_image			varchar(255)		null,
	previous_part		integer				null,
	price				numeric(5,2)		not null,
	URL					varchar(255)		null,
	CONSTRAINT	PK_MOVIE	PRIMARY KEY	(movie_id),
	CONSTRAINT 	FK_MOVIE_REF_MOVIE				FOREIGN KEY (previous_part)
		REFERENCES Movie (movie_id),
	CONSTRAINT ck_publication_year 					CHECK (publication_year >= 1890 AND publication_year <= 2017),
	CONSTRAINT uc_title								UNIQUE (title)

)

CREATE TABLE Movie_Cast (
	movie_id			integer				not null,
	person_id			integer				not null,
	role				varchar(255)		not null,
	CONSTRAINT	PK_MOVIE_CAST	PRIMARY KEY	(movie_id, person_id, role),
	CONSTRAINT 	FK_MOVIE_CAST_REF_PERSON		FOREIGN KEY (person_id)
		REFERENCES Person (person_id)
		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_MOVIE_CAST_REF_MOVIE			FOREIGN KEY (movie_id)
		REFERENCES Movie (movie_id)
		ON UPDATE CASCADE ON DELETE CASCADE


)


CREATE TABLE Movie_Directors (
	movie_id			integer				not null,
	person_id			integer				not null,
	CONSTRAINT	PK_MOVIE_DIRECTORS	PRIMARY KEY	(movie_id, person_id),
	CONSTRAINT	FK_MOVIE_DIRECTORS_REF_PERSON	FOREIGN KEY (person_id)
		REFERENCES	Person (person_id)
		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_MOVIE_DIRECTORS_REF_MOVIE		FOREIGN KEY (movie_id)
		REFERENCES Movie (movie_id)
		ON UPDATE CASCADE ON DELETE CASCADE
)


CREATE TABLE Movie_Genre (
	movie_id			integer				not null,
	genre_name			varchar(255)		not null,
	CONSTRAINT	PK_MOVIE_GENRE	PRIMARY KEY	(movie_id, genre_name),
	CONSTRAINT 	FK_MOVIE_GENRE_REF_GENRE		FOREIGN KEY (genre_name)
		REFERENCES Genre (genre_name)
		ON UPDATE CASCADE ON DELETE CASCADE,
		CONSTRAINT	FK_MOVIE_GENRE_REF_MOVIE		FOREIGN KEY (movie_id)
		REFERENCES Movie (movie_id)
		ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Payment (
	payment_method		varchar(10)			not null,
	CONSTRAINT 	PK_PAYMENT		PRIMARY KEY	(payment_method)
)


CREATE TABLE Contract (
	contract_type		varchar(10)			not null,
	price_per_month		numeric(5,2)		not null,
	discount_percentage	numeric(2)			not null,
	CONSTRAINT	PK_CONTRACT		PRIMARY KEY	(contract_type)
)


CREATE TABLE Country (
	country_name		varchar(50)			not null,
	CONSTRAINT 	PK_COUNTRY	PRIMARY KEY	(country_name)
)


CREATE TABLE Customer (
	customer_mail_address	varchar(255)	not null,
	lastname			varchar(50)			not null,
	firstname			varchar(50)			not null,
	payment_method		varchar(10)			not null,
	payment_card_number	varchar(30)			not null,
	contract_type		varchar(10)			not null,
	subscription_start	date				not null,
	subscription_end	date				null,
	user_name			varchar(30)			not null,
	password			varchar(50)			not null,
	country_name		varchar(50)			not null,
	gender				char(1)				null,
	birth_date			date				null,
	CONSTRAINT	PK_CUSTOMER		PRIMARY KEY	(customer_mail_address),
	CONSTRAINT	FK_CUSTOMER_REF_PAYMENT			FOREIGN KEY (payment_method)
		REFERENCES Payment (payment_method)
		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT 	FK_CUSTOMER_REF_CONTRACT		FOREIGN KEY (contract_type)
		REFERENCES Contract (contract_type)
		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT 	FK_CUSTOMER_REF_COUNTRY			FOREIGN KEY (country_name)
		REFERENCES Country (country_name)
		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT ck_subscription_start 				CHECK (subscription_start < subscription_end),
	CONSTRAINT uc_user_name							UNIQUE (user_name),
	CONSTRAINT uc_customer_mail_address				UNIQUE (customer_mail_address),
	CONSTRAINT ck_gender_customer					CHECK (gender IN ('M', 'F'))

)

CREATE TABLE WatchHistory (
	movie_id			integer				not null,
	customer_mail_address	varchar(255)	not null,
	watch_date			date				not null,
	price				numeric(5,2)		not null,
	invoiced			bit					not null,
	CONSTRAINT	PK_WATCHHISTORY		PRIMARY KEY	(movie_id, customer_mail_address, watch_date),
	CONSTRAINT 	FK_WATCHHISTORY_REF_MOVIE		FOREIGN KEY (movie_id)
		REFERENCES Movie (movie_id)
		ON UPDATE CASCADE,
	CONSTRAINT	FK_WATCHHISTORY_REF_CUSTOMER	FOREIGN KEY (customer_mail_address)
		REFERENCES Customer (customer_mail_address)
		ON UPDATE CASCADE

)