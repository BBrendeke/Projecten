INSERT INTO dbo.veiling(voorwerp_id, titel, beschrijving, startprijs, betalingswijze, plaatsnaam, land, looptijd, datum_begin,
					datum_eind, looptijd_begin, looptijd_eind, verzendkosten, gesloten, verkoopprijs) 
VALUES



(333, 'Tafel', 'Eikenhouten tafel altijd binnen gestaan', 300.99, 'Contant', 'Boxmeer', 'Nederland', 5, '2018/04/10', '2018/04/15',
 '2018/04/10 00:00:00', '2018/04/15 12:00:00', 20.25, 1, 290.25),
(222, 'Volkswagen Golf', 'Practige goedlopende auto niet afgeragd', 12500.25, 'Rekening' , 'Zutphen', 'Nederland', 10, '2018/05/01', '2018/05/11',
 '2018/05/01 00:00:00', '2018/05/11 00:00:00', NULL, 0, NULL),
(111, 'Plamuurmes', 'Een prachtig tweedehands plamuurmes 34 uur gedraaid', 3.30, 'Contant', 'Arnhem', 'Nederland' , 5, '2018/04/25', '2018/04/30',
 '01:00:00', '01:00:00', 6.00, 0, 4.25)


select * from veiling