USE [master]
GO
/****** Object:  Database [StudentSystem]    Script Date: 11/01/2025 4:29:50 PM ******/
CREATE DATABASE [StudentSystem]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'StudentSystem', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\StudentSystem.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'StudentSystem_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\StudentSystem_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [StudentSystem] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [StudentSystem].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [StudentSystem] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [StudentSystem] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [StudentSystem] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [StudentSystem] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [StudentSystem] SET ARITHABORT OFF 
GO
ALTER DATABASE [StudentSystem] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [StudentSystem] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [StudentSystem] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [StudentSystem] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [StudentSystem] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [StudentSystem] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [StudentSystem] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [StudentSystem] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [StudentSystem] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [StudentSystem] SET  ENABLE_BROKER 
GO
ALTER DATABASE [StudentSystem] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [StudentSystem] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [StudentSystem] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [StudentSystem] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [StudentSystem] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [StudentSystem] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [StudentSystem] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [StudentSystem] SET RECOVERY FULL 
GO
ALTER DATABASE [StudentSystem] SET  MULTI_USER 
GO
ALTER DATABASE [StudentSystem] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [StudentSystem] SET DB_CHAINING OFF 
GO
ALTER DATABASE [StudentSystem] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [StudentSystem] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [StudentSystem] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [StudentSystem] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'StudentSystem', N'ON'
GO
ALTER DATABASE [StudentSystem] SET QUERY_STORE = ON
GO
ALTER DATABASE [StudentSystem] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [StudentSystem]
GO
/****** Object:  Table [dbo].[Courses]    Script Date: 11/01/2025 4:29:50 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Courses](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[course_code] [varchar](20) NOT NULL,
	[course_name] [varchar](100) NOT NULL,
	[department] [varchar](100) NULL,
	[duration_years] [int] NULL,
	[created_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Students]    Script Date: 11/01/2025 4:29:51 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Students](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[student_id] [varchar](20) NOT NULL,
	[first_name] [varchar](100) NOT NULL,
	[last_name] [varchar](100) NOT NULL,
	[email] [varchar](100) NOT NULL,
	[phone] [varchar](20) NULL,
	[address] [text] NULL,
	[birth_date] [date] NULL,
	[gender] [varchar](10) NULL,
	[course] [varchar](100) NULL,
	[year_level] [int] NULL,
	[status] [varchar](20) NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Courses] ON 
GO
INSERT [dbo].[Courses] ([id], [course_code], [course_name], [department], [duration_years], [created_at]) VALUES (1, N'BSIT', N'Bachelor of Science in Information Technology', N'College of Computer Studies', 4, CAST(N'2025-11-01T09:18:12.480' AS DateTime))
GO
INSERT [dbo].[Courses] ([id], [course_code], [course_name], [department], [duration_years], [created_at]) VALUES (2, N'BSCS', N'Bachelor of Science in Computer Science', N'College of Computer Studies', 4, CAST(N'2025-11-01T09:18:12.480' AS DateTime))
GO
INSERT [dbo].[Courses] ([id], [course_code], [course_name], [department], [duration_years], [created_at]) VALUES (3, N'BSCE', N'Bachelor of Science in Civil Engineering', N'College of Engineering', 5, CAST(N'2025-11-01T09:18:12.480' AS DateTime))
GO
INSERT [dbo].[Courses] ([id], [course_code], [course_name], [department], [duration_years], [created_at]) VALUES (4, N'BSME', N'Bachelor of Science in Mechanical Engineering', N'College of Engineering', 5, CAST(N'2025-11-01T09:18:12.480' AS DateTime))
GO
INSERT [dbo].[Courses] ([id], [course_code], [course_name], [department], [duration_years], [created_at]) VALUES (5, N'BSEd', N'Bachelor of Secondary Education', N'College of Education', 4, CAST(N'2025-11-01T09:18:12.480' AS DateTime))
GO
INSERT [dbo].[Courses] ([id], [course_code], [course_name], [department], [duration_years], [created_at]) VALUES (6, N'BSBA', N'Bachelor of Science in Business Administration', N'College of Business', 4, CAST(N'2025-11-01T09:18:12.480' AS DateTime))
GO
INSERT [dbo].[Courses] ([id], [course_code], [course_name], [department], [duration_years], [created_at]) VALUES (7, N'BSN', N'Bachelor of Science in Nursing', N'College of Nursing', 4, CAST(N'2025-11-01T09:18:12.480' AS DateTime))
GO
INSERT [dbo].[Courses] ([id], [course_code], [course_name], [department], [duration_years], [created_at]) VALUES (8, N'BSA', N'Bachelor of Science in Accountancy', N'College of Business', 4, CAST(N'2025-11-01T09:18:12.480' AS DateTime))
GO
SET IDENTITY_INSERT [dbo].[Courses] OFF
GO
SET IDENTITY_INSERT [dbo].[Students] ON 
GO
INSERT [dbo].[Students] ([id], [student_id], [first_name], [last_name], [email], [phone], [address], [birth_date], [gender], [course], [year_level], [status], [created_at], [updated_at]) VALUES (1, N'34545', N'Marilyn', N'Mc Arthur', N'sample@gmail.com', N'09089478376', N'Panabo', CAST(N'2005-06-14' AS Date), N'Male', N'Bachelor of Science in Accountancy', 1, N'Active', CAST(N'2025-11-01T09:37:47.460' AS DateTime), CAST(N'2025-11-01T13:12:46.050' AS DateTime))
GO
SET IDENTITY_INSERT [dbo].[Students] OFF
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ__Courses__AB6B45F1D8557E93]    Script Date: 11/01/2025 4:29:51 PM ******/
ALTER TABLE [dbo].[Courses] ADD UNIQUE NONCLUSTERED 
(
	[course_code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ__Students__2A33069BF28D044F]    Script Date: 11/01/2025 4:29:51 PM ******/
ALTER TABLE [dbo].[Students] ADD UNIQUE NONCLUSTERED 
(
	[student_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ__Students__AB6E616488B809C9]    Script Date: 11/01/2025 4:29:51 PM ******/
ALTER TABLE [dbo].[Students] ADD UNIQUE NONCLUSTERED 
(
	[email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Courses] ADD  DEFAULT ((4)) FOR [duration_years]
GO
ALTER TABLE [dbo].[Courses] ADD  DEFAULT (getdate()) FOR [created_at]
GO
ALTER TABLE [dbo].[Students] ADD  DEFAULT ('Active') FOR [status]
GO
ALTER TABLE [dbo].[Students] ADD  DEFAULT (getdate()) FOR [created_at]
GO
ALTER TABLE [dbo].[Students] ADD  DEFAULT (getdate()) FOR [updated_at]
GO
USE [master]
GO
ALTER DATABASE [StudentSystem] SET  READ_WRITE 
GO
