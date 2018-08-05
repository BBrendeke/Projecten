use iproject4
GO

IF COALESCE(OBJECT_ID('dbo.StripCrLfTab'), 0) <> 0
BEGIN
    DROP FUNCTION dbo.StripCrLfTab;
END
GO
CREATE FUNCTION dbo.StripCrLfTab
(
    @val NVARCHAR(1000)
)
RETURNS @Results TABLE
(
    TrimmedVal NVARCHAR(1000) NULL
)
AS
BEGIN
    DECLARE @TrimmedVal NVARCHAR(1000);
    SET @TrimmedVal = CASE WHEN RIGHT(@val, 1) = CHAR(13) OR RIGHT(@val, 1) = CHAR(10) OR RIGHT(@val, 1) = CHAR(9)
            THEN LEFT(
                CASE WHEN LEFT(@val, 1) = CHAR(13) OR LEFT(@val, 1) = CHAR(10) OR LEFT(@val, 1) = CHAR(9)
                THEN RIGHT(@val, LEN(@val) - 1)
                ELSE @val
                END
                , LEN(@val) -1 )
            ELSE
                CASE WHEN LEFT(@val, 1) = CHAR(13) OR LEFT(@val, 1) = CHAR(10) OR LEFT(@val, 1) = CHAR(9)
                THEN RIGHT(@val, LEN(@val) - 1)
                ELSE @val
                END
            END;
    IF @TrimmedVal LIKE (CHAR(13) + '%')
        OR @TrimmedVal LIKE (CHAR(10) + '%')
        OR @TrimmedVal LIKE (CHAR(9) + '%')
        OR @TrimmedVal LIKE ('%' + CHAR(13))
        OR @TrimmedVal LIKE ('%' + CHAR(10))
        OR @TrimmedVal LIKE ('%' + CHAR(9))
        SELECT @TrimmedVal = tv.TrimmedVal
        FROM dbo.StripCrLfTab(@TrimmedVal) tv;
    INSERT INTO @Results (TrimmedVal)
    VALUES (@TrimmedVal);
    RETURN;
END;
GO

SELECT TOP(200)Beschrijving
FROM Items 
CROSS APPLY dbo.StripCrLfTab(Beschrijving);

SELECT TOP(200)Beschrijving
FROM Items

SELECT REPLACE(Beschrijving, char(44), '') AS Beschrijving From Items