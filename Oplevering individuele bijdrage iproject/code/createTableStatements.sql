USE [iproject4]
GO

/****** Object:  Table [dbo].[blacklist]    Script Date: 14-6-2018 10:41:05 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[blacklist](
	[mailadres] [varchar](30) NOT NULL
) ON [PRIMARY]
GO


USE [iproject4]
GO

/****** Object:  Table [dbo].[token]    Script Date: 14-6-2018 10:41:28 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[token](
	[token] [varchar](50) NOT NULL,
	[mailadres] [varchar](30) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[token] ASC,
	[mailadres] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


