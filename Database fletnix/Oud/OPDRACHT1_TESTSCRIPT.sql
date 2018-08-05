
--Goede populatie
INSERT INTO Genre VALUES ('Actie', null);
INSERT INTO Movie VALUES (1, 'Matrix', 136, 'The Matrix is het eerste deel uit een trilogie. De andere twee delen zijn The Matrix Reloaded en The Matrix Revolutions. Alle delen zijn uitgegeven door Warner Bros.', 1999, 'https://upload.wikimedia.org/wikipedia/en/9/9a/The_Matrix_soundtrack_cover.jpg', null, 5, 'https://www.youtube.com/watch?v=m8e-FF8MsqU');
INSERT INTO Person VALUES (1, 'Reeves', 'Keanu', 'M');
INSERT INTO Movie_Cast VALUES (1, 1, 'Neo');
INSERT INTO Movie_Directors VALUES (3, 7);
INSERT INTO Movie_Genre VALUES (1, 'Actie');
INSERT INTO Payment VALUES ('PayPal');
INSERT INTO Contract VALUES ('1 maand', 10, 0);
INSERT INTO Country VALUES ('Nederland');
INSERT INTO Customer VALUES ('martijnp@live.nl', 'Peijer', 'Martijn', 'PayPal', '105926', '2 maanden', '16-nov-2017', '16-jan-2018', 'martijnp', 'peijer123', 'Nederland', 'M', '10-dec-1995');
INSERT INTO WatchHistory VALUES (1, 'martijnp@live.nl', '11-nov-2017', 5, 1);

--Tegenvoorbeelden
INSERT INTO Genre VALUES ('Actie', 'Actie');
INSERT INTO Genre VALUES ('Actie', 'Meer actie');
--Je probeert hier twee keer actie in te voeren als genre.

INSERT INTO Movie VALUES (1, 'Matrix', 136, 'The Matrix is het eerste deel uit een trilogie. De andere twee delen zijn The Matrix Reloaded en The Matrix Revolutions. Alle delen zijn uitgegeven door Warner Bros.', 999, 'https://upload.wikimedia.org/wikipedia/en/9/9a/The_Matrix_soundtrack_cover.jpg', null, 5, 'https://www.youtube.com/watch?v=m8e-FF8MsqU');
--Het jaar valt buiten 1890 tot 2017.

INSERT INTO Person VALUES (2, 'Reeves', 'Keanu', 'M');
INSERT INTO Person VALUES (2, 'Fishburne', 'Laurence', 'U');
--Hier heb je twee films met de zelfde person_id, dat kan ook niet. En de tweede heeft U als gender, wat niet binnen de check constraint valt.

INSERT INTO Movie_Cast VALUES (1, NULL, 'Neo');
INSERT INTO Movie_Cast VALUES (1, 1, 'Neo');
--Hier gebruik je twee keer dezelde rol, dit mag niet. Ook geef je null als person_id wat ook niet kan.

INSERT INTO Movie_Directors VALUES (3, 7);
INSERT INTO Movie_Directors VALUES (3, 7);
--Je probeert twee keer dezelfde director aan een film te koppelen wat niet kan door de constraint.

INSERT INTO Movie_Genre VALUES (1, 'Actie');
INSERT INTO Movie_Genre VALUES (1, 'Actie');
--Hier voeg je twee keer het zelfde genre op de zelfde film wat niet mag.

INSERT INTO Payment VALUES (NULL);
--Payment_method mag geen null zijn.

INSERT INTO Contract VALUES ('1 maand', 10, 0);
INSERT INTO Contract VALUES ('1 maand', 10, 0);
--Hier voeg je twee keer het zelfde contract in te voegen wat niet mag omdat deze al bestaat.

INSERT INTO Country VALUES ('Nederland');
INSERT INTO Country VALUES ('Nederland');
--Hier voeg je twee keer het zelfde land in te voegen wat de constraint niet toe laat.

INSERT INTO Customer VALUES ('martijnp@live.nl', 'Peijer', 'Martijn', 'PayPal', '105926', '2 maanden', '16-nov-2017', '16-jan-2018', 'martijnp', 'peijer123', 'Nederland', 'M', '10-dec-1995');
INSERT INTO Customer VALUES ('martijnp@live.nl', 'Peijer', 'Martijn', 'Natura', '105926', '2 dagen', '16-nov-2017', '16-jan-2018', 'martijnp', 'peijer123', 'Nederland', 'U', '10-dec-1995');
--Je mag maar een keer met een bepaald email adress en gebruikersnaam registreren. Ook is natura als payment_method en U als gender niet toegestaan.

INSERT INTO WatchHistory VALUES (#, 'martijnp@bla.nl', '11-nov-2017', 5, 1);
--Het movie_id moet wel geldig zijn en email-address moet geregistreerd zijn.