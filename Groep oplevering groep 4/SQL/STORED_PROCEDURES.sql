CREATE PROCEDURE getItemId
AS
SELECT voorwerp_id from veiling
RETURN
GO

CREATE PROCEDURE getPopularItems
AS
SELECT top 8 count(DISTINCT(gebruikersnaam)) as aantal , voorwerp_id from bod group by voorwerp_id order by aantal desc
RETURN 
GO

CREATE PROCEDURE getLastItems
AS
SELECT top 8 voorwerp_id from veiling order by looptijd_eind
RETURN
GO

CREATE PROCEDURE getDetails @itemId INT
AS
SELECT * FROM veiling WHERE voorwerp_id = @itemId
RETURN 
GO

CREATE PROCEDURE getBids @itemId INT
AS
SELECT TOP(10) * FROM Bod WHERE voorwerp_id = @itemId ORDER BY bodbedrag desc
RETURN 
GO

CREATE PROCEDURE getTitle @itemId INT
AS
SELECT titel FROM veiling WHERE voorwerp_id = @itemId
RETURN
GO

CREATE PROCEDURE getImage @itemId INT
AS
SELECT filenaam FROM bestand WHERE voorwerp_id = @itemId
RETURN
GO

CREATE PROCEDURE getItemDescription @itemId INT 
AS 
SELECT beschrijving FROM veiling WHERE voorwerp_id = @itemId
RETURN 
GO

CREATE PROCEDURE getHighestBid @itemId INT
AS
SELECT MAX(bodbedrag) FROM Bod WHERE voorwerp_id = @itemId
RETURN
GO

CREATE PROCEDURE getHighestVoorwerp_id 
AS
SELECT MAX(voorwerp_id) FROM veiling
RETURN
GO

CREATE PROCEDURE getName @itemId INT
AS
SELECT rubrieknaam FROM rubrieken WHERE rubrieknummer = @itemId
RETURN
GO

CREATE PROCEDURE getOldItems
AS 
SELECT voorwerp_id FROM veiling
RETURN 
GO

-- Jaimy --

CREATE PROCEDURE getCategories
AS
WITH CTE AS (
                SELECT	r.rubrieknummer, r.rubrieknaam, r.parent, r.active
                FROM	rubrieken r
                WHERE	r.parent = -1
            
                UNION ALL
            
                SELECT	rr.rubrieknummer, rr.rubrieknaam, rr.parent, rr.active
                FROM	rubrieken rr
                INNER JOIN	CTE cte
                ON		cte.rubrieknummer = rr.parent
            )
            SELECT      rubrieknummer, rubrieknaam, parent, active
            FROM        CTE
RETURN
GO

CREATE PROCEDURE getParentCategories
AS 
SELECT * FROM rubrieken WHERE parent = -1 ORDER BY rubrieknaam ASC
RETURN 
GO

CREATE PROCEDURE getItemsByCategory @rubriekLaagsteNiveau INT
AS 
SELECT voorwerp_id FROM rubriek WHERE rubriekLaagsteNiveau = @rubriekLaagsteNiveau
RETURN 
GO

-- EIND --

CREATE PROCEDURE uspVeilingPlaatsen 
@voorwerp_id INT,
@titel VARCHAR(50),
@beschrijving VARCHAR(255),
@startprijs NUMERIC(10,2),
@betalingswijze VARCHAR(15),
@betalingsinstructie VARCHAR(30),
@plaatsnaam VARCHAR(25),
@land VARCHAR(30),
@looptijd INT,
@looptijd_begin DATETIME,
@looptijd_eind DATETIME,
@verzendkosten NUMERIC(10,2),
@verzendinstructie VARCHAR(50),
@verkoper VARCHAR(20),
@koper VARCHAR(20),
@gesloten BIT,
@verkoopprijs NUMERIC(10,2),
@conditie VARCHAR(20)
AS
INSERT INTO veiling(voorwerp_id, titel, beschrijving, startprijs, betalingswijze, betalingsinstructie, plaatsnaam, land, looptijd, looptijd_begin, looptijd_eind, verzendkosten, verzendinstructie, verkoper, koper, gesloten, verkoopprijs, conditie) 
VALUES (@voorwerp_id, @titel, @beschrijving, @startprijs, @betalingswijze, @betalingsinstructie, @plaatsnaam, @land, @looptijd, @looptijd_begin, @looptijd_eind , @verzendkosten, @verzendinstructie, @verkoper, @koper ,@gesloten, @verkoopprijs, @conditie)
GO

EXEC uspVeilingPlaatsen @voorwerp_id = 444, @titel = 'SP Testing', @beschrijving = 'blablablablabalba', @startprijs = 15 , @betalingswijze = 'Contant', @betalingsinstructie = 'GEEN', @plaatsnaam = 'Zetten', @land = 'NEDERLAND', @looptijd = 10, @looptijd_begin = '2018-05-24 01:13:38.000', @looptijd_eind = '2018-05-31 01:13:38.000', @verzendkosten = 20.00, @verzendinstructie = 'geen', @verkoper = 'verkoper', @koper = NULL, @gesloten = 0, @verkoopprijs = 20.25, @conditie = 'GOED'





EXEC getItemId
EXEC getPopularItems
EXEC getLastItems
EXEC getDetails @itemId = 17
EXEC getBids @itemId = 17
EXEC getTitle @itemId = 17
EXEC getImage @itemId = 333
EXEC getItemDescription @itemId = 17
EXEC getHighestVoorwerp_id 
EXEC getName @itemId = 16
EXEC getOldItems


select * from bestand
select * from veiling
select * from veiling
select * from rubriek
select * FROM items
drop PROCEDURE uspVeilingPlaatsen
drop PROCEDURE usp_Insert_veiling
drop PROCEDURE getItemId
drop PROCEDURE getBids
drop PROCEDURE getName 