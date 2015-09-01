<?php
  require_once('../../api/base.php');
  require_once('../../database/connection.php');
  
  $db = new db_base();
  
  $result = query_all_champions_static();
  $champions = json_decode(query_all_champions_static());
  foreach($champions->data as $champion){
    #var_dump($champion->image);
    #echo "<br>";
  }
  #persistImage($db, $champions);
  #persistInfo($db, $champions);
  #persistPassive($db, $champions);
  #persistLevelTip($db, $champions);
  #persistRecommended($db, $champions);
  #persistSkins($db, $champions);
  #persistStats($db, $champions);
  #persistChampions($db, $champions);
  
  function persistChampions($db, $champions) {
    foreach($champions->data as $champion){
      $id = (int)$champion->id;
      $allytips = addslashes(json_encode($champion->allytips));
      $blurb = 'NULL';
      if(property_exists($champion, 'blurb')){
        $blurb = addslashes($champion->blurb);
      }
      $enemytips = addslashes(json_encode($champion->enemytips));
      $key = addslashes($champion->key);
      $lore = addslashes($champion->lore);
      $name = addslashes($champion->name);
      $partype = addslashes($champion->partype);
      $tags = addslashes(json_encode($champion->tags));
      $title = addslashes($champion->title);
      $query = "INSERT INTO static_ChampionDto (id, allytips, blurb, enemytips, `key`, lore, name, partype, tags, title) VALUES ";
      $query .= "({$id}, '{$allytips}', '{$blurb}', '{$enemytips}', '{$key}', '{$lore}', '{$name}', '{$partype}', '{$tags}', '{$title}')";
      $result = $db->query($query);
    }
  }
  
  function persistImage($db, $champions) {
    foreach($champions->data as $champion){
      $reference_id = (int)$champion->id;
      $imgObj = $champion->image;
      $full = $imgObj->full;
      $sprite = $imgObj->sprite;
      $group = $imgObj->group;
      $x = (int)$imgObj->x;
      $y = (int)$imgObj->y;
      $w = (int)$imgObj->w;
      $h = (int)$imgObj->h;
      $query = "INSERT INTO static_ImageDto (full, `group`, h, sprite, w, x, y, reference_type, reference_id) VALUES ";
      $query .= "('{$full}', '{$group}', {$h}, '{$sprite}', {$w}, {$x}, {$y}, 1, {$reference_id})";
      $result = $db->query($query);
      echo $query;
      echo "<br>";
    }
  }
  
  function persistInfo($db, $champions) {
    foreach($champions->data as $champion){
      $reference_id = (int)$champion->id;
      $info = $champion->info;
      $attack = (int)$info->attack;
      $defense = (int)$info->defense;
      $difficulty = (int)$info->difficulty;
      $magic = (int)$info->magic;
      $query = "INSERT INTO static_InfoDto (attack, defense, difficulty, magic, reference_type, reference_id) VALUES "
                ."({$attack}, {$defense}, {$difficulty}, {$magic}, 1, {$reference_id})";
      $result = $db->query($query);
      echo $query;
      echo '<br>';
    }
  }
  
  function persistPassive($db, $champions){
    $id = 1;
    foreach($champions->data as $champion){
      $reference_id = (int)$champion->id;
      $passive = $champion->passive;
      $description = addslashes($passive->description);
      $image = $passive->image;
      $full = addslashes($image->full);
      $sprite = addslashes($image->sprite);
      $group = addslashes($image->group);
      $x = (int)$image->x;
      $y = (int)$image->y;
      $w = (int)$image->w;
      $h = (int)$image->h;
      $name = addslashes($passive->name);
      $sanitizedDescription = addslashes($passive->sanitizedDescription);
      $query = "INSERT INTO static_ImageDto (full, `group`, h, sprite, w, x, y, reference_type, reference_id) VALUES ";
      $query .= "('{$full}', '{$group}', {$h}, '{$sprite}', {$w}, {$x}, {$y}, 2, {$id})";
      $result = $db->query($query);
      $query2 = "INSERT INTO static_PassiveDto (description, name, sanitizedDescription, id, reference_type, reference_id) VALUES ";
      $query2 .= "('{$description}', '{$name}', '{$sanitizedDescription}', {$id}, 1, {$reference_id})";
      $result2 = $db->query($query2);
      $id++;
    }
  }
  
  function persistRecommended($db, $champions){
    foreach($champions->data as $champion){
      $reference_id = (int)$champion->id;
      $recommended_list = $champion->recommended;
      foreach($recommended_list as $recommended){
        $recommended_blocks = $recommended->blocks;
        $recommended_champion = addslashes($recommended->champion);
        $recommended_map  = addslashes($recommended->map);
        $recommended_mode = addslashes($recommended->mode);
        $recommended_priority = (int)$recommended->priority;
        $recommended_title = addslashes($recommended->title);
        $recommended_type = addslashes($recommended->type);
        $query = "INSERT INTO static_RecommendedDto (id, champion, map, mode, priority, title, type, reference_type, reference_id) VALUES ";
        $query .= "(NULL, '{$recommended_champion}', '{$recommended_map}', '{$recommended_mode}', {$recommended_priority}, '{$recommended_title}', '{$recommended_type}', 1, {$reference_id})";
        $db->query($query);
        $recommended_id = $db->get_insert_id();
        foreach($recommended_blocks as $block){
          $items = [];
          if(property_exists($block, 'items')){
            $items = $block->items;
          }
          $recMath = 'NULL';
          if(property_exists($block, 'recMath')){
            $recMath = (int)$block->recMath;
          }
          $type = 'NULL';
          if(property_exists($block, 'type')){
            $type = addslashes($block->type);
          }
          $query = "INSERT INTO static_BlockDto (id, `type`, recMath, reference_type, reference_id) VALUES";
          $query .= "(NULL, '{$type}', {$recMath}, 1, {$recommended_id})";
          $db->query($query);
          $block_id = $db->get_insert_id();
          foreach($items as $item){
            $count = (int)$item->count;
            $id = (int)$item->id;
            $query = "INSERT INTO static_BlockItemDto (id, count, reference_type, reference_id) VALUES";
            $query .= "(NULL, {$count}, 1, {$block_id})";
            $db->query($query);
          }
        }
      }    
    }
  }
  
  function persistSkins($db, $champions){
    foreach ($champions->data as $champion) {
      $skinList = $champion->skins;
      $reference_id = (int)$champion->id;
      foreach ($skinList as $skin) {
        $name = addslashes($skin->name);
        $num = (int)$skin->num;
        $query = 'INSERT INTO static_SkinDto (id, name, num, reference_id, reference_type) VALUES ';
        $query .= "(NULL, '{$name}', {$num}, {$reference_id},1)";
        $db->query($query);
      }
    } 
  }
  
  function persistSpells($db, $champions){
    foreach ($champions->data as $champion) {
      $champion_id = (int)$champion->id;
      $spells = $champion->spells;
      foreach($spells as $spell) {
        $altimages = [];
        if(property_exists($spell, 'altimages')) {
          $altimages = $spell->altimages;
        }
        $cooldown = json_encode($spell->cooldown);
        $cooldownBurn = $spell->cooldownBurn;
        $cost = json_encode($spell->cost);
        $costBurn = addslashes($spell->costBurn);
        $costType = addslashes($spell->costType);
        $description = addslashes($spell->description);
        $effect = json_encode($spell->effect);
        $effectBurn = json_encode($spell->effectBurn);
        $image = $spell->image;
        $key = addslashes($spell->key);
        $leveltip = $spell->leveltip;
        $maxrank = (int)$spell->maxrank;
        $name = addslashes($spell->name);
        $range = json_encode($spell->range);
        $rangeBurn = addslashes($spell->rangeBurn);
        $resource = '';
        if (property_exists($spell, 'resource')) {
          $resource = addslashes($spell->resource);
        }
        $sanitizedDescription = addslashes($spell->sanitizedDescription);
        $sanitizedTooltip = addslashes($spell->sanitizedTooltip);
        $tooltip = addslashes($spell->tooltip);
        $vars = [];
        if (property_exists($spell,'vars')) {
          $vars = $spell->vars;
        }
        
        //insert into spellDto
        $query = "INSERT INTO static_ChampionSpellDto "
          ."(id, cooldown, cooldownBurn, cost, costBurn, description, effect, effectBurn, `key`, "
          ."maxrank, name, `range`, rangeBurn, resource, sanitizedDescription, sanitizedTooltip, tooltip, reference_type, reference_id) VALUES ";
        $query .= "(NULL, '{$cooldown}', '{$cooldownBurn}', '{$cost}', '{$costBurn}', '{$description}', '{$effect}', '{$effectBurn}', '{$key}', "
          ."{$maxrank}, '{$name}', '{$range}', '{$rangeBurn}', '{$resource}', '{$sanitizedDescription}', '{$sanitizedTooltip}', '{$tooltip}', 1, {$champion_id})";
        $db->query($query);
        $spell_id = $db->get_insert_id();
        
        foreach($altimages as $altimage) {
          $full = $altimage->full;
          $sprite = $altimage->sprite;
          $group = $altimage->group;
          $x = (int)$altimage->x;
          $y = (int)$altimage->y;
          $w = (int)$altimage->w;
          $h = (int)$altimage->h;
          $query = "INSERT INTO static_ImageDto (full, `group`, h, sprite, w, x, y, reference_type, reference_id) VALUES ";
          $query .= "('{$full}', '{$group}', {$h}, '{$sprite}', {$w}, {$x}, {$y}, 4, {$spell_id})";
          $db->query($query);
        }
        
        $full = $image->full;
        $sprite = $image->sprite;
        $group = $image->group;
        $x = (int)$image->x;
        $y = (int)$image->y;
        $w = (int)$image->w;
        $h = (int)$image->h;
        $imageQuery = "INSERT INTO static_ImageDto (full, `group`, h, sprite, w, x, y, reference_type, reference_id) VALUES ";
        $imageQuery .= "('{$full}', '{$group}', {$h}, '{$sprite}', {$w}, {$x}, {$y}, 3, {$spell_id})";
        $db->query($imageQuery);
        
        $lvltipEffect = addslashes(json_encode($leveltip->effect));
        $lvltipLabel = addslashes(json_encode($leveltip->label));
        //insert into leveltip
        $query = "INSERT INTO static_LevelTipDto (id, effect, `label`, reference_type, reference_id) VALUES ";
        $query .= "(NULL, '{$lvltipEffect}', '{$lvltipLabel}', 1, {$spell_id})";
        $db->query($query);
        
        foreach($vars as $var) {
          $varCoeff = json_encode($var->coeff);
          $varDyn = '';
          if (property_exists($var, 'dyn')) {
            $varDyn = addslashes($var->dyn);
          }
          $varKey = addslashes($var->key);
          $varLink = addslashes($var->link);
          $ranksWith = '';
          if (property_exists($var, 'ranksWith')) {
            $ranksWith = addslashes($var->ranksWith);
          }
          //insert into varsDto
          $query = "INSERT INTO static_SpellVarsDto (id, coeff, dyn, `key`, link, ranksWith, reference_type, reference_id) VALUES ";
          $query .= "(NULL, '{$varCoeff}', '{$varDyn}', '{$varKey}', '{$varLink}', '{$ranksWith}', 1, {$spell_id})";
          $db->query($query);
        }
      }
    }
  }
  
  function persistStats($db, $champions){
    foreach ($champions->data as $champion) {
      $stats = $champion->stats;
      $reference_id = (int)$champion->id;
      $armor = $stats->armor;
      $armorperlevel = $stats->armorperlevel;
      $attackdamage = $stats->attackdamage;
      $attackdamageperlevel = $stats->attackdamageperlevel;
      $attackrange = $stats->attackrange;
      $attackspeedoffset = $stats->attackspeedoffset;
      $attackspeedperlevel = $stats->attackspeedperlevel;
      $crit = $stats->crit;
      $critperlevel = $stats->critperlevel;
      $hp = $stats->hp;
      $hpperlevel = $stats->hpperlevel;
      $hpregen = $stats->hpregen;
      $hpregenperlevel = $stats->hpregenperlevel;
      $movespeed = $stats->movespeed;
      $mp = $stats->mp;
      $mpperlevel = $stats->mpperlevel;
      $mpregen = $stats->mpregen;
      $mpregenperlevel = $stats->mpregenperlevel;
      $spellblock = $stats->spellblock;
      $spellblockperlevel = $stats->spellblockperlevel;
      $query = "INSERT INTO static_StatsDto (armor, armorperlevel, attackdamage, attackdamageperlevel, attackrange, attackspeedoffset, attackspeedperlevel, crit, critperlevel, hp, hpperlevel, hpregen, hpregenperlevel, movespeed, mp, mpperlevel, mpregen, mpregenperlevel, spellblock, spellblockperlevel, reference_type, reference_id) VALUES "
      ."({$armor}, {$armorperlevel}, {$attackdamage}, {$attackdamageperlevel}, {$attackrange}, {$attackspeedoffset}, {$attackspeedperlevel}, {$crit}, {$critperlevel}, {$hp}, {$hpperlevel}, {$hpregen}, {$hpregenperlevel}, {$movespeed}, {$mp}, {$mpperlevel}, {$mpregen}, {$mpregenperlevel}, {$spellblock}, {$spellblockperlevel}, 1, {$reference_id})";
      $db->query($query);
    } 
  }
  
  function persistLevelTip($db, $champions) {
    $n = 0;
    $db->query("delete from static_LevelTipDto where 1; ");
    foreach($champions->data as $champion){
      $n++;
      $levelTip = $champion->leveltip;
      $query = "INSERT INTO `static_LevelTipDto`(id, effect, label) VALUES "
                ."({$champion->id}, {$levelTip->effect}, {$levelTip->label})";
      echo $n.'  '.$query;
      $result = $db->query($query);
      echo '<br>';
    }
  }
  
?>