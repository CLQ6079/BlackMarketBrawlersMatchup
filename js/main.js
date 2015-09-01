function draw_role_chart(mid, top, adc, jg, support) {
    $("#champion_stats").append("<canvas id=\"role_chart\" width=\"100\" height=\"100\"></canvas>");
    var data = [
	{
	    value: mid,
	    color:"#009933",
	    highlight:"#00CC33",
	    label: "mid"
	},
	{
	    value: top,
	    color: "#FFCC33",
	    highlight:"#FFCC66",
	    label: "top"
	},
	{
	    value: adc,
	    color: "#CC3300",
	    highlight: "#CC6600",
	    label: "adc"
	},
	{
	    value: jg,
	    color: "#6633CC",
	    highlight: "#6666CC",
	    label: "jg"
	},
	{
	    value: support,
	    color: "#0066FF",
	    highlight:"#0099FF",
	    label: "support"
	}
    ]
    var options = {
	//Boolean - Whether we should show a stroke on each segment
	segmentShowStroke : true,
	
	//String - The colour of each segment stroke
	segmentStrokeColor : "#fff",
	
	//Number - The width of each segment stroke
	segmentStrokeWidth : 2,
	
	//Number - The percentage of the chart that we cut out of the middle
	percentageInnerCutout : 50, // This is 0 for Pie charts
	
	//Number - Amount of animation steps
	animationSteps : 100,
	
	//String - Animation easing effect
	animationEasing : "easeOutBounce",
	
	//Boolean - Whether we animate the rotation of the Doughnut
	animateRotate : true,
	
	//Boolean - Whether we animate scaling the Doughnut from the centre
	animateScale : false,
	
	//String - A legend template
	legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    }
    var ctx = document.getElementById("role_chart").getContext("2d");
    new Chart(ctx).Doughnut(data,options);
}

function clear_role_chart() {
    $("#role_chart").remove();
}

function fillChampionStats(champion) {
	$(".champion_stats_name").html(champion.name);
	$(".champion_stats_title").html(champion.title);
	
	var gameStatsItems = $(".champion_game_stats_item").toArray();
	$(gameStatsItems[0]).html("Win Rate: "+ champion.winrate);
	$(gameStatsItems[1]).html("Average KDA: "+ champion.kda);
	$(gameStatsItems[2]).html("Ban Rate: "+ champion.banrate);
	$(gameStatsItems[3]).html("Popularity: "+ champion.popularity);
	$(gameStatsItems[4]).html("Meta: "+ champion.meta);
	
	var topPartners = $(".top_partners_img").toArray();
	$(topPartners[0]).attr("src", "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/"+champions[champion.top_partners[0]].key+".png");
	$(topPartners[1]).attr("src", "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/"+champions[champion.top_partners[1]].key+".png");
	$(topPartners[2]).attr("src", "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/"+champions[champion.top_partners[2]].key+".png");
	
	var topEnemies = $(".top_enemies_img").toArray();
	$(topEnemies[0]).attr("src", "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/"+champions[champion.top_enemies[0]].key+".png");
	$(topEnemies[1]).attr("src", "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/"+champions[champion.top_enemies[1]].key+".png");
	$(topEnemies[2]).attr("src", "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/"+champions[champion.top_enemies[2]].key+".png");
	
	$("#champion_stats").css("background-image", "url(http://ddragon.leagueoflegends.com/cdn/img/champion/splash/"+champion.key+"_0.jpg");
}

function showMatchup(ids) {
	$(".champion_matchup_blur").show();
	var max = matchups['max'];
	if (ids.length==2) {
	    var left = matchups[ids[0]+","+ids[1]];
	    var right = matchups[ids[1]+","+ids[0]];
	    $(".champion_matchup_champion_img_left_container").append("<img class=\"champion_matchup_champion_img_left\" src=\"" + "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/" + left.key + ".png\" />");
	    $(".champion_matchup_champion_img_right_container").append("<img class=\"champion_matchup_champion_img_right\" src=\"" + "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/" + right.key + ".png\" />");
	    var leftBars = $(".champion_matchup_chart_item_bar_left").toArray();
	    var leftBarsContainers = $(".champion_matchup_chart_item_bar_left_container").toArray();
	    var rightBars = $(".champion_matchup_chart_item_bar_right").toArray();
	    var rightBarsContainers = $(".champion_matchup_chart_item_bar_right_container").toArray();
	    $(leftBars[0]).css("width", String(parseFloat(left.winrate)/parseFloat(max.winrate)*250) +"px");
	    $(leftBarsContainers[0]).prepend("<span class=\"stat\">"+left.winrate+"</span>");
	    $(leftBars[1]).css("width", String(parseFloat(left.kill)/parseFloat(max.kill)*250) +"px");
	    $(leftBarsContainers[1]).prepend("<span class=\"stat\">"+left.kill+"</span>");
	    $(leftBars[2]).css("width", String(parseFloat(left.death)/parseFloat(max.death)*250) +"px");
	    $(leftBarsContainers[2]).prepend("<span class=\"stat\">"+left.death+"</span>");
	    $(leftBars[3]).css("width", String(parseFloat(left.assist)/parseFloat(max.assist)*250) +"px");
	    $(leftBarsContainers[3]).prepend("<span class=\"stat\">"+left.assist+"</span>");
	    $(leftBars[4]).css("width", String(parseFloat(left.gold)/parseFloat(max.gold)*250) +"px");
	    $(leftBarsContainers[4]).prepend("<span class=\"stat\">"+left.gold+"</span>");
	    $(leftBars[5]).css("width", String(parseFloat(left.cs)/parseFloat(max.cs)*250) +"px");
	    $(leftBarsContainers[5]).prepend("<span class=\"stat\">"+left.cs+"</span>");
	    $(leftBars[6]).css("width", String(parseFloat(left.fb)/parseFloat(max.fb)*250) +"px");
	    $(leftBarsContainers[6]).prepend("<span class=\"stat\">"+left.fb+"</span>");
	    $(rightBars[0]).css("width", String(parseFloat(right.winrate)/parseFloat(max.winrate)*250) +"px");
	    $(rightBarsContainers[0]).append("<span class=\"stat\">"+right.winrate+"</span>");
	    $(rightBars[1]).css("width", String(parseFloat(right.kill)/parseFloat(max.kill)*250) +"px");
	    $(rightBarsContainers[1]).append("<span class=\"stat\">"+right.kill+"</span>");
	    $(rightBars[2]).css("width", String(parseFloat(right.death)/parseFloat(max.death)*250) +"px");
	    $(rightBarsContainers[2]).append("<span class=\"stat\">"+right.death+"</span>");
	    $(rightBars[3]).css("width", String(parseFloat(right.assist)/parseFloat(max.assist)*250) +"px");
	    $(rightBarsContainers[3]).append("<span class=\"stat\">"+right.assist+"</span>");
	    $(rightBars[4]).css("width", String(parseFloat(right.gold)/parseFloat(max.gold)*250) +"px");
	    $(rightBarsContainers[4]).append("<span class=\"stat\">"+right.gold+"</span>");
	    $(rightBars[5]).css("width", String(parseFloat(right.cs)/parseFloat(max.cs)*250) +"px");
	    $(rightBarsContainers[5]).append("<span class=\"stat\">"+right.cs+"</span>");
	    $(rightBars[6]).css("width", String(parseFloat(right.fb)/parseFloat(max.fb)*250) +"px");
	    $(rightBarsContainers[6]).append("<span class=\"stat\">"+right.fb+"</span>");
	}
	else{
	    var left1 = matchups[ids[0]+","+ids[2]];
	    var left2 = matchups[ids[0]+","+ids[3]];
	    var left3 = matchups[ids[1]+","+ids[2]];
	    var left4 = matchups[ids[1]+","+ids[3]];
	    var right1 = matchups[ids[2]+","+ids[0]];
	    var right2 = matchups[ids[2]+","+ids[1]];
	    var right3 = matchups[ids[3]+","+ids[0]];
	    var right4 = matchups[ids[3]+","+ids[1]];
	    $(".champion_matchup_champion_img_left_container").append("<img class=\"champion_matchup_champion_img_left\" src=\"" + "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/" + left1.key + ".png\" />");	    
	    $(".champion_matchup_champion_img_left_container").append("<img class=\"champion_matchup_champion_img_left\" src=\"" + "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/" + left3.key + ".png\" />");
	    $(".champion_matchup_champion_img_right_container").append("<img class=\"champion_matchup_champion_img_right\" src=\"" + "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/" + right1.key + ".png\" />");
	    $(".champion_matchup_champion_img_right_container").append("<img class=\"champion_matchup_champion_img_right\" src=\"" + "http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/" + right3.key + ".png\" />");
	    var left = new matchup(
		"",
		String(((parseFloat(left1.winrate)+parseFloat(left2.winrate)+parseFloat(left3.winrate)+parseFloat(left4.winrate))/4).toFixed(1))+"%",
		String(((parseFloat(left1.kill)+parseFloat(left2.kill)+parseFloat(left3.kill)+parseFloat(left4.kill))/4).toFixed(1)),
		String(((parseFloat(left1.death)+parseFloat(left2.death)+parseFloat(left3.death)+parseFloat(left4.death))/4).toFixed(1)),
		String(((parseFloat(left1.assist)+parseFloat(left2.assist)+parseFloat(left3.assist)+parseFloat(left4.assist))/4).toFixed(1)),
		String(((parseFloat(left1.gold)+parseFloat(left2.gold)+parseFloat(left3.gold)+parseFloat(left4.gold))/4).toFixed(0)),
		String(((parseFloat(left1.cs)+parseFloat(left2.cs)+parseFloat(left3.cs)+parseFloat(left4.cs))/4).toFixed(1)),
		String(((parseFloat(left1.fb)+parseFloat(left2.fb)+parseFloat(left3.fb)+parseFloat(left4.fb))/4).toFixed(1))
	    )
	    var right = new matchup(
		"",
		String(((parseFloat(right1.winrate)+parseFloat(right2.winrate)+parseFloat(right3.winrate)+parseFloat(right4.winrate))/4).toFixed(1))+"%",
		String(((parseFloat(right1.kill)+parseFloat(right2.kill)+parseFloat(right3.kill)+parseFloat(right4.kill))/4).toFixed(1)),
		String(((parseFloat(right1.death)+parseFloat(right2.death)+parseFloat(right3.death)+parseFloat(right4.death))/4).toFixed(1)),
		String(((parseFloat(right1.assist)+parseFloat(right2.assist)+parseFloat(right3.assist)+parseFloat(right4.assist))/4).toFixed(1)),
		String(((parseFloat(right1.gold)+parseFloat(right2.gold)+parseFloat(right3.gold)+parseFloat(right4.gold))/4).toFixed(0)),
		String(((parseFloat(right1.cs)+parseFloat(right2.cs)+parseFloat(right3.cs)+parseFloat(right4.cs))/4).toFixed(1)),
		String(((parseFloat(right1.fb)+parseFloat(right2.fb)+parseFloat(right3.fb)+parseFloat(right4.fb))/4).toFixed(1))
	    )
	    var leftBars = $(".champion_matchup_chart_item_bar_left").toArray();
	    var leftBarsContainers = $(".champion_matchup_chart_item_bar_left_container").toArray();
	    var rightBars = $(".champion_matchup_chart_item_bar_right").toArray();
	    var rightBarsContainers = $(".champion_matchup_chart_item_bar_right_container").toArray();
	    $(leftBars[0]).css("width", String(parseFloat(left.winrate)/parseFloat(max.winrate)*250) +"px");
	    $(leftBarsContainers[0]).prepend("<span class=\"stat\">"+left.winrate+"</span>");
	    $(leftBars[1]).css("width", String(parseFloat(left.kill)/parseFloat(max.kill)*250) +"px");
	    $(leftBarsContainers[1]).prepend("<span class=\"stat\">"+left.kill+"</span>");
	    $(leftBars[2]).css("width", String(parseFloat(left.death)/parseFloat(max.death)*250) +"px");
	    $(leftBarsContainers[2]).prepend("<span class=\"stat\">"+left.death+"</span>");
	    $(leftBars[3]).css("width", String(parseFloat(left.assist)/parseFloat(max.assist)*250) +"px");
	    $(leftBarsContainers[3]).prepend("<span class=\"stat\">"+left.assist+"</span>");
	    $(leftBars[4]).css("width", String(parseFloat(left.gold)/parseFloat(max.gold)*250) +"px");
	    $(leftBarsContainers[4]).prepend("<span class=\"stat\">"+left.gold+"</span>");
	    $(leftBars[5]).css("width", String(parseFloat(left.cs)/parseFloat(max.cs)*250) +"px");
	    $(leftBarsContainers[5]).prepend("<span class=\"stat\">"+left.cs+"</span>");
	    $(leftBars[6]).css("width", String(parseFloat(left.fb)/parseFloat(max.fb)*250) +"px");
	    $(leftBarsContainers[6]).prepend("<span class=\"stat\">"+left.fb+"</span>");
	    $(rightBars[0]).css("width", String(parseFloat(right.winrate)/parseFloat(max.winrate)*250) +"px");
	    $(rightBarsContainers[0]).append("<span class=\"stat\">"+right.winrate+"</span>");
	    $(rightBars[1]).css("width", String(parseFloat(right.kill)/parseFloat(max.kill)*250) +"px");
	    $(rightBarsContainers[1]).append("<span class=\"stat\">"+right.kill+"</span>");
	    $(rightBars[2]).css("width", String(parseFloat(right.death)/parseFloat(max.death)*250) +"px");
	    $(rightBarsContainers[2]).append("<span class=\"stat\">"+right.death+"</span>");
	    $(rightBars[3]).css("width", String(parseFloat(right.assist)/parseFloat(max.assist)*250) +"px");
	    $(rightBarsContainers[3]).append("<span class=\"stat\">"+right.assist+"</span>");
	    $(rightBars[4]).css("width", String(parseFloat(right.gold)/parseFloat(max.gold)*250) +"px");
	    $(rightBarsContainers[4]).append("<span class=\"stat\">"+right.gold+"</span>");
	    $(rightBars[5]).css("width", String(parseFloat(right.cs)/parseFloat(max.cs)*250) +"px");
	    $(rightBarsContainers[5]).append("<span class=\"stat\">"+right.cs+"</span>");
	    $(rightBars[6]).css("width", String(parseFloat(right.fb)/parseFloat(max.fb)*250) +"px");
	    $(rightBarsContainers[6]).append("<span class=\"stat\">"+right.fb+"</span>");
	}
	
	$(".champion_matchup").show("bounce", {times:2}, 1000);
	$(".champion_matchup_blur").click(function(){
		$(this).hide();
		$(".champion_matchup_champion_img_left_container").empty();
		$(".champion_matchup_champion_img_right_container").empty();
		$(".stat").remove();
		$(".champion_matchup").hide();
	})
	
}

function detectMatchup() {
	var top = Boolean($( "#champion_slot0" ).attr("data")) && Boolean($( "#champion_slot5" ).attr("data"));
	var mid = Boolean($( "#champion_slot1" ).attr("data")) && Boolean($( "#champion_slot6" ).attr("data"));
	var jg = Boolean($( "#champion_slot2" ).attr("data")) && Boolean($( "#champion_slot7" ).attr("data"));
	var bot = Boolean($( "#champion_slot3" ).attr("data")) &&
		  Boolean($( "#champion_slot4" ).attr("data")) &&
		  Boolean($( "#champion_slot8" ).attr("data")) &&
		  Boolean($( "#champion_slot9" ).attr("data"));
	if (top) {
		$("#matchup_slot0").css("box-shadow", "inset 0 0 10px #fff");
		$("#matchup_slot0").off();
		$("#matchup_slot0").on("click", function() {
			showMatchup([$( "#champion_slot0" ).attr("data"), $( "#champion_slot5" ).attr("data")]);	
		});
	}
	else {
		$("#matchup_slot0").css("box-shadow", "");
		$("#matchup_slot0").off();						  
	}
	if (mid) {
		$("#matchup_slot1").css("box-shadow", "inset 0 0 10px #fff");
		$("#matchup_slot1").off();
		$("#matchup_slot1").on("click", function() {
			showMatchup([$( "#champion_slot1" ).attr("data"), $( "#champion_slot6" ).attr("data")]);
		});
	}
	else {
		$("#matchup_slot1").css("box-shadow", "");
		$("#matchup_slot1").off();						  
	}
	if (jg) {
		$("#matchup_slot2").css("box-shadow", "inset 0 0 10px #fff");
		$("#matchup_slot2").off();
		$("#matchup_slot2").on("click", function() {
			showMatchup([$( "#champion_slot2" ).attr("data"), $( "#champion_slot7" ).attr("data")]);
		});
	}
	else {
		$("#matchup_slot2").css("box-shadow", "");
		$("#matchup_slot2").off();						  
	}
	if (bot) {
		$("#matchup_slot3").css("box-shadow", "inset 0 0 10px #fff");
		$("#matchup_slot3").off();
		$("#matchup_slot3").on("click", function() {
			showMatchup([$( "#champion_slot3" ).attr("data"), $( "#champion_slot4" ).attr("data"), $( "#champion_slot8" ).attr("data"), $( "#champion_slot9" ).attr("data")]);
		});
	}
	else {
		$("#matchup_slot3").css("box-shadow", "");
		$("#matchup_slot3").off();						  
	}
}

function draw_champion_table(){
    var cssClassNames = {
	'headerRow': 'champion_table_header',
	'tableRow': 'champion_table_row',
	'oddTableRow': 'champion_table_row_odd',
	'selectedTableRow': '',
	'hoverTableRow': '',
	'headerCell': '',
	'tableCell': 'champion_table_cell',
	'rowNumberCell': ''};
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Champion');
    data.addColumn('string', '');
    data.addColumn('number', 'Win Rate %');
    data.addColumn('number', 'Popularity %');
    data.addColumn('number', 'Ban Rate %');
    data.addColumn('number', 'KDA');
    data.addColumn('number', 'FB Rate %');
    data.addColumn('number', 'KS Score');
    data.addColumn('number', 'CC ability');
    var champion_data = [];
    var i;
    for (var i in champions) {
	var champion = champions[i].name;
	var img = "<img src=\"http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/"+champions[i].key+".png"+"\" />";
	var winrate = parseFloat(champions[i].winrate);
	var popularity = parseFloat(champions[i].popularity);
	var banrate = parseFloat(champions[i].banrate);
	var kda = parseFloat(champions[i].kda);
	var fb = parseFloat(champions[i].fb);
	var ks = parseFloat((2008/champions[i].ks*100).toFixed(2));
	var cc = parseFloat((champions[i].cc/2672*100).toFixed(2));
	champion_data.push([champion, img, winrate, popularity, banrate, kda, fb, ks, cc]);
    }
    data.addRows(champion_data);

    var table = new google.visualization.Table(document.getElementById('champion_table'));

    table.draw(data, {allowHtml:true, width: '100%', height: '100%', 'cssClassNames': cssClassNames});
}

$(document).ready(function () {
	$( ".champion_img").draggable({revert:'invalid',
				       helper: 'clone'});
	$( ".champion_slot" ).droppable({
	    accept: ".champion_img",
	    activeClass: "ui-state-hover",
	    hoverClass: "ui-state-active",
	    drop: function( event, ui ) {
		$(this).attr("src", ui.draggable.attr("src"));
		$(this).attr("data", ui.draggable.attr("data"));
		detectMatchup();
            }
        });
	
	$( ".champion_slot" ).dblclick(function() {
		$(this).attr("src", "img/champion_slot.png");
		$(this).removeAttr("data");
		detectMatchup();
	});
	
	$(function() {
		$( "#champion_stats" ).dialog({
		  autoOpen: false,
		  closeOnEscape: true,
		  width: 560,
		  height: 380,
		  show: {
		    effect: "blind",
		    duration: 1000
		  },
		  hide: {
		    effect: "explode",
		    duration: 1000
		  }
		});
 
		$( ".champion_slot" ).click(function() {
			if ($(this).attr("data")) {
			    var id = $(this).attr("data");
			    champion = champions[id];
			    fillChampionStats(champion);
			    $( "#champion_stats" ).dialog( "open" );
			    draw_role_chart(champion.role_distribution[0],
					    champion.role_distribution[1],
					    champion.role_distribution[2],
					    champion.role_distribution[3],
					    champion.role_distribution[4]);
			    $( ".ui-dialog" ).blur(function() {
				$('#champion_stats').dialog( "close" );
				clear_role_chart();
			    }); 
			}
		});
	});
	
	google.setOnLoadCallback(draw_champion_table);
});

