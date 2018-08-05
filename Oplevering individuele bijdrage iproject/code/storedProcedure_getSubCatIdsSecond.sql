USE [iproject4]
GO

/****** Object:  StoredProcedure [dbo].[getSubCatIdsSecond]    Script Date: 14-6-2018 10:33:16 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[getSubCatIdsSecond] @catId int
as


if exists(
select b.rubrieknaam as second
FROM rubrieken r
JOIN rubrieken z ON r.parent = z.rubrieknummer
JOIN rubrieken b ON r.rubrieknummer = b.parent)
BEGIN 
	select b.rubrieknummer as second
	FROM rubrieken r
	JOIN rubrieken z ON r.parent = z.rubrieknummer
	JOIN rubrieken b ON r.rubrieknummer = b.parent
	WHERE r.rubrieknummer = @catId
ORDER BY r.rubrieknaam ASC
END 
RETURN
GO


