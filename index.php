<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/util/image.php');
?>
<!DOCTYPE html>

<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['table']}]}"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/champion.js"></script>
    <script src="js/matchup.js"></script>
    <script src="js/main.js"></script>
    <title>League of Legends - Black Market Brawlers Matchup</title>
</head>

<body>
    <div class="background">
        <div class="dot"></div>
        <img class="background-img" src="img/background.jpg" />
    </div>
    <h2 class="header">Black Market Brawlers Matchup</h2>
    <div class="main">
        <div class="champions">
            <?php
                print_champion_icons();
            ?>
        </div>
        <div class="instruction">Drag champion icons into champion slots, click slot to view champion, click sword to view matchup.</div>
        <img class="champion_slot" id="champion_slot0" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <div id="champion_stats">
            <div class="champion_stats_info">
                <h2 class="champion_stats_name"></h2>
                <h4 class="champion_stats_title"></h4>
            </div>
            <div class="champion_game_stats">
                <li class="champion_game_stats_item"></li>
                <li class="champion_game_stats_item"></li>
                <li class="champion_game_stats_item"></li>
                <li class="champion_game_stats_item"></li>
                <li class="champion_game_stats_item"></li>
            </div>
            <div class="top_partners">
                <span class="top_partners_title">Top partners</span>
                <br>
                <img class="champion_stats_image top_partners_img" />
                <img class="champion_stats_image top_partners_img" />
                <img class="champion_stats_image top_partners_img" />
            </div>
            <div class="top_enemies">
                <span class="top_enemies_title">Top enemies</span>
                <br>
                <img class="champion_stats_image top_enemies_img" />
                <img class="champion_stats_image top_enemies_img" />
                <img class="champion_stats_image top_enemies_img" />
            </div>
        </div>
        <img class="champion_slot" id="champion_slot1" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="champion_slot" id="champion_slot2" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="champion_slot" id="champion_slot3" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="champion_slot" id="champion_slot4" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="champion_slot" id="champion_slot5" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="champion_slot" id="champion_slot6" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="champion_slot" id="champion_slot7" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="champion_slot" id="champion_slot8" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="champion_slot" id="champion_slot9" src="img/champion_slot.png" title="Drag champion image to here, click to see champion info."/>
        <img class="matchup_slot" id="matchup_slot0" src="http://img2.wikia.nocookie.net/__cb20141225142418/dont-starve-game/images/b/bb/Icon_Fight.png" title="Drag champion image to lane, click here to see match up info." />
        <img class="matchup_slot" id="matchup_slot1" src="http://img2.wikia.nocookie.net/__cb20141225142418/dont-starve-game/images/b/bb/Icon_Fight.png" title="Drag champion image to lane, click here to see match up info." />
        <img class="matchup_slot" id="matchup_slot2" src="http://img2.wikia.nocookie.net/__cb20141225142418/dont-starve-game/images/b/bb/Icon_Fight.png" title="Drag champion image to lane, click here to see match up info." />
        <img class="matchup_slot" id="matchup_slot3" src="http://img2.wikia.nocookie.net/__cb20141225142418/dont-starve-game/images/b/bb/Icon_Fight.png" title="Drag champion image to lane, click here to see match up info." />
        <img src="img/map.png" class="main_img"/>
        <div class="champion_matchup_blur"></div>
        <div class="champion_matchup">
            <div class="champion_matchup_top">
                <div class="champion_matchup_champion_img_left_container" >
                </div>
                <img class="champion_matchup_champion_img_mid" src="http://ddragon.leagueoflegends.com/cdn/5.2.1/img/ui/score.png" />
                <div class="champion_matchup_champion_img_right_container">
                </div>
            </div>
            <div class="champion_matchup_chart">
                <div class="champion_matchup_chart_item_container">
                    <div class="champion_matchup_chart_item">
                        <span class="champion_matchup_chart_item_bar_left_container">
                            <span class="champion_matchup_chart_item_bar_left"></span>
                        </span>
                        <span class="champion_matchup_chart_item_mid">Win Rate</span>
                        <span class="champion_matchup_chart_item_bar_right_container">
                            <span class="champion_matchup_chart_item_bar_right"></span>
                        </span>
                    </div>
                </div>
                <div class="champion_matchup_chart_item_container">
                    <div class="champion_matchup_chart_item">
                        <span class="champion_matchup_chart_item_bar_left_container">
                            <span class="champion_matchup_chart_item_bar_left"></span>
                        </span>
                        <span class="champion_matchup_chart_item_mid">Kill</span>
                        <span class="champion_matchup_chart_item_bar_right_container">
                            <span class="champion_matchup_chart_item_bar_right"></span>
                        </span>
                    </div>
                </div>
                <div class="champion_matchup_chart_item_container">
                    <div class="champion_matchup_chart_item">
                        <span class="champion_matchup_chart_item_bar_left_container">
                            <span class="champion_matchup_chart_item_bar_left"></span>
                        </span>
                        <span class="champion_matchup_chart_item_mid">Death</span>
                        <span class="champion_matchup_chart_item_bar_right_container">
                            <span class="champion_matchup_chart_item_bar_right"></span>
                        </span>
                    </div>
                </div>
                <div class="champion_matchup_chart_item_container">
                    <div class="champion_matchup_chart_item">
                        <span class="champion_matchup_chart_item_bar_left_container">
                            <span class="champion_matchup_chart_item_bar_left"></span>
                        </span>
                        <span class="champion_matchup_chart_item_mid">Assist</span>
                        <span class="champion_matchup_chart_item_bar_right_container">
                            <span class="champion_matchup_chart_item_bar_right"></span>
                        </span>
                    </div>
                </div>
                <div class="champion_matchup_chart_item_container">
                    <div class="champion_matchup_chart_item">
                        <span class="champion_matchup_chart_item_bar_left_container">
                            <span class="champion_matchup_chart_item_bar_left"></span>
                        </span>
                        <span class="champion_matchup_chart_item_mid">Gold</span>
                        <span class="champion_matchup_chart_item_bar_right_container">
                            <span class="champion_matchup_chart_item_bar_right"></span>
                        </span>
                    </div>
                </div>
                <div class="champion_matchup_chart_item_container">
                    <div class="champion_matchup_chart_item">
                        <span class="champion_matchup_chart_item_bar_left_container">
                            <span class="champion_matchup_chart_item_bar_left"></span>
                        </span>
                        <span class="champion_matchup_chart_item_mid">CS</span>
                        <span class="champion_matchup_chart_item_bar_right_container">
                            <span class="champion_matchup_chart_item_bar_right"></span>
                        </span>
                    </div>
                </div>
                <div class="champion_matchup_chart_item_container">
                    <div class="champion_matchup_chart_item">
                        <span class="champion_matchup_chart_item_bar_left_container">
                            <span class="champion_matchup_chart_item_bar_left"></span>
                        </span>
                        <span class="champion_matchup_chart_item_mid">FB%</span>
                        <span class="champion_matchup_chart_item_bar_right_container">
                            <span class="champion_matchup_chart_item_bar_right"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="champion_matchup_bottom"></div>
        </div>
    </div>
    <div id="champion_table">
    </div>
</body>
</html>
