-- niet zomaar uitvoeren staat niet in de goede volgorde

insert into thumbnails
select  * 
from bestand
where filenaam like 'images/1%' 

insert into gebruiker
select  DISTINCT LEFT(Username,20) as gebruikersnaam,
		'niet aanwezig' as voornaam,
		'niet aanwezig' as achternaam,
		'niet aanwezig' as adresregel1,
		null as adresregel2,
		RIGHT(Postalcode,6) as postcode,
		LEFT(location,20) as plaatsnaam,
		LEFT(Country,25) as land,
		'1980-1-1' as geboortedatum,
		LEFT(Username,20) + '@gmail.com'as mailadres,
		123 as wachtwoord,
		1 as vraag,
		'niet aanwezig' as antwoordtekst,
		1 as verkoper,
		0 as beheerder
from Users
insert into verkoper
select DISTINCT LEFT(Username,20) as gebruikersnaam,
		'bank' as bank,
		0 as bankrekening,
		null as creditcard
from users
insert into veiling
select  distinct items.ID as voorwerp_id,
		LEFT(Titel, 50) as titel,
		LEFT(Beschrijving, 255) as beschrijving,
		cast(Prijs as numeric(10,2)) as startprijs,
		'Niet aanwezig' as betalingswijze,
		'Niet aanwezig' as betalingsinstructie,
		LEFT(Locatie,25) as plaatsnaam,
		LEFT(items.Land,30) as land,
		35 as looptijd,
		2018-05-31 as looptijd_begin,
		2018-06-5 as looptijd_eind,
		NULL as verzendkosten,
		NULL as verzendinstructie,
		LEFT(verkoper,20) as verkoper,
		NULL as koper,
		0 as gesloten,
		NULL as verkoopprijs,
		LEFT(Conditie,20) as conditie
from items


select id , count(id)
from items 
group by ID


select * from veiling
insert into thumbnails
select	'http://iproject4.icasites.nl/thumbnails/' + Thumbnail as filenaam,
		cast(ID as int) as voorwerp_id
from Items

insert into bestand
select	'http://iproject4.icasites.nl/pics/' + illustratieFile as filenaam,	
		itemID as voorwerp_id
from Illustraties

insert into rubriek
select ID as voorwerp_id,
	   Categorie as rubriekLaagsteNivaeu
from items

select * from rubriek





















delete from Illustraties where itemID > 50000

select * from gebruiker

select

alter table bestand
alter column filenaam varchar(100) not null


select * from verkoper
update gebruiker
set beheerder = 1
where gebruikersnaam = 'nick' 

select * from veiling 
select * from bestand where voorwerp_id = 12877


declare @itemID INT;
set @itemID = 0;
update items set Oldid = ID 
while((select max(ID) from items) > (select count(ID) from items) + 700 )
begin
	if exists((select ID from items where ID = @itemID + 500)) begin
	set @itemID = @itemID + 1
	end
	if not exists((select ID from items where ID = @itemID + 500)) begin
	update items set ID = 500 + @itemID  where ID = (select max(ID) from items)
	PRINT @itemID + 500
	set @itemID = @itemID + 1
	
	end
	
end
go
update Illustraties set illustraties.itemID = Items.ID from Items where illustraties.itemID = Items.Oldid
go
select * from items
select * from Illustraties
drop table Illustraties


SELECT * INTO itemscopy FROM Items

select * from itemscopy

alter table illustraties
drop constraint ItemsVoorPlaatje

update itemscopy set ID = ROW_NUMBER()OVER(ORDER by id) + 500

alter table items

add Oldid bigint not null default(1)


select * FROM items


SELECT * INTO items FROM itemscopy2
SELECT * INTO illustraties FROM Illustratiescopy

select * from items

insert into dbo.items(Oldid) 
select id
from dbo.items 
where ID = 501

select * from items
update items set Oldid = ID  
drop table items
