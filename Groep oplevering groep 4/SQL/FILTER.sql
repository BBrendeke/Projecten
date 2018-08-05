use iProject4
GO 

ALTER FUNCTION [dbo].[udf_StripHTML]
(
@HTMLText varchar(MAX)
)
RETURNS varchar(MAX)
AS
BEGIN
DECLARE @Start  int
DECLARE @End    int
DECLARE @Length int

-- Replace the HTML entity &amp; with the '&' character (this needs to be done first, as
-- '&' might be double encoded as '&amp;amp;')
SET @Start = CHARINDEX('&amp;', @HTMLText)
SET @End = @Start + 4
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '&')
SET @Start = CHARINDEX('&amp;', @HTMLText)
SET @End = @Start + 4
SET @Length = (@End - @Start) + 1
END

-- Replace the HTML entity &lt; with the '<' character
SET @Start = CHARINDEX('&lt;', @HTMLText)
SET @End = @Start + 3
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '<')
SET @Start = CHARINDEX('&lt;', @HTMLText)
SET @End = @Start + 3
SET @Length = (@End - @Start) + 1
END

-- Replace the HTML entity &gt; with the '>' character
SET @Start = CHARINDEX('&gt;', @HTMLText)
SET @End = @Start + 3
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '>')
SET @Start = CHARINDEX('&gt;', @HTMLText)
SET @End = @Start + 3
SET @Length = (@End - @Start) + 1
END

-- Replace the HTML entity &amp; with the '&' character
SET @Start = CHARINDEX('&amp;amp;', @HTMLText)
SET @End = @Start + 4
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '&')
SET @Start = CHARINDEX('&amp;amp;', @HTMLText)
SET @End = @Start + 4
SET @Length = (@End - @Start) + 1
END

-- Replace the HTML entity &nbsp; with the ' ' character
SET @Start = CHARINDEX('&nbsp;', @HTMLText)
SET @End = @Start + 5
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, ' ')
SET @Start = CHARINDEX('&nbsp;', @HTMLText)
SET @End = @Start + 5
SET @Length = (@End - @Start) + 1
END

-- Replace any <br> tags with a newline
SET @Start = CHARINDEX('<br>', @HTMLText)
SET @End = @Start + 3
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, CHAR(13) + CHAR(10))
SET @Start = CHARINDEX('<br>', @HTMLText)
SET @End = @Start + 3
SET @Length = (@End - @Start) + 1
END

-- Replace any a: tags with a space
SET @Start = CHARINDEX('a:', @HTMLText)
SET @End = @Start + 3
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, ' ')
SET @Start = CHARINDEX('a:', @HTMLText)
SET @End = @Start + 10
SET @Length = (@End - @Start) + 1
END

-- Replace any <br/> tags with a newline
SET @Start = CHARINDEX('<br/>', @HTMLText)
SET @End = @Start + 4
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, 'CHAR(13) + CHAR(10)')
SET @Start = CHARINDEX('<br/>', @HTMLText)
SET @End = @Start + 4
SET @Length = (@End - @Start) + 1
END

-- Replace any <br /> tags with a newline
SET @Start = CHARINDEX('<br />', @HTMLText)
SET @End = @Start + 5
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, 'CHAR(13) + CHAR(10)')
SET @Start = CHARINDEX('<br />', @HTMLText)
SET @End = @Start + 5
SET @Length = (@End - @Start) + 1
END

-- Replace any CHAR(13) + CHAR(10) with a new space
SET @Start=CHARINDEX('3) + CHAR(10)',@HTMLText)
SET @END = @Start + 13
SET @Length = (@End - @Start) + 1

WHILE(@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '' )
SET @Start = CHARINDEX('3) + CHAR(10)', @HTMLText)
SET @End = @Start + 13
SET @length = (@End - @Start) + 1
END
-- Replace ebay reclame zin with a space
SET @Start = CHARINDEX('Gemaakt door eBay Turbo Lister.', @HTMLText)
SET @End = @Start + 555
SET @Length = (@End - @Start) + 1

WHILE(@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @length, '')
SET @Start = CHARINDEX('Gemaakt door eBay Turbo Lister. ', @HTMLText)
SET @End = @Start + 555
SET @Length = (@End - @Start) + 1
END

-- Replace Paypal request with a space
SET @Start = CHARINDEX('PLEASE DON''T USE PAYPAL', @HTMLText)
SET @End = @Start + 19
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('PLEASE DON''T USE PAYPAL', @HTMLText)
SET @End = @Start + 19
SET @Length = (@End - @Start) + 1
END

-- Remove the css of w3 schools
SET @Start = CHARINDEX('/*',@HTMLText)
SET @End = @Start + 3905
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('/*', @HTMLText)
SET @End = @Start + 3905
SET @Length = (@End - @Start) + 1
END
-- Remove anything between <whatever> tags
SET @Start = CHARINDEX('<', @HTMLText)
SET @End = CHARINDEX('>', @HTMLText, CHARINDEX('<', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('<', @HTMLText)
SET @End = CHARINDEX('>', @HTMLText, CHARINDEX('<', @HTMLText))
SET @Length = (@End - @Start) + 1
END

--Remove css classes anything between {whatever} tags
SET @Start = CHARINDEX('#', @HTMLText)
SET @End = CHARINDEX('}', @HTMLText, CHARINDEX('{', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('#', @HTMLText)
SET @End = CHARINDEX('}', @HTMLText, CHARINDEX('{', @HTMLText))
SET @Length = (@End - @Start) + 1
END

--Remove anything between -whatever- tags
SET @Start = CHARINDEX('-', @HTMLText)
SET @END = CHARINDEX('-', @HTMLText, CHARINDEX('-', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('-', @HTMLText)
SET @End = CHARINDEX ('-', @HTMLText, CHARINDEX('-', @HTMLText))
SET @Length = (@End - @Start) + 1
END

-- Remove anything between **whatever** tags
SET @Start = CHARINDEX('*', @HTMLText)
SET @END = CHARINDEX('*', @HTMLText, CHARINDEX('*', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('*', @HTMLText)
SET @End = CHARINDEX ('*', @HTMLText, CHARINDEX('*', @HTMLText))
SET @Length = (@End - @Start) + 1
END

--Remove anything between // ) tag
SET @Start = CHARINDEX('/ ', @HTMLText)
SET @END = CHARINDEX(') ', @HTMLText, CHARINDEX('/ ', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('/ ', @HTMLText)
SET @End = CHARINDEX (')', @HTMLText, CHARINDEX('/ ', @HTMLText))
SET @Length = (@End - @Start) + 1
END

--Remove anything between document en ; tag
SET @Start = CHARINDEX('document', @HTMLText)
SET @END = CHARINDEX(';', @HTMLText, CHARINDEX('document', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('document', @HTMLText)
SET @End = CHARINDEX (';', @HTMLText, CHARINDEX('document', @HTMLText))
SET @Length = (@End - @Start) + 1
END

-- remove anything between html en ) tag
SET @Start = CHARINDEX('html', @HTMLText)
SET @END = CHARINDEX(')', @HTMLText, CHARINDEX('html', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('html', @HTMLText)
SET @End = CHARINDEX (')', @HTMLText, CHARINDEX('html', @HTMLText))
SET @Length = (@End - @Start) + 1
END

--Remove anything between p.p1 en p.p14) tag
SET @Start = CHARINDEX('p.p ', @HTMLText)
SET @END = CHARINDEX('14', @HTMLText, CHARINDEX('p.p1 ', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('p.p ', @HTMLText)
SET @End = CHARINDEX ('14', @HTMLText, CHARINDEX('p.p1 ', @HTMLText))
SET @Length = (@End - @Start) + 1
END

--Remove anything between span.s1 en span.s8) tag
SET @Start = CHARINDEX('span.s1 ', @HTMLText)
SET @END = CHARINDEX('span.s8', @HTMLText, CHARINDEX('span.s1 ', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('span.s1', @HTMLText)
SET @End = CHARINDEX ('span.s8', @HTMLText, CHARINDEX('span.s1', @HTMLText))
SET @Length = (@End - @Start) + 1
END
--- remove the last jiberishc
SET @Start = CHARINDEX(' = ', @HTMLText)
SET @End = CHARINDEX (' } ', @HTMLText, CHARINDEX( ' = ', @HTMLTEXT))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length >0) BEGIN
SET @HTMLText =STUFF(@HTMLText, @Start, @length, '')
SET @Start = CHARINDEX(' = ', @HTMLText)
SET @End = CHARINDEX (' } ', @HTMLText, CHARINDEX( ' = ', @HTMLTEXT))
SET @Length = (@End - @Start) + 1
END

SET @Start = CHARINDEX('">'' ', @HTMLText)
SET @End = CHARINDEX (' drag_drop', @HTMLText, CHARINDEX( ' = ', @HTMLTEXT))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length >0) BEGIN
SET @HTMLText =STUFF(@HTMLText, @Start, @length, '')
SET @Start = CHARINDEX('">'' ', @HTMLText)
SET @End = CHARINDEX (' drag_drop', @HTMLText, CHARINDEX( ' = ', @HTMLTEXT))
SET @Length = (@End - @Start) + 1
END

RETURN LTRIM(RTRIM(@HTMLText))

END

GO

select * from veiling


UPDATE veiling
SET Beschrijving = dbo.udf_StripHTML(Beschrijving)

UPDATE veiling
SET titel = dbo.udf_StripHTML(titel)

SELECT * FROM Bod

SELECT gebruikersnaam, bodbedrag
FROM Bod
WHERE bodbedrag = (
SELECT max(bodbedrag)
FROM BOD
WHERE voorwerp_id = 16
)

select name, mark
from students
where mark = (
    select max(mark)
    from students
)