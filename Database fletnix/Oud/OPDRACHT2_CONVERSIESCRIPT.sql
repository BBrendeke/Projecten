USE fletnix

DELETE FROM Genre;
DELETE FROM Person;
DELETE FROM Movie_Genre;
DELETE FROM Movie_Cast;
DELETE FROM Movie_Directors;
DELETE FROM Movie;


INSERT INTO fletnix.dbo.Person
SELECT CAST (Id AS int) AS person_id,
	        LEFT(Lname,50) AS lastname,
               LEFT(Fname,50) AS firstname,
					NULL AS gender
FROM    MYIMDB.dbo.Imported_Directors


INSERT INTO fletnix.dbo.Person
SELECT CAST (Id+90000 AS int) AS person_id,
	        LEFT(Lname,50) AS lastname,
               LEFT(Fname,50) AS firstname,
					CAST (Gender AS char) AS gender
FROM    MYIMDB.dbo.Imported_Person

INSERT INTO fletnix.dbo.Movie
SELECT CAST (Id AS int) AS movie_id,
			LEFT(Name, 255) AS title,
				NULL AS duration,
					NULL AS description,
						CAST(Year AS int) AS publication_year,
							NULL AS cover_image,
								NULL AS previous_part,
									0 AS price,
										NULL AS URL
FROM    MYIMDB.dbo.Imported_Movie


INSERT INTO fletnix.dbo.Genre
SELECT DISTINCT (LEFT(Genre,50)) AS genre_name,
		NULL AS description
			
FROM MYIMDB.dbo.Imported_Genre


INSERT INTO fletnix.dbo.Movie_Genre
SELECT DISTINCT Id AS movie_id,
			LEFT(Genre, 255) AS genre_name
FROM MYIMDB.dbo.Imported_Genre
WHERE Id IN (SELECT movie_id
			FROM fletnix.dbo.Movie)


INSERT INTO fletnix.dbo.Movie_Cast
SELECT DISTINCT Mid AS movie_id,
			CAST (Pid+90000 AS int) AS person_id,
				LEFT(Role, 255) AS role
FROM MYIMDB.dbo.Imported_Cast
WHERE Mid IN (SELECT movie_id
			FROM fletnix.dbo.Movie)



INSERT INTO fletnix.dbo.Movie_Directors
SELECT DISTINCT Mid AS movie_id,
			CAST (Did AS int) AS person_id
FROM MYIMDB.dbo.Imported_Movie_Directors
WHERE Mid IN (SELECT movie_id
			FROM fletnix.dbo.Movie)