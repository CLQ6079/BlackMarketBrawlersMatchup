/**********************************************/
/*        lolelf data analysiss SQL           */
/*     Copyright © 2015 by Guangyu Liu        */
/*     Copyright © 2015 by Xiangqiang Li      */
/**********************************************/


-- ----------------------------------------------
-- Champions info
-- ----------------------------------------------

--
-- For each champion, get totalGames, wins, KDA
--
SELECT championId, ROUND(sum(fb) * 100/sum(matches),2) as FB, ROUND(sum(damage)/sum(kills)) as ks,
	ROUND(sum(cc)/sum(matches)) as cc, sum(matches) as matches
FROM
(
	(
		SELECT p1.championId as championId, sum(ps1.firstBloodKill) as fb, sum(ps1.kills) as kills, 
			sum(ps1.totalDamageDealtToChampions) as damage, 
			sum(ps1.totalTimeCrowdControlDealt) as cc,
			count(p1.reference_id) as matches
		FROM lolelf_br.Participant p1 JOIN lolelf_br.ParticipantStats ps1 ON p1.id = ps1.reference_id
		GROUP BY p1.championId
	)
	UNION ALL 
	(
		SELECT p1.championId as championId, sum(ps1.firstBloodKill) as fb, sum(ps1.kills) as kills, 
			sum(ps1.totalDamageDealtToChampions) as damage, 
			sum(ps1.totalTimeCrowdControlDealt) as cc,
			count(p1.reference_id) as matches
		FROM lolelf_kr.Participant p1 JOIN lolelf_kr.ParticipantStats ps1 ON p1.id = ps1.reference_id
		GROUP BY p1.championId
	)
	UNION ALL 
	(
		SELECT p1.championId as championId, sum(ps1.firstBloodKill) as fb, sum(ps1.kills) as kills, 
			sum(ps1.totalDamageDealtToChampions) as damage, 
			sum(ps1.totalTimeCrowdControlDealt) as cc,
			count(p1.reference_id) as matches
		FROM lolelf_las.Participant p1 JOIN lolelf_las.ParticipantStats ps1 ON p1.id = ps1.reference_id
		GROUP BY p1.championId
	)
	UNION ALL 
	(
		SELECT p1.championId as championId, sum(ps1.firstBloodKill) as fb, sum(ps1.kills) as kills, 
			sum(ps1.totalDamageDealtToChampions) as damage, 
			sum(ps1.totalTimeCrowdControlDealt) as cc,
			count(p1.reference_id) as matches
		FROM lolelf_tr.Participant p1 JOIN lolelf_br.ParticipantStats ps1 ON p1.id = ps1.reference_id
		GROUP BY p1.championId
	)
	UNION ALL 
	(
		SELECT p1.championId as championId, sum(ps1.firstBloodKill) as fb, sum(ps1.kills) as kills, 
			sum(ps1.totalDamageDealtToChampions) as damage, 
			sum(ps1.totalTimeCrowdControlDealt) as cc,
			count(p1.reference_id) as matches
		FROM lolelf_eune.Participant p1 JOIN lolelf_eune.ParticipantStats ps1 ON p1.id = ps1.reference_id
		GROUP BY p1.championId
	) 
)as a
GROUP BY championId
ORDER BY championId;

--
-- For each champion, get banned times
--
SELECT count(*) FROM BannedChampion
GROUP BY championId;

--
-- For each champion, get lane positions
--
SELECT championId, lane, IFNULL(temp1.CNT, 0)
FROM lolelf_br.static_ChampionDto c1 LEFT JOIN 
(
	SELECT p1.championId, pt1.lane, count(*) AS CNT
	FROM Participant p1 LEFT JOIN ParticipantTimeline pt1 ON pt1.reference_id = p1.id
	GROUP BY p1.championId, pt1.lane
	
) AS temp1 ON c1.id=temp1.championId
WHERE id != 41
ORDER BY lane, championId;


-- ----------------------------------------------
-- Matchup info
-- ----------------------------------------------
SELECT p1.championId, p2.ChampionId, count(p1.reference_id) AS Matches, sum(ps1.winner) AS wins, sum(ps1.kills) AS Kills, sum(ps1.deaths) AS Deaths,
	sum(ps1.goldEarned) AS Golds, sum(ps1.minionsKilled) AS CS, sum(ps1.firstBloodKill) AS FB
FROM Participant p1 JOIN Participant p2 ON p1.reference_Id = p2.reference_Id
	 JOIN ParticipantStats ps1 ON p1.id = ps1.reference_id
WHERE p1.teamId != p2.teamId
GROUP BY p1.championId, p2.championId
LIMIT 20000;

SELECT *
FROM   tempView s
WHERE 
        (
            SELECT  COUNT(*) 
            FROM    tempView  f
            WHERE f.p1Id = s.p1Id AND 
                  f.wins > s.wins
        ) <= 3;

#count top3 partners based on winRate where matches > 20
set @num := 0, @type := '';
select p1Id, p2Id, totalmatches, winrate
from (
  select p1Id, p2Id, totalmatches, winrate,
      @num := if(@type = p1Id, @num + 1, 1) as row_number,
      @type := p1Id as dummy
  from toppartners
  where totalmatches > 20 	
) as x where x.row_number <= 3;

ALTER VIEW tempView AS
SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
	sum(ps1.winner)/count(distinct p1.reference_id) AS wins
FROM Participant p1 JOIN Participant p2 ON p1.reference_Id = p2.reference_Id
	 JOIN ParticipantStats ps1 ON p1.id = ps1.reference_id
WHERE p1.teamId = p2.teamId AND p1.championId != p2.championId
GROUP BY p1.championId, p2.championId
ORDER BY p1Id, wins DESC;

set @num := 0, @type := '';
select p1Id, p2Id, totalmatches, loserate
from (
  select p1Id, p2Id, totalmatches, loserate,
      @num := if(@type = p1Id, @num + 1, 1) as row_number,
      @type := p1Id as dummy
  from topanemy
  where totalmatches > 20 and p1Id != p2Id
) as x where x.row_number <= 3;

CREATE VIEW topAnemyView AS
SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
	(count(distinct p1.reference_id) - sum(ps1.winner))/count(distinct p1.reference_id) AS loserate
FROM Participant p1 JOIN Participant p2 ON p1.reference_Id = p2.reference_Id
	 JOIN ParticipantStats ps1 ON p1.id = ps1.reference_id
WHERE p1.teamId != p2.teamId
GROUP BY p1.championId, p2.championId
ORDER BY p1Id, loserate DESC;


ALTER VIEW lolelf_br.topAnemyView AS
SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
FROM lolelf_br.Participant p1 JOIN lolelf_br.Participant p2 ON p1.reference_Id = p2.reference_Id
	 JOIN lolelf_br.ParticipantStats ps1 ON p1.id = ps1.reference_id
WHERE p1.teamId != p2.teamId
GROUP BY p1.championId, p2.championId
ORDER BY p1Id, wins DESC;

ALTER VIEW lolelf_kr.topAnemyView AS
SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
	sum(ps1.winner) AS wins
FROM lolelf_kr.Participant p1 JOIN lolelf_kr.Participant p2 ON p1.reference_Id = p2.reference_Id
	 JOIN lolelf_kr.ParticipantStats ps1 ON p1.id = ps1.reference_id
WHERE p1.teamId != p2.teamId
GROUP BY p1.championId, p2.championId
ORDER BY p1Id, wins DESC;

CREATE VIEW lolelf_eune.topAnemyView AS
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_eune.Participant p1 JOIN lolelf_eune.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_eune.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC;

CREATE VIEW lolelf_tr.topAnemyView AS
SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_tr.Participant p1 JOIN lolelf_tr.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_tr.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC;

CREATE VIEW lolelf_las.topAnemyView AS
SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_las.Participant p1 JOIN lolelf_las.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_las.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC;

DROP table topAnemy;
CREATE TEMPORARY TABLE IF NOT EXISTS topAnemy AS (
SELECT p1Id, p2Id, sum(matches) AS totalMatches, (sum(matches) - sum(wins)) / sum(matches) AS loseRate
FROM
(
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_br.Participant p1 JOIN lolelf_br.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_br.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_kr.Participant p1 JOIN lolelf_kr.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_kr.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_eune.Participant p1 JOIN lolelf_eune.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_eune.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_tr.Participant p1 JOIN lolelf_tr.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_tr.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_las.Participant p1 JOIN lolelf_las.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_las.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
) a
GROUP BY p1Id, p2Id
ORDER BY p1Id ASC, loseRate DESC
LIMIT 20000);

drop table topPartners;
CREATE TEMPORARY table topPartners AS
SELECT p1Id, p2Id, sum(matches) AS totalMatches, sum(wins) / sum(matches) AS winRate
FROM
(
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_br.Participant p1 JOIN lolelf_br.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_br.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId = p2.teamId AND p1.championId != p2.championId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_kr.Participant p1 JOIN lolelf_kr.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_kr.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId = p2.teamId AND p1.championId != p2.championId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_eune.Participant p1 JOIN lolelf_eune.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_eune.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId = p2.teamId AND p1.championId != p2.championId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_tr.Participant p1 JOIN lolelf_tr.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_tr.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId = p2.teamId AND p1.championId != p2.championId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId AS p1Id, p2.championId AS p2Id, count(distinct p1.reference_id) AS matches,
			sum(ps1.winner) AS wins
		FROM lolelf_las.Participant p1 JOIN lolelf_las.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_las.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId = p2.teamId AND p1.championId != p2.championId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
) a
GROUP BY p1Id, p2Id
ORDER BY p1Id, winrate DESC
LIMIT 20000;

DROP TABLE laneAnalysis;
CREATE TEMPORARY TABLE IF NOT EXISTS laneAnalysis AS (
SELECT p1Id, p2Id, sum(Matches) AS Matches, sum(wins) AS wins, sum(kills) AS kills,
	sum(deaths) AS deaths, sum(assists) AS assists,sum(Golds) as golds, sum(CS) AS cs, sum(FB) as FB
FROM
(
	(
		SELECT p1.championId AS p1Id, p2.ChampionId AS p2Id, count(p1.reference_id) AS Matches, sum(ps1.winner) AS wins, sum(ps1.kills) AS Kills, sum(ps1.deaths) AS Deaths,
			sum(ps1.assists) AS assists,sum(ps1.goldEarned) AS Golds, sum(ps1.minionsKilled) AS CS, sum(ps1.firstBloodKill) AS FB
		FROM lolelf_br.Participant p1 JOIN lolelf_br.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_br.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId, p2.ChampionId, count(p1.reference_id) AS Matches, sum(ps1.winner) AS wins, sum(ps1.kills) AS Kills, sum(ps1.deaths) AS Deaths,
			sum(ps1.assists) AS assists,sum(ps1.goldEarned) AS Golds, sum(ps1.minionsKilled) AS CS, sum(ps1.firstBloodKill) AS FB
		FROM lolelf_kr.Participant p1 JOIN lolelf_kr.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_kr.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId, p2.ChampionId, count(p1.reference_id) AS Matches, sum(ps1.winner) AS wins, sum(ps1.kills) AS Kills, sum(ps1.deaths) AS Deaths,
			sum(ps1.assists) AS assists,sum(ps1.goldEarned) AS Golds, sum(ps1.minionsKilled) AS CS, sum(ps1.firstBloodKill) AS FB
		FROM lolelf_eune.Participant p1 JOIN lolelf_eune.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_eune.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId, p2.ChampionId, count(p1.reference_id) AS Matches, sum(ps1.winner) AS wins, sum(ps1.kills) AS Kills, sum(ps1.deaths) AS Deaths,
			sum(ps1.assists) AS assists,sum(ps1.goldEarned) AS Golds, sum(ps1.minionsKilled) AS CS, sum(ps1.firstBloodKill) AS FB
		FROM lolelf_tr.Participant p1 JOIN lolelf_tr.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_tr.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
	UNION ALL
	(
		SELECT p1.championId, p2.ChampionId, count(p1.reference_id) AS Matches, sum(ps1.winner) AS wins, sum(ps1.kills) AS Kills, sum(ps1.deaths) AS Deaths,
			sum(ps1.assists) AS assists,sum(ps1.goldEarned) AS Golds, sum(ps1.minionsKilled) AS CS, sum(ps1.firstBloodKill) AS FB
		FROM lolelf_las.Participant p1 JOIN lolelf_las.Participant p2 ON p1.reference_Id = p2.reference_Id
			 JOIN lolelf_las.ParticipantStats ps1 ON p1.id = ps1.reference_id
		WHERE p1.teamId != p2.teamId
		GROUP BY p1.championId, p2.championId
		ORDER BY p1Id, wins DESC
	)
) a
GROUP BY p1Id, p2Id
ORDER BY p1Id, p2Id
LIMIT 20000);

SELECT p1Id, p2Id, ROUND(wins*100/matches, 1) AS winRate, ROUND(kills/matches, 1) AS kills, 
	ROUND(deaths/matches, 1) AS deaths, ROUND(assists/matches) as assists, ROUND(golds/matches) AS golds,
	ROUND(cs/matches) AS cs, ROUND(FB*100/matches) AS fb,
	c1.key, c2.key from laneAnalysis la1 join lolelf_br.static_ChampionDto c1 on la1.p1Id = c1.id
	Join lolelf_br.static_ChampionDto c2 on la1.p2Id = c2.id
LIMIT 20000;


