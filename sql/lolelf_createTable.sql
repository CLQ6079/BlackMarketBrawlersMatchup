/**********************************************/
/*       lolelf Table Generation SQL          */
/*     Copyright © 2015 by Guangyu Liu        */
/*     Copyright © 2015 by Xiangqiang Li      */
/**********************************************/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Database: This script assumes you have a database
--           already set up.
--

-- --------------------------------------------------------

--
-- Table structure for table `BannedChampion`
--

CREATE TABLE IF NOT EXISTS `BannedChampion` (
  `championId` int(11) DEFAULT NULL,
  `pickTurn` int(11) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Champions`
--

CREATE TABLE IF NOT EXISTS `Champions` (
  `active` tinyint(1) NOT NULL,
  `botEnabled` tinyint(1) NOT NULL,
  `botMmEnabled` tinyint(1) NOT NULL,
  `freeToPlay` tinyint(1) NOT NULL,
  `id` bigint(20) NOT NULL,
  `rankedPlayEnabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='v1.2';

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `ascendedType` text,
  `assistingParticipantIds` text,
  `buildingType` text,
  `creatorId` int(11) DEFAULT NULL,
  `eventType` text,
  `itemAfter` int(11) DEFAULT NULL,
  `itemBefore` int(11) DEFAULT NULL,
  `itemId` int(11) DEFAULT NULL,
  `killerId` int(11) DEFAULT NULL,
  `laneType` text,
  `levelUpType` text,
  `monsterType` text,
  `participantId` int(11) DEFAULT NULL,
  `pointCaptured` text,
  `skillSlot` int(11) DEFAULT NULL,
  `teamId` int(11) DEFAULT NULL,
  `timestamp` bigint(20) DEFAULT NULL,
  `towerType` text,
  `victimId` int(11) DEFAULT NULL,
  `wardType` text,
`id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Frame`
--

CREATE TABLE IF NOT EXISTS `Frame` (
  `participantFrames` text,
  `timestamp` bigint(20) DEFAULT NULL,
`id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map_details`
--

CREATE TABLE IF NOT EXISTS `map_details` (
  `mapId` bigint(32) NOT NULL,
  `mapName` varchar(50) DEFAULT NULL,
  `unpurchasableItemList` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mastery`
--

CREATE TABLE IF NOT EXISTS `mastery` (
  `id` int(16) NOT NULL,
  `description` text NOT NULL,
  `masteryTree` varchar(500) NOT NULL,
  `name` varchar(100) NOT NULL,
  `prereq` varchar(100) NOT NULL,
  `ranks` int(16) NOT NULL,
  `sanitizedDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MatchDetail`
--

CREATE TABLE IF NOT EXISTS `MatchDetail` (
  `mapId` bigint(20) DEFAULT NULL,
  `matchCreation` bigint(20) DEFAULT NULL,
  `matchDuration` bigint(20) DEFAULT NULL,
  `matchId` bigint(20) NOT NULL DEFAULT '0',
  `matchMode` text,
  `matchType` text,
  `matchVersion` text,
  `platformId` text,
  `queueType` text,
  `region` text,
  `season` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `match_mastery`
--

CREATE TABLE IF NOT EXISTS `match_mastery` (
  `masteryId` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `match_rune`
--

CREATE TABLE IF NOT EXISTS `match_rune` (
  `rank` bigint(20) DEFAULT NULL,
  `runeId` bigint(20) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Participant`
--

CREATE TABLE IF NOT EXISTS `Participant` (
  `championId` int(11) DEFAULT NULL,
  `highestAchievedSeasonTier` text,
  `participantId` int(11) DEFAULT NULL,
  `spell1Id` int(11) DEFAULT NULL,
  `spell2Id` int(11) DEFAULT NULL,
  `teamId` int(11) DEFAULT NULL,
`id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantIdentity`
--

CREATE TABLE IF NOT EXISTS `ParticipantIdentity` (
  `participantId` int(11) DEFAULT NULL,
`id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantStats`
--

CREATE TABLE IF NOT EXISTS `ParticipantStats` (
  `assists` bigint(20) DEFAULT NULL,
  `champLevel` bigint(20) DEFAULT NULL,
  `combatPlayerScore` bigint(20) DEFAULT NULL,
  `deaths` bigint(20) DEFAULT NULL,
  `doubleKills` bigint(20) DEFAULT NULL,
  `firstBloodAssist` tinyint(1) DEFAULT NULL,
  `firstBloodKill` tinyint(1) DEFAULT NULL,
  `firstInhibitorAssist` tinyint(1) DEFAULT NULL,
  `firstInhibitorKill` tinyint(1) DEFAULT NULL,
  `firstTowerAssist` tinyint(1) DEFAULT NULL,
  `firstTowerKill` tinyint(1) DEFAULT NULL,
  `goldEarned` bigint(20) DEFAULT NULL,
  `goldSpent` bigint(20) DEFAULT NULL,
  `inhibitorKills` bigint(20) DEFAULT NULL,
  `item0` bigint(20) DEFAULT NULL,
  `item1` bigint(20) DEFAULT NULL,
  `item2` bigint(20) DEFAULT NULL,
  `item3` bigint(20) DEFAULT NULL,
  `item4` bigint(20) DEFAULT NULL,
  `item5` bigint(20) DEFAULT NULL,
  `item6` bigint(20) DEFAULT NULL,
  `killingSprees` bigint(20) DEFAULT NULL,
  `kills` bigint(20) DEFAULT NULL,
  `largestCriticalStrike` bigint(20) DEFAULT NULL,
  `largestKillingSpree` bigint(20) DEFAULT NULL,
  `largestMultiKill` bigint(20) DEFAULT NULL,
  `magicDamageDealt` bigint(20) DEFAULT NULL,
  `magicDamageDealtToChampions` bigint(20) DEFAULT NULL,
  `magicDamageTaken` bigint(20) DEFAULT NULL,
  `minionsKilled` bigint(20) DEFAULT NULL,
  `neutralMinionsKilled` bigint(20) DEFAULT NULL,
  `neutralMinionsKilledEnemyJungle` bigint(20) DEFAULT NULL,
  `neutralMinionsKilledTeamJungle` bigint(20) DEFAULT NULL,
  `nodeCapture` bigint(20) DEFAULT NULL,
  `nodeCaptureAssist` bigint(20) DEFAULT NULL,
  `nodeNeutralize` bigint(20) DEFAULT NULL,
  `nodeNeutralizeAssist` bigint(20) DEFAULT NULL,
  `objectivePlayerScore` bigint(20) DEFAULT NULL,
  `pentaKills` bigint(20) DEFAULT NULL,
  `physicalDamageDealt` bigint(20) DEFAULT NULL,
  `physicalDamageDealtToChampions` bigint(20) DEFAULT NULL,
  `physicalDamageTaken` bigint(20) DEFAULT NULL,
  `quadraKills` bigint(20) DEFAULT NULL,
  `sightWardsBoughtInGame` bigint(20) DEFAULT NULL,
  `teamObjective` bigint(20) DEFAULT NULL,
  `totalDamageDealt` bigint(20) DEFAULT NULL,
  `totalDamageDealtToChampions` bigint(20) DEFAULT NULL,
  `totalDamageTaken` bigint(20) DEFAULT NULL,
  `totalHeal` bigint(20) DEFAULT NULL,
  `totalPlayerScore` bigint(20) DEFAULT NULL,
  `totalScoreRank` bigint(20) DEFAULT NULL,
  `totalTimeCrowdControlDealt` bigint(20) DEFAULT NULL,
  `totalUnitsHealed` bigint(20) DEFAULT NULL,
  `towerKills` bigint(20) DEFAULT NULL,
  `tripleKills` bigint(20) DEFAULT NULL,
  `trueDamageDealt` bigint(20) DEFAULT NULL,
  `trueDamageDealtToChampions` bigint(20) DEFAULT NULL,
  `trueDamageTaken` bigint(20) DEFAULT NULL,
  `unrealKills` bigint(20) DEFAULT NULL,
  `visionWardsBoughtInGame` bigint(20) DEFAULT NULL,
  `wardsKilled` bigint(20) DEFAULT NULL,
  `wardsPlaced` bigint(20) DEFAULT NULL,
  `winner` tinyint(1) DEFAULT NULL,
`id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantTimeline`
--

CREATE TABLE IF NOT EXISTS `ParticipantTimeline` (
  `lane` text,
  `role` text,
`id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantTimelineData`
--

CREATE TABLE IF NOT EXISTS `ParticipantTimelineData` (
  `tenToTwenty` double DEFAULT NULL,
  `thirtyToEnd` double DEFAULT NULL,
  `twentyToThirty` double DEFAULT NULL,
  `zeroToTen` double DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Player`
--

CREATE TABLE IF NOT EXISTS `Player` (
  `matchHistoryUri` text,
  `profileIcon` int(11) DEFAULT NULL,
  `summonerId` bigint(20) DEFAULT NULL,
  `summonerName` text,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Position`
--

CREATE TABLE IF NOT EXISTS `Position` (
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_BlockDto`
--

CREATE TABLE IF NOT EXISTS `static_BlockDto` (
  `recMath` tinyint(1) DEFAULT NULL,
  `type` text,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_BlockItemDto`
--

CREATE TABLE IF NOT EXISTS `static_BlockItemDto` (
  `count` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `id` int(100) NOT NULL,
  `reference_id` int(12) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_ChampionDto`
--

CREATE TABLE IF NOT EXISTS `static_ChampionDto` (
  `allytips` text,
  `blurb` text,
  `enemytips` text,
  `id` int(11) NOT NULL,
  `key` text NOT NULL,
  `lore` text NOT NULL,
  `name` text NOT NULL,
  `partype` text NOT NULL,
  `tags` text,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_ChampionSpellDto`
--

CREATE TABLE IF NOT EXISTS `static_ChampionSpellDto` (
  `cooldown` text,
  `cooldownBurn` text,
  `cost` text,
  `costBurn` text,
  `costType` text,
  `description` text,
  `effect` text COMMENT 'This field is a List of List of Double.',
  `effectBurn` text,
  `key` text,
  `maxrank` int(11) DEFAULT NULL,
  `name` text,
  `range` text COMMENT 'This field is either a List of Integer or the String ''self'' for spells that target one''s own champion.',
  `rangeBurn` text,
  `resource` text,
  `sanitizedDescription` text,
  `sanitizedTooltip` text,
  `tooltip` text,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_ImageDto`
--

CREATE TABLE IF NOT EXISTS `static_ImageDto` (
  `full` text NOT NULL,
  `group` text NOT NULL,
  `h` int(11) NOT NULL,
  `sprite` text NOT NULL,
  `w` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_InfoDto`
--

CREATE TABLE IF NOT EXISTS `static_InfoDto` (
  `attack` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `magic` int(11) NOT NULL,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_LevelTipDto`
--

CREATE TABLE IF NOT EXISTS `static_LevelTipDto` (
  `effect` text NOT NULL,
  `label` text NOT NULL,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_PassiveDto`
--

CREATE TABLE IF NOT EXISTS `static_PassiveDto` (
  `description` text NOT NULL,
  `name` text NOT NULL,
  `sanitizedDescription` text NOT NULL,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_RecommendedDto`
--

CREATE TABLE IF NOT EXISTS `static_RecommendedDto` (
  `champion` text NOT NULL,
  `map` text NOT NULL,
  `mode` text NOT NULL,
  `priority` tinyint(1) DEFAULT NULL,
  `title` text NOT NULL,
  `type` text NOT NULL,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_SkinDto`
--

CREATE TABLE IF NOT EXISTS `static_SkinDto` (
  `name` text NOT NULL,
  `num` int(11) NOT NULL,
`id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_SpellVarsDto`
--

CREATE TABLE IF NOT EXISTS `static_SpellVarsDto` (
  `coeff` text,
  `dyn` text,
  `key` text,
  `link` text,
  `ranksWith` text,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_StatsDto`
--

CREATE TABLE IF NOT EXISTS `static_StatsDto` (
  `armor` double NOT NULL,
  `armorperlevel` double NOT NULL,
  `attackdamage` double NOT NULL,
  `attackdamageperlevel` double NOT NULL,
  `attackrange` double NOT NULL,
  `attackspeedoffset` double NOT NULL,
  `attackspeedperlevel` double NOT NULL,
  `crit` double NOT NULL,
  `critperlevel` double NOT NULL,
  `hp` double NOT NULL,
  `hpperlevel` double NOT NULL,
  `hpregen` double NOT NULL,
  `hpregenperlevel` double NOT NULL,
  `movespeed` double NOT NULL,
  `mp` double NOT NULL,
  `mpperlevel` double NOT NULL,
  `mpregen` double NOT NULL,
  `mpregenperlevel` double NOT NULL,
  `spellblock` double NOT NULL,
  `spellblockperlevel` double NOT NULL,
`id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Team`
--

CREATE TABLE IF NOT EXISTS `Team` (
  `baronKills` int(11) DEFAULT NULL,
  `dominionVictoryScore` bigint(20) DEFAULT NULL,
  `dragonKills` int(11) DEFAULT NULL,
  `firstBaron` tinyint(1) DEFAULT NULL,
  `firstBlood` tinyint(1) DEFAULT NULL,
  `firstDragon` tinyint(1) DEFAULT NULL,
  `firstInhibitor` tinyint(1) DEFAULT NULL,
  `firstTower` tinyint(1) DEFAULT NULL,
  `inhibitorKills` int(11) DEFAULT NULL,
  `teamId` int(11) DEFAULT NULL,
  `towerKills` int(11) DEFAULT NULL,
  `vilemawKills` int(11) DEFAULT NULL,
  `winner` tinyint(1) DEFAULT NULL,
`id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Timeline`
--

CREATE TABLE IF NOT EXISTS `Timeline` (
  `frameInterval` bigint(20) DEFAULT NULL,
`id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` int(11) DEFAULT NULL,
  `reference_field` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Champions`
--
ALTER TABLE `Champions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Frame`
--
ALTER TABLE `Frame`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastery`
--
ALTER TABLE `mastery`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MatchDetail`
--
ALTER TABLE `MatchDetail`
 ADD PRIMARY KEY (`matchId`);

--
-- Indexes for table `Participant`
--
ALTER TABLE `Participant`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ParticipantIdentity`
--
ALTER TABLE `ParticipantIdentity`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ParticipantStats`
--
ALTER TABLE `ParticipantStats`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ParticipantTimeline`
--
ALTER TABLE `ParticipantTimeline`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_BlockDto`
--
ALTER TABLE `static_BlockDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_ChampionDto`
--
ALTER TABLE `static_ChampionDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_ChampionSpellDto`
--
ALTER TABLE `static_ChampionSpellDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_ImageDto`
--
ALTER TABLE `static_ImageDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_InfoDto`
--
ALTER TABLE `static_InfoDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_LevelTipDto`
--
ALTER TABLE `static_LevelTipDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_PassiveDto`
--
ALTER TABLE `static_PassiveDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_RecommendedDto`
--
ALTER TABLE `static_RecommendedDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_SkinDto`
--
ALTER TABLE `static_SkinDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_SpellVarsDto`
--
ALTER TABLE `static_SpellVarsDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_StatsDto`
--
ALTER TABLE `static_StatsDto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Team`
--
ALTER TABLE `Team`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Timeline`
--
ALTER TABLE `Timeline`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Event`
--
ALTER TABLE `Event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Frame`
--
ALTER TABLE `Frame`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Participant`
--
ALTER TABLE `Participant`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ParticipantIdentity`
--
ALTER TABLE `ParticipantIdentity`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ParticipantStats`
--
ALTER TABLE `ParticipantStats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ParticipantTimeline`
--
ALTER TABLE `ParticipantTimeline`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_BlockDto`
--
ALTER TABLE `static_BlockDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_ChampionSpellDto`
--
ALTER TABLE `static_ChampionSpellDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_ImageDto`
--
ALTER TABLE `static_ImageDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_InfoDto`
--
ALTER TABLE `static_InfoDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_LevelTipDto`
--
ALTER TABLE `static_LevelTipDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_PassiveDto`
--
ALTER TABLE `static_PassiveDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_RecommendedDto`
--
ALTER TABLE `static_RecommendedDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_SkinDto`
--
ALTER TABLE `static_SkinDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_SpellVarsDto`
--
ALTER TABLE `static_SpellVarsDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `static_StatsDto`
--
ALTER TABLE `static_StatsDto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Team`
--
ALTER TABLE `Team`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Timeline`
--
ALTER TABLE `Timeline`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- INDEX for better query performance
-- 
CREATE INDEX participant_referenceId on lolelf_kr.Participant(reference_id);
CREATE INDEX participantTimeline_referenceId on lolelf_kr.ParticipantTimeline(reference_id);
CREATE INDEX Team_referenceId on lolelf_kr.Team(reference_id);
CREATE INDEX Participant_championId on lolelf_kr.Participant(championId);
CREATE INDEX ParticipantStats_referenceId on lolelf_kr.ParticipantStats(reference_id);