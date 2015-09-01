<?php
$input = "armor	double	
armorperlevel	double	
attackdamage	double	
attackdamageperlevel	double	
attackrange	double	
attackspeedoffset	double	
attackspeedperlevel	double	
crit	double	
critperlevel	double	
hp	double	
hpperlevel	double	
hpregen	double	
hpregenperlevel	double	
movespeed	double	
mp	double	
mpperlevel	double	
mpregen	double	
mpregenperlevel	double	
spellblock	double	
spellblockperlevel	double";

$output = str_replace('double', '', $input);
$output_arr = preg_split('/\s/', $output);
$insert = 'INSERT INTO static_StatsDto (';
foreach($output_arr as $out){
    if(!$out == ''){
       $insert .= $out;
       $insert .= ', ';
    }  
}
$insert .= " VALUES (";

foreach($output_arr as $out){
    if(!$out == ''){
       $insert .= '{$'.$out;
       $insert .= '}'.', ';
    }  
}
echo $insert;


?>