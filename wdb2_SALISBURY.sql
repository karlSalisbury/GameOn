-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2014 at 11:05 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wdb2_salisbury`
--
CREATE DATABASE IF NOT EXISTS `wdb2_salisbury` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wdb2_salisbury`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `joinDate` datetime NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`adminID`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `firstName`, `lastName`, `password`, `salt`, `email`, `joinDate`, `type`) VALUES
(1, 'admin', 'Karl', 'Salisbury', 'ed2fea123159fb17619843437fcd03bd5601c71de08b5ab8b694fe8647ba9c2a', '2d7a4fc0c200060e0eb36c9d95869314', 'karl.salisbury@gmail.com', '2014-01-13 14:00:00', 0),
(2, 'adminkt', 'Kristi', 'Turman', '19612ae3ed04b7c224ba12db07be5ce0915eed3de351ccbf60508f948b476e5a', '15cec5205c9e34355287acbb4d096a08', 'kristi@gmail.com', '2014-01-01 09:00:00', 0),
(3, 'adminst', 'Scott', 'Turman', '0fec1e61a67e7a0fd3623e0d9d656fc765462557c2a5f5933ee37b63d9864d80', 'a1dca222c170e3d2b5dd2557d5a57090', 'turman@telstra.com.au', '2014-01-20 14:30:00', 0),
(4, 'adminrw', 'Richard', 'Weathers', '8a35fd6de1e692dfa8277c405f93bba34926176285c85a13634e54e051b576f3', '09d1fe391935b75f798053f866ee5052', 'richo@gmail.com', '2014-01-20 16:00:00', 0),
(5, 'adminnc', 'Nicholas', 'Cutter', 'd54dc8e24b12ba4805777d6b6eac977094b73962a15e04f227ec40eb6ec56432', '4d069acd30e4b0c6eb5e5f36c01d1482', 'nicholas.cutter@gmail.com', '2014-01-22 13:00:00', 0),
(6, 'admintest', 'Testguy', 'Testy', '7080eaeee355ecff627144fa948760e2f6db397f9c0aff05b06da3a430f3b58b', 'fa6f204b0a9881f27f3ec8212c11a166', 'testy@tests.com.au', '2014-04-22 09:38:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  `categoryDesc` varchar(100) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `category`, `categoryDesc`) VALUES
(1, 'Xbox 360', 'Games designed to play on the Xbox 360 platform.'),
(2, 'Playstation 3', 'Games designed to play on the PlayStation 3 platform.'),
(3, 'PC', 'Games designed to play on the personal computer platform.'),
(4, 'iOS', '<p>Games designed to play on Apple iOS devices</p>'),
(6, 'Xbox One', '<p>Games for the Xbox One</p>'),
(7, 'Playstation 4', '<p>Games released for the Sony Playstation 4</p>'),
(8, 'Android', '<p>Games designed to play on Android devices</p>'),
(9, 'Linux', '<p>Games designed to play on Linux systems</p>'),
(10, 'Nintendo 3DS', '<p>Games for the Nintendo 3DS and 2DS family</p>'),
(11, 'PSVita', '<p>Games designed for the Sony Playstation Vita handheld console</p>');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `commentContent` text NOT NULL,
  `reviewID` int(11) NOT NULL,
  `memberID` int(11) DEFAULT NULL,
  `commentDate` datetime NOT NULL,
  `adminID` int(10) DEFAULT NULL COMMENT 'Foreign key  linking admin  table ',
  PRIMARY KEY (`commentID`),
  KEY `fk_comment_member1_idx` (`memberID`),
  KEY `fk_comment_review1_idx` (`reviewID`),
  KEY `adminID` (`adminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `commentContent`, `reviewID`, `memberID`, `commentDate`, `adminID`) VALUES
(1, '<p>I love Minecraft!</p>', 1, 17, '2014-01-20 09:00:00', NULL),
(2, '<p>Best Minecraft version yet. Thanks for the review.</p>', 1, 26, '2014-04-02 02:30:00', NULL),
(3, '<p>I play this way too much</p>', 4, 27, '2014-01-13 16:00:00', NULL),
(5, '<p>It works<strong> OMGFTWYAY!</strong></p>', 2, 15, '2014-04-02 12:50:11', NULL),
(6, '<p>Wow review</p>', 2, 15, '2014-04-02 18:01:49', NULL),
(7, '<p>Updated comment</p>', 3, 15, '2014-04-21 16:42:39', NULL),
(12, '<p>Reply to comment</p>', 3, NULL, '2014-04-22 13:22:26', 1),
(13, '<p>I love Uncharted!</p>', 17, 15, '2014-04-25 09:37:23', NULL),
(14, '<p>Yay Minecraft!</p>', 1, 15, '2014-04-25 10:10:52', NULL),
(15, '<p>I &nbsp;loved the original Yoshi''s Island!</p>', 16, 15, '2014-04-25 10:25:58', NULL),
(16, '<p>Cj you a straight up busta</p>', 4, 15, '2014-04-29 10:05:16', NULL),
(17, '<p>You would</p>', 17, NULL, '2014-04-29 10:06:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `current`
--

CREATE TABLE IF NOT EXISTS `current` (
  `themeID` int(11) NOT NULL COMMENT 'FK linking the current table to the theme table',
  PRIMARY KEY (`themeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `current`
--

INSERT INTO `current` (`themeID`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `memberID` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(64) NOT NULL,
  `username` varchar(25) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `suburb` varchar(40) DEFAULT NULL,
  `postcode` varchar(45) DEFAULT NULL,
  `country` varchar(40) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `joinDate` datetime NOT NULL,
  `image` varchar(200) NOT NULL,
  `newsletter` char(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `state` enum('QLD','NSW','SA','NT','TAS','ACT','WA','NEW ZEALAND','NARNIA') NOT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `password`, `username`, `salt`, `firstName`, `lastName`, `street`, `suburb`, `postcode`, `country`, `phone`, `mobile`, `email`, `gender`, `joinDate`, `image`, `newsletter`, `type`, `state`) VALUES
(15, '9d26a3c61c0e2ce5c980ad8c7fff13c08cf898b6f3786930c73b68e3b88ad779', 'natalie', '002640cb549ba08ee90cd79aee89cce7', 'Natalie', 'Goddard', '18 Edward Street', ' Brisbane', '4001', 'Australia', '738109022', '401209638', 'ngoddard@gmail.com', 'Female', '2014-01-16 14:00:00', '4699_nataliegoddard.png', 'Y', 1, 'QLD'),
(16, '19612ae3ed04b7c224ba12db07be5ce0915eed3de351ccbf60508f948b476e5a', 'yvette', '15cec5205c9e34355287acbb4d096a08', 'Yvette', 'Lyons', '24 Avoca St', ' Yeronga', '4104', 'Australia', '073 848578', '413652378', 'yvette_lyon@hotmail.com', '', '2014-01-16 08:30:00', 'Yvette.jpg', 'Y', 1, 'QLD'),
(17, '0fec1e61a67e7a0fd3623e0d9d656fc765462557c2a5f5933ee37b63d9864d80', 'kathryn', 'a1dca222c170e3d2b5dd2557d5a57090', 'Kathryn', 'Jenkinns', '1/18 Dexter St', ' Tennyson', '4105', 'Australia', '431096952', '', 'katjenkinns@iinet.net', '', '2014-01-20 09:00:00', 'Kathryn.jpg', 'Y', 1, 'QLD'),
(18, '8a35fd6de1e692dfa8277c405f93bba34926176285c85a13634e54e051b576f3', 'jenny', '09d1fe391935b75f798053f866ee5052', 'Jennifer', 'Louise', '103 Davis Lane', ' Brendale', '4500', 'Australia', '753201738', '489459921', 'jen.L@talktalk.net', '', '2014-01-23 01:00:00', 'jenniferlouise.png', 'Y', 1, 'QLD'),
(19, 'd54dc8e24b12ba4805777d6b6eac977094b73962a15e04f227ec40eb6ec56432', 'michelle', '4d069acd30e4b0c6eb5e5f36c01d1482', 'Michelle', 'Turner', '29 Cascade Drive', ' Underwood', '4119', 'Australia', '770731334', '447789653', 'MTurner@optusnet.com.au', '', '2014-04-30 03:30:00', 'Michelle.jpg', 'Y', 1, 'QLD'),
(20, '9d26a3c61c0e2ce5c980ad8c7fff13c08cf898b6f3786930c73b68e3b88ad779', 'bennie', '002640cb549ba08ee90cd79aee89cce7', 'Ben', 'Hogan', '', '', '4510', 'Australia', '', '', 'ben1972@gmail.com', 'Male', '2014-02-02 17:30:00', 'Bennie.jpg', 'Y', 1, 'QLD'),
(21, '19612ae3ed04b7c224ba12db07be5ce0915eed3de351ccbf60508f948b476e5a', 'natasha', '15cec5205c9e34355287acbb4d096a08', 'Natasha', 'Smith', '56 Ascot Court', ' Bundall', '4217', 'Australia', '792811317', '415475042', 'NSmithy@tpg.com.au', '', '2014-02-18 09:15:00', 'Natasha.jpg', 'Y', 1, 'QLD'),
(22, '0fec1e61a67e7a0fd3623e0d9d656fc765462557c2a5f5933ee37b63d9864d80', 'court', 'a1dca222c170e3d2b5dd2557d5a57090', 'Courtney', 'Gonsalves', '24/145 Snipe St', ' Miami', '4220', 'Australia', '755490087', '454657581', 'gonsalves@iinet.net', '', '2014-02-12 18:00:00', 'Court.jpg', 'Y', 1, 'QLD'),
(23, '8a35fd6de1e692dfa8277c405f93bba34926176285c85a13634e54e051b576f3', 'jason', '09d1fe391935b75f798053f866ee5052', 'Jason', 'House', '2 Carberry St', ' Grange', '4051', 'Australia', '443881263', '', 'man_in_the_house@talktalk.net', '', '2014-03-17 13:00:00', 'jasonhouse.png', 'Y', 1, 'QLD'),
(24, 'd54dc8e24b12ba4805777d6b6eac977094b73962a15e04f227ec40eb6ec56432', 'tony', '4d069acd30e4b0c6eb5e5f36c01d1482', 'Tony', 'House', '', '', '4509', 'Australia', '417286753', '', 'tmat@gmail.com', '', '2014-03-20 20:00:00', 'Tony.jpg', 'Y', 1, 'QLD'),
(26, '19612ae3ed04b7c224ba12db07be5ce0915eed3de351ccbf60508f948b476e5a', 'julia', '15cec5205c9e34355287acbb4d096a08', 'Julia', 'Hammar', '76 Ontario Crescent', ' Parkinson', '4115', 'Australia', '739772748', '402324857', 'julia.hammar@bigpond.com', '', '2014-04-02 02:30:00', 'Julia.jpg', 'Y', 1, 'QLD'),
(27, '0fec1e61a67e7a0fd3623e0d9d656fc765462557c2a5f5933ee37b63d9864d80', 'james', 'a1dca222c170e3d2b5dd2557d5a57090', 'James', 'Menon', '34 Taylor St', ' Windsor', '4030', 'Australia', '739217545', '402952335', 'jamie.menon@gmail.com', '', '2014-01-13 16:00:00', 'James.jpg', 'Y', 1, 'QLD');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `content` text NOT NULL,
  `adminID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `rating` int(2) NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `fk_review_admin_idx` (`adminID`),
  KEY `fk_review_category1_idx` (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `title`, `categoryID`, `content`, `adminID`, `date`, `rating`, `image`) VALUES
(1, 'Minecraft', 2, 'Though it may look primitive at a glance, your options in Minecraft are limited only by your imagination. Cobbling together a first home out of dirt and stone feels great; building a castle with a moat, a dining hall, and a working underground rail system feels even greater. That sense of creative progression, coupled with the inherent danger of mining underground caverns full of monsters, makes Minecraft exciting, rewarding, and tense. It', 2, '2014-01-01 09:00:00', 5, 'minecraft.jpg'),
(2, 'Assassin''s Creed Liberation HD', 1, '<p>For a multitude of reasons, Aveline is the kind of character I think is awesome.</p>', 5, '2014-04-13 19:04:23', 3, 'assassinscreed.jpg'),
(3, 'Ravensword: Shadowlands', 3, '<p>The best-case scenario for Ravensword: Shadowlands might be to consider it as a budget RPG suitable primarily for people who cannot play better RPGs, because of stuff.</p>', 4, '2014-04-13 19:13:01', 3, 'ravensword.jpg'),
(4, 'Grand Theft Auto: San Andreas', 4, 'Rockstar has gone to great lengths to ensure that GTA: San Andreas supports updated textures, draw distances, and lighting that live up to the potential of Retina displays, but many elements such as character models and mission structures can''t help but show their age. Still, this mobile port''s every bit as fun as playing the original if you have the gamepad to support it, but the touchscreen control, while competent are not the best way to play. At seven bucks for some of the most memorable gaming content of the last decade, though, it''s probably a risk worth taking.', 2, '2014-01-13 14:00:00', 4, 'grandtheftauto.jpg'),
(5, 'Titanfall', 6, '<p><span style="color: #252525; font-family: sans-serif;"><span style="font-size: 14px; line-height: 22.399999618530273px;">Titanfall is a 2014 first-person shooter, online multiplayer video game developed by Respawn Entertainment and published by Electronic Arts exclusively for Microsoft Windows, Xbox 360, and Xbox One. Titanfall was highly anticipated for its pedigree as the debut game from Respawn, a company formed by two of Infinity Ward''s co-founders who helped create the successful Call of Duty franchise. The game received a great deal of publicity leading up to its release on March 11, 2014.</span></span></p>', 1, '2014-04-23 13:38:34', 1, '6584_titanfall.png'),
(6, 'Angry Birds Star Wars 2', 8, '<p>Angry Birds Star Wars II is a puzzle video game, a crossover between Star Wars and the Angry Birds series, that was released on September 18, 2013.[1] The game is the seventh Angry Birds game developed by Rovio Entertainment. The game is a sequel to Angry Birds Star Wars and is based on the Star Wars prequel trilogy.[</p>', 1, '2014-04-23 14:06:05', 2, '5260_angrybirds.png'),
(7, 'South Park the Stick of Truth', 3, '<p>The stick of truth was funny yay!</p>', 1, '2014-04-23 13:24:23', 5, '7956_southpark.png'),
(8, 'Dark Souls 2', 7, '<p>Dark Souls II is an action role-playing video game set in an open world environment. Dark Souls II was developed for Microsoft Windows, PlayStation 3 and Xbox 360 by From Software. From Software published the game in Japan, while Namco Bandai Games published the game in other regions.</p>', 4, '2014-04-23 13:43:18', 5, '9596_darksouls2.png'),
(9, 'GTA V', 1, '<p>Grand Theft Auto V is an open world, action-adventure video game developed by Rockstar North and published by Rockstar Games. It was released on 17 September 2013 for the PlayStation 3 and Xbox 360. The game is the first main entry in the Grand Theft Auto series since Grand Theft Auto IV was released in 2008. Set within the fictional state of San Andreas, based on Southern California, the game''s single-player story follows three criminals and their efforts to perform a number of heists while under pressure from a government agency. The game''s use of open world design lets players freely roam San Andreas, which includes open countryside and the fictional city of Los Santos, based on Los Angeles.</p>', 4, '2014-04-23 14:00:28', 5, '3371_gtav.png'),
(10, 'Farcry 3', 1, '<p>Far Cry 3 is an open world first-person shooter video game developed mainly by Ubisoft Montreal in conjunction with Ubisoft Massive, Ubisoft Red Storm, Ubisoft Shanghai and Ubisoft Reflections, published by Ubisoft for Microsoft Windows, Xbox 360 and PlayStation 3. The game was released on November 29, 2012 in Australia, November 30 in Europe, and December 4 in North America. A stand-alone expansion titled Far Cry 3: Blood Dragon was released on April 30, 2013.Far Cry 3 is an open world first-person shooter video game developed mainly by Ubisoft Montreal in conjunction with Ubisoft Massive, Ubisoft Red Storm, Ubisoft Shanghai and Ubisoft Reflections, published by Ubisoft for Microsoft Windows, Xbox 360 and PlayStation 3. The game was released on November 29, 2012 in Australia, November 30 in Europe, and December 4 in North America. A stand-alone expansion titled Far Cry 3: Blood Dragon was released on April 30, 2013.</p>', 2, '2014-04-23 14:02:48', 4, '9083_farcry3.png'),
(11, 'Battlefield 4', 3, '<p>Battlefield 4 is a first-person shooter video game developed by Swedish video game developer EA Digital Illusions CE (DICE) and published by Electronic Arts. It is a sequel to 2011''s Battlefield 3. It was released on October 29, 2013 in North America, October 31, 2013 in Australia, November 1, 2013 in Europe and New Zealand and November 7, 2013 in Japan for Microsoft Windows, PlayStation 3, PlayStation 4, Xbox 360 and Xbox One.</p>\r\n<p>Battlefield 4 received positive critical response from reviewers and was a commercial success, praised for its multiplayer mode, gameplay and graphics. In contrast, the game''s single-player campaign was highly criticised by critics for being short and shallow, as well as glitches and bugs upon the game''s release.</p>', 4, '2014-04-23 14:08:33', 3, '8926_battlefield4.png'),
(12, 'Assassin''s Creed Black Flag', 7, '<p>Assassin''s Creed IV: Black Flag is a 2013 historical action-adventure open world video game developed by Ubisoft Montreal and published by Ubisoft. It was released for the PlayStation 3, Xbox 360 and Wii U in October 2013 and for the PlayStation 4, Windows and Xbox One in November 2013.</p>\r\n<p>It is the sixth major installment in the Assassin''s Creed series, a sequel to 2012''s Assassin''s Creed III''s modern story and a prequel to its historical storyline. The story is set in the early 18th century Caribbean during the Golden Age of Piracy, and follows notorious pirate Edward Kenway, grandfather of Assassin''s Creed III protagonist Ratonhnhak&eacute;:ton, who stumbles upon the conflict waged by the Assassins and Templars. Unlike previous games, gameplay elements focus more on ship-based exploration in the open world map, while also retaining the series'' third-person land-based exploration, melee combat, and stealth system. Multiplayer also returns, albeit with only land-based modes and settings.</p>\r\n<p>Assassin''s Creed IV: Black Flag received positive reviews, with critics praising the open world gameplay, side-quests, graphics and naval combat. The story received a mixed response, while criticism fell on aspects of the story missions which were considered repetitive. The game received several awards and nominations, including winning the Spike VGX 2013 award for Best Action Adventure Game.</p>', 2, '2014-04-23 14:12:14', 3, '8103_blackflag.png'),
(13, 'Limbo', 4, '<p>Limbo (stylized as LIMBO) is a puzzle-platform video game, the first title by independent Danish game developer Playdead. The game was released in July 2010 as a platform exclusive title on Xbox Live Arcade, and was later re-released as part of a retail game pack along with Trials HD and ''Splosion Man in April 2011. Ports of the game to the PlayStation 3 and Microsoft Windows were created by Playdead, released after the year-long Xbox 360 exclusivity period was completed. An OS X version was released in December 2011, while a Linux port was available in May 2012. Ports for PlayStation Vita and iOS were released in June and July 2013, respectively.</p>', 5, '2014-04-23 14:15:26', 5, '2909_limbo.png'),
(14, 'Kavinsky', 8, '<p>&nbsp;''Outrun'' album producer Kavinsky introduces the first ever video game based on a record. Defeat foul villains and shady night creatures as you wander in the mean streets of Downtown LA. Your favorite Kavinsky records provide the soundtrack for your ride.</p>\r\n<p>Mighty martial arts moves, deadly weapons, and the perfect soundtrack are just a click away! Grab it so you can take Kavinsky, his story, and his dreaded foes with you anywhere you go.</p>\r\n<p>It&rsquo;s music history in a video game, now available on all portable platforms and devices.</p>', 5, '2014-04-23 14:19:06', 3, '5371_kavinsky.png'),
(15, 'Forza 5', 6, '<p>Forza Motorsport 5 is a racing video game developed by Turn 10 Studios and published by Microsoft Studios for the Xbox One video game console.[1] The game was released on November 22, 2013 as launch title. The game was revealed on May 21, 2013 during the Xbox One reveal event with a teaser trailer that showed an orange McLaren P1 racing against a silver McLaren F1.[2] On August 15, 2013, the "Limited Edition" of the game was announced, and will include multiple car packs and a VIP membership for the game. It features Jeremy Clarkson, James May, and Richard Hammond from Top Gear for the game''s commentary when choosing a new event, championship, or league. It is the fifth installment in the Forza Motorsport series.</p>', 2, '2014-04-23 14:22:37', 2, '4844_forza5.png'),
(16, 'Yoshi''s New Island', 10, '<p>After the events of Super Mario World 2: Yoshi''s Island, the couple to whom the Stork gave Baby Mario and Baby Luigi allege that the brothers are not their babies. It goes on searching for the real parents, when it finds Kamek wanting to steal the babies once more. Again, he proceeds to take only Baby Luigi away, and Baby Mario falls on the nearby Egg Island. He is found by a group of Yoshis who decide to take him to his brother and defeat Baby Bowser, since he is planning to turn Egg Island into his vacation home.</p>\r\n<p>After defeating both Baby Bowser and his older self, Egg Island is saved, and Baby Luigi is rescued. The Stork proceeds to take the brothers to fulfill his job of sending them to the correct parents. After the Stork gets there, this couple confirm that Mario and Luigi are indeed their children. After this, Mr. Pipe is seen; it reveals its true identity and vanishes.</p>', 1, '2014-04-24 15:06:37', 3, '699_2609125-0671411247-yoshi.jpg'),
(17, 'Uncharted: Golden Abyss', 11, '<p>The story is set some time before the events of Uncharted: Drake''s Fortune, and begins in medias res with Nathan Drake following rival explorer Jason Dante through a temple complex in Panama. Dante has ordered his army of mercenaries to kill Drake on sight, and after a series of gunfights, the platform Drake is climbing is hit by an RPG.</p>\r\n<p>The game then flashes back two weeks, when Drake and Dante, revealed to be old friends, arrive at a dig site in Panama headed by Dante''s "partner" Marisa Chase, who doesn''t trust him. At the site, they find corpses of Spanish conquistadors that were apparently poisoned and a grave marker with a Visigoth symbol. Chase also shows Drake an amulet that she hid from Dante. The dig is then interrupted by Dante''s real partner, warlord Roberto Guerro. Guerro captures Drake and Chase, however they escape Guerro''s base after Chase starts a diversionary fire.</p>\r\n<p>They then go to the house of her grandfather Vincent Perez, who found the amulet at the site. Perez hired Dante to conduct further research after being diagnosed with terminal cancer, and Dante paid off Guerro for access to the site in return for a share of the treasure that Guerro will use to fund his conflict. Chase arrived at the site herself hoping to finish Perez'' work. Upon returning to Perez'' study, they learn that the marker referred to the Sete Cidades, an ancient Christian sect dedicated to finding the seven cities of gold. Friar Marcos de Niza, a member of the sect, had led Coronado''s expedition to find C&iacute;bola only to find the villages of the Zuni.</p>', 2, '2014-04-24 15:14:26', 2, 'uncharted.png'),
(18, 'Far Cry 3: Blood Dragon', 1, '<p>Far Cry 3: Blood Dragon is set in a dystopian 2007. Players control a ''Mark IV Cyber Commando'' named Sergeant Rex Power Colt (voiced by Michael Biehn). Ubisoft describes the game as "an 80s VHS vision of the future" where the player must "get the girl, kill the bad guys, and save the world". The game''s villain is Colonel Sloan, who commands the Omega Force, a cyborg army.</p>\r\n<p>Blood Dragon is a stand-alone expansion of Far Cry 3, meaning players do not need the original copy of Far Cry 3 to play Far Cry 3: Blood Dragon. Gameplay, though akin to Far Cry 3, using the same engine and general mechanics, is streamlined to provide a more linear experience. The skill tree, instead of a chosen path down three "ways of the animal", is replaced with a simpler leveling system that automatically unlocks benefits. The crafting is removed completely.</p>\r\n<p>The gameplay is open world, first-person shooter, with the same vehicles from Far Cry 3. The player will find themselves using high powered explosives, heavily modified firearms, and a large knife in order to kill their way through the main missions. Side missions involve liberating garrisons, killing rare animals, and saving Nerds. Stealth is rewarded with extra Cyber Points, the equivalent of Experience Points. The game also includes a plethora of hidden collectibles which, when found, unlock helpful rewards to assist with play.</p>', 1, '2014-04-25 12:34:13', 5, '6162_far-cry-3-blood-dragon-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `themeID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier',
  `name` varchar(40) NOT NULL COMMENT 'Name of theme',
  `Description` text NOT NULL COMMENT 'Brief description of theme',
  `stylesheet` varchar(40) NOT NULL COMMENT 'The CSS stylesheet file name for the theme',
  `Image` varchar(200) NOT NULL COMMENT 'Image of theme',
  PRIMARY KEY (`themeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`themeID`, `name`, `Description`, `stylesheet`, `Image`) VALUES
(1, 'Default', 'The default GameOn theme', 'default.css', 'default_theme.png'),
(2, 'Flat', 'A flat colour theme for GameOn', 'flat.css', 'flat_theme.png');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `typeID` tinyint(1) NOT NULL COMMENT 'Unique identifier',
  `type` varchar(20) NOT NULL COMMENT 'Type of account  (0 = admin  account or 1 =  member account)',
  PRIMARY KEY (`typeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_member1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_review1` FOREIGN KEY (`reviewID`) REFERENCES `review` (`reviewID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_admin` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_category1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `type_ibfk_1` FOREIGN KEY (`typeID`) REFERENCES `admin` (`type`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
