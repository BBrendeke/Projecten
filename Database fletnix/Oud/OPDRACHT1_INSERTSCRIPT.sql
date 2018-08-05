USE fletnix

DELETE FROM Genre;
DELETE FROM Movie;
DELETE FROM Person;
DELETE FROM Movie_Cast;
DELETE FROM Movie_Directors;
DELETE FROM Movie_Genre;
DELETE FROM Payment;
DELETE FROM Contract;
DELETE FROM Country;
DELETE FROM Customer;
DELETE FROM WatchHistory;

INSERT INTO Genre VALUES ('Actie', null);
INSERT INTO Genre VALUES ('Sciencefiction', null);
INSERT INTO Genre VALUES ('Horror', null);
INSERT INTO Genre VALUES ('Animatiefilm', null);

INSERT INTO Movie VALUES (1, 'Matrix', 136, 'The Matrix is het eerste deel uit een trilogie. De andere twee delen zijn The Matrix Reloaded en The Matrix Revolutions. Alle delen zijn uitgegeven door Warner Bros.', 1999, 'https://upload.wikimedia.org/wikipedia/en/9/9a/The_Matrix_soundtrack_cover.jpg', null, 5, 'https://www.youtube.com/watch?v=m8e-FF8MsqU');
INSERT INTO Movie VALUES (2, 'Matrix Reloaded', 136, 'The Matrix Reloaded is een Amerikaanse sciencefictionfilm uit 2003. Het is het tweede deel van de Matrix trilogie. Net zoals het vorige deel geproduceerd door Joel Silver en uitgegeven door Warner Bros.', 2003, 'http://www.coverwhiz.com/content/The-Matrix-Reloaded.jpg', 1, 9, 'https://www.youtube.com/watch?v=kYzz0FSgpSU');
INSERT INTO Movie VALUES (3, 'E.T. The Extra-Terrestrial', 115, 'E.T. the Extra-Terrestrial (vaak afgekort tot E.T.) is een Amerikaanse sciencefictionfilm uit 1982. De film werd geregisseerd en medegeproduceerd door Steven Spielberg.', 1982, 'http://img.soundtrackcollector.com/movie/large/E_T.jpg', null, 4.99, 'https://www.youtube.com/watch?v=taMnCjzKgd8');
INSERT INTO Movie VALUES (4, 'Saw', 103, 'Saw (Engels voor zaag) is het eerste deel van acht thriller-horrorfilms in de Saw-reeks. De films gaan over Jigsaw, een man die mensen van wie hij vindt dat ze dat verdienen ontvoert en gevangen zet in vallen die een dodelijke uitkomst kunnen hebben.', 2004, 'http://www.dvd-forum.at/img/uploaded/kinoplakate/large/121429181868012500.jpg', null, 7.99, 'https://www.youtube.com/watch?v=OCZp5v8V-94');
INSERT INTO Movie VALUES (5, 'Frozen', 102, 'Frozen is een Amerikaanse animatiefilm uit 2013 geproduceerd door Walt Disney Animation Studios.[2] Het is de 53ste animatiefilm van Disney.', 2013, 'https://i.ytimg.com/vi/XfRY0ASZHuU/movieposter.jpg', null, 12.99, 'https://www.youtube.com/watch?v=TbQm5doF_Uc');
INSERT INTO Movie VALUES (6, 'Die Hard', 131, 'Die Hard is een actiefilm uit 1988, geschreven door Jeb Stuart en Steven E. de Souza. De hoofdrollen worden gespeeld door Bruce Willis, Bonnie Bedelia, Alan Rickman en William Atherton.', 1988, 'https://letusnerd.files.wordpress.com/2013/02/die-hard.jpg', null, 6, 'https://www.youtube.com/watch?v=2TQ-pOvI6Xo');
INSERT INTO Movie VALUES (7, 'Die Hard 2', 124, 'Die Hard 2 is het vervolg op de populaire Die Hard-film uit 1988. De film werd geregisseerd door Renny Harlin en kwam uit in de bioscoop op 4 juli 1990.', 1990, 'https://www.mauvais-genres.com/15391-thickbox_default/die-hard-2-movie-poster-29x41-in-usa-1990-renny-harlin-bruce-willis.jpg', 6, 8, 'https://www.youtube.com/watch?v=OyxfXQ4MGLQ');

INSERT INTO Person VALUES (1, 'Reeves', 'Keanu', 'M');
INSERT INTO Person VALUES (2, 'Fishburne', 'Laurence', 'M');
INSERT INTO Person VALUES (3, 'Moss', 'Carrie-Anne', 'F');
INSERT INTO Person VALUES (4, 'Thomas', 'Henry', 'M');
INSERT INTO Person VALUES (5, 'MacNaughton', 'Robert', 'M');
INSERT INTO Person VALUES (6, 'Barrymore', 'Drew', 'M');
INSERT INTO Person VALUES (7, 'Spielberg', 'Steven', 'M');
INSERT INTO Person VALUES (8, 'Elwes', 'Cary', 'M');
INSERT INTO Person VALUES (9, 'Bell', 'Tobin', 'M');
INSERT INTO Person VALUES (10, 'Whannell', 'Leigh', 'M');
INSERT INTO Person VALUES (11, 'Wan', 'James', 'M');
INSERT INTO Person VALUES (12, 'Willis', 'Bruce', 'M');
INSERT INTO Person VALUES (13, 'Rickman', 'Alan', 'M');
INSERT INTO Person VALUES (14, 'Bedella', 'Bonnie', 'F');
INSERT INTO Person VALUES (15, 'McTiernan', 'John', 'M');
INSERT INTO Person VALUES (16, 'Sadler', 'William', 'M');
INSERT INTO Person VALUES (17, 'Evans', 'Art', 'M');
INSERT INTO Person VALUES (18, 'Harlin', 'Renny', 'M');

INSERT INTO Movie_Cast VALUES (1, 1, 'Neo');
INSERT INTO Movie_Cast VALUES (1, 2, 'Morpheus');
INSERT INTO Movie_Cast VALUES (1, 3, 'Trinity');
INSERT INTO Movie_Cast VALUES (2, 1, 'Neo');
INSERT INTO Movie_Cast VALUES (2, 2, 'Morpheus');
INSERT INTO Movie_Cast VALUES (2, 3, 'Trinity');
INSERT INTO Movie_Cast VALUES (3, 4, 'Elliot');
INSERT INTO Movie_Cast VALUES (3, 5, 'Michael');
INSERT INTO Movie_Cast VALUES (3, 6, 'Gertie');
INSERT INTO Movie_Cast VALUES (4, 8, 'Dr. Lawrence Gordon');
INSERT INTO Movie_Cast VALUES (4, 9, 'John Kramer / Jigsaw');
INSERT INTO Movie_Cast VALUES (4, 10, 'Adam Stanheight');
INSERT INTO Movie_Cast VALUES (6, 12, 'John McClane');
INSERT INTO Movie_Cast VALUES (6, 13, 'Hans Gruber');
INSERT INTO Movie_Cast VALUES (6, 14, 'Holly Gennaro McClane');
INSERT INTO Movie_Cast VALUES (7, 12, 'John McClane');
INSERT INTO Movie_Cast VALUES (7, 16, 'Kolonel Stuart');
INSERT INTO Movie_Cast VALUES (7, 17, 'Leslie Barnes');

INSERT INTO Movie_Directors VALUES (3, 7);
INSERT INTO Movie_Directors VALUES (4, 11);
INSERT INTO Movie_Directors VALUES (6, 15);
INSERT INTO Movie_Directors VALUES (7, 18);

INSERT INTO Movie_Genre VALUES (1, 'Actie');
INSERT INTO Movie_Genre VALUES (2, 'Actie');
INSERT INTO Movie_Genre VALUES (3, 'Sciencefiction');
INSERT INTO Movie_Genre VALUES (4, 'Horror');
INSERT INTO Movie_Genre VALUES (5, 'Animatiefilm');
INSERT INTO Movie_Genre VALUES (6, 'Actie');
INSERT INTO Movie_Genre VALUES (7, 'Actie');

INSERT INTO Payment VALUES ('PayPal');
INSERT INTO Payment VALUES ('VISA');
INSERT INTO Payment VALUES ('MasterCard');
INSERT INTO Payment VALUES ('ING');
INSERT INTO Payment VALUES ('Rabobank');

INSERT INTO Contract VALUES ('1 maand', 10, 0);
INSERT INTO Contract VALUES ('2 maanden', 10, 5);
INSERT INTO Contract VALUES ('4 maanden', 10, 10);
INSERT INTO Contract VALUES ('6 maanden', 10, 15);
INSERT INTO Contract VALUES ('Onbeperkt', 10, 20);

INSERT INTO Country VALUES ('Nederland');
INSERT INTO Country VALUES ('Duitsland');
INSERT INTO Country VALUES ('Frankrijk');
INSERT INTO Country VALUES ('Verenigde Staten');
INSERT INTO Country VALUES ('België');
INSERT INTO Country VALUES ('China');

INSERT INTO Customer VALUES ('martijnp@live.nl', 'Peijer', 'Martijn', 'PayPal', '105926', '2 maanden', '16-nov-2017', '16-jan-2018', 'martijnp', 'peijer123', 'Nederland', 'M', '10-dec-1995');
INSERT INTO Customer VALUES ('mauricedekoning@live.nl', 'De Koning', 'Maurice', 'MasterCard', '102126', '4 maanden', '12-oct-2017', '12-feb-2018', 'mauriceje', 'grolsch', 'Nederland', 'M', '7-nov-1997');
INSERT INTO Customer VALUES ('bartbrendeke@gmail.com', 'Brendeke', 'Bart', 'ING', 'NL69ING123456789', '1 maand', '11-nov-2017', '11-dec-2017', 'bart123', 'bren12', 'Nederland', 'M', '7-jul-1998');
INSERT INTO Customer VALUES ('janjanssen@live.nl', 'Janssen', 'Jan', 'RaboBank', 'NL12RABO0294810581', '2 maanden', '4-jul-2017', '4-sep-2017', 'j.janssen', 'boom11', 'Nederland', 'M', '11-dec-1969');
INSERT INTO Customer VALUES ('hanns.bratwurst@hotmail.com', 'Bratwurst', 'Hanns', 'PayPal', '356211', 'Onbeperkt', '4-feb-2017', null, 'bratwurstie', 'schnitzel', 'Duitsland', 'M', '6-may-1982');
INSERT INTO Customer VALUES ('baguette@croissant.fr', 'Baguette', 'Lola', 'VISA', '992121', '4 maanden', '4-apr-2017', '4-aug-2017', 'baguette', 'fromage', 'Frankrijk', 'F', '12-dec-1994');
INSERT INTO Customer VALUES ('lingwang@kawai.cn', 'Wang', 'Ling', 'VISA', '123654', 'Onbeperkt', '1-oct-2017', null, 'shanghai22', 'hongkong1', 'China', 'M', '4-feb-2000');
INSERT INTO Customer VALUES ('johnmcclane@diehard.com', 'McClane', 'John', 'MasterCard', '234567', 'Onbeperkt', '7-jul-2017', null, 'john.mcclane', 'dieharder', 'Verenigde Staten', 'M', '4-apr-1970');
INSERT INTO Customer VALUES ('bushgeorge@hotmail.com', 'Bush', 'George', 'PayPal', '124551', 'Onbeperkt', '1-jan-2016', null, 'george.b', 'preseident123', 'Verenigde Staten', 'M', '2-feb-1962');
INSERT INTO Customer VALUES ('lisa.anne@live.nl', 'Anne', 'Lisa', 'VISA', '222222', '6 maanden', '6-jun-2016', '12-jun-2016', 'annelisax', 'secretpassword', 'België', 'F', '20-nov-1996');

INSERT INTO WatchHistory VALUES (1, 'martijnp@live.nl', '11-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'mauricedekoning@live.nl', '12-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'bartbrendeke@gmail.com', '13-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'janjanssen@live.nl', '14-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'hanns.bratwurst@hotmail.com', '15-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'baguette@croissant.fr', '16-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'lingwang@kawai.cn', '10-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'johnmcclane@diehard.com', '9-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'bushgeorge@hotmail.com', '12-nov-2017', 5, 1);
INSERT INTO WatchHistory VALUES (1, 'lisa.anne@live.nl', '14-nov-2017', 5, 1);