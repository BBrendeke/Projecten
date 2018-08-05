USE fletnix

--A
SELECT M.title, M.publication_year, G.genre_name
FROM Movie M JOIN Movie_Genre G
ON M.movie_id = G.movie_id
ORDER BY G.genre_name;

--B
SELECT movie_id, title
FROM Movie
WHERE publication_year >= 1990 
AND publication_year <= 2010
ORDER BY publication_year;

--C
SELECT lastname, firstname, subscription_start
FROM Customer
WHERE subscription_end is NULL
ORDER BY lastname;

--D
SELECT M.movie_id, M.title, P.firstname, P.lastname
FROM person P INNER JOIN Movie_Cast C ON p.person_id = c.person_id
	INNER JOIN Movie M ON c.movie_id = m.movie_id
WHERE M.title LIKE 'Terminator%'
AND M.publication_year = 1991;

--E
SELECT M.title, M.publication_year
FROM Movie_Cast C JOIN Movie M ON C.movie_id = M.movie_id
JOIN Person P ON P.person_id = C.person_id
WHERE P.lastname LIKE 'Schwarzenegger'
AND P.firstname LIKE 'Arnold'

--F
CREATE VIEW vwOpenstaande_kosten AS
SELECT C.lastname, C.firstname, SUM(W.price) AS Totale_schuld
FROM Customer C INNER JOIN WatchHistory W on W.customer_mail_address = C.customer_mail_address
GROUP BY C.lastname, C.firstname
HAVING SUM(W.price) > 0

--G
CREATE VIEW vwMinst_bekeken AS
SELECT TOP 100 M.title, COUNT(W.movie_id) AS number_of_times_watched
FROM WatchHistory W inner join Movie M on M.movie_id =  W.movie_id
GROUP BY M.title
--ORDER BY number_of_times_watched

--H(Geeft geen resultaat na 16-01-2018 omdat de laatste watch_date 16-11-2017 is)
CREATE VIEW vwTwee_maanden AS
SELECT M.title, M.publication_year,
COUNT (W.watch_date) AS number_of_times_watched
FROM Movie M, WatchHistory W
WHERE W.watch_date IS NOT NULL
GROUP BY M.title, M.publication_year, W.watch_date
HAVING W.watch_date >= DATEADD(MONTH,-2, GETDATE())
--ORDER BY number_of_times_watched



--I
SELECT title, publication_year
FROM movie
WHERE movie_id in (
	SELECT movie_id
	FROM Movie_Genre
	GROUP BY movie_id
	HAVING COUNT(movie_id) > 8)

--J
SELECT P.firstname, P.lastname
FROM Person P INNER JOIN Movie_Cast C ON P.person_id = C.person_id
	INNER JOIN Movie_Genre G ON G.movie_id = C.movie_id
WHERE P.gender = 'F' 
AND G.genre_name in (SELECT genre_name
					FROM Movie_Genre
					WHERE genre_name = 'Horror')
AND G.genre_name in (SELECT genre_name
					FROM Movie_Genre
					WHERE genre_name = 'Family')
GROUP BY P.firstname, P.lastname

--K
SELECT TOP 1 P.firstname, P.lastname, COUNT(movie_id) AS aantal_films
FROM Person P JOIN Movie_Directors D ON P.person_id = D.person_id
GROUP BY P.firstname, P.lastname
ORDER BY COUNT(movie_id) DESC

--L
CREATE VIEW vwPopulaire_films AS
SELECT genre_name, (COUNT(genre_name)*100/(SELECT COUNT(genre_name) FROM Movie_Genre)) AS percentage
FROM Movie_Genre
GROUP BY genre_name
--ORDER BY percentage DESC

--M
CREATE VIEW vwGemiddelde_films_bekeken_per_dag AS
SELECT C.customer_mail_address, 
COUNT(W.customer_mail_address)/DATEDIFF(DAY,C.subscription_start, GETDATE()) AS Gemiddelde_films_bekeken_per_dag
FROM Customer C, WatchHistory W
GROUP BY C.customer_mail_address, C.subscription_start
HAVING COUNT(W.customer_mail_address)/DATEDIFF(DAY,C.subscription_start, GETDATE()) >= 2
--ORDER BY COUNT(W.customer_mail_address)/DATEDIFF(DAY,C.subscription_start, GETDATE()) DESC
