USE iproject4
go
DROP TABLE if exists bestand;
go
DROP TABLE if exists bod;
go
DROP TABLE if exists gebruikerstelefoon;
go
DROP TABLE if exists rubriek;
go
DROP TABLE if exists rubrieken;
go
DROP TABLE if exists feedback;
go
DROP TABLE if exists veiling;
go
DROP TABLE if exists verkoper;
go
DROP TABLE if exists gebruiker;
go
drop TABLE if exists vraag;
go
DROP TABLE if exists feedback
go
DROP FUNCTION if exists isVerkoper;
go
CREATE FUNCTION isVerkoper
(@gebruikersnaam varchar(20))
	returns varchar(20)
	as
	begin
	return(
		select gebruikersnaam
		from gebruiker
		where gebruikersnaam = @gebruikersnaam AND verkoper = 1
		)
		end

go
DROP FUNCTION if exists betaalmethodeNietAanwezig;
go
CREATE FUNCTION betaalmethodeNietAanwezig()
	returns bit
	as
	begin
	return case when exists(
		select *
		from verkoper
		where bankrekening is null and creditcard is null
		)
		then 1
		else 0
		end
	end
go

DROP FUNCTION if exists getBestanden;
go
CREATE FUNCTION getBestanden
(@voorwerp_id int)
	returns int
	as
	begin
	return(
		select SUM(@voorwerp_id)
		from bestand
		where @voorwerp_id = voorwerp_id
		)
		end

go

DROP FUNCTION if exists getVerkoper;
go
CREATE FUNCTION getVerkoper
(@voorwerp_id int)
	returns varchar(20)
	as
	begin
	return(
		select verkoper
		from veiling
		where @voorwerp_id = voorwerp_id
		)
		end

go





CREATE TABLE vraag
(
vraagnummer int NOT NULL,
vraag varchar(25) NOT NULL,
constraint PK_vraag primary key (vraagnummer),

);
CREATE TABLE gebruiker
(
	gebruikersnaam varchar(20)		 NOT NULL,
	voornaam varchar(20)			 NOT NULL,
	achternaam varchar(20)			 NOT NULL,
	adresregel1 varchar(20)			 NOT NULL,
	adresregel2 varchar(20)			 NULL,
	postcode varchar(6)				 NOT NULL,
	plaatsnaam varchar(25)			 NOT NULL,
	land varchar(25)				 NOT NULL,
	geboortedatum date				 NOT NULL,
	mailadres varchar(30)			 NOT NULL,
	wachtwoord varchar(20)			 NOT NULL,
	vraag int						 NOT NULL,
	antwoordtekst varchar(20)        NOT NULL,
	verkoper bit					 NOT NULL,
	constraint PK_gebruiker primary key (gebruikersnaam),	
	constraint FK_gebruiker_vraag foreign key (vraag) references vraag(vraagnummer)
	on update cascade
	on delete cascade,
 
);
CREATE TABLE verkoper
(
	gebruikersnaam varchar(20)		 NOT NULL,
	bank varchar(20)				     NULL,
	bankrekening varchar(20)		     NULL,
	creditcard varchar(20)				 NULL,
	constraint PK_verkoper primary key (gebruikersnaam),
	constraint FK_verkoper_gebruiker foreign key (gebruikersnaam) references gebruiker(gebruikersnaam)
	on update cascade
	on delete cascade,
	constraint CK_verkoper_isVerkoper check(gebruikersnaam = dbo.isVerkoper(gebruikersnaam)),
	constraint CK_betaalmethodeIsAanwezig check(dbo.betaalmethodeNietAanwezig() = 0)


);
CREATE TABLE veiling
(
	voorwerp_id			INT	 		    NOT NULL,
	titel 				VARCHAR(50)	 	NOT NULL,
	voorwerp_afbeelding	VARCHAR(255)	NOT NULL,
	beschrijving 		VARCHAR(255)	NOT NULL,
	startprijs 			NUMERIC(10,2)			NOT NULL,
	betalingswijze 		VARCHAR(15) 	NOT NULL,
	betalingsinstructie VARCHAR(30) 	NULL,
	plaatsnaam 			VARCHAR(25) 	NOT NULL,
	land 				VARCHAR(30) 	NOT NULL,
	looptijd 			INT			NOT NULL,
	looptijd_begin		DATETIME 		NOT NULL,
	looptijd_eind 		DATETIME 		NOT NULL,
	verzendkosten 		NUMERIC(10,2) 			NULL,
	verzendinstructie 	VARCHAR(50) 	NULL,
	verkoper 			VARCHAR(20) 	NOT NULL,
	koper 				VARCHAR(20) 	NULL,
	gesloten 			BIT 			NOT NULL,
	verkoopprijs 		NUMERIC(10,2) 			NULL,
	constraint PK_veiling primary key (voorwerp_id),
	constraint FK_veiling_verkoper foreign key (verkoper) references verkoper(gebruikersnaam)
	on update no action
	on delete no action,
	constraint FK_veiling_gebruiker foreign key (koper) references gebruiker(gebruikersnaam)
	on update no action
	on delete no action,
	-- TO DO !!!
	--Kolom VeilingGesloten? heeft de waarde 0 als de systeemdatum en –tijd
	--vroeger zijn dan wat kolommen LooptijdeindeDag en LooptijdeindeTijdstip
	--aangeven, en de waarde 1 als de systeemdatum en –tijd later zijn dan dat.

	--Kolom Koper heeft een NULL-waarde, tenzij de veiling is gesloten en er op het
	--voorwerp een bod is uitgebracht. Dan heeft kolom Koper de waarde uit kolom
	--Bod(Gebruiker) die bij het hoogste bod op hetzelfde voorwerp hoort.

	--Kolom Verkoopprijs heeft een NULL-waarde, tenzij de veiling is gesloten en er
	--op het voorwerp een bod is uitgebracht. Dan heeft kolom Verkoopprijs de
	--waarde uit kolom Bod(Bodbedrag) die bij het hoogste bod op hetzelfde
	--voorwerp hoort.
);
CREATE TABLE rubrieken
(
	rubrieknummer int	NOT NULL,
	rubrieknaam varchar(25)			NOT NULL,
	subrubrieknummer int		NULL,
	parent int              NOT NULL,
	constraint PK_rubrieken primary key (rubrieknummer),
	

);
CREATE TABLE rubriek
(
	voorwerp_id int					 NOT NULL,
	rubriekLaagsteNiveau int         NOT NULL,
	constraint PK_rubriek primary key (voorwerp_id, rubriekLaagsteNiveau),
	constraint FK_rubriek_voowerp foreign key (voorwerp_id) references veiling(voorwerp_id)
	on update cascade
	on delete cascade,
	constraint FK_rubriek_rubrieken foreign key (rubriekLaagsteNiveau) references rubrieken(rubrieknummer)
	on update cascade
	on delete cascade,


);


CREATE TABLE gebruikerstelefoon
(
	nummer int						NOT NULL,
	gebruikersnaam varchar(20)      NOT NULL,
	telefoonnummer varchar(20)			NOT NULL,
	constraint PK_gebruikerstelefoon primary key (nummer, gebruikersnaam),
	constraint FK_gebruikerstelefoon_gebruiker foreign key (gebruikersnaam) references gebruiker(gebruikersnaam)
	on update cascade
	on delete cascade,

);
CREATE TABLE Bod
(
	voorwerp_id int					NOT NULL,
	bodbedrag NUMERIC(10,2)		NOT NULL,
	gebruikersnaam varchar(20)		NOT NULL,
	boddag datetime					NOT NULL,
	constraint PK_bod primary key (voorwerp_id,bodbedrag),
	constraint FK_bod_voorwerp foreign key (voorwerp_id) references veiling(voorwerp_id)
	on update cascade
	on delete cascade,
	constraint FK_bod_gebruiker foreign key (gebruikersnaam) references gebruiker(gebruikersnaam)
	on update cascade
	on delete cascade,
	constraint CK_geenEigenBiedingen check(dbo.getVerkoper(voorwerp_id) != gebruikersnaam),
	-- TO DO !!!
	--Een nieuw bod moet hoger zijn dan al bestaande bedragen die geboden zijn
    --voor hetzelfde voorwerp, en tenminste zoveel hoger als de minimumverhoging
    --voorschrijft (zie appendix B, proces 3.1).
);	
CREATE TABLE bestand
(
	filenaam varchar(25)			NOT NULL,
	voorwerp_id int					NOT NULL,
	constraint PK_bestand primary key (filenaam),
	constraint FK_bestand_veiling foreign key (voorwerp_id) references veiling(voorwerp_id)
	on update cascade
	on delete cascade,
	constraint CK_max4fotos check(dbo.getBestanden(voorwerp_id) < 5) 
);				
CREATE TABLE feedback
(
	voorwerp_id int not null,
	soortgebruiker varchar(12) not null,
	feedbacksoort varchar(12)	not null,
	datum datetime not null,
	commentaar varchar(255) null,
	constraint PK_feedback primary key (voorwerp_id,soortgebruiker),
	constraint FK_feedback foreign key (voorwerp_id) references veiling(voorwerp_id)
	on update cascade
	on delete cascade,
)	
--ALTER TABLE rubrieken
--add constraint FK_rubrieken_rubriek foreign key (rubrieknummer) references rubriek(rubriekLaagsteNiveau);				

alter table bestand
a




DROP FUNCTION if exists veilingGesloten;
go
CREATE FUNCTION veilingGesloten
(@voorwerp_id int)
	returns bit
	as
	begin
		if(getdate() > select looptijd_eind from veiling where @voorwerp_id = voorwerp_id) begin
		update
		end
		return

		
		
		end

go