DROP TABLE Series
DROP TABLE Series_Directors
DROP TABLE Companies
DROP TABLE Age_Categories

CREATE TABLE Series (
		country				varchar(50)			not null,
		place_of_studio		varchar(50)			not null,
		title				varchar(100)		not null,
		start				integer				not null,
		number_of_seasons	integer				not null,
		director			varchar(50)			not null,
		number_of_episodes	integer				not null,
		age_advisery		varchar(2)			null,
		company_code		char(1)				not null
		CONSTRAINT			PK_SERIES			PRIMARY KEY (country, title, director)
)
		
CREATE TABLE Series_Directors (
		director			varchar(50)			not null,
		director_id			integer				not null
		CONSTRAINT			FK_DIRECTORS_REF_SERIES				FOREIGN KEY (director) REFERENCES Series (director)
		ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Companies (
		company_code		char(1)				not null,
		company				varchar(50)			not null
		CONSTRAINT			FK_COMPANIES_REF_SERIES				FOREIGN KEY (company_code) REFERENCES Series (company_code)
		ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Age_Categories (
		age_advisery		varchar(2)			not null,
		age_description		varchar(50)			not null
		CONSTRAINT			FK_AGE_REF_SERIES					FOREIGN KEY (age_advisery) REFERENCES Series (age_advisery)
		ON UPDATE CASCADE ON DELETE CASCADE
)

INSERT INTO Series VALUES ('The Netherlands', 'Aalsmeer', 'Flodder', 1993, 5, 'Dick Maas', 62, 'AL', 'V')
INSERT INTO Series VALUES ('The Netherlands', 'Aalsmeer', 'Flodder', 1993, 5, 'Laurens Geels', 62, 'AL', 'V')
INSERT INTO Series VALUES ('The Netherlands', 'Aalsmeer', 'Divorce', 2012, 4, 'John de Mol', 49, '12', 'R')
INSERT INTO Series VALUES ('USA', 'Los Angeles', 'Game of Thrones', 2011, 6, 'David Benioff', 60, '12', 'H')
INSERT INTO Series VALUES ('USA', 'Los Angeles', 'Divorce', 2016, 1, 'Paul Simms', 10, '16', 'H')
INSERT INTO Series VALUES ('France', 'Paris', 'Mafiosa', 2006, 5, 'Hugues Pagan', 40, '12', 'C')
INSERT INTO Series VALUES ('France', 'Paris', 'Les Petits Meurtres d''Agatha Christie', 2009, 3, 'Anne Giafferi', 31, '12', 'F')
INSERT INTO Series VALUES ('France', 'Paris', 'Les Petits Meurtres d''Agatha Christie', 2009, 3, 'Murielle Magellan', 31, '12', 'F')

INSERT INTO Series_Directors VALUES ('Dick Maas', 48752)
INSERT INTO Series_Directors VALUES ('Laurens Geels', 269426)
INSERT INTO Series_Directors VALUES ('John de Mol', 213445)
INSERT INTO Series_Directors VALUES ('David Benioff', 945466)
INSERT INTO Series_Directors VALUES ('Paul Simms', 945467)
INSERT INTO Series_Directors VALUES ('Hugues Pagan', 945468)
INSERT INTO Series_Directors VALUES ('Anne Giafferi', 945468)
INSERT INTO Series_Directors VALUES ('Murielle Magellan', 945469)

INSERT INTO Companies VALUES ('V', 'Veronica')
INSERT INTO Companies VALUES ('R', 'RTL4')
INSERT INTO Companies VALUES ('H', 'HBO')
INSERT INTO Companies VALUES ('C', 'Canal +')
INSERT INTO Companies VALUES ('F', 'France 2')

INSERT INTO Age_Categories VALUES ('AL', 'All ages')
INSERT INTO Age_Categories VALUES ('12', '12 years and older')
INSERT INTO Age_Categories VALUES ('16', '16 years and older')